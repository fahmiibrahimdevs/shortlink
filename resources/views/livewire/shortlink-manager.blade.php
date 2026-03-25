<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 space-y-10 relative z-10">
    <!-- Glow behind the manager -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-3xl bg-cyan-600/10 blur-[100px] pointer-events-none rounded-full"></div>

    <!-- Header & Form -->
    <div class="relative bg-[#0b1120]/80 backdrop-blur-xl border border-cyan-500/30 shadow-[0_0_20px_rgba(6,182,212,0.15)] rounded-2xl p-8 md:p-10 flex flex-col items-center text-center overflow-hidden">
        
        <!-- Corner Accents -->
        <div class="absolute top-0 left-0 w-16 h-16 border-t-2 border-l-2 border-cyan-400 opacity-50 rounded-tl-2xl"></div>
        <div class="absolute bottom-0 right-0 w-16 h-16 border-b-2 border-r-2 border-fuchsia-400 opacity-50 rounded-br-2xl"></div>

        <h2 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-fuchsia-500 tracking-widest uppercase mb-4 drop-shadow-[0_0_10px_rgba(6,182,212,0.5)]">
            SYSTEM.SHORTLINK
        </h2>
        <p class="text-cyan-100/60 max-w-lg mb-8 text-sm uppercase tracking-widest">
            Initialize compression protocol. Input coordinates below.
        </p>

        @if (session()->has('success'))
            <div class="w-full bg-green-900/30 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg relative mb-6 backdrop-blur-sm shadow-[0_0_10px_rgba(34,197,94,0.2)]" role="alert">
                <span class="block sm:inline tracking-wider">{{ session('success') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="createShortlink" class="w-full max-w-3xl relative flex items-center group">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-fuchsia-500 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
            
            <input 
                type="url" 
                wire:model="original_url" 
                placeholder="ENTER.TARGET.URL [HTTPS://...]" 
                class="relative w-full rounded-full border border-cyan-500/30 bg-[#060b14]/90 text-cyan-50 focus:border-cyan-400 focus:ring focus:ring-cyan-500/30 shadow-inner py-5 pl-8 pr-40 text-lg transition duration-300 placeholder-cyan-700/50 uppercase font-mono tracking-wider"
                required
            >
            <button 
                type="submit" 
                class="absolute right-2 top-2 bottom-2 bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-500 hover:to-cyan-400 text-[#050b14] font-bold py-2 px-8 rounded-full transition-all duration-300 ease-out shadow-[0_0_15px_rgba(6,182,212,0.4)] hover:shadow-[0_0_25px_rgba(6,182,212,0.6)] hover:scale-105 uppercase tracking-widest text-sm"
            >
                <div class="flex items-center gap-2">
                    <svg wire:loading.remove wire:target="createShortlink" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <svg wire:loading wire:target="createShortlink" class="animate-spin -ml-1 mr-2 h-4 w-4 text-[#050b14]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="createShortlink">Execute</span>
                    <span wire:loading wire:target="createShortlink">Processing</span>
                </div>
            </button>
        </form>
        @error('original_url') 
            <span class="text-fuchsia-400 text-sm mt-3 uppercase tracking-widest drop-shadow-[0_0_5px_rgba(232,121,249,0.8)]"><span class="font-bold mr-2">ERR:</span>{{ $message }}</span> 
        @enderror
    </div>

    <!-- Links Matrix -->
    <div class="relative bg-[#0b1120]/80 backdrop-blur-xl border border-cyan-900/50 shadow-[0_4px_30px_rgba(0,0,0,0.5)] sm:rounded-2xl overflow-hidden group">
        <!-- Hover edge lighting -->
        <div class="absolute top-0 w-full h-[1px] bg-gradient-to-r from-transparent via-cyan-500/50 to-transparent"></div>
        
        <div class="px-8 py-6 border-b border-cyan-900/50 flex justify-between items-center bg-[#060b14]/50">
            <h3 class="text-lg font-bold text-cyan-400 tracking-widest uppercase flex items-center gap-3">
                <svg class="w-5 h-5 text-cyan-500 drop-shadow-[0_0_5px_rgba(6,182,212,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Data Vault
            </h3>
            <span class="bg-cyan-950/50 border border-cyan-500/30 text-cyan-300 text-xs font-mono px-3 py-1 rounded shadow-[0_0_10px_rgba(6,182,212,0.1)]">
                ENTRIES: {{ str_pad($links->count(), 4, '0', STR_PAD_LEFT) }}
            </span>
        </div>
        
        @if ($links->isEmpty())
            <div class="p-16 text-center text-cyan-800 flex flex-col items-center">
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-cyan-500/20 blur-xl rounded-full"></div>
                    <svg class="relative w-20 h-20 text-cyan-700/50 drop-shadow-[0_0_15px_rgba(6,182,212,0.2)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                    </svg>
                </div>
                <p class="text-xl font-mono tracking-widest text-cyan-600/70">NO DATA FOUND</p>
                <p class="text-xs uppercase mt-2 text-cyan-800">Awaiting URL input to generate hash</p>
            </div>
        @else
            <ul class="divide-y divide-cyan-900/30 bg-[#080d18]/50">
                @foreach ($links as $link)
                    <li class="p-6 transition-all duration-300 hover:bg-cyan-900/20 group relative overflow-hidden">
                        <!-- Scanline hover effect -->
                        <div class="absolute left-0 top-0 h-full w-[2px] bg-cyan-400 opacity-0 group-hover:opacity-100 group-hover:shadow-[0_0_15px_rgba(6,182,212,1)] transition-opacity"></div>
                        
                        <div class="flex items-center justify-between ml-4">
                            <div class="truncate pr-4 flex-1">
                                <a 
                                    href="{{ url($link->short_code) }}" 
                                    target="_blank" 
                                    class="inline-flex items-center gap-2 text-fuchsia-400 font-bold text-xl hover:text-fuchsia-300 transition-colors drop-shadow-[0_0_8px_rgba(232,121,249,0.3)] hover:drop-shadow-[0_0_12px_rgba(232,121,249,0.6)] mb-1 font-mono tracking-wide"
                                >
                                    {{ url($link->short_code) }}
                                    <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 group-hover:-translate-y-1 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <p class="text-sm text-cyan-200/50 truncate font-mono tracking-tight" title="{{ $link->original_url }}">
                                    >> {{ $link->original_url }}
                                </p>
                                <div class="flex items-center gap-6 mt-4 text-xs font-mono text-cyan-500/70 uppercase">
                                    <span class="flex items-center gap-2 bg-[#050b14] border border-cyan-800/50 px-3 py-1.5 rounded shadow-[inset_0_0_10px_rgba(0,0,0,0.5)]">
                                        <svg class="w-3.5 h-3.5 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        {{ str_pad($link->clicks, 3, '0', STR_PAD_LEFT) }} HITS
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        T-{{ $link->created_at->diffForHumans(null, true, true) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 pr-2">
                                <button
                                    x-data="{ 
                                        copied: false,
                                        copyToClipboard(text) {
                                            if (navigator.clipboard && window.isSecureContext) {
                                                navigator.clipboard.writeText(text);
                                            } else {
                                                let textArea = document.createElement('textarea');
                                                textArea.value = text;
                                                textArea.style.position = 'fixed';
                                                textArea.style.left = '-999999px';
                                                textArea.style.top = '-999999px';
                                                document.body.appendChild(textArea);
                                                textArea.focus();
                                                textArea.select();
                                                try {
                                                    document.execCommand('copy');
                                                } catch (err) {
                                                    console.error('Failed to copy text: ', err);
                                                }
                                                textArea.remove();
                                            }
                                            this.copied = true;
                                            setTimeout(() => this.copied = false, 2000);
                                        }
                                    }"
                                    @click="copyToClipboard('{{ url($link->short_code) }}')"
                                    class="flex items-center gap-2 text-cyan-500 hover:text-cyan-300 bg-cyan-950/30 hover:bg-cyan-900/50 border border-cyan-900/50 hover:border-cyan-500/50 px-4 py-2.5 rounded-xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(6,182,212,0.3)] font-mono uppercase text-xs tracking-wider"
                                >
                                    <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span x-show="!copied">Copy Link</span>

                                    <svg x-show="copied" style="display: none;" class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span x-show="copied" style="display: none;" class="text-green-400">Copied!</span>
                                </button>
                                
                                <button 
                                    wire:click="deleteLink({{ $link->id }})"
                                    wire:confirm="PURGE RECORD? This action cannot be undone."
                                    class="text-red-500 hover:text-red-400 bg-red-950/30 hover:bg-red-900/50 border border-red-900/50 hover:border-red-500/50 p-2.5 rounded-xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(239,68,68,0.3)]"
                                    title="PURGE LINK"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
