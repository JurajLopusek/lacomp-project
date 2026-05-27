/* ════════════════════════════════════════════════════════════
   MAP SETUP
════════════════════════════════════════════════════════════ */
const map = L.map('map', { zoomControl: true }).setView([48.72, 19.5], 7);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

let routeLayer    = null;
let markerGroup   = L.layerGroup().addTo(map);
let currentOrdered = null;  // ordered coords after last calculation
let dragSrcIdx    = null;   // index in currentOrdered being dragged
let originalOrdered = null; // snapshot poradia z čerstvého TSP (na obnovenie po DnD)
let originalOsrmRoute = null; // a aj jeho OSRM geometria (cache → bez API volania)

/* ════════════════════════════════════════════════════════════
   WAYPOINT UI
════════════════════════════════════════════════════════════ */
let wpSeq = 0;   // ever-increasing ID
let wpCount = 0; // current count

function addWaypoint() {
  if (wpCount >= 20) return;
  wpSeq++;
  wpCount++;
  updateWpCounter();

  const list = document.getElementById('waypointsList');
  const div  = document.createElement('div');
  div.className = 'flex items-center gap-[6px] mb-[6px]';
  div.id = `wp-${wpSeq}`;
  div.innerHTML = `
    <span class="wp-badge w-7 h-7 rounded-full flex items-center justify-center text-[0.78em] font-bold text-white bg-green-200 flex-shrink-0">${wpCount}</span>
    <input type="text" placeholder="napr. Žilina" class="w-full px-[10px] py-2 border border-gray-300 rounded-md text-[0.93em] transition-colors focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100" />
    <button onclick="removeWaypoint(${wpSeq})" title="Odstrániť" class="flex-shrink-0 flex items-center justify-center w-[26px] h-[26px] rounded-full bg-red-50 border border-red-200 text-red-600 hover:bg-red-100 cursor-pointer text-[0.95em]">✕</button>
  `;
  list.appendChild(div);
  document.getElementById('addWpBtn').disabled = wpCount >= 20;
}

function removeWaypoint(id) {
  const el = document.getElementById(`wp-${id}`);
  if (el) { el.remove(); wpCount--; }
  document.getElementById('addWpBtn').disabled = false;
  // Re-number badges
  document.querySelectorAll('#waypointsList .wp-badge').forEach((b, i) => {
    b.textContent = i + 1;
  });
  updateWpCounter();
}

function updateWpCounter() {
  document.getElementById('wpCounter').textContent = `(${wpCount} / 20)`;
}

/* ════════════════════════════════════════════════════════════
   HELPERS
════════════════════════════════════════════════════════════ */
const sleep = ms => new Promise(r => setTimeout(r, ms));

function setStatus(msg, type = 'loading') {
  const bar = document.getElementById('statusBar');
  bar.className = `status-bar ${type}`;
  if (type === 'error') {
    bar.innerHTML = `⚠️ ${msg}`;
  } else {
    bar.innerHTML = `<div class="spinner"></div><span id="statusText">${msg}</span>`;
  }
}

function setProgress(pct) {
  const wrap = document.getElementById('progressWrap');
  wrap.style.display = 'block';
  document.getElementById('progressFill').style.width = pct + '%';
}

function hideStatus() {
  document.getElementById('statusBar').className   = 'status-bar';
  document.getElementById('progressWrap').style.display = 'none';
}

function formatDuration(sec) {
  const h = Math.floor(sec / 3600);
  const m = Math.floor((sec % 3600) / 60);
  return h > 0 ? `${h} h ${m} min` : `${m} min`;
}

function formatDist(m) {
  return m >= 1000 ? `${(m / 1000).toFixed(1)} km` : `${Math.round(m)} m`;
}

/* ════════════════════════════════════════════════════════════
   GEOCODING  (Photon by Komoot – OpenStreetMap data, Slovakia bbox)
════════════════════════════════════════════════════════════ */
async function geocode(name) {
  // Location bias: centre of Slovakia + bounding box
  // Photon supports lang: en, de, fr, it
  const url = `https://photon.komoot.io/api/?q=${encodeURIComponent(name + ' Slovensko')}`
    + `&limit=5&lang=en&lat=48.7&lon=19.5&zoom=8`;

  const res  = await fetch(url);
  if (!res.ok) throw new Error(`Geokódovanie zlyhalo (HTTP ${res.status}).`);
  const data = await res.json();

  if (!data.features || data.features.length === 0)
    throw new Error(`Miesto „${name}" sa nenašlo na Slovensku.`);

  // Prefer results inside Slovakia
  const sk = data.features.find(f =>
    f.properties.countrycode === 'SK' ||
    f.properties.country === 'Slovakia' ||
    f.properties.country === 'Slovensko'
  ) || data.features[0];

  const p   = sk.properties;
  const display = [p.name, p.street, p.city || p.town || p.village, p.state, p.country]
    .filter(Boolean).join(', ');
  const [lng, lat] = sk.geometry.coordinates;

  return { name, display, lat, lng };
}

