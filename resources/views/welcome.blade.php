@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    @include('components.site.intro')

    <!-- As above, so below. As within, so without. -->
    <div class="synthwave-divider mx-auto max-w-lg my-4"></div>

    {{-- Identity Cards --}}
    <section class="py-16 px-6">
        <div class="mx-auto max-w-5xl">
            <p class="hero-element text-center text-sm font-mono uppercase tracking-[0.25em] text-brand-cyan/60 dark:text-brand-cyan/80 mb-12 neon-glow">Five lives. One person.</p>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                {{-- ROW 1: Engineer (4) + Ronin (4) + Architect (4) --}}

                {{-- THE ENGINEER -- terminal-like, compact --}}
                <div class="identity-card gradient-border col-span-1 md:col-span-4 group cursor-pointer circuit-bg" data-reveal data-hermetic="eye">
                    <a href="/about" class="absolute inset-0 z-10 rounded-bento" aria-label="Read about The Engineer"></a>
                    <div class="flex flex-col h-full justify-between relative">
                        <div>
                            <p class="text-xs font-mono uppercase tracking-widest text-cyan-600 dark:text-cyan-400 mb-3">// The Engineer</p>
                            <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">
                                <span class="text-cyan-500 dark:text-cyan-400 font-mono">&gt; </span>AI systems that ship to production.
                            </h3>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag">Python</span>
                            <span class="tag">LangGraph</span>
                            <span class="tag">RAG</span>
                            <span class="tag">MCP</span>
                            <span class="tag">Neo4j</span>
                            <span class="tag">Qdrant</span>
                        </div>
                    </div>
                    <span class="absolute bottom-6 right-6 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity text-sm font-mono">&rarr;</span>
                </div>

                {{-- THE RONIN -- Giant Mushin kanji as hero --}}
                <a href="https://obsidianronin.substack.com" target="_blank" rel="noopener noreferrer" class="identity-card gradient-border gradient-border-amber col-span-1 md:col-span-4 flex flex-col items-center justify-center text-center group sacred-geo-bg" data-reveal data-hermetic="caduceus">
                    <p class="text-xs font-mono uppercase tracking-widest text-amber-600 dark:text-amber-400 mb-2">// The Ronin</p>
                    <p class="font-heading text-7xl md:text-8xl text-amber-600 dark:text-amber-400 leading-none select-none neon-text-amber mb-3" aria-hidden="true">&#28961;&#24515;</p>
                    <p class="text-xs font-mono text-amber-600/70 dark:text-amber-400/70 tracking-widest uppercase">Mushin &middot; No-Mind</p>
                    <span class="text-sm font-mono text-amber-600 dark:text-amber-400 mt-4 opacity-0 group-hover:opacity-100 transition-opacity">Substack &rarr;</span>
                </a>

                {{-- THE ARCHITECT -- cyberpunk gradient bg fill --}}
                <a href="https://elarquitecto.ai" target="_blank" rel="noopener noreferrer" class="identity-card gradient-border gradient-border-cyber col-span-1 md:col-span-4 group scan-lines cyber-gradient-bg" data-reveal>
                    <div class="relative flex flex-col h-full justify-between">
                        <div>
                            <p class="text-xs font-mono uppercase tracking-widest text-purple-600 dark:text-purple-400 mb-3">// The Architect</p>
                            <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-2 neon-text-purple">El Arquitecto A.I.</h3>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">
                                Democratizing AI in Spanish. For builders across Latin America.
                            </p>
                        </div>
                        <span class="text-sm font-mono text-purple-600 dark:text-purple-400 mt-4 opacity-0 group-hover:opacity-100 transition-opacity">elarquitecto.ai &rarr;</span>
                    </div>
                </a>

                {{-- ROW 2: Father (4) + Rider (8) --}}

                {{-- THE FATHER -- warm, simple, amber accent --}}
                <div class="identity-card gradient-border gradient-border-amber col-span-1 md:col-span-4" data-reveal>
                    <p class="text-xs font-mono uppercase tracking-widest text-amber-600/80 dark:text-amber-400/80 mb-4">// The Father</p>
                    <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-3 italic">"The best technology serves people, not the other way around."</h3>
                    <p class="text-xs font-mono text-amber-600/60 dark:text-amber-400/60">Mexico &bull; Bicultural &bull; Bilingual</p>
                </div>

                {{-- THE RIDER -- split layout, glowing 4:20 --}}
                <div class="identity-card gradient-border col-span-1 md:col-span-8" data-reveal>
                    <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                        <div class="flex-1">
                            <p class="text-xs font-mono uppercase tracking-widest text-muted dark:text-dark-muted mb-3">// The Rider</p>
                            <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-2">Discipline is architecture, not motivation.</h3>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">
                                Harley Davidson Forty-Eight 1200cc. Katana owner. Martial arts. The discipline is operational infrastructure.
                            </p>
                        </div>
                        <div class="shrink-0 text-center">
                            <p class="font-heading text-6xl md:text-7xl text-cyan-500 dark:text-cyan-400 leading-none neon-text">4:20</p>
                            <p class="text-[10px] font-mono text-cyan-600/60 dark:text-cyan-400/60 mt-2 tracking-widest uppercase">Every morning</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="synthwave-divider mx-auto max-w-lg my-4"></div>

    {{-- Experiments --}}
    <section class="py-16 px-6">
        <div class="mx-auto max-w-5xl">
            <p class="text-sm font-mono uppercase tracking-[0.25em] text-brand-cyan/60 dark:text-brand-cyan/80 mb-8 neon-glow"><span class="text-brand-cyan">&gt;</span> experiments<span class="typing-cursor"></span></p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="https://github.com/albertorsesc/knowledge-curator-pipeline" target="_blank" rel="noopener noreferrer" class="bento-card group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-600 dark:text-cyan-400">MCP Server</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">Knowledge Curator Pipeline</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Turns articles into distilled knowledge notes in an Obsidian vault.</p>
                </a>

                <a href="https://github.com/albertorsesc/soundmind" target="_blank" rel="noopener noreferrer" class="bento-card group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-600 dark:text-cyan-400">Python</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">SoundMind</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Psychoacoustic masking, brainwave entrainment, NLP-patterned affirmations.</p>
                </a>

                <a href="https://github.com/albertorsesc/pain-discovery" target="_blank" rel="noopener noreferrer" class="bento-card group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-600 dark:text-cyan-400">Python</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">Pain Discovery</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Scrapes X, HN, Reddit to analyze posts and surface business opportunities.</p>
                </a>

                <a href="https://github.com/albertorsesc/ai-cli" target="_blank" rel="noopener noreferrer" class="bento-card group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-600 dark:text-cyan-400">Python</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">AI CLI</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Interactive command-line app for news headlines with AI-powered Q&A.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    @include('components.site.contact')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap === 'undefined') return;

        // Hero staggered entrance
        const heroElements = document.querySelectorAll('.hero-element');
        if (heroElements.length) {
            gsap.set(heroElements, { opacity: 0, y: 40, scale: 0.95 });
            gsap.to(heroElements, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.9,
                stagger: 0.15,
                ease: 'power3.out',
                delay: 0.2,
            });
        }

        // Identity cards entrance with ScrollTrigger
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            const cards = document.querySelectorAll('.identity-card');
            cards.forEach((card, i) => {
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 90%',
                        once: true,
                    },
                    opacity: 0,
                    y: 60,
                    scale: 0.95,
                    duration: 0.9,
                    delay: (i % 3) * 0.15,
                    ease: 'power3.out',
                });
            });
        }
    });
</script>
@endpush
