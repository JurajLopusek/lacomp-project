<div>
  <h3 class="text-xl font-bold text-slate-900 mb-1">Napíšte nám správu</h3>
  <p class="text-slate-500 text-sm mb-7">Vyplňte formulár a ozveme sa vám najneskôr do jedného pracovného dňa.</p>

  <form wire:submit.prevent="send" method="post" class="flex flex-col gap-5">

    <div>
      <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
        Meno <span class="text-red-500">*</span>
      </label>
      <input type="text" id="name" wire:model.live="name"
             placeholder="Ján Novák"
             autocomplete="name"
             class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#d42020]/30 focus:border-[#d42020] transition-all @error('name') border-red-400 bg-red-50 @enderror" />
      @error('name')
        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
        E-mail <span class="text-red-500">*</span>
      </label>
      <input type="email" id="email" wire:model.live="email"
             placeholder="jan.novak@email.sk"
             autocomplete="email"
             class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#d42020]/30 focus:border-[#d42020] transition-all @error('email') border-red-400 bg-red-50 @enderror" />
      @error('email')
        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="message" class="block text-sm font-semibold text-slate-700 mb-1.5">
        Správa <span class="text-red-500">*</span>
      </label>
      <textarea id="message" rows="5" wire:model.live="message"
                placeholder="Popíšte, s čím potrebujete pomôcť alebo na čo sa chcete opýtať…"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#d42020]/30 focus:border-[#d42020] transition-all resize-none @error('message') border-red-400 bg-red-50 @enderror"></textarea>
      @error('message')
        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label class="block text-sm font-semibold text-slate-700 mb-1.5">Príloha</label>
      <label for="file-upload"
             class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-dashed border-slate-300 bg-slate-50 cursor-pointer hover:border-[#d42020] hover:bg-red-50 transition-all @error('photo') border-red-400 bg-red-50 @enderror">
        <svg class="w-5 h-5 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
        </svg>
        <span class="text-sm text-slate-500">
          @if($photo)
            <span class="text-slate-800 font-medium">{{ $photoName }}</span>
          @else
            Kliknite pre výber súboru
          @endif
        </span>
      </label>
      <input id="file-upload" type="file" wire:model="photo" class="hidden">
      @error('photo')
        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit"
            class="flex items-center justify-center gap-2 w-full bg-[#d42020] text-white font-semibold py-3 px-6 rounded-xl hover:bg-[#b31c1c] hover:-translate-y-0.5 transition-all duration-200">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
      </svg>
      Odoslať správu
    </button>

  </form>

  @if(session()->has('success'))
    <div class="mt-5 flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800">
      <svg class="w-5 h-5 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      <div>
        <strong class="block text-sm font-bold">Správa bola odoslaná!</strong>
        <span class="text-xs text-emerald-700">Ozveme sa vám najneskôr do jedného pracovného dňa.</span>
      </div>
    </div>
  @endif

  @if(session()->has('error'))
    <div class="mt-5 flex items-center gap-3 px-5 py-4 bg-red-50 border border-red-200 rounded-xl text-red-800">
      <svg class="w-5 h-5 text-red-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span class="text-sm">{{ session('error') }}</span>
    </div>
  @endif
</div>
