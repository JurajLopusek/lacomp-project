<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Najkratšia trasa – Slovensko</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite('resources/css/app.css')
</head>
<body class="h-screen w-screen overflow-hidden bg-gray-50 text-gray-900 font-sans flex flex-col">

<div class="flex flex-1 overflow-hidden relative">

    <!-- ═══ SIDEBAR ═══════════════════════════════════════════ -->
    <aside class="sidebar-panel w-[400px] min-w-[400px] bg-white flex flex-col shadow-[2px_0_8px_rgba(0,0,0,0.1)] overflow-hidden z-5 transition-all duration-300 ease-in-out" id="sidebar">

        <!-- ── TOP PANE: zadávanie miest ── -->
        <div class="flex flex-col flex-1 min-h-0">
            <div class="flex-1 overflow-y-auto p-[18px_16px_8px]">

                <!-- HOME -->
                <div class="mb-[14px]">
                    <div class="text-[0.78em] font-bold uppercase tracking-[0.06em] text-emerald-900 mb-[6px] border-b-2 border-emerald-200 pb-[3px]">Domovské / štartové mesto</div>
                    <div class="flex items-center gap-[6px] mb-[6px]">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center text-lg font-bold text-white bg-emerald-900">🏠</span>
                        <input type="text" id="homeCity" class="w-full px-[10px] py-2 border border-gray-300 rounded-md text-[0.93em] transition-colors focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100" placeholder="napr. Bratislava" />
                    </div>
                </div>

                <!-- WAYPOINTS -->
                <div class="mb-[14px]">
                    <div class="text-[0.78em] font-bold uppercase tracking-[0.06em] text-emerald-900 mb-[6px] border-b-2 border-emerald-200 pb-[3px]">
                        Zastávky <span id="wpCounter" class="font-normal text-gray-600">(0 / 20)</span>
                    </div>
                    <div id="waypointsList" class="mb-[6px]"></div>
                    <button class="w-full py-[7px] px-2 bg-emerald-50 border-[1.5px] border-dashed border-emerald-600 rounded-md text-emerald-900 text-[0.88em] cursor-pointer mb-[14px] hover:bg-emerald-100 disabled:opacity-45 disabled:cursor-default" id="addWpBtn" onclick="addWaypoint()">＋ Pridať zastávku</button>
                </div>

                <!-- RESULT -->
                <div>
                    <!-- placeholder keď ešte nie sú výsledky -->
                    <div class="result-placeholder flex flex-col items-center justify-center h-full min-h-[120px] text-gray-400 text-[0.88em] gap-2 text-center" id="resultPlaceholder">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Trasa sa zobrazí tu<br>po výpočte
                    </div>

                    <!-- výsledok -->
                    <div class="result-section" id="resultSection">
                        <div class="text-[0.78em] font-bold uppercase tracking-[0.06em] text-emerald-900 mb-1 border-b-2 border-emerald-200 pb-[3px]">Výsledok trasy</div>
                        <div class="summary-box bg-emerald-50 border border-emerald-200 rounded-lg p-3 mb-2 text-[0.9em]" id="summaryBox"></div>
                        <div id="modifiedBanner" style="display:none;" class="items-center justify-between gap-2 bg-amber-50 border border-amber-300 rounded-md px-3 py-2 mb-2 text-[0.82em]">
                            <span class="text-amber-900">⚠ Poradie ručne upravené</span>
                            <button class="bg-amber-600 text-white px-2 py-1 rounded text-[0.92em] hover:bg-amber-700 whitespace-nowrap cursor-pointer" onclick="restoreOriginal()" title="Vrátiť na poradie odporúčané algoritmom">↻ Obnoviť optimum</button>
                        </div>
                        <ul class="route-list" id="routeList"></ul>
                        <button class="text-[0.8em] text-gray-600 bg-transparent border-0 cursor-pointer p-[2px_4px] underline flex-shrink-0 block mx-auto mb-2 hover:text-red-700" onclick="resetAll()">↺ Resetovať</button>
                    </div>
                </div>

            </div><!-- /pane-scroll -->

            <!-- calc button + progress + status -->
            <div class="flex-shrink-0">
                <button class="flex items-center justify-center gap-2 w-[calc(100%-32px)] mx-4 my-2 py-3 px-3 bg-gradient-to-br from-emerald-900 to-emerald-600 text-white border-0 rounded-lg font-bold cursor-pointer transition-opacity hover:opacity-90 disabled:bg-gray-500 disabled:cursor-default disabled:opacity-100" id="calcBtn" onclick="calculateRoute()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Vypočítať najkratšiu trasu
                </button>
                <div class="progress-wrap bg-emerald-100 rounded h-[5px] overflow-hidden mx-4 mb-2 flex-shrink-0" id="progressWrap">
                    <div class="progress-fill h-full transition-all duration-300" id="progressFill" style="width:0%;background:#27ae60"></div>
                </div>
                <div class="status-bar mx-4 mb-3 py-[9px] px-3 rounded-lg text-[0.87em] flex-shrink-0" id="statusBar">
                    <div class="spinner"></div>
                    <span id="statusText"></span>
                </div>
            </div><!-- /pane-actions -->
        </div><!-- /pane-top -->


    </aside><!-- /sidebar -->

    <!-- TOGGLE BUTTON -->
    <button class="sidebar-toggle fixed left-[400px] top-1/2 -translate-y-1/2 z-[9999] bg-emerald-900 text-white border-0 rounded-r-lg w-[26px] h-16 cursor-pointer flex items-center justify-center text-xl font-bold shadow-lg hover:bg-emerald-800 select-none" id="sidebarToggle" onclick="toggleSidebar()" title="Skryť / zobraziť panel">‹</button>

    <!-- ═══ MAIN AREA (header + map) ══════════════════════════════ -->
    <div class="main-area flex-1 flex flex-col overflow-hidden">
        <header class="bg-gradient-to-br from-emerald-900 to-emerald-600 text-white px-6 py-[14px] flex items-center gap-3 flex-shrink-0 shadow-lg z-10">
            <div>
                <h1 class="text-[1.4em] font-bold">🗺 Najkratšia trasa – Slovensko</h1>
                <p class="text-[0.85em] opacity-85">Zadajte mestá a vypočítajte optimálnu trasu</p>
            </div>
        </header>
        <!-- ═══ MAP ════════════════════════════════════════════ -->
        <div id="map" class="flex-1"></div>
    </div><!-- /main-area -->
