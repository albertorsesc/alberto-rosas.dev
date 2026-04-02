<nav class="text-base lg:text-sm">
    <ul role="list" class="space-y-9">
        @foreach ($nav as $section)
            <li>
                <h2 class="font-heading font-medium text-body dark:text-dark-body">
                    {{ $section['title'] }}
                </h2>
                <ul
                    role="list"
                    class="mt-2 space-y-2 border-l-2 border-border lg:mt-4 lg:space-y-4 dark:border-dark-border"
                >
                    @foreach ($section['links'] as $link)
                        <li class="relative">
                            <a
                                @class([
                                    'before:-translate-y-1/2 block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:rounded-full transition-colors',
                                    'font-semibold text-brand-cyan before:bg-brand-cyan' =>
                                        url()->current() === route('prezet.show', ['slug' => $link['slug']]),
                                    'text-muted dark:text-dark-muted before:hidden before:bg-muted hover:text-body dark:hover:text-dark-body hover:before:block' =>
                                        url()->current() !== route('prezet.show', ['slug' => $link['slug']]),
                                ])
                                href="{{ route('prezet.show', ['slug' => $link['slug']]) }}"
                            >
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</nav>
