@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    @include('components.site.intro')

    <!-- As above, so below. As within, so without. -->
    <div class="synthwave-divider mx-auto max-w-lg my-4"></div>

    {{-- The Engineer --}}
    <section class="py-16 px-6">
        <div class="mx-auto max-w-5xl">
            <p class="hero-element text-center font-mono text-xs uppercase tracking-widest text-cyan-700 dark:text-cyan-400 mb-12"><span class="text-brand-cyan/50">//</span> what I do</p>

            <div class="identity-card gradient-border group circuit-bg" data-reveal data-hermetic="eye">
                <a href="/about" class="absolute inset-0 z-10 rounded-bento" aria-label="Read about The Engineer"></a>
                <div class="relative flex flex-col gap-8 md:flex-row md:gap-12">

                    {{-- Left: identity + headline --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">The Engineer</p>
                        <h2 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4 leading-tight">
                            Agents for systems where being wrong has consequences.
                        </h2>
                        <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-3">
                            12+ years in software, 5+ in production AI. Agentic workflows, tool-calling, retrieval pipelines, NL2SQL engines. Judged on eval scores and uptime, not demos.
                        </p>
                        <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-6">
                            Earlier years in cybersecurity automation (SIEM, IDS/IPS, SOAR) shape how I design for safety in everything I ship now.
                        </p>

                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="tag">Python</span>
                            <span class="tag">LangGraph</span>
                            <span class="tag">MCP</span>
                            <span class="tag">RAG</span>
                            <span class="tag">GraphRAG</span>
                            <span class="tag">Qdrant</span>
                            <span class="tag">Neo4j</span>
                            <span class="tag">RAGAS</span>
                            <span class="tag">Langfuse</span>
                            <span class="tag">FastAPI</span>
                        </div>

                    </div>

                    {{-- Right: stats grid --}}
                    <div class="md:w-72 shrink-0">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl border border-border dark:border-dark-border bg-surface-alt dark:bg-dark-surface-alt px-4 py-3">
                                <p class="font-heading text-2xl text-cyan-700 dark:text-cyan-400 neon-text leading-none">12+</p>
                                <p class="text-[10px] font-mono uppercase tracking-widest text-muted dark:text-dark-muted mt-2">Years in software</p>
                            </div>
                            <div class="rounded-xl border border-border dark:border-dark-border bg-surface-alt dark:bg-dark-surface-alt px-4 py-3">
                                <p class="font-heading text-2xl text-cyan-700 dark:text-cyan-400 neon-text leading-none">5+</p>
                                <p class="text-[10px] font-mono uppercase tracking-widest text-muted dark:text-dark-muted mt-2">Years in production AI</p>
                            </div>
                            <div class="rounded-xl border border-border dark:border-dark-border bg-surface-alt dark:bg-dark-surface-alt px-4 py-3">
                                <p class="font-heading text-2xl text-cyan-700 dark:text-cyan-400 neon-text leading-none">500K+</p>
                                <p class="text-[10px] font-mono uppercase tracking-widest text-muted dark:text-dark-muted mt-2">Records across production systems</p>
                            </div>
                            <div class="rounded-xl border border-border dark:border-dark-border bg-surface-alt dark:bg-dark-surface-alt px-4 py-3">
                                <p class="font-heading text-2xl text-cyan-700 dark:text-cyan-400 neon-text leading-none">97%</p>
                                <p class="text-[10px] font-mono uppercase tracking-widest text-muted dark:text-dark-muted mt-2">NL2SQL accuracy (SADIE)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="absolute bottom-6 right-6 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity text-sm font-mono">&rarr;</span>
            </div>

            {{-- What I work on now --}}
            <div class="grid gap-4 md:grid-cols-3 mt-4">
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Agentic</p>
                    <h3 class="font-heading text-fluid-base text-body dark:text-dark-body mb-2">Production agentic systems</h3>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Tool-calling agents with intent routing, multi-turn context, and hallucination grading. Long-horizon harnesses with durable plans and checkpointing.</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Retrieval</p>
                    <h3 class="font-heading text-fluid-base text-body dark:text-dark-body mb-2">Hybrid retrieval</h3>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Dense + sparse + graph. Qdrant (ModernBERT 768d + BM25, RRF fusion) plus Neo4j graph traversal. Custom rerankers where it pays.</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Evals</p>
                    <h3 class="font-heading text-fluid-base text-body dark:text-dark-body mb-2">Evaluation as engineering</h3>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">RAGAS, LLM-as-judge calibrated to labeled data, CI-gated regression, Langfuse end-to-end. If it isn't measured, it isn't shipped.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="synthwave-divider mx-auto max-w-lg my-4"></div>

    {{-- Experiments --}}
    <section class="py-16 px-6">
        <div class="mx-auto max-w-5xl">
            <p class="font-mono text-xs uppercase tracking-widest text-cyan-700 dark:text-cyan-400 mb-8"><span class="text-brand-cyan/50">//</span> experiments</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="https://github.com/albertorsesc/knowledge-curator-pipeline" target="_blank" rel="noopener noreferrer" class="gradient-border group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-700 dark:text-cyan-400">MCP Server</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">Knowledge Curator Pipeline</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Turns articles into distilled knowledge notes in an Obsidian vault.</p>
                </a>

                <a href="https://github.com/albertorsesc/soundmind" target="_blank" rel="noopener noreferrer" class="gradient-border group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-700 dark:text-cyan-400">Python</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">SoundMind</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Psychoacoustic masking, brainwave entrainment, NLP-patterned affirmations.</p>
                </a>

                <a href="https://github.com/albertorsesc/pain-discovery" target="_blank" rel="noopener noreferrer" class="gradient-border group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-700 dark:text-cyan-400">Python</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h4 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">Pain Discovery</h4>
                    <p class="text-sm text-muted dark:text-dark-muted">Scrapes X, HN, Reddit to analyze posts and surface business opportunities.</p>
                </a>

                <a href="https://github.com/albertorsesc/ai-cli" target="_blank" rel="noopener noreferrer" class="gradient-border group" data-reveal>
                    <div class="flex items-start justify-between mb-3">
                        <p class="text-xs font-mono text-cyan-700 dark:text-cyan-400">Python</p>
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
    });
</script>
@endpush