/* ════════════════════════════════════════════════════════════
   OSRM  – duration matrix
════════════════════════════════════════════════════════════ */
async function getDurationMatrix(coords) {
  const pts = coords.map(c => `${c.lng},${c.lat}`).join(';');
  const url = `https://router.project-osrm.org/table/v1/driving/${pts}?annotations=duration`;
  const res  = await fetch(url);
  const data = await res.json();
  if (data.code !== 'Ok')
    throw new Error('Chyba pri získavaní matice cestovných časov (OSRM).');
  return data.durations;   // NxN, seconds
}

/* ════════════════════════════════════════════════════════════
   OSRM  – actual route + geometry
════════════════════════════════════════════════════════════ */
async function getRoute(coords) {
  const pts = coords.map(c => `${c.lng},${c.lat}`).join(';');
  const url = `https://router.project-osrm.org/route/v1/driving/${pts}`
    + `?overview=full&geometries=geojson&steps=false`;
  const res  = await fetch(url);
  const data = await res.json();
  if (data.code !== 'Ok')
    throw new Error('Chyba pri načítaní trasy z OSRM.');
  return data.routes[0];
}

/* ════════════════════════════════════════════════════════════
   TSP  – Nearest Neighbour  (fixed start/end)
════════════════════════════════════════════════════════════ */
function nearestNeighbour(matrix, startIdx, endIdx) {
  const n = matrix.length;
  const intermediates = [];
  for (let i = 0; i < n; i++)
    if (i !== startIdx && i !== endIdx) intermediates.push(i);

  const route    = [startIdx];
  const remaining = [...intermediates];

  while (remaining.length > 0) {
    const last = route[route.length - 1];
    let bestI = 0, bestD = Infinity;
    remaining.forEach((city, i) => {
      const d = matrix[last][city];
      if (d !== null && d < bestD) { bestD = d; bestI = i; }
    });
    route.push(remaining[bestI]);
    remaining.splice(bestI, 1);
  }

  route.push(endIdx);
  return route;
}

/* ════════════════════════════════════════════════════════════
   TSP  – 2-opt improvement  (start and end stay fixed)
════════════════════════════════════════════════════════════ */
function twoOpt(route, matrix) {
  const n = route.length;
  let improved = true;
  let iterations = 0;

  while (improved && iterations < 150) {
    improved = false;
    iterations++;
    // Only permute indices 1 … n-2  (keep 0 and n-1 fixed)
    for (let i = 1; i < n - 2; i++) {
      for (let j = i + 1; j < n - 1; j++) {
        const d_before = (matrix[route[i-1]][route[i]] ?? Infinity)
                       + (matrix[route[j]][route[j+1]] ?? Infinity);
        const d_after  = (matrix[route[i-1]][route[j]] ?? Infinity)
                       + (matrix[route[i]][route[j+1]] ?? Infinity);
        if (d_after < d_before - 0.1) {
          // Reverse segment [i..j]
          let l = i, r = j;
          while (l < r) {
            [route[l], route[r]] = [route[r], route[l]];
            l++; r--;
          }
          improved = true;
        }
      }
    }
  }
  return route;
}

