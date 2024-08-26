<div
        x-data="{
        visible: false,
        animationDirection: ''
    }"
        x-ref="serviceRef"
        x-init="
        const el = $refs.serviceRef;
        const index = Array.from(el.parentNode.children).indexOf(el); // Get the index of the card
        animationDirection = index % 2 === 0 ? 'left' : 'right'; // Alternate direction
        const observer = new IntersectionObserver(([entry]) => {
            visible = entry.isIntersecting;
        }, { threshold: 0.1 });
        observer.observe(el);
    "
        :class="{
        'transition-transform duration-700 ease-out': true,
        'opacity-100 translate-x-0': visible,
        'opacity-0 -translate-x-full': !visible && animationDirection === 'left',
        'opacity-0 translate-x-full': !visible && animationDirection === 'right'
    }"
        class="group mb-3 sm:mb-8 last:mb-0 transform opacity-0"
>
<section class="bg-white items-center max-w-[48rem] border-2 border-cyan-400 dark:border-none rounded-lg shadow-lg dark:shadow-cyan-500 overflow-hidden sm:pr-8 relative sm:h-[15rem] transition dark:text-white dark:bg-white/10 dark:hover:bg-white/20">
    <div class="pt-4 pb-7 px-5 sm:pt-10 sm:max-w-full flex flex-col h-full">
        <h3 class="text-2xl font-semibold">{{ $service['title'] }}</h3>
        <p class="mt-2 leading-relaxed text-xl text-gray-700 dark:text-white/70">
            {{ $service['description'] }}
        </p>
        <ul class="flex flex-wrap mt-4 gap-2 sm:mt-auto">
            {{--@foreach ($project['tags'] as $tag)
                <li class="bg-black/[0.7] px-3 py-1 text-[0.7rem] uppercase tracking-wider text-white rounded-full dark:text-white/70">
                    {{ $tag }}
                </li>
            @endforeach--}}
        </ul>
    </div>
</section>
</div>
