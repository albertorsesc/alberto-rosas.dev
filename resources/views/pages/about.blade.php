@extends('layouts.app')

@section('title', 'About — Alberto Rosas')
@section('description', 'AI & Agentic Systems Engineer based in Mexico. Production agentic systems for products where being wrong has real consequences. Agent frameworks, retrieval pipelines, eval-first.')

@section('content')
<article class="pt-32 pb-20">

    {{-- Hero --}}
    <header class="mx-auto max-w-5xl px-6 mb-12" data-reveal>
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="relative shrink-0 float">
                <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-cyan-500 via-purple-500 to-fuchsia-500 opacity-20 dark:opacity-40 blur-md animate-pulse-slow"></div>
                <img
                    src="https://avatars.githubusercontent.com/u/22654040?v=4"
                    alt="Alberto Rosas"
                    class="relative w-36 h-36 md:w-44 md:h-44 rounded-3xl object-cover"
                    loading="eager"
                />
            </div>
            <div>
                <p class="text-xs font-mono uppercase tracking-widest text-cyan-700 dark:text-cyan-400 mb-3"><span class="text-brand-cyan/50">//</span> The Engineer</p>
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

    {{-- Security-First AI Engineering --}}
    <section class="mx-auto max-w-5xl px-6 mb-16">
        <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8" data-reveal>Security-First AI Engineering</h2>
        <div class="grid gap-4 md:grid-cols-2">
            <div class="gradient-border" data-reveal>
                <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Threat Modeling</p>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-2">STRIDE applied to agent design</p>
                <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Tool-calling, MCP servers, and multi-step delegation modeled in the design doc. Attack surface mapped before code, aligned to OWASP Agentic Top 10 2026 and NIST&rsquo;s AI Agent Standards Initiative.</p>
            </div>
            <div class="gradient-border" data-reveal>
                <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">MCP Hardening</p>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Protocol-level defense</p>
                <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Gateway auth (OAuth 2.1), bidirectional JSON-RPC inspection, signed-server allowlists, structured audit logs. Aligned to OWASP MCP Top 10.</p>
            </div>
            <div class="gradient-border" data-reveal>
                <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">RAG Data Governance</p>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Vector stores are not a privacy boundary</p>
                <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Pre-embedding PII masking, document-level ACLs propagated into the index, lineage tracking for GDPR erasure. Embedding inversion (LLM08:2025) treated as a real attack.</p>
            </div>
            <div class="gradient-border" data-reveal>
                <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Guardrails &amp; Evals</p>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Trust by measurement</p>
                <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Llama Guard 3 and NeMo Guardrails at runtime. Garak and PyRIT in CI for adversarial regression. Sandboxed execution (e2b, Modal) for any tool that touches code.</p>
            </div>
            <div class="gradient-border md:col-span-2" data-reveal>
                <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Compliance Readiness</p>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-2">EU AI Act &middot; NIST AI RMF &middot; ISO/IEC 42001</p>
                <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Conformity-ready logging, human-oversight hooks, automated evidence capture. EU AI Act obligations phasing in through 2026&ndash;2027; ISO/IEC 42001 increasingly required in enterprise AI procurement. SOAR-style automation applied to audit trails.</p>
            </div>
        </div>
    </section>

    <div>

        {{-- Key Projects --}}
        <section class="mx-auto max-w-5xl px-6 mb-16">
            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">Key Projects</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">UCF AI Engine</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Sole architect of the AI layer for a compliance SaaS</p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Hybrid retrieval (Qdrant + Neo4j) over 91K+ regulatory records, LangGraph agentic chat, CRAG hallucination verification. Docker/AWS.</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">SADIE</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Production NL2SQL agentic platform</p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">LangGraph + MCP tool-calling, MongoDB Atlas RAG pipeline, 93&ndash;97% query accuracy, Langfuse observability. FastAPI SSE.</p>
                </div>
                <div class="gradient-border gradient-border-amber" data-reveal>
                    <p class="font-mono text-xs text-amber-700 dark:text-amber-400 mb-2">TriageOps Framework</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">6-step AI adoption methodology</p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Discovery Sprints recovered 70+ hrs/month ($42K annually) for one operations team.</p>
                </div>
            </div>
        </section>

        {{-- Technical Skills --}}
        <section class="mx-auto max-w-5xl px-6 mb-16">
            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">Technical Skills</h2>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-3">LLMs & Models</p>
                    <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">GPT-4o, Claude, Gemini, Llama 3, Mistral, Qwen3, ModernBERT; fine-tuning (Unsloth, HuggingFace)</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-3">Agentic Systems</p>
                    <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">LangGraph, LangChain, MCP/tool-calling, multi-agent orchestration, multi-step reasoning, intent classification, memory systems</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-3">RAG & Retrieval</p>
                    <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Qdrant, MongoDB Atlas, FAISS, Chroma, Neo4j, GraphRAG, hybrid retrieval (dense + sparse + graph), NL2SQL, context engineering</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-3">Evaluation & LLMOps</p>
                    <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">RAGAS, hallucination detection, latency benchmarking, Langfuse, Opik, Langsmith, MLflow, prompt versioning, CI/CD eval pipelines</p>
                </div>
                <div class="gradient-border md:col-span-2" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-3">Engineering</p>
                    <p class="text-sm text-muted dark:text-dark-muted leading-relaxed">Python, TypeScript, PHP/Laravel, FastAPI, Docker, Kubernetes, AWS (Bedrock, SageMaker, EC2, S3, Lambda), CI/CD, Clean Architecture, microservices, event-driven systems</p>
                </div>
            </div>
        </section>

        {{-- Experience Timeline --}}
        <section class="mx-auto max-w-5xl px-6 mb-16">
            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">Experience</h2>

            <div class="space-y-6">
                {{-- Unified Compliance --}}
                <div class="gradient-border" data-reveal>
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div>
                            <h3 class="text-body dark:text-dark-body font-medium">Unified Compliance</h3>
                            <p class="text-sm text-cyan-700 dark:text-cyan-400">Senior AI &amp; Agentic Systems Engineer / Architect (Contract)</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted">2025 &ndash; 2026</p>
                            <p class="font-mono text-[10px] text-cyan-700/80 dark:text-cyan-400/70 mt-0.5">via TriageOps</p>
                        </div>
                    </div>
                    <p class="text-xs text-muted dark:text-dark-muted italic mb-3">Sole architect of the entire AI Engine for UCF's ControlSight compliance platform &mdash; 91K+ regulatory records.</p>
                    <ul class="text-xs text-muted dark:text-dark-muted space-y-1.5 list-none">
                        <li>&bull; Built EEL pipeline: PostgreSQL &rarr; dense (ModernBERT) + sparse (BM25) embeddings &rarr; dual-load into Qdrant and Neo4j</li>
                        <li>&bull; Designed hybrid retrieval: Qdrant vector+BM25 with Neo4j graph traversal, plus CRAG grading</li>
                        <li>&bull; Built LangGraph agentic chat with intent classification, multi-turn context, query rewriting</li>
                        <li>&bull; Modeled 8 entity types and 10+ relationships in Neo4j with Cypher queries and cross-store validation</li>
                        <li>&bull; Evaluated using RAGAS (context recall/precision, faithfulness, answer relevancy)</li>
                        <li>&bull; Directed company AI strategy, aligning AI capabilities with product, GTM, and data privacy</li>
                    </ul>
                </div>

                {{-- Storage360 --}}
                <div class="gradient-border" data-reveal>
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div>
                            <h3 class="text-body dark:text-dark-body font-medium">Storage360</h3>
                            <p class="text-sm text-cyan-700 dark:text-cyan-400">AI &amp; Agentic Systems Engineer / Architect (Contract)</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="font-mono text-xs text-muted dark:text-dark-muted">2024 &ndash; 2025</p>
                            <p class="font-mono text-[10px] text-cyan-700/80 dark:text-cyan-400/70 mt-0.5">via TriageOps</p>
                        </div>
                    </div>
                    <p class="text-xs text-muted dark:text-dark-muted italic mb-3">Built SADIE &mdash; a production NL2SQL agentic platform for a property management SaaS.</p>
                    <ul class="text-xs text-muted dark:text-dark-muted space-y-1.5 list-none">
                        <li>&bull; Built agentic workflow using LangGraph with MCP tool-calling and multi-step reasoning</li>
                        <li>&bull; Implemented RAG pipeline with MongoDB Atlas vector search, Qwen3 embeddings</li>
                        <li>&bull; Achieved 93&ndash;97% accuracy via RAGAS evaluation and CI/CD regression testing</li>
                        <li>&bull; Built MCP server for secure read-only database access with schema caching</li>
                        <li>&bull; Deployed via Docker Compose with Langfuse observability and FastAPI SSE streaming</li>
                    </ul>
                </div>

                {{-- IncFile --}}
                <div class="gradient-border" data-reveal>
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div>
                            <h3 class="text-body dark:text-dark-body font-medium">IncFile (Bizee)</h3>
                            <p class="text-sm text-cyan-700 dark:text-cyan-400">AI Systems Engineer / Software Engineer / Technical Project Lead</p>
                        </div>
                        <p class="font-mono text-xs text-muted dark:text-dark-muted shrink-0">2022 &ndash; Present</p>
                    </div>
                    <p class="text-xs text-muted dark:text-dark-muted italic mb-3">Leading AI strategy and platform architecture at a business formation SaaS.</p>
                    <ul class="text-xs text-muted dark:text-dark-muted space-y-1.5 list-none">
                        <li>&bull; Designed multi-agent system for document processing, handling 1,000+ daily requests</li>
                        <li>&bull; Built RAG pipeline with vector search; experimented with GraphRAG/KAG</li>
                        <li>&bull; Implemented multi-layer memory systems for cross-session context retention</li>
                        <li>&bull; Reduced manual data entry by 65% through intelligent form processing</li>
                        <li>&bull; Led platform migration from legacy monolith to service-oriented stack with CI/CD</li>
                        <li>&bull; Mentored 8 engineers on AI/ML development practices</li>
                    </ul>
                </div>

                {{-- Global Cybersec --}}
                <div class="gradient-border" data-reveal>
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div>
                            <h3 class="text-body dark:text-dark-body font-medium">Global Cybersec</h3>
                            <p class="text-sm text-cyan-700 dark:text-cyan-400">Engineering Manager</p>
                        </div>
                        <p class="font-mono text-xs text-muted dark:text-dark-muted shrink-0">2017 &ndash; 2021</p>
                    </div>
                    <p class="text-xs text-muted dark:text-dark-muted italic mb-3">Led engineering for a cybersecurity firm building security automation and incident response.</p>
                    <ul class="text-xs text-muted dark:text-dark-muted space-y-1.5 list-none">
                        <li>&bull; Event-driven architecture processing millions of daily security events</li>
                        <li>&bull; Integrated SIEM, IDS/IPS, firewalls, and SOAR &mdash; 60% reduction in incident response time</li>
                        <li>&bull; Built 4 microservice applications, managed team of 5 engineers</li>
                    </ul>
                </div>

                {{-- Early Career --}}
                <div class="gradient-border" data-reveal>
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                        <div>
                            <h3 class="text-body dark:text-dark-body font-medium">Multiple Companies</h3>
                            <p class="text-sm text-cyan-700 dark:text-cyan-400">Software Engineer</p>
                        </div>
                        <p class="font-mono text-xs text-muted dark:text-dark-muted shrink-0">2014 &ndash; 2017</p>
                    </div>
                    <p class="text-xs text-muted dark:text-dark-muted italic mb-3">Full-stack roles across logistics, healthcare, and proptech.</p>
                    <ul class="text-xs text-muted dark:text-dark-muted space-y-1.5 list-none">
                        <li>&bull; Built logistics platform (GT Transport) handling AP/AR, routing, payroll, HR</li>
                        <li>&bull; Healthcare and proptech platforms with API design, testing, security</li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Education --}}
        <section class="mx-auto max-w-5xl px-6 mb-16">
            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">Education & Certifications</h2>
            <div class="gradient-border" data-reveal>
                <p class="text-sm text-body dark:text-dark-body font-medium mb-1">Universidad Polit&eacute;cnica de Baja California</p>
                <p class="text-xs text-muted dark:text-dark-muted mb-4">Information Technology Engineering (2014&ndash;2016)</p>
                <div class="flex flex-wrap gap-2">
                    <span class="tag">LangChain & LLMs Guide</span>
                    <span class="tag">Gen AI Foundational Models</span>
                    <span class="tag">Business Process Modeling with AI</span>
                </div>
            </div>
        </section>

        {{-- What I'm available for --}}
        <section class="mx-auto max-w-5xl px-6 mb-16">
            <h2 class="font-heading text-fluid-xl text-body dark:text-dark-body mb-8">What I&rsquo;m Available For</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Senior Roles</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">AI &amp; Agentic Systems Engineer &middot; AI Systems Architect</p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Full-time remote, contractor or EOR-employed.</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Consulting</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">AI adoption via <a href="https://triageops.com" target="_blank" rel="noopener noreferrer" class="text-cyan-700 dark:text-cyan-400 hover:underline">TriageOps</a></p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Discovery Sprints, scoped pilots, eval-gated rollouts for mid-market teams.</p>
                </div>
                <div class="gradient-border" data-reveal>
                    <p class="font-mono text-xs text-cyan-700 dark:text-cyan-400 mb-2">Architecture Review</p>
                    <p class="text-sm text-body dark:text-dark-body font-medium mb-2">Second-opinion on production agents</p>
                    <p class="text-xs text-muted dark:text-dark-muted leading-relaxed">Context engineering, evals, MCP attack surface, agent security audits.</p>
                </div>
            </div>
        </section>

        {{-- Download Resume + CTA --}}
        <section class="mx-auto max-w-5xl px-6 text-center" data-reveal>
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-center">
                <a
                    href="/alberto_rosas_ai_engineer.pdf"
                    download
                    class="btn btn-primary"
                >
                    Download Full Resume (PDF)
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </a>
                <a
                    href="/#contact"
                    class="btn btn-ghost"
                >
                    Let&rsquo;s talk
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>
    </div>

</article>
@endsection