</div><!-- /layout -->

<!-- Mobile Responsive & Animation Styles -->
<style>
    .sidebar-toggle {
        transition: left 0.3s ease, background-color 0.15s;
    }

    .sidebar-panel {
        transition: width 0.3s ease, min-width 0.3s ease;
    }

    .sidebar-panel.collapsed {
        width: 0 !important;
        min-width: 0 !important;
    }

    .progress-fill {
        background: #27ae60;
    }

    .status-bar {
        display: none;
    }

    .status-bar.loading {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff8e1;
        color: #7d5a00;
        border: 1px solid #ffe082;
    }

    .status-bar.error {
        display: block;
        background: #fdecea;
        color: #b71c1c;
        border: 1px solid #f5c6c6;
    }

    .spinner {
        width: 18px;
        height: 18px;
        border: 3px solid #ffe082;
        border-top-color: #f59e0b;
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
        flex-shrink: 0;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .progress-wrap {
        display: none;
    }

    .progress-wrap.show {
        display: block;
    }

    .result-section {
        display: none;
    }

    .result-section.visible {
        display: block;
    }

    .route-list li.draggable {
        cursor: grab;
    }

    .route-list li.dragging {
        opacity: 0.3;
        background: #f9f9f9;
    }

    .route-list li.drag-over {
        border-top: 2px solid #27ae60;
        background: #f0faf4;
    }

    .drag-handle {
        font-size: 1.15em;
        color: #aaa;
        flex-shrink: 0;
        padding: 6px 6px 6px 2px;
        margin: -6px 0;
        cursor: grab;
        line-height: 1;
    }

    .route-list li.draggable {
        touch-action: none;
        user-select: none;
        -webkit-user-select: none;
        -webkit-touch-callout: none;
    }

    .route-list li.dragging,
    .route-list li.dragging .drag-handle {
        cursor: grabbing;
    }

    .drag-handle-ph {
        width: 14px;
        flex-shrink: 0;
    }

    .summary-box .row {
        display: flex;
        justify-content: space-between;
        padding: 3px 0;
    }

    .summary-box .row strong {
        color: #155d30;
    }

    .route-list {
        list-style: none;
    }

    .route-list li {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 7px 0;
        border-bottom: 1px solid #eee;
        font-size: 0.88em;
    }

    .route-list li:last-child {
        border-bottom: none;
    }

    .step-num {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75em;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .step-num.start {
        background: #155d30;
    }

    .step-num.end {
        background: #c0392b;
    }

    .step-num.mid {
        background: #27ae60;
    }

    .leg-info {
        margin-left: auto;
        font-size: 0.82em;
        color: #666;
        white-space: nowrap;
    }

    .result-placeholder svg {
        opacity: 0.35;
    }

    /* Badge dots */

    .btn-remove {
        background: #fde8e8;
        border: 1px solid #f5c6c6;
        color: #c0392b;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        font-size: 0.95em;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-remove:hover {
        background: #f5c6c6;
    }

    /* Mobile Responsive */
    @media (max-width: 700px) {
        .sidebar-panel {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100% !important;
            min-width: unset !important;
            height: 100%;
            z-index: 2000;
            transform: translateX(0);
            transition: transform 0.3s ease !important;
        }

        .sidebar-panel.collapsed {
            width: 100% !important;
            min-width: unset !important;
            transform: translateX(-100%) !important;
        }

        .sidebar-toggle {
            left: auto !important;
            right: 14px !important;
            top: 10px !important;
            transform: none !important;
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
            font-size: 20px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.45) !important;
        }

        header {
            padding: 10px 66px 10px 16px;
            min-height: 56px;
        }

        header h1 {
            font-size: 1.05em;
        }

        header p {
            display: none;
        }

        #homeCity,
        input[type="text"].solo {
            font-size: 16px;
        }
    }
</style>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/lunys-route-optimizer.js') }}"></script>
</body>
</html>

