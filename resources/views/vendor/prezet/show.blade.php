<x-prezet::template>
    {{-- Reading Progress Bar --}}
    <div class="reading-progress"></div>

    {{-- Left Sidebar --}}
    <x-slot name="left">
        <x-prezet::sidebar :nav="$nav" />
    </x-slot>

    {{-- Main Content --}}
    <article>
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
        </header>
        <div
            class="prose prose-stone dark:prose-invert max-w-none prose-headings:font-heading prose-headings:tracking-tight prose-a:text-brand-cyan prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-code:font-mono prose-pre:rounded-xl prose-pre:border prose-pre:border-border dark:prose-pre:border-dark-border"
        >
            {!! $body !!}
        </div>
    </article>

    {{-- Right Sidebar (TOC) --}}
    <x-slot name="right">
        <div
            class="hidden xl:sticky xl:top-28 xl:-mr-6 xl:block xl:h-[calc(100vh-8rem)] xl:flex-none xl:overflow-y-auto xl:py-16 xl:pr-6"
        >
            <nav aria-labelledby="on-this-page-title" class="w-56">
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
                                        'text-brand-cyan border-brand-cyan': activeHeading === '{{ $h2['id'] }}',
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
                                                    'text-brand-cyan border-brand-cyan': activeHeading === '{{ $h3['id'] }}',
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
        </div>
    </x-slot>
</x-prezet::template>
