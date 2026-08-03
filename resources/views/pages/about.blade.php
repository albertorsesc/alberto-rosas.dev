@extends('layouts.app')

@php
    seo()
        ->title('About · Alberto Rosas')
        ->description('AI & Agentic Systems Engineer in Mexico. How I work: production agentic systems, hybrid retrieval, and eval-first delivery, from a security-automation background.')
        ->url(route('about'));
@endphp

@section('content')
<article class="pt-32 pb-20">

    {{-- Hero --}}
    <header class="mx-auto max-w-5xl px-6 mb-12" data-reveal>
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="relative shrink-0">
                <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-cyan-500 via-purple-500 to-fuchsia-500 opacity-20 dark:opacity-40 blur-md"></div>
                <img
                    src="https://avatars.githubusercontent.com/u/22654040?v=4"
                    alt="Alberto Rosas"
                    class="relative w-36 h-36 md:w-44 md:h-44 rounded-3xl object-cover"
                    loading="eager"
                />
            </div>
            <div>
                <p class="text-xs font-mono uppercase tracking-widest text-cyan-700 dark:text-cyan-400 mb-3"><span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> The Engineer</p>
                <h1 class="font-heading text-fluid-3xl text-body dark:text-dark-body mb-3 neon-text">Alberto Rosas</h1>
                <p class="font-mono text-sm text-muted dark:text-dark-muted leading-relaxed">
                    <span class="text-cyan-700 dark:text-cyan-400">AI &amp; Agentic Systems Engineer</span>
                    &middot; 12+ yrs software / 5+ yrs production AI
                    &middot; <span class="text-cyan-700 dark:text-cyan-400">Mexico</span>
                    &middot; EN/ES native
                </p>
            </div>
        </div>
    </header>

    {{-- Tabs: Story (who I am) and Approach (how I work). Career and case studies
         live on /work; this page is the person and the method. --}}
    <div class="mx-auto max-w-5xl px-6" x-data="{ tab: 'approach' }" data-reveal>

        <div role="tablist" aria-label="About" class="flex gap-1 border-b border-border dark:border-dark-border mb-10">
            <button
                id="tab-approach" role="tab" x-ref="approachBtn"
                aria-controls="panel-approach"
                :aria-selected="tab === 'approach' ? 'true' : 'false'"
                :tabindex="tab === 'approach' ? 0 : -1"
                @click="tab = 'approach'"
                @keydown.right.prevent="tab = 'story'; $nextTick(() => $refs.storyBtn.focus())"
                @keydown.left.prevent="tab = 'story'; $nextTick(() => $refs.storyBtn.focus())"
                :class="tab === 'approach'
                    ? 'text-cyan-700 dark:text-brand-cyan border-brand-cyan'
                    : 'text-muted dark:text-dark-muted border-transparent hover:text-body dark:hover:text-dark-body'"
                class="px-4 py-3 -mb-px font-mono text-xs uppercase tracking-[0.2em] border-b-2 transition-colors duration-200"
            >Approach</button>
            <button
                id="tab-story" role="tab" x-ref="storyBtn"
                aria-controls="panel-story"
                :aria-selected="tab === 'story' ? 'true' : 'false'"
                :tabindex="tab === 'story' ? 0 : -1"
                @click="tab = 'story'"
                @keydown.left.prevent="tab = 'approach'; $nextTick(() => $refs.approachBtn.focus())"
                @keydown.right.prevent="tab = 'approach'; $nextTick(() => $refs.approachBtn.focus())"
                :class="tab === 'story'
                    ? 'text-cyan-700 dark:text-brand-cyan border-brand-cyan'
                    : 'text-muted dark:text-dark-muted border-transparent hover:text-body dark:hover:text-dark-body'"
                class="px-4 py-3 -mb-px font-mono text-xs uppercase tracking-[0.2em] border-b-2 transition-colors duration-200"
            >Story</button>
        </div>

        {{-- Story --}}
        <div id="panel-story" role="tabpanel" aria-labelledby="tab-story" x-show="tab === 'story'" x-cloak tabindex="0" class="focus:outline-none">
            <div class="max-w-2xl space-y-5 text-fluid-base text-muted dark:text-dark-muted leading-relaxed">
                <p>
                    I'm an AI and agentic systems engineer based in Mexico, with 12+ years in software and the last five on production AI. I build systems where the model is one component of something that has to be reliable, evaluable, and safe.
                </p>
                <p>
                    I didn't start in AI. I spent years in cybersecurity automation, running SIEM, IDS/IPS, and SOAR pipelines over millions of events a day. That background is why I design for agent safety, MCP attack surfaces, and policy-as-code from the start.
                </p>
                <p>
                    The other habit that carried over is measurement. Most &ldquo;RAG works&rdquo; claims fall apart under a real eval, so I build the evals first: custom harnesses, LLM-as-judge with measured agreement, CI-gated regression. Below the relevance bar, the system says it doesn't have sourced material rather than guessing.
                </p>
                <p class="text-body dark:text-dark-body">
                    Today I architect production agentic systems for customer-facing products, and I help mid-market teams find where AI actually pays off through <a href="https://triageops.com" target="_blank" rel="noopener noreferrer" class="text-cyan-700 dark:text-cyan-400 hover:underline">TriageOps</a>. Bilingual EN/ES, US-timezone friendly.
                </p>
            </div>

            <div class="mt-10">
                <a href="/#contact" class="btn btn-primary group">
                    Let&rsquo;s talk
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Approach --}}
        <div id="panel-approach" role="tabpanel" aria-labelledby="tab-approach" x-show="tab === 'approach'" tabindex="0" class="focus:outline-none">

            {{-- Frame first: the rigor is what makes fast shipping safe, not a gate
                 that slows it down. Capabilities (what I deliver) lead; security and
                 evals follow as the safety net. --}}
            <p class="max-w-2xl text-fluid-base text-muted dark:text-dark-muted leading-relaxed mb-12">
                The evals run in CI, the threat model is a design-doc pass, and the guardrails are code. The discipline is automated and light, so problems surface in a build rather than in production.
            </p>

            <div class="space-y-16">

                {{-- Capabilities --}}
                <section>
                    <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">What I build</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Agentic Systems</p>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Production agent systems end to end: orchestration, tool-calling, multi-step reasoning, intent routing, and memory that persists across sessions.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Retrieval</p>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Hybrid retrieval that holds up on real corpora: dense, sparse, and graph combined with reranking, plus NL-to-SQL when the answer is a query rather than a paragraph.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Evaluation &amp; Observability</p>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Custom eval harnesses with LLM-as-judge and hallucination grading, gated in CI, with end-to-end tracing so regressions surface before users do.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Models</p>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Frontier and open-weight models, including self-hosted deployment and fine-tuning for domain-specific tasks.</p>
                        </div>
                        <div class="gradient-border group md:col-span-2">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-3">Production Engineering</p>
                            <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Clean-architecture backends, async APIs, and containerized deployment, plus the platform migration and scaling work that keeps systems reliable under load.</p>
                        </div>
                    </div>
                </section>

                {{-- Security & evals: the safety net that keeps speed from turning fragile --}}
                <section>
                    <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-2">Security and evals, built in</h2>
                    <p class="text-sm text-muted dark:text-dark-muted mb-8 max-w-2xl">Carried over from years in security operations.</p>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Threat Modeling</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Threat modeling before a tool is granted</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Attack surface mapped in the design doc before code, STRIDE-style, drawn from years of SIEM and SOAR operations. Tracked against the OWASP LLM and Agentic Top 10 and MITRE ATLAS.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Tool-Calling &amp; MCP</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Read-only enforced in the policy layer</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">On SADIE's MCP server, database access is read-only and enforced in policy code, not model behavior. Default-deny allowlist, with tool output treated as untrusted input.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Regulated Data</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Governance for regulated data</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">500K+ regulated records under GDPR and HIPAA. Sensitive data routed to self-hosted models, PII masked before embedding, embeddings access-controlled like their source, tenant scope resolved at query time (OWASP LLM08).</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Red-Teaming</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Adversarial testing gated in CI</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Systems red-teamed with garak and PyRIT, with findings gated in CI so a regression that reopens a known jailbreak fails the build. Tracked against the OWASP LLM Top 10 and MITRE ATLAS.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Runtime Guardrails</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Layered runtime guardrails</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Custom guardrails layered with Llama Guard and NeMo Guardrails, validating input and output on both sides of the model call. Code-executing tools run sandboxed in e2b behind an egress allowlist.</p>
                        </div>
                        <div class="gradient-border group">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted transition-colors duration-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 mb-2">Governance</p>
                            <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Governance and compliance readiness</p>
                            <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Built the AI layer for a platform used by compliance auditors, with systems classified against the EU AI Act, NIST AI RMF, and ISO/IEC 42001. Refusal and confidence tiering surfaced to users when certainty is low.</p>
                        </div>
                    </div>
                </section>

            </div>

        </div>

    </div>

</article>
@endsection
