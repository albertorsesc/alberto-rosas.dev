@extends('layouts.app')

@php
    seo()
        ->title('Work · Alberto Rosas')
        ->description('Selected production AI systems: a compliance engine over 500K+ regulated records, an NL-to-SQL platform at 93–97% accuracy, and a multi-agent document platform.')
        ->url(route('work'));
@endphp

@section('content')
<article class="pt-32 pb-24 px-6">
    <div class="mx-auto max-w-5xl">

        {{-- Header --}}
        <header class="mb-14" data-reveal>
            <p class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-5 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> work
            </p>
            <h1 class="font-heading text-fluid-3xl text-body dark:text-dark-body mb-4">Work</h1>
            <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed max-w-2xl">
                Recent production AI systems in depth, and the earlier engineering roles behind them. Every figure comes from the engagement it names.
            </p>
        </header>

        {{-- Flagship case studies. Two columns: a meta rail (client, role, the
             headline metric, stack) beside the substance (title, then context /
             built / result). Both columns carry weight, so no dead space, and the
             reading measure stays tight. --}}
        <div class="space-y-6">
            @foreach ([
                [
                    'client' => 'Unified Compliance Framework',
                    'role'   => 'Sole Architect · 2025–2026',
                    'metric' => '500K+', 'metricLabel' => 'regulated records',
                    'title'  => 'AI engine for a compliance SaaS',
                    'context'=> 'A multi-tenant compliance platform used by GRC managers and auditors, who feed its answers into audit documentation. A confident-wrong answer reaches a regulator.',
                    'built'  => [
                        'Hybrid retrieval: Qdrant (ModernBERT + BM25, RRF fusion) plus Neo4j graph traversal across compliance hierarchies.',
                        'LangGraph agentic chat with intent routing across six intents and CRAG hallucination grading.',
                        'Multi-signal confidence tiering surfaced to the user, with refusal when the evidence is thin.',
                        'Custom RAGAS eval harness with LLM-as-judge; Langfuse tracing end to end.',
                    ],
                    'result' => 'Multi-tenant scoping resolved at query time, with no per-tenant data duplication. Every answer is graded and traced before it reaches a user.',
                    'tags'   => ['Qdrant','Neo4j','LangGraph','CRAG','RAGAS','Langfuse'],
                ],
                [
                    'client' => 'Storage360',
                    'role'   => 'Sole Architect · 2024–2025',
                    'metric' => '93–97%', 'metricLabel' => 'query accuracy',
                    'title'  => 'Production NL-to-SQL platform',
                    'context'=> 'A property-management SaaS where the agent writes SQL against the customer\'s own database, so a wrong query becomes a wrong business decision.',
                    'built'  => [
                        'LangGraph agent over a custom MCP server for read-only database access, with schema caching and FK detection.',
                        'MongoDB Atlas vector search, Qwen3 embeddings, and a structured business-rule context library.',
                        'Accuracy CI-gated against golden datasets, so a regression fails the build instead of reaching a user.',
                        'FastAPI SSE streaming, Langfuse observability.',
                    ],
                    'result' => 'The read-only boundary is enforced in the policy layer, not by trusting the model. Accuracy is CI-gated, so a regression fails the build before it reaches a customer.',
                    'tags'   => ['MCP','LangGraph','MongoDB Atlas','Qwen3','RAGAS'],
                ],
                [
                    'client' => 'Incfile / Bizee',
                    'role'   => 'AI Engineer & Tech Lead · 2022–2026',
                    'metric' => '1000+', 'metricLabel' => 'requests a day',
                    'title'  => 'Multi-agent document platform',
                    'context'=> 'Document processing and decision support in front of customers filing real paperwork, across multiple data sources.',
                    'built'  => [
                        'Multi-agent system for document processing and decision support across multiple data sources.',
                        'RAG over business documentation, with GraphRAG/KAG experiments for retrieval precision.',
                        'Multi-layer memory (short/long-term, procedural) for cross-session context.',
                        'Led the monolith-to-services migration and set the development standards the team adopted.',
                    ],
                    'result' => 'Cut manual data entry by 65%. Mentored 8 engineers on AI/ML practice and production deployment.',
                    'tags'   => ['RAG','GraphRAG','Unsloth','FastAPI'],
                ],
            ] as $c)
                <article class="gradient-border group" data-reveal>
                    <div class="grid gap-x-10 gap-y-7 md:grid-cols-12">

                        {{-- Meta rail --}}
                        <div class="md:col-span-4">
                            <p class="font-heading text-fluid-base text-body dark:text-dark-body leading-tight">{{ $c['client'] }}</p>
                            <p class="font-mono text-[11px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-2
                                      transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400">
                                {{ $c['role'] }}
                            </p>

                            <div class="mt-7">
                                <p class="font-heading text-4xl md:text-5xl text-cyan-700 dark:text-cyan-400 neon-text tabular-nums leading-none">{{ $c['metric'] }}</p>
                                <p class="font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted mt-2.5">{{ $c['metricLabel'] }}</p>
                            </div>

                            <div class="mt-7 flex flex-wrap gap-2">
                                @foreach ($c['tags'] as $t)<span class="tag">{{ $t }}</span>@endforeach
                            </div>
                        </div>

                        {{-- Substance --}}
                        <div class="md:col-span-8 min-w-0">
                            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body leading-snug mb-6">{{ $c['title'] }}</h2>

                            <div class="space-y-5">
                                <div>
                                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-cyan-700 dark:text-cyan-400/70 mb-2">Context</p>
                                    <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed">{{ $c['context'] }}</p>
                                </div>
                                <div>
                                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-cyan-700 dark:text-cyan-400/70 mb-2">Built</p>
                                    <ul role="list" class="space-y-2.5 text-fluid-base text-muted dark:text-dark-muted leading-relaxed">
                                        @foreach ($c['built'] as $b)
                                            <li class="flex items-start gap-3 min-w-0">
                                                <span class="text-cyan-700 dark:text-cyan-400/60 mt-2 shrink-0" aria-hidden="true"><svg class="w-1.5 h-1.5" viewBox="0 0 6 6" fill="currentColor"><circle cx="3" cy="3" r="3"/></svg></span>
                                                <span class="min-w-0 [overflow-wrap:anywhere]">{{ $b }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-cyan-700 dark:text-cyan-400/70 mb-2">Result</p>
                                    <p class="text-fluid-base text-body dark:text-dark-body leading-relaxed">{{ $c['result'] }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>
            @endforeach
        </div>

        {{-- Earlier career. Compact rows, deliberately lighter than the case-study
             cards; Global Cybersec carries a little more, since the security-
             automation years are where the safety-first habits came from. --}}
        <section class="mt-16" data-reveal>
            <p class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-6 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> earlier
            </p>
            <div class="border-t border-border dark:border-dark-border">
                <div class="py-5 border-b border-border dark:border-dark-border">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline gap-1">
                        <p class="text-body dark:text-dark-body font-medium">
                            Global Cybersec <span class="text-muted dark:text-dark-muted font-normal">· Engineering Manager</span>
                        </p>
                        <p class="font-mono text-xs text-muted dark:text-dark-muted shrink-0">2017–2021</p>
                    </div>
                    <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed mt-2 max-w-3xl">
                        Security automation and incident response. Event-driven architecture over millions of daily security events; integrated SIEM, IDS/IPS, firewalls, and SOAR into one automated pipeline, cutting incident response time 60%. Built 4 microservice applications, managed a team of 8.
                    </p>
                </div>
                <div class="py-5 border-b border-border dark:border-dark-border">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline gap-1">
                        <p class="text-body dark:text-dark-body font-medium">
                            Earlier roles <span class="text-muted dark:text-dark-muted font-normal">· Senior / Full-Stack Engineer</span>
                        </p>
                        <p class="font-mono text-xs text-muted dark:text-dark-muted shrink-0">2014–2022</p>
                    </div>
                    <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed mt-2 max-w-3xl">
                        Logistics, healthcare, and SaaS across GT Transport, Buddhi, Fulcrum Digital, and HQ Rental Software: operations platforms, a healthcare support product built from the ground up, automated data pipelines, and test suites from scratch.
                    </p>
                </div>
            </div>
        </section>

        {{-- Education & certifications --}}
        <section class="mt-16" data-reveal>
            <p class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-6 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> education
            </p>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-body dark:text-dark-body font-medium">Information Technology Engineering</p>
                    <p class="text-fluid-sm text-muted dark:text-dark-muted">Universidad Politécnica de Baja California · 2014–2016</p>
                </div>
                <div class="flex flex-wrap gap-2 sm:justify-end sm:max-w-md">
                    <span class="tag">LangChain &amp; LLMs</span>
                    <span class="tag">Generative AI &amp; LLMs</span>
                    <span class="tag">Gen AI Foundational Models</span>
                    <span class="tag">Business Process Modeling with AI</span>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <div class="mt-16" data-reveal>
            <a href="/#contact" class="btn btn-primary group">
                Let&rsquo;s talk
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

    </div>
</article>
@endsection
