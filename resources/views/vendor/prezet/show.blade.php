@php
    // Blog posts are articles; Prezet's SetSeo never sets the type. Also emit
    // BlogPosting JSON-LD that references the site-level Person/Org by @id.
    seo()->type('article');
    $ldBase = rtrim(url('/'), '/');
    $blogPosting = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $frontmatter->title ?? null,
        'datePublished' => isset($frontmatter->createdAt) ? $frontmatter->createdAt->toIso8601String() : null,
        'articleSection' => $frontmatter->category ?? null,
        'author' => ['@id' => $ldBase.'/#person'],
        'publisher' => ['@id' => $ldBase.'/#triageops'],
        'mainEntityOfPage' => url()->current(),
        'image' => $ldBase.'/og-image.png',
    ]);
@endphp
<x-prezet::template>
    <script type="application/ld+json">{!! json_encode($blogPosting, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Reading Progress Bar --}}
    <div class="reading-progress"></div>

    {{-- Centered article + TOC. No left docs-sidebar: for a personal blog the top
         nav and the /blog index already cover navigation, and the left rail only
         starved the reading column and left the desktop lopsided. The article now
         reads at a generous measure, centered, with a sticky table of contents. --}}
    <div class="mx-auto flex w-full max-w-3xl gap-10 xl:max-w-5xl xl:gap-16">
        <article class="min-w-0 flex-1">
            <header class="mb-10 space-y-3">
                @if ($frontmatter->category)
                    <span class="tag">
                        {{ $frontmatter->category }}
                    </span>
                @endif
                <h1 class="font-heading text-fluid-3xl tracking-tight text-body dark:text-dark-body">
                    {{ $frontmatter->title }}
                </h1>
                @if (isset($frontmatter->createdAt))
                    <time
                        datetime="{{ $frontmatter->createdAt->toIso8601String() }}"
                        class="block font-mono text-sm text-muted dark:text-dark-muted"
                    >
                        {{ $frontmatter->createdAt->format('F j, Y') }}
                    </time>
                @endif
                <p class="font-mono text-sm text-muted dark:text-dark-muted">
                    By <a href="/about" rel="author" class="text-cyan-700 dark:text-cyan-400 hover:underline">Alberto Rosas</a>
                </p>
            </header>
            <div
                class="prose prose-lg prose-stone dark:prose-invert max-w-none prose-headings:font-heading prose-headings:tracking-tight prose-a:text-cyan-700 dark:prose-a:text-cyan-400 prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-code:font-mono prose-pre:rounded-xl prose-pre:border prose-pre:border-border dark:prose-pre:border-dark-border"
            >
                {!! $body !!}
            </div>
        </article>

        {{-- Table of contents — sticky, desktop only --}}
        <aside class="hidden xl:block xl:flex-none">
            <nav
                aria-labelledby="on-this-page-title"
                class="sticky top-28 max-h-[calc(100vh-8rem)] w-56 overflow-y-auto py-2"
            >
                <h2
                    id="on-this-page-title"
                    class="font-heading text-sm font-medium text-body dark:text-dark-body"
                >
                    On this page
                </h2>
                <ol role="list" class="mt-4 space-y-3 text-sm">
                    @foreach ($headings as $h2)
                        <li>
                            <h3>
                                <a
                                    href="#{{ $h2['id'] }}"
                                    :class="{
                                        'text-cyan-700 dark:text-brand-cyan border-brand-cyan': activeHeading === '{{ $h2['id'] }}',
                                        'text-muted dark:text-dark-muted hover:text-body dark:hover:text-dark-body border-transparent': activeHeading !== '{{ $h2['id'] }}'
                                    }"
                                    x-on:click.prevent="scrollToHeading('{{ $h2['id'] }}')"
                                    class="block border-l-2 pl-3 transition-colors duration-200"
                                >
                                    {{ $h2['title'] }}
                                </a>
                            </h3>

                            @if ($h2['children'])
                                <ol
                                    role="list"
                                    class="mt-2 space-y-3 pl-3"
                                >
                                    @foreach ($h2['children'] as $h3)
                                        <li>
                                            <a
                                                href="#{{ $h3['id'] }}"
                                                :class="{
                                                    'text-cyan-700 dark:text-brand-cyan border-brand-cyan': activeHeading === '{{ $h3['id'] }}',
                                                    'text-muted dark:text-dark-muted hover:text-body dark:hover:text-dark-body border-transparent': activeHeading !== '{{ $h3['id'] }}'
                                                }"
                                                x-on:click.prevent="scrollToHeading('{{ $h3['id'] }}')"
                                                class="block border-l-2 pl-3 transition-colors duration-200"
                                            >
                                                {{ $h3['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </aside>
    </div>
</x-prezet::template>