/* ════════════════════════════════════════════════════════════
   TSP  – Or-opt  (presúva 1 zastávku na najlepšiu pozíciu)
   Často nájde zlepšenia ktoré 2-opt minul (napr. zlý NN štart).
════════════════════════════════════════════════════════════ */
function orOpt(route, matrix) {
  let improved = true;
  let iterations = 0;

  while (improved && iterations < 100) {
    improved = false;
    iterations++;
    const n = route.length;

    // Skúšame relokovať mesto na pozícii i ∈ [1, n-2]  (0 a n-1 = domov, fixné)
    for (let i = 1; i < n - 1; i++) {
      const a = route[i - 1], b = route[i], c = route[i + 1];
      const cab = matrix[a][b], cbc = matrix[b][c], cac = matrix[a][c];
      if (cab == null || cbc == null || cac == null) continue;
      // Zisk po odstránení b z (a,b,c)
      const removeGain = cab + cbc - cac;

      let bestJ = -1, bestDelta = -1e-6;  // požaduj aspoň malé zlepšenie

      // Skús vložiť b za pozíciu j ∈ [0, n-2]
      for (let j = 0; j < n - 1; j++) {
        if (j === i - 1 || j === i) continue;   // no-op pozície
        const x = route[j], y = route[j + 1];
        const cxy = matrix[x][y], cxb = matrix[x][b], cby = matrix[b][y];
        if (cxy == null || cxb == null || cby == null) continue;
        const insertCost = cxb + cby - cxy;
        const delta = insertCost - removeGain;     // celková zmena ceny
        if (delta < bestDelta) { bestDelta = delta; bestJ = j; }
      }

      if (bestJ >= 0) {
        // Aplikuj presun
        const [city] = route.splice(i, 1);
        const insertAt = bestJ < i ? bestJ + 1 : bestJ;
        route.splice(insertAt, 0, city);
        improved = true;
        break;   // reštartuj outer loop s novou trasou
      }
    }
  }
  return route;
}

/* ════════════════════════════════════════════════════════════
   TSP  – Held-Karp DP  (exact optimum, ideálne pre N ≤ 12)
   Pamäť: 2^(N-1) × (N-1) × 8 B    (pre N=11 to je ~80 KB)
════════════════════════════════════════════════════════════ */
function heldKarp(matrix) {
  const n = matrix.length;
  if (n < 3) return null;          // špeciálne prípady riešené inde
  const m = n - 1;                 // medziľahlé mestá (1..n-1)
  const states = 1 << m;
  const allMask = states - 1;
  const INF = Infinity;

  // dp[mask*m + i] = min cena: štart 0 → navštívené mestá v mask → koniec v meste (i+1)
  const dp = new Float64Array(states * m);
  dp.fill(INF);
  const parent = new Int8Array(states * m);
  parent.fill(-1);

  // Bázový krok: len jedno mesto navštívené, priamo z domova
  for (let i = 0; i < m; i++) {
    const c = matrix[0][i + 1];
    if (c != null) dp[(1 << i) * m + i] = c;
  }

  // Iteruj cez podmnožiny
  for (let mask = 1; mask <= allMask; mask++) {
    for (let i = 0; i < m; i++) {
      if (!(mask & (1 << i))) continue;
      const cur = dp[mask * m + i];
      if (cur === INF) continue;
      const from = i + 1;
      for (let j = 0; j < m; j++) {
        if (mask & (1 << j)) continue;
        const c = matrix[from][j + 1];
        if (c == null) continue;
        const nm = mask | (1 << j);
        const nc = cur + c;
        const idx = nm * m + j;
        if (nc < dp[idx]) { dp[idx] = nc; parent[idx] = i; }
      }
    }
  }

  // Pridaj návrat domov a vyber najlepšie posledné mesto
  let bestEnd = -1, bestCost = INF;
  for (let i = 0; i < m; i++) {
    const back = matrix[i + 1][0];
    if (back == null) continue;
    const total = dp[allMask * m + i] + back;
    if (total < bestCost) { bestCost = total; bestEnd = i; }
  }
  if (bestEnd === -1) return null; // nedosiahnuteľná konfigurácia

  // Rekonštrukcia cesty
  const path = [];
  let mask = allMask, cur = bestEnd;
  while (cur !== -1) {
    path.push(cur + 1);
    const p = parent[mask * m + cur];
    mask ^= (1 << cur);
    cur = p;
  }
  path.reverse();
  return [0, ...path, 0];
}

/* ════════════════════════════════════════════════════════════
   Helper – spočítaj celkový čas trasy podľa matice
════════════════════════════════════════════════════════════ */
function routeCost(route, matrix) {
  let s = 0;
  for (let i = 0; i < route.length - 1; i++) {
    const c = matrix[route[i]][route[i + 1]];
    if (c == null) return Infinity;
    s += c;
  }
  return s;
}

