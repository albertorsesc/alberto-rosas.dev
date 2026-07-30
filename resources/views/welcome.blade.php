@extends('layouts.app')

@php
    // Home uses the site-default title/description from AppServiceProvider; set canonical here.
    seo()->url(url('/'));
@endphp

@section('content')
    {{-- Hallmark · macrostructure: Marquee Hero · genre: atmospheric
       · design-system: design.md · designed-as-app
       Fold = intro (typography only). Below-fold = irregular bento; the grid gap
       is the rhythm, so no rules between blocks. --}}
    @include('components.site.intro')

    {{-- First CTA arrives below the fold, per the macrostructure. --}}
    <section class="px-6 md:px-12 py-14">
        <div class="flex flex-wrap items-center gap-x-8 gap-y-5">
            <a href="#contact" class="btn btn-primary group">
                Let's talk
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>

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

    {{-- ── How I help · the consulting offer surfaced early. Advisory carries the
           recovered-hours proof; the job/role option stays in the contact triage so
           this section reads purely as "for companies". ── --}}
    <section class="px-6 md:px-12 py-16">
        <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-4 font-normal">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> how i help
        </h2>
        <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed max-w-2xl mb-10">
            I help mid-market teams put AI to work: finding where it pays off, building the systems, and keeping them reliable in production.
        </p>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="gradient-border group">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Advisory</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body leading-snug mb-3">Point AI at the right problem</h3>
                <p class="text-sm text-muted dark:text-dark-muted leading-relaxed mb-3">Where AI pays off in your business, what to build first, and what to leave alone.</p>
                <p class="text-sm text-body dark:text-dark-body leading-relaxed">A first engagement recovered 70+ hours a month, about $42K a year, for an operations team.</p>
            </div>
            <div class="gradient-border group">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Build</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body leading-snug mb-3">Production agentic systems</h3>
                <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Design and build the system end to end: agents, retrieval, tool-calling, and the evals that gate what ships.</p>
            </div>
            <div class="gradient-border group">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Review</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body leading-snug mb-3">Second-opinion on production agents</h3>
                <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Context engineering, evals, MCP attack surface, and agent security.</p>
            </div>
        </div>
    </section>

    {{-- ── Block 1 · anchor + stat panel. A clean 2-up, both cells earn their height. ── --}}
    <section class="px-6 md:px-12 pb-6">
        <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-8 font-normal">
            <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> the engineer
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-stretch">

            <article class="gradient-border group relative flex flex-col" data-reveal>
                <a href="/about" class="absolute inset-0 z-10 rounded-bento" aria-label="Read about the engineer"></a>
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted mb-3
                           transition-colors duration-300
                           group-hover:text-cyan-700 dark:group-hover:text-cyan-400">The Engineer</p>
                <h3 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4 leading-tight [overflow-wrap:anywhere]">
                    Production agentic systems for customer-facing products.
                </h3>
                <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-3">
                    12+ years in software, 5+ in production AI. Agentic workflows, tool-calling, retrieval pipelines, NL2SQL engines. Judged on eval scores and uptime.
                </p>
                <p class="text-sm md:text-base text-muted dark:text-dark-muted leading-relaxed mb-6">
                    Earlier years in cybersecurity automation (SIEM, IDS/IPS, SOAR) shape how I design for safety in everything I ship now.
                </p>
                {{-- Capabilities, not a vendor list: the card reads as what the
                     engineer can do, not which five tools he happens to use. --}}
                <div class="mt-auto flex flex-wrap gap-2">
                    <span class="tag">Agent orchestration</span><span class="tag">Tool-calling</span>
                    <span class="tag">Retrieval pipelines</span><span class="tag">Knowledge graphs</span>
                    <span class="tag">Vector search</span><span class="tag">Evaluation</span>
                    <span class="tag">Observability</span><span class="tag">Production APIs</span>
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

    {{-- ── Block 2 · selected work teaser. Full case studies live on /work;
           the homepage shows a three-line preview that links there. ── --}}
    <section class="px-6 md:px-12 py-16">
        <div class="flex items-baseline justify-between gap-4 mb-8">
            <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> selected work
            </h2>
            <a href="/work" class="font-mono text-xs uppercase tracking-[0.2em] text-muted dark:text-dark-muted transition-colors duration-300 hover:text-cyan-700 dark:hover:text-cyan-400">
                All work <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="border-t border-border dark:border-dark-border">
            @foreach ([
                ['client' => 'Unified Compliance Framework', 'years' => '2025–2026', 'claim' => 'AI engine for a compliance SaaS, over 500K+ regulated records.'],
                ['client' => 'Storage360 · SADIE',           'years' => '2024–2025', 'claim' => 'Production NL-to-SQL platform at 93–97% accuracy.'],
                ['client' => 'Incfile / Bizee',              'years' => '2022–2026', 'claim' => 'Multi-agent document platform at 1000+ requests a day.'],
            ] as $s)
                <a href="/work" class="group block py-6 border-b border-border dark:border-dark-border">
                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-muted dark:text-dark-muted mb-2 [overflow-wrap:anywhere]">
                        {{ $s['client'] }} · {{ $s['years'] }}
                    </p>
                    <div class="flex items-baseline justify-between gap-4">
                        <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body leading-snug
                                   transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400">
                            {{ $s['claim'] }}
                        </h3>
                        <span class="font-mono text-sm text-muted dark:text-dark-muted opacity-0 group-hover:opacity-100 transition-opacity shrink-0 hidden md:inline" aria-hidden="true">&rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ── Block 3 · experiments. Mirrors the GitHub profile pins (fetched and
           cached weekly). Irregular bento spans keyed to pin count; the first
           pin is the flagship wide cell. Whole section hides if there are no
           pins. Each card: tech stack · title · description · topic tags. ── --}}
    @if (! empty($experiments))
        <section class="px-6 md:px-12 pb-24">
            <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-8 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> experiments
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                @foreach ($experiments as $p)
                    <a href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer" class="gradient-border group !py-6 flex flex-col {{ $p['span'] }}">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-muted dark:text-dark-muted
                               transition-colors duration-300 min-w-0 [overflow-wrap:anywhere]
                               group-hover:text-cyan-700 dark:group-hover:text-cyan-400">{{ implode(' · ', $p['stack']) ?: 'Repository' }}</p>
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
    @endif

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

