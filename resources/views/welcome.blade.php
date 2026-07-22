@extends('layouts.app')

@section('content')
    {{-- Hallmark · macrostructure: Marquee Hero · genre: atmospheric
       · design-system: design.md · designed-as-app
       Fold = intro (typography only). Below-fold = irregular bento; the grid gap
       is the rhythm, so no rules between blocks. --}}
    @include('components.site.intro')

    {{-- First CTA arrives below the fold, per the macrostructure. --}}
    <section class="px-6 md:px-12 py-14">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <a href="#contact" class="btn btn-primary group">
                    Let's build something
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="/alberto_rosas_ai_engineer.pdf" download class="btn btn-ghost">
                    Resume
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <a href="https://www.linkedin.com/in/albertorsesc" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-colors" aria-label="LinkedIn (opens in new tab)">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <a href="https://github.com/albertorsesc" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-colors" aria-label="GitHub (opens in new tab)">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                </a>
                <a href="https://x.com/bcryp7" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl text-muted hover:text-brand-cyan dark:text-dark-muted dark:hover:text-brand-cyan transition-colors" aria-label="X (Twitter) (opens in new tab)">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ── Block 1 · anchor + stat panel. A clean 2-up, both cells earn their height. ── --}}
    <section class="px-6 md:px-12 pb-6">
        <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-8 font-normal">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> the work
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">

            <article class="gradient-border group relative flex flex-col" data-reveal data-hermetic="eye">
                <span class="hermetic-eye" aria-hidden="true">&#x2625;</span>
                <a href="/about" class="absolute inset-0 z-10 rounded-bento" aria-label="Read about the engineer"></a>
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted mb-3
                           transition-colors duration-300
                           group-hover:text-cyan-700 dark:group-hover:text-cyan-400">The Engineer</p>
                <h3 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4 leading-tight [overflow-wrap:anywhere]">
                    Agents for systems where being wrong has consequences.
                </h3>
                <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-3">
                    12+ years in software, 5+ in production AI. Agentic workflows, tool-calling, retrieval pipelines, NL2SQL engines. Judged on eval scores and uptime, not demos.
                </p>
                <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-6">
                    Earlier years in cybersecurity automation (SIEM, IDS/IPS, SOAR) shape how I design for safety in everything I ship now.
                </p>
                <div class="mt-auto flex flex-wrap gap-2">
                    <span class="tag">Python</span><span class="tag">LangGraph</span><span class="tag">MCP</span>
                    <span class="tag">RAG</span><span class="tag">GraphRAG</span><span class="tag">Qdrant</span>
                    <span class="tag">Neo4j</span><span class="tag">RAGAS</span><span class="tag">Langfuse</span>
                    <span class="tag">FastAPI</span>
                </div>
                <span class="absolute bottom-6 right-6 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity text-sm font-mono" aria-hidden="true">&rarr;</span>
            </article>

            {{-- One stat panel instead of four stretched tiles: the numbers read as a
                 set, and there is no leftover height to fill. --}}
            <div class="bento-card grid grid-cols-2 gap-x-8 gap-y-10 content-center" data-reveal>
                <div>
                    <p class="font-heading text-3xl sm:text-4xl md:text-5xl text-cyan-700 dark:text-cyan-400 neon-text leading-none tabular-nums">12+</p>
                    <p class="text-[10px] font-mono uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-3">Years in software</p>
                </div>
                <div>
                    <p class="font-heading text-3xl sm:text-4xl md:text-5xl text-cyan-700 dark:text-cyan-400 neon-text leading-none tabular-nums">5+</p>
                    <p class="text-[10px] font-mono uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-3">Years in production AI</p>
                </div>
                <div>
                    <p class="font-heading text-3xl sm:text-4xl md:text-5xl text-cyan-700 dark:text-cyan-400 neon-text leading-none tabular-nums">500K+</p>
                    <p class="text-[10px] font-mono uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-3">Records across production systems</p>
                </div>
                <div>
                    <p class="font-heading text-3xl sm:text-4xl md:text-5xl text-cyan-700 dark:text-cyan-400 neon-text leading-none tabular-nums">93&ndash;97%</p>
                    <p class="text-[10px] font-mono uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-3">NL2SQL accuracy (SADIE)</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Block 2 · named systems, not category claims. Every figure, client
           name and stack line is quoted from BIO.md "Selected work" (L102-117).
           Layer 1 is the 20-second read; Layer 2 is the engineer read. ── --}}
    <section class="px-6 md:px-12 py-16">
        <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-10 font-normal">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> systems in production
        </h2>

        <div class="relative" data-trace-rail>
            {{-- The playhead. A 2px track in the left gutter whose lit head grows
                 with scroll; nodes latch on as it passes them. --}}
            <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-px hidden md:block
                        bg-border dark:bg-dark-border" aria-hidden="true"></div>
            <div class="pointer-events-none absolute left-0 top-0 w-px hidden md:block origin-top
                        bg-gradient-to-b from-brand-cyan/80 to-brand-cyan/20"
                 style="height:100%; transform:scaleY(0)" data-rail-head aria-hidden="true"></div>

        <ul>
            @foreach ([
                [
                    'n' => '01', 'client' => 'Unified Compliance Framework · ControlSight', 'years' => '2025–2026',
                    'claim' => 'Sole architect of the AI layer over 500K+ regulatory records.',
                    'stake' => 'Customers are compliance professionals feeding answers into audit documentation. A confident-wrong answer does not stay inside the product, which shapes every design call.',
                    'stack' => 'Qdrant (ModernBERT 768d + BM25, RRF fusion) + Neo4j (8 entity types, 10+ relationships, Cypher cross-store validation). LangGraph chat with intent classification across six intents, CRAG grading, multi-signal confidence tiering.',
                    'edge'  => 'Multi-tenant subscription scoping resolved at query time, with no per-tenant data duplication.',
                    'tags'  => ['Qdrant','Neo4j','LangGraph','CRAG','RAGAS','Langfuse'],
                ],
                [
                    'n' => '02', 'client' => 'Storage360 · SADIE', 'years' => '2024–2025',
                    'claim' => 'Production NL-to-SQL agentic platform at 93–97% accuracy.',
                    'stake' => 'A property-management SaaS where the model writes SQL against the customer\'s own data. Accuracy is CI-gated against golden datasets, so a regression fails the build rather than reaching a user.',
                    'stack' => 'LangGraph with a custom MCP server for read-only DB access, schema caching and FK detection. MongoDB Atlas vector search, Qwen3 embeddings, structured business-rule context library, FastAPI SSE streaming.',
                    'edge'  => 'The read-only MCP boundary is enforced at the policy layer, not by trusting the model to behave.',
                    'tags'  => ['MCP','LangGraph','MongoDB Atlas','Qwen3','RAGAS'],
                ],
                [
                    'n' => '03', 'client' => 'Incfile / Bizee', 'years' => '2022–present',
                    'claim' => 'Led the monolith-to-services migration and a multi-agent system at 1000+ daily requests.',
                    'stake' => 'Document processing and decision support across multiple data sources, in front of real customers filing real paperwork. Cut manual data entry by 65%.',
                    'stack' => 'RAG pipeline over business documentation, GraphRAG/KAG experiments for retrieval precision, fine-tuning with Unsloth and HuggingFace Transformers. Multi-layer memory (short/long-term, procedural) for cross-session context.',
                    'edge'  => 'Mentored 8 engineers on AI/ML practice and production deployment.',
                    'tags'  => ['RAG','GraphRAG','Unsloth','FastAPI'],
                ],
            ] as $sys)
                <li x-data="{ open: false }" data-node
                    class="rail-row group py-10 md:py-14 border-b border-border dark:border-dark-border md:pl-[8.333%]">
                    <div class="grid gap-x-8 gap-y-4 md:grid-cols-12 md:items-start">
                        <p class="relative font-mono text-[10px] tabular-nums tracking-[0.18em] text-muted dark:text-dark-muted
                                  transition-colors duration-300 md:col-span-1
                                  group-hover:text-cyan-700 dark:group-hover:text-cyan-400">
                            <span class="absolute hidden md:block h-2 w-2 rounded-full -translate-x-[calc(8.333vw-3px)]
                                         top-1.5 bg-border dark:bg-dark-border transition-colors duration-300"
                                  data-node-dot aria-hidden="true"></span>{{ $sys['n'] }}</p>

                        <div class="md:col-span-6 lg:col-span-5 min-w-0">
                            <p class="font-mono text-[10px] uppercase tracking-[0.3em] text-muted dark:text-dark-muted mb-4
                                      transition-colors duration-300
                                      group-hover:text-cyan-700 dark:group-hover:text-cyan-400 [overflow-wrap:anywhere]">
                                {{ $sys['client'] }} · {{ $sys['years'] }}
                            </p>
                            <h3 class="font-heading text-fluid-2xl text-body dark:text-dark-body leading-[1.05] tracking-[-0.015em]
                                       transition-transform duration-500 ease-out group-hover:translate-x-1">
                                {{ $sys['claim'] }}
                            </h3>
                        </div>

                        <p class="md:col-span-5 md:col-start-8 lg:col-start-9 lg:col-span-4 md:pt-2 min-w-0
                                  text-sm text-muted dark:text-dark-muted leading-relaxed">
                            {{ $sys['stake'] }}
                        </p>
                    </div>

                    {{-- Negative margins keep the visual size; the hit area grows to 44px+. --}}
                    <button type="button" @click="open = !open" :aria-expanded="open"
                            class="mt-3 py-4 -mb-4 px-2 -mx-2 font-mono text-[10px] uppercase tracking-[0.25em] text-muted dark:text-dark-muted
                                   transition-colors duration-300 hover:text-cyan-700 dark:hover:text-cyan-400
                                   focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                   focus-visible:outline-[color:var(--brand-cyan)]">
                        <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span>
                        <span x-text="open ? 'less' : 'how it works'"></span>
                    </button>

                    <div x-show="open" x-collapse class="mt-7 grid gap-x-8 gap-y-5 md:grid-cols-12">
                        <div class="md:col-start-2 md:col-span-6 lg:col-span-5 min-w-0 space-y-4">
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">{{ $sys['stack'] }}</p>
                            <p class="text-sm text-body dark:text-dark-body leading-relaxed">{{ $sys['edge'] }}</p>
                        </div>
                        <div class="md:col-span-5 md:col-start-8 lg:col-start-9 lg:col-span-4 flex flex-wrap gap-2 items-start">
                            @foreach ($sys['tags'] as $t)<span class="tag">{{ $t }}</span>@endforeach
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

            {{-- The verdict. Not a fourth system: the line the whole section argues
                 toward, promoted out of a paragraph into display type. --}}
            <div class="relative pt-14 md:pt-20 md:pl-[8.333%]" data-verdict>
                <span class="absolute left-0 top-14 md:top-20 hidden md:block h-3 w-3 -translate-x-[5.5px]
                             rounded-full bg-brand-cyan opacity-0" data-verdict-dot aria-hidden="true"></span>
                <p class="font-heading text-fluid-2xl md:text-fluid-3xl text-body dark:text-dark-body
                          leading-[1.05] tracking-[-0.02em] max-w-3xl opacity-0" data-verdict-line>
                    If it isn't measured, it isn't shipped.
                </p>
            </div>
        </div>
    </section>

    {{-- ── Block 3 · experiments. Irregular bento spans (4/2 over 3/3 on six
           columns): the MCP server is the flagship and earns the wide cell,
           carrying more content rather than stretched whitespace. Rows stretch
           so each band reads as one composed line. ── --}}
    <section class="px-6 md:px-12 pb-24">
        <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-8 font-normal">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> experiments
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
            @foreach ([
                [
                    'url' => 'https://github.com/albertorsesc/knowledge-curator-pipeline',
                    'kind' => 'MCP Server',
                    'name' => 'Knowledge Curator Pipeline',
                    'desc' => 'Turns articles into distilled knowledge notes in an Obsidian vault. Deterministic pipelines extract frameworks, playbooks, and belief-changing data, not summaries.',
                    'tags' => ['MCP', 'Obsidian', 'Pipelines'],
                    'span' => 'lg:col-span-4',
                ],
                [
                    'url' => 'https://github.com/albertorsesc/soundmind',
                    'kind' => 'Psychoacoustics',
                    'name' => 'SoundMind',
                    'desc' => 'Psychoacoustic masking, brainwave entrainment, NLP-patterned affirmations, and targeted memory reactivation in layered audio sessions.',
                    'tags' => [],
                    'span' => 'lg:col-span-2',
                ],
                [
                    'url' => 'https://github.com/albertorsesc/pain-discovery',
                    'kind' => 'Local Models',
                    'name' => 'Pain Discovery',
                    'desc' => 'Scrapes X, HN, Reddit to surface business opportunities. Runs on local models through Ollama.',
                    'tags' => [],
                    'span' => 'lg:col-span-3',
                ],
                [
                    'url' => 'https://github.com/albertorsesc/ai-cli',
                    'kind' => 'CLI',
                    'name' => 'AI CLI',
                    'desc' => 'Interactive command-line app for news headlines with AI-powered Q&A and image generation.',
                    'tags' => [],
                    'span' => 'lg:col-span-3',
                ],
            ] as $p)
                <a href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer" class="gradient-border group !py-6 flex flex-col {{ $p['span'] }}">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-muted dark:text-dark-muted
                           transition-colors duration-300
                           group-hover:text-cyan-700 dark:group-hover:text-cyan-400">{{ $p['kind'] }}</p>
                        <svg class="w-4 h-4 text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" /></svg>
                    </div>
                    <h3 class="font-heading text-fluid-base text-body dark:text-dark-body mb-1">{{ $p['name'] }}</h3>
                    <p class="text-sm text-muted dark:text-dark-muted">{{ $p['desc'] }}</p>
                    @if ($p['tags'])
                        <div class="mt-auto pt-4 flex flex-wrap gap-2">
                            @foreach ($p['tags'] as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </section>

    {{-- ── Block 4 · writing. Editorial index rows, deliberately not another
           card grid: three card sections on one page is the ceiling. Mono date,
           serif title promoted to accent on hover, hairline rules between rows. ── --}}
    @if ($posts->isNotEmpty())
        <section class="px-6 md:px-12 pb-24">
            <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-8 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> writing
            </h2>

            <div class="border-t border-border dark:border-dark-border">
                @foreach ($posts as $post)
                    <a href="{{ route('prezet.show', $post->slug) }}"
                       class="group grid grid-cols-1 md:grid-cols-[10rem_1fr_auto] gap-1 md:gap-8 items-baseline
                              py-6 border-b border-border dark:border-dark-border">
                        <time datetime="{{ $post->createdAt->toIso8601String() }}"
                              class="font-mono text-xs text-muted dark:text-dark-muted tabular-nums">
                            {{ $post->createdAt->format('M Y') }}
                        </time>
                        <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body leading-snug
                                   transition-colors duration-300
                                   group-hover:text-cyan-700 dark:group-hover:text-cyan-400">
                            {{ $post->title }}
                        </h3>
                        <span class="font-mono text-sm text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity hidden md:inline" aria-hidden="true">&rarr;</span>
                    </a>
                @endforeach
            </div>

            <a href="{{ route('prezet.index') }}"
               class="inline-flex items-baseline gap-2 mt-6 font-mono text-xs uppercase tracking-[0.2em]
                      text-muted dark:text-dark-muted transition-colors duration-300
                      hover:text-cyan-700 dark:hover:text-cyan-400">
                All {{ $postCount }} posts <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
    @endif

    {{-- Contact --}}
    @include('components.site.contact')
@endsection

@push('scripts')
<script>
    // Signature moment: the section draws its own trace as you scroll.
    // The playhead latches each system node, then terminates on the verdict.
    // Scrubbed, never pinned — pinning fights the mobile address bar and takes
    // scroll away from the reader, which is a poor trade on a page about reliability.
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

        const rail = document.querySelector('[data-trace-rail]');
        if (!rail) return;

        const head    = rail.querySelector('[data-rail-head]');
        const nodes   = [...rail.querySelectorAll('[data-node]')];
        const dots    = [...rail.querySelectorAll('[data-node-dot]')];
        const vLine   = rail.querySelector('[data-verdict-line]');
        const vDot    = rail.querySelector('[data-verdict-dot]');

        const LIT = 'var(--brand-cyan)';

        gsap.matchMedia().add({
            motion:  '(prefers-reduced-motion: no-preference)',
            reduced: '(prefers-reduced-motion: reduce)',
            desktop: '(min-width: 768px)',
        }, (ctx) => {
            const { motion, reduced, desktop } = ctx.conditions;

            // Reduced motion, or narrow: render the end state, no scroll coupling.
            if (reduced || !desktop) {
                gsap.set(head, { scaleY: 1 });
                gsap.set(dots, { backgroundColor: LIT });
                gsap.set([vLine, vDot], { opacity: 1 });
                return;
            }

            if (!motion) return;

            // The head grows across the whole section.
            gsap.to(head, {
                scaleY: 1, ease: 'none',
                scrollTrigger: { trigger: rail, start: 'top 65%', end: 'bottom 75%', scrub: 0.6 },
            });

            // Each node latches when the head reaches it, and stays lit on scroll-back
            // for the dot (toggleActions reverses colour only, not the head).
            nodes.forEach((node, i) => {
                gsap.to(dots[i], {
                    backgroundColor: LIT, duration: 0.25, ease: 'none',
                    scrollTrigger: { trigger: node, start: 'top 60%', toggleActions: 'play none none reverse' },
                });
            });

            // The verdict lands last.
            gsap.to([vDot, vLine], {
                opacity: 1, y: 0, duration: 0.7, stagger: 0.08, ease: 'power3.out',
                scrollTrigger: { trigger: vLine, start: 'top 82%', once: true },
            });
        });
    });
</script>
@endpush