/* ════════════════════════════════════════════════════════════
   MAIN  – calculateRoute
════════════════════════════════════════════════════════════ */
async function calculateRoute() {
  const homeName = document.getElementById('homeCity').value.trim();

  if (!homeName) {
    setStatus('Zadajte domovské / štartové mesto.', 'error');
    return;
  }

  const wpInputs = document.querySelectorAll('#waypointsList input[type="text"]');
  const wpNames  = Array.from(wpInputs)
    .map(i => i.value.trim())
    .filter(n => n.length > 0);

  if (wpNames.length === 0) {
    setStatus('Pridajte aspoň jednu zastávku.', 'error');
    return;
  }

  const calcBtn = document.getElementById('calcBtn');
  calcBtn.disabled = true;

  try {
    /* ── 1. GEOCODING ── */
    const allNames = [homeName, ...wpNames];
    const coords   = [];

    for (let i = 0; i < allNames.length; i++) {
      setStatus(`Hľadám polohu: ${allNames[i]} (${i+1}/${allNames.length})…`);
      setProgress(Math.round((i / allNames.length) * 40));
      const c = await geocode(allNames[i]);
      coords.push(c);
      // Small delay to be respectful to the free API
      if (i < allNames.length - 1) await sleep(300);
    }

    setProgress(50);

    /* ── 2. TSP – kruhová trasa (štart = cieľ = domov) ── */
    let orderedIdxs;

    if (coords.length === 2) {
      // Domov + 1 zastávka → domov
      orderedIdxs = [0, 1, 0];
    } else {
      setStatus('Vypočítavam maticu cestovných časov…');
      const matrix = await getDurationMatrix(coords);
      setProgress(70);

      if (coords.length <= 11) {
        // Malá inštancia → Held-Karp DP = garantované optimum
        setStatus('Hľadám optimálne poradie (exact)…');
        orderedIdxs = heldKarp(matrix);
        if (!orderedIdxs) {
          // Fallback ak boli nedosiahnuteľné uzly (null v matici)
          let route = nearestNeighbour(matrix, 0, 0);
          route = twoOpt(route, matrix);
          route = orOpt(route, matrix);
          orderedIdxs = route;
        }
      } else {
        // Väčšia inštancia → heuristika: NN + striedavo 2-opt & Or-opt
        setStatus('Optimalizujem poradie zastávok…');
        let route = nearestNeighbour(matrix, 0, 0);
        let prevCost = Infinity;
        let cost = routeCost(route, matrix);
        let cycles = 0;
        while (cost < prevCost - 0.001 && cycles < 10) {
          prevCost = cost;
          route = twoOpt(route, matrix);
          route = orOpt(route, matrix);
          cost = routeCost(route, matrix);
          cycles++;
        }
        orderedIdxs = route;
      }
      setProgress(85);
    }

    /* ── 3. GET ROUTE GEOMETRY ── */
    setStatus('Načítavam trasu…');
    const ordered   = orderedIdxs.map(i => coords[i]);
    const osrmRoute = await getRoute(ordered);
    setProgress(100);

    /* ── Snapshot pôvodného (TSP-optimálneho) poradia na obnovenie ── */
    originalOrdered   = [...ordered];
    originalOsrmRoute = osrmRoute;

    /* ── 4. DISPLAY ── */
    hideStatus();
    displayResult(ordered, osrmRoute);

  } catch (err) {
    setStatus(err.message, 'error');
    document.getElementById('progressWrap').style.display = 'none';
  } finally {
    calcBtn.disabled = false;
  }
}

