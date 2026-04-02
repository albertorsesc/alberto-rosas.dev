{{-- Mobile Sidebar --}}
<div
    x-show="showSidebar"
    x-on:keydown.escape.window="showSidebar = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 flex h-full items-start overflow-y-auto bg-body/50 pr-10 backdrop-blur dark:bg-dark-body/50 lg:hidden"
>
    <div
        class="min-h-full w-full max-w-xs bg-surface px-4 pb-12 pt-24 dark:bg-dark-surface sm:px-6"
        x-on:click.outside="showSidebar = false"
    >
        <x-prezet::nav :nav="$nav" />
    </div>
</div>

{{-- Desktop Sidebar --}}
<div class="hidden lg:relative lg:block lg:flex-none">
    <div class="absolute inset-y-0 right-0 w-[50vw] bg-surface-alt dark:bg-dark-surface-alt"></div>
    <div
        class="absolute bottom-0 right-0 top-16 hidden h-12 w-px bg-gradient-to-t from-border dark:from-dark-border"
    ></div>
    <div
        class="absolute bottom-0 right-0 top-28 hidden w-px bg-border dark:bg-dark-border"
    ></div>
    <div
        class="sticky top-28 -ml-0.5 flex h-[calc(100vh-8rem)] w-64 flex-col justify-between overflow-y-auto overflow-x-hidden pb-4 pl-0.5 pr-8 pt-16 xl:w-72 xl:pr-16"
    >
        <x-prezet::nav :nav="$nav" />
        <div class="text-xs text-muted dark:text-dark-muted">
            <a target="_blank" href="https://prezet.com" class="hover:text-body dark:hover:text-dark-body transition-colors">Powered by Prezet</a>
        </div>
    </div>
</div>
