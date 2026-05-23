@php
    /* @var \BenBjurstrom\Prezet\Data\FrontmatterData $article */
@endphp

<x-prezet::template>
    @seo([
        'title' => 'Articles — Alberto Rosas',
        'description' =>
            'AI & Agentic Systems Engineer. Writing on production agents, hybrid retrieval, security and guardrails, evaluation pipelines, and the engineering behind real AI systems.',
        'url' => route('prezet.index'),
    ])

    <section class="mt-8 lg:mt-12">
        {{-- Page Header --}}
        <div class="mb-10 space-y-2">
            <p class="font-mono text-sm text-brand-cyan">
                Writing & Research
            </p>
            <h1 class="font-heading text-fluid-3xl tracking-tight text-body dark:text-dark-body">
                Articles
            </h1>
            <p class="max-w-2xl text-fluid-base text-muted dark:text-dark-muted">
                Thoughts on AI, software engineering, and building intelligent systems.
            </p>
        </div>

        @if ($articles->count())
            {{-- Featured / Latest Post --}}
            @php $featured = $articles->first(); @endphp
            <article class="bento-card mb-12 overflow-hidden p-0" data-reveal>
                <a href="{{ route('prezet.show', $featured->slug) }}" class="group block">
                    @if ($featured->image)
                        <div class="overflow-hidden">
                            <img
                                class="h-64 w-full object-cover object-center transition-transform duration-500 group-hover:scale-105 sm:h-80"
                                src="{{ $featured->image }}"
                                alt="{{ $featured->title }}"
                            />
                        </div>
                    @endif
                    <div class="p-6 sm:p-8">
                        @if ($featured->category)
                            <span class="tag">{{ $featured->category }}</span>
                        @endif
                        <h2 class="mt-3 font-heading text-fluid-xl tracking-tight text-body dark:text-dark-body group-hover:text-brand-cyan transition-colors">
                            {{ $featured->title }}
                        </h2>
                        <time
                            datetime="{{ $featured->createdAt->toIso8601String() }}"
                            class="mt-2 block font-mono text-sm text-muted dark:text-dark-muted"
                        >
                            {{ $featured->createdAt->format('F j, Y') }}
                        </time>
                        <p class="mt-3 text-fluid-base leading-relaxed text-muted dark:text-dark-muted">
                            {{ $featured->excerpt }}
                        </p>
                        <span class="text-link mt-4 inline-flex items-center gap-1 text-sm font-medium text-brand-cyan">
                            Read article
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </div>
                </a>
            </article>

            {{-- Remaining Posts Grid --}}
            @if ($articles->count() > 1)
                <div class="grid gap-8 md:grid-cols-2">
                    @foreach ($articles->skip(1) as $article)
                        <article class="bento-card group overflow-hidden p-0" data-reveal>
                            <a href="{{ route('prezet.show', $article->slug) }}" class="block h-full">
                                @if ($article->image)
                                    <div class="overflow-hidden">
                                        <img
                                            class="h-48 w-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                            src="{{ $article->image }}"
                                            alt="{{ $article->title }}"
                                        />
                                    </div>
                                @endif
                                <div class="flex flex-1 flex-col p-6">
                                    @if ($article->category)
                                        <span class="tag self-start">{{ $article->category }}</span>
                                    @endif
                                    <h2 class="mt-3 font-heading text-xl tracking-tight text-body dark:text-dark-body group-hover:text-brand-cyan transition-colors">
                                        {{ $article->title }}
                                    </h2>
                                    <time
                                        datetime="{{ $article->createdAt->toIso8601String() }}"
                                        class="mt-2 block font-mono text-sm text-muted dark:text-dark-muted"
                                    >
                                        {{ $article->createdAt->format('F j, Y') }}
                                    </time>
                                    <p class="mt-3 flex-1 text-sm leading-relaxed text-muted dark:text-dark-muted line-clamp-3">
                                        {{ $article->excerpt }}
                                    </p>
                                    <span class="text-link mt-4 inline-flex items-center gap-1 text-sm font-medium text-brand-cyan">
                                        Read more
                                        <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
        @else
            <p class="text-muted dark:text-dark-muted">No articles yet. Check back soon.</p>
        @endif
    </section>
</x-prezet::template>
