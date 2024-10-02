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
    <section class="bg-white items-center mx-auto max-w-[48rem] border-2 border-cyan-400 dark:border-none rounded-lg shadow-lg dark:shadow-cyan-500 overflow-hidden sm:pr-8 relative sm:h-[15rem] transition dark:text-white dark:bg-white/10 dark:hover:bg-white/20">
        <div class="pt-4 pb-7 px-5 sm:pt-10 sm:max-w-full flex flex-col h-full">
            <h3 class="text-2xl font-semibold">{{ $service['title'] }}</h3>
            <p class="mt-2 leading-relaxed text-xl text-gray-700 dark:text-white/70">
                {{ $service['description'] }}
            </p>
            <ul class="flex flex-wrap mt-4 gap-2 sm:mt-auto">
            </ul>
        </div>
    </section>
</div>
