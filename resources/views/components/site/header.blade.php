<header
    x-data="{ menuOpen: false }"
    x-init="$watch('menuOpen', v => document.body.style.overflowY = v ? 'hidden' : '')"
    class="fixed top-0 left-0 right-0 z-50"
>
    {{-- Desktop Nav --}}
    <nav class="mx-auto max-w-5xl px-6 py-4">
        <div class="flex items-center justify-between rounded-2xl border border-border/50 bg-surface/80 px-6 py-3 shadow-sm backdrop-blur-xl dark:border-cyan-500/10 dark:bg-[#0a0a0a]/90 dark:backdrop-blur-none dark:shadow-[0_0_20px_rgba(0,245,255,0.03)]">
            {{-- Logo --}}
            <a href="/" class="font-heading text-xl tracking-tight text-body dark:text-dark-body transition-colors hover:text-brand-cyan">
                Alberto Rosas
            </a>

            {{-- Desktop Links --}}
            <div class="hidden sm:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['name' => 'About', 'href' => '/about'],
                        ['name' => 'Blog', 'href' => '/blog'],
                        ['name' => 'Now', 'href' => '/now'],
                        ['name' => 'Uses', 'href' => '/uses'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a
                        href="{{ $link['href'] }}"
                        @class([
                            'relative px-4 py-2 text-sm font-body transition-all duration-200',
                            'text-brand-cyan font-medium' => request()->is(ltrim($link['href'], '/')),
                            'text-muted hover:text-body dark:text-dark-muted dark:hover:text-dark-body' => !request()->is(ltrim($link['href'], '/')),
                        ])
                        @if(request()->is(ltrim($link['href'], '/')))
                            aria-current="page"
                        @endif
                        style="font-variation-settings: 'wght' {{ request()->is(ltrim($link['href'], '/')) ? '600' : '400' }};"
                        onmouseenter="this.style.fontVariationSettings='\'wght\' 600'"
                        onmouseleave="this.style.fontVariationSettings='\'wght\' {{ request()->is(ltrim($link['href'], '/')) ? '600' : '400' }}'"
                    >
                        {{ $link['name'] }}
                        @if(request()->is(ltrim($link['href'], '/')))
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 rounded-full bg-brand-cyan"></span>
                        @endif
                    </a>
                @endforeach

                {{-- Dark mode toggle --}}
                <button
                    @click="darkMode = !darkMode; document.documentElement.classList.add('transitioning-colors'); setTimeout(() => document.documentElement.classList.remove('transitioning-colors'), 300)"
                    class="ml-2 p-2 rounded-lg text-muted hover:text-body dark:text-dark-muted dark:hover:text-dark-body transition-colors"
                    aria-label="Toggle dark mode"
                >
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                </button>
            </div>

            {{-- Mobile hamburger --}}
            <button
                @click="menuOpen = !menuOpen"
                class="sm:hidden p-2 rounded-lg text-muted hover:text-body dark:text-dark-muted dark:hover:text-dark-body"
                aria-label="Toggle menu"
            >
                <svg x-show="!menuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="menuOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Full-Screen Overlay --}}
    <div
        x-show="menuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="menuOpen = false"
        class="fixed inset-0 z-40 flex flex-col items-center justify-center gap-8 bg-surface/95 backdrop-blur-xl dark:bg-dark-surface/95 sm:hidden"
    >
        @foreach ([['/', 'Home'], ['/about', 'About'], ['/blog', 'Blog'], ['/now', 'Now'], ['/uses', 'Uses']] as [$href, $name])
            <a
                href="{{ $href }}"
                @click="menuOpen = false"
                class="font-heading text-3xl tracking-tight transition-colors {{ request()->is(ltrim($href, '/') ?: '/') ? 'text-brand-cyan' : 'text-body dark:text-dark-body hover:text-brand-cyan' }}"
            >
                {{ $name }}
            </a>
        @endforeach

        {{-- Mobile dark mode toggle --}}
        <button
            @click="darkMode = !darkMode"
            class="mt-4 p-3 rounded-full border border-border dark:border-dark-border text-muted dark:text-dark-muted"
            aria-label="Toggle dark mode"
        >
            <svg x-show="!darkMode" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
            <svg x-show="darkMode" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
        </button>
    </div>
</header>
