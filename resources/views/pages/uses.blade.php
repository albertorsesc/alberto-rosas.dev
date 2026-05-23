@extends('layouts.app')

@section('title', 'Uses — Alberto Rosas')
@section('description', 'The tools, hardware, and systems Alberto Rosas uses daily for AI engineering and life.')

@section('content')
<article class="pt-32 pb-20">

    {{-- Header --}}
    <header class="mx-auto max-w-5xl px-6 mb-16" data-reveal>
        <h1 class="font-heading text-fluid-3xl text-body dark:text-dark-body mb-3">What I Use</h1>
        <p class="text-fluid-base text-muted dark:text-dark-muted max-w-2xl">
            Hardware, software, systems &mdash; and one motorcycle.
        </p>
    </header>

    {{-- Grid --}}
    <div class="mx-auto max-w-5xl px-6 grid gap-8 md:gap-10 md:grid-cols-2">

        {{-- The Machine --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">The Machine</h2>
            <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed mb-3">
                <span class="font-mono text-body dark:text-dark-body">M5 Max MacBook Pro</span>, 128GB unified memory.
            </p>
            <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                Configured for running local AI stacks and large context models. This is not a laptop &mdash; it's a workstation.
            </p>
        </div>

        {{-- AI / ML Stack --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">AI / ML Stack</h2>
            <ul class="space-y-2.5 text-muted dark:text-dark-muted text-fluid-sm">
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">Python</span> + <span class="font-mono text-body dark:text-dark-body">FastAPI</span></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">LangGraph</span>, <span class="font-mono text-body dark:text-dark-body">LangChain</span>, <span class="font-mono text-body dark:text-dark-body">Pydantic AI</span></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">LangSmith</span> &amp; <span class="font-mono text-body dark:text-dark-body">Langfuse</span> for observability</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">OpenAI API</span> &amp; <span class="font-mono text-body dark:text-dark-body">Anthropic API</span></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">Ollama</span> for local models</span>
                </li>
            </ul>
        </div>

        {{-- Vector Databases --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">Vector Databases</h2>
            <ul class="space-y-2.5 text-muted dark:text-dark-muted text-fluid-sm">
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">MongoDB Atlas</span> Vector Search</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Qdrant</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Pinecone</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">ChromaDB</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Weaviate</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">pgvector</span>
                </li>
            </ul>
        </div>

        {{-- Development --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">Development</h2>
            <ul class="space-y-2.5 text-muted dark:text-dark-muted text-fluid-sm">
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">PyCharm</span> / <span class="font-mono text-body dark:text-dark-body">VS Code</span></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Claude Code</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">Warp</span> terminal</span>
                </li>
            </ul>
        </div>

        {{-- Languages & Frameworks --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">Languages & Frameworks</h2>
            <ul class="space-y-2.5 text-muted dark:text-dark-muted text-fluid-sm">
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">Python</span> &mdash; primary language now</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">PHP / Laravel</span> &mdash; the roots</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">TypeScript</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">FastAPI</span> &amp; <span class="font-mono text-body dark:text-dark-body">React</span></span>
                </li>
            </ul>
        </div>

        {{-- Cloud & Infrastructure --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">Cloud & Infrastructure</h2>
            <ul class="space-y-2.5 text-muted dark:text-dark-muted text-fluid-sm">
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span><span class="font-mono text-body dark:text-dark-body">AWS</span> (Lambda, S3, ECS)</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Google Cloud</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Kubernetes</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Terraform</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">Docker</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-brand-cyan mt-1 flex-shrink-0">&bull;</span>
                    <span class="font-mono text-body dark:text-dark-body">GitHub Actions</span>
                </li>
            </ul>
        </div>

        {{-- Knowledge System --}}
        <div class="gradient-border" data-reveal>
            <h2 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-4">Knowledge System</h2>
            <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed mb-2">
                <span class="font-mono text-body dark:text-dark-body">Obsidian</span> with custom YAML frontmatter, wiki-link hubs, and epistemic belief-update framing.
            </p>
            <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                Every note has a confidence level. Knowledge isn't static &mdash; it updates like a Bayesian prior.
            </p>
        </div>

        {{-- The Harley --}}
        <div class="gradient-border gradient-border-amber md:col-span-2 !p-0" data-reveal>
            <div class="grid md:grid-cols-2 items-stretch min-h-[20rem]">
                <div class="relative overflow-hidden">
                    <img
                        src="/img/harley-davidson-48-1600.jpg"
                        alt="2017 Harley Davidson Sportster Forty-Eight"
                        loading="lazy"
                        class="w-full h-full object-cover min-h-[16rem] md:min-h-full"
                        style="image-orientation: from-image;"
                    />
                    {{-- subtle amber overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-surface/40 dark:to-dark-surface/40 pointer-events-none"></div>
                </div>
                <div class="p-6 md:p-8 flex flex-col justify-center">
                    <p class="font-mono text-xs uppercase tracking-widest text-brand-amber/70 mb-3">// the ride</p>
                    <h2 class="font-heading text-fluid-lg text-brand-amber mb-3">The Harley</h2>
                    <p class="font-mono text-fluid-base text-body dark:text-dark-body mb-3">2017 Sportster Forty-Eight &middot; 1200cc</p>
                    <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                        Yes, it&rsquo;s on the uses page. If it moves you forward, it&rsquo;s a tool.
                    </p>
                </div>
            </div>
        </div>

    </div>

</article>
@endsection