/* ════════════════════════════════════════════════════════════
   DISPLAY
════════════════════════════════════════════════════════════ */
function displayResult(ordered, osrmRoute, fitMap = true) {
  currentOrdered = ordered;
  // Clear map
  markerGroup.clearLayers();
  if (routeLayer) { map.removeLayer(routeLayer); routeLayer = null; }

  // Draw polyline
  routeLayer = L.geoJSON(osrmRoute.geometry, {
    style: { color: '#27ae60', weight: 5, opacity: .85 }
  }).addTo(map);

  // Markers – domov sa zobrazí len raz (konečné miesto má rovnaké súradnice)
  ordered.forEach((c, idx) => {
    const isReturn = idx === ordered.length - 1;
    if (isReturn) return; // preskočiť duplikát domovského markera

    const isHome  = idx === 0;
    const color   = isHome ? '#155d30' : '#27ae60';
    const label   = isHome ? '🏠' : String(idx);
    const fsize   = isHome ? '15px' : '13px';

    const icon = L.divIcon({
      className: '',
      html: `<div style="
        background:${color};color:#fff;border-radius:50%;
        width:30px;height:30px;
        display:flex;align-items:center;justify-content:center;
        font-weight:700;font-size:${fsize};
        border:3px solid #fff;
        box-shadow:0 2px 6px rgba(0,0,0,.35)
      ">${label}</div>`,
      iconSize: [30, 30],
      iconAnchor: [15, 15]
    });

    L.marker([c.lat, c.lng], { icon })
      .bindPopup(`<strong>${c.name}</strong><br><small>${c.display}</small>`)
      .addTo(markerGroup);
  });

  if (fitMap) map.fitBounds(routeLayer.getBounds(), { padding: [40, 40] });

  // Summary
  const totalSec  = osrmRoute.duration;
  const totalDist = osrmRoute.distance;
  const legs      = osrmRoute.legs || [];

  document.getElementById('summaryBox').innerHTML = `
    <div class="row"><span>🕐 Celkový čas:</span>   <strong>${formatDuration(totalSec)}</strong></div>
    <div class="row"><span>📏 Celková vzdialenosť:</span> <strong>${formatDist(totalDist)}</strong></div>
    <div class="row"><span>📍 Počet zastávok:</span>  <strong>${ordered.length - 2}</strong></div>
  `;

  // Route list
  const ul = document.getElementById('routeList');
  ul.innerHTML = '';

  // DnD hint (only when there are moveable stops)
  const hintEl = document.getElementById('dndHint');
  if (hintEl) hintEl.style.display = ordered.length > 3 ? '' : 'none';

  ordered.forEach((c, idx) => {
    const isHome      = idx === 0;
    const isReturn    = idx === ordered.length - 1;
    const isDraggable = !isHome && !isReturn;
    const cls         = (isHome || isReturn) ? 'start' : 'mid';
    const label       = (isHome || isReturn) ? '🏠' : String(idx);
    const cityName    = isReturn ? `↩ Návrat: ${c.name}` : c.name;

    let legInfo = '';
    if (legs[idx]) {
      legInfo = `<span class="leg-info">${formatDist(legs[idx].distance)} · ${formatDuration(legs[idx].duration)}</span>`;
    }

    const li = document.createElement('li');
    li.innerHTML = `
      ${isDraggable ? '<span class="drag-handle">⠿</span>' : '<span class="drag-handle-ph"></span>'}
      <span class="step-num ${cls}">${label}</span>
      <span>${cityName}</span>
      ${legInfo}
    `;

    if (isDraggable) {
      li.classList.add('draggable');
      li.draggable = true;

      li.addEventListener('dragstart', e => {
        dragSrcIdx = idx;
        e.dataTransfer.effectAllowed = 'move';
        setTimeout(() => li.classList.add('dragging'), 0);
      });
      li.addEventListener('dragend', () => {
        li.classList.remove('dragging');
        ul.querySelectorAll('li').forEach(el => el.classList.remove('drag-over'));
      });
      li.addEventListener('dragover', e => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        ul.querySelectorAll('li').forEach(el => el.classList.remove('drag-over'));
        li.classList.add('drag-over');
      });
      li.addEventListener('dragleave', () => li.classList.remove('drag-over'));
      li.addEventListener('drop', e => {
        e.preventDefault();
        li.classList.remove('drag-over');
        const toIdx = idx;
        if (dragSrcIdx === null || dragSrcIdx === toIdx) return;
        // Reorder: move item from dragSrcIdx to toIdx (home at 0 and last stay fixed)
        const arr = [...currentOrdered];
        const [moved] = arr.splice(dragSrcIdx, 1);
        arr.splice(toIdx, 0, moved);
        dragSrcIdx = null;
        currentOrdered = arr;
        reloadRoute();
      });

      /* ── TOUCH (mobil) — drag začne hneď po dotyku, ťahaním sa presúva ── */
      let touchDragging = false;

      li.addEventListener('touchstart', e => {
        if (e.touches.length !== 1) return;
        touchDragging = true;
        dragSrcIdx = idx;
        li.classList.add('dragging');
      }, { passive: true });

      li.addEventListener('touchmove', e => {
        if (!touchDragging) return;
        e.preventDefault(); // blokuj scroll, robíme drag
        const t = e.touches[0];
        const overEl = document.elementFromPoint(t.clientX, t.clientY);
        const overLi = overEl ? overEl.closest('li') : null;
        ul.querySelectorAll('li').forEach(el => el.classList.remove('drag-over'));
        if (overLi && overLi !== li && ul.contains(overLi) && overLi.classList.contains('draggable')) {
          overLi.classList.add('drag-over');
        }
      }, { passive: false });

      li.addEventListener('touchend', () => {
        if (!touchDragging) return;
        touchDragging = false;
        li.classList.remove('dragging');
        const dropEl = ul.querySelector('li.drag-over');
        ul.querySelectorAll('li').forEach(el => el.classList.remove('drag-over'));
        if (!dropEl) { dragSrcIdx = null; return; }
        const toIdx = Array.from(ul.children).indexOf(dropEl);
        if (toIdx < 0 || dragSrcIdx === toIdx) { dragSrcIdx = null; return; }
        const arr = [...currentOrdered];
        const [moved] = arr.splice(dragSrcIdx, 1);
        arr.splice(toIdx, 0, moved);
        dragSrcIdx = null;
        currentOrdered = arr;
        reloadRoute();
      });

      li.addEventListener('touchcancel', () => {
        touchDragging = false;
        li.classList.remove('dragging');
        ul.querySelectorAll('li').forEach(el => el.classList.remove('drag-over'));
        dragSrcIdx = null;
      });
    }

    ul.appendChild(li);
  });

  document.getElementById('resultPlaceholder').style.display = 'none';
  document.getElementById('resultSection').classList.add('visible');
  updateModifiedBanner();
}

