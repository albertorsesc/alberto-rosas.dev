{{-- Hero — cybernetic, not corporate --}}
<section id="home" class="relative min-h-[90vh] flex items-center justify-center pt-24 pb-16 px-6 overflow-hidden">

    {{-- Animated gradient background --}}
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-surface dark:to-dark-surface z-10"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] md:w-[800px] md:h-[800px] rounded-full bg-gradient-to-r from-cyan-500/10 via-purple-500/5 to-fuchsia-500/10 dark:from-cyan-500/20 dark:via-purple-500/10 dark:to-fuchsia-500/20 blur-[100px] animate-pulse-slow"></div>
    </div>

    <div class="mx-auto max-w-5xl w-full">
        <div class="flex flex-col items-center text-center">

            {{-- Photo with glow ring --}}
            <div class="hero-element relative mb-8">
                <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-cyan-500 via-purple-500 to-fuchsia-500 opacity-30 dark:opacity-50 blur-md animate-pulse-slow"></div>
                <div class="relative scan-lines rounded-full">
                    <img
                        src="https://avatars.githubusercontent.com/u/22654040?v=4"
                        alt="Alberto Rosas"
                        width="160"
                        height="160"
                        class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover ring-2 ring-white/20 dark:ring-white/10"
                        loading="eager"
                        fetchpriority="high"
                    />
                </div>
            </div>

            {{-- Greeting --}}
            <p
                x-data="{
                    greeting: '',
                    init() {
                        const h = new Date().getHours();
                        this.greeting = h < 12 ? 'Buenos d\u00edas' : h < 18 ? 'Buenas tardes' : 'Buenas noches';
                    }
                }"
                class="hero-element text-fluid-sm text-brand-cyan font-mono mb-6 tracking-wider uppercase"
            ><span class="text-brand-cyan/60">//</span> <span x-text="greeting"></span><span class="typing-cursor"></span></p>

            {{-- Name --}}
            <h1 class="hero-element font-heading text-fluid-hero text-body dark:text-dark-body tracking-tight leading-[1.05] mb-6 glitch-hover neon-glow" data-text="Alberto Rosas">
                Alberto Rosas
            </h1>

            {{-- Tagline --}}
            <p class="hero-element text-fluid-xl text-body dark:text-dark-body leading-snug max-w-2xl mb-4 font-medium">
                Consider everything. Believe nothing. <span class="text-brand-cyan">Build anyway.</span>
            </p>
            <p class="hero-element text-fluid-base text-muted dark:text-dark-muted leading-relaxed max-w-lg mb-10">
                AI Engineer &middot; Founder of TRIAGE Ops &middot; Obsidian Ronin
            </p>

            {{-- CTAs --}}
            <div class="hero-element flex flex-col sm:flex-row items-center gap-4 mb-10">
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-2 px-8 py-4 rounded-full bg-gradient-to-r from-cyan-500 to-cyan-600 text-white font-medium text-fluid-sm shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all duration-300 hover:-translate-y-0.5"
                >
                    Let's Build Something
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>

                <a
                    href="/resume_alberto_rosas.pdf"
                    download
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-white/10 dark:border-white/10 text-body dark:text-dark-body font-medium text-fluid-sm hover:border-brand-cyan/50 hover:text-brand-cyan transition-all duration-300 hover:-translate-y-0.5 backdrop-blur-sm"
                >
                    Grab My Resume
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
            </div>

            {{-- Social Links --}}
            <div class="hero-element flex items-center gap-5">
                <a href="https://www.linkedin.com/in/albertorsesc" target="_blank" rel="noopener noreferrer" class="p-2.5 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-all duration-300 hover:-translate-y-1" aria-label="LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <a href="https://github.com/albertorsesc" target="_blank" rel="noopener noreferrer" class="p-2.5 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-all duration-300 hover:-translate-y-1" aria-label="GitHub">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                </a>
                <a href="https://x.com/bcryp7" target="_blank" rel="noopener noreferrer" class="p-2.5 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-all duration-300 hover:-translate-y-1" aria-label="X (Twitter)">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
