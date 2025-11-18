<div
        x-data="{
        visible: false,
        direction: 'left'
    }"
        x-ref="serviceRef"
        x-cloak
        x-init="
        $nextTick(() => {
            const el = $refs.serviceRef;
            const index = Array.from(el.parentElement.children).indexOf(el);
            direction = index % 2 === 0 ? 'left' : 'right';

            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            visible = true;
                        }, index * 200);
                    }
                },
                {
                    threshold: 0.1,
                    rootMargin: '100px 0px 100px 0px' // Increased rootMargin
                }
            );

            // Fallback for mobile devices
            const checkVisibility = () => {
                const rect = el.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                if (rect.top <= windowHeight && rect.bottom >= 0) {
                    setTimeout(() => {
                        visible = true;
                    }, index * 200);
                    window.removeEventListener('scroll', checkVisibility);
                }
            };

            // Use both IntersectionObserver and scroll event
            observer.observe(el);
            window.addEventListener('scroll', checkVisibility);
            checkVisibility(); // Check initial visibility
        });
    "
        :class="{
        'translate-x-0 opacity-100': visible,
        '-translate-x-full opacity-0': !visible && direction === 'left',
        'translate-x-full opacity-0': !visible && direction === 'right'
    }"
        class="group mb-3 sm:mb-8 last:mb-0 transform transition-all duration-1000 ease-out w-full"
>
    <section class="bg-white items-center mx-auto max-w-[48rem] border-2 border-cyan-400 dark:border-none rounded-lg shadow-lg dark:shadow-cyan-500 overflow-hidden sm:pr-8 relative min-h-[16rem] h-auto transition dark:text-white dark:bg-white/10 dark:hover:bg-white/20">
        <div class="pt-4 pb-7 px-5 sm:pt-10 sm:max-w-full flex flex-col h-full">
            <div class="flex items-center gap-3">
                @if(isset($service['icon']))
                    <span class="text-3xl">{{ $service['icon'] }}</span>
                @endif
                <h3 class="text-2xl font-semibold">{{ $service['title'] }}</h3>
            </div>
            <p class="mt-2 leading-relaxed text-xl text-gray-700 dark:text-white/70">
                {{ $service['description'] }}
            </p>
            <ul class="flex flex-wrap mt-4 gap-2">
                @if(isset($service['tags']))
                    @foreach ($service['tags'] as $tag)
                        <li class="bg-black/[0.7] px-3 py-1 text-[0.7rem] uppercase tracking-wider text-white rounded-full dark:text-white/70">
                            {{ $tag }}
                        </li>
                    @endforeach
                @endif
            </ul>
            
            @if(isset($service['url']))
                <div class="mt-6">
                    <a href="{{ $service['url'] }}" target="_blank" class="inline-flex items-center gap-2 text-cyan-600 dark:text-cyan-400 font-medium hover:underline">
                        Visit Triage Ops <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