/* ════════════════════════════════════════════════════════════
   ORIGINAL-ORDER RESTORE
════════════════════════════════════════════════════════════ */
function isOrderModified() {
  if (!originalOrdered || !currentOrdered) return false;
  if (originalOrdered.length !== currentOrdered.length) return false;
  for (let i = 0; i < originalOrdered.length; i++) {
    if (originalOrdered[i].name !== currentOrdered[i].name) return true;
  }
  return false;
}

function updateModifiedBanner() {
  const banner = document.getElementById('modifiedBanner');
  if (!banner) return;
  banner.style.display = isOrderModified() ? 'flex' : 'none';
}

function restoreOriginal() {
  if (!originalOrdered || !originalOsrmRoute) return;
  // Pôvodný OSRM výsledok je nacacheovaný — žiadne nové API volanie
  displayResult([...originalOrdered], originalOsrmRoute, false);
}

/* ════════════════════════════════════════════════════════════
   RELOAD ROUTE  (po manuálnom DnD preusporiadaní)
════════════════════════════════════════════════════════════ */
async function reloadRoute() {
  const calcBtn = document.getElementById('calcBtn');
  calcBtn.disabled = true;
  setStatus('Aktualizujem trasu…');
  try {
    const osrmRoute = await getRoute(currentOrdered);
    hideStatus();
    displayResult(currentOrdered, osrmRoute, false); // neposun mapu
  } catch (err) {
    setStatus(err.message, 'error');
  } finally {
    calcBtn.disabled = false;
  }
}

/* ════════════════════════════════════════════════════════════
   SIDEBAR TOGGLE
════════════════════════════════════════════════════════════ */
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const btn     = document.getElementById('sidebarToggle');
  const isMobile = window.matchMedia('(max-width: 700px)').matches;
  const isNowCollapsed = sidebar.classList.toggle('collapsed');

  if (!isMobile) {
    btn.style.left = isNowCollapsed ? '0px' : '360px';
  } else {
    // Mobil: tlačidlo zostáva vpravo hore, CSS riadi polohu
    btn.style.left = '';
    btn.style.right = '';
  }
  btn.textContent = isNowCollapsed ? '›' : '‹';
  btn.title       = isNowCollapsed ? 'Zobraziť panel' : 'Skryť panel';
  setTimeout(() => map.invalidateSize(), 320);
}

/* ════════════════════════════════════════════════════════════
   RESET
════════════════════════════════════════════════════════════ */
function resetAll() {
  document.getElementById('homeCity').value = '';
  document.getElementById('waypointsList').innerHTML = '';
  wpCount = 0;
  updateWpCounter();
  document.getElementById('addWpBtn').disabled = false;
  document.getElementById('resultSection').classList.remove('visible');
  document.getElementById('resultPlaceholder').style.display = '';
  document.getElementById('summaryBox').innerHTML = '';
  document.getElementById('routeList').innerHTML = '';
  markerGroup.clearLayers();
  if (routeLayer) { map.removeLayer(routeLayer); routeLayer = null; }
  currentOrdered = null;
  originalOrdered = null;
  originalOsrmRoute = null;
  dragSrcIdx = null;
  const banner = document.getElementById('modifiedBanner');
  if (banner) banner.style.display = 'none';
  hideStatus();
  addWaypoint(); // vždy jedna zastávka na začiatku
}

// Jedna zastávka hneď pri načítaní stránky
addWaypoint();

