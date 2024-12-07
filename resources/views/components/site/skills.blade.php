<section
        id="tech-stack"
        data-section="Tech Stack"
        x-data="{
        skillsVisible: false,
        animateSkill(el, index) {
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 150);
        }
    }"
    x-intersect="skillsVisible = true; $nextTick(() => { $refs.skillsList.querySelectorAll('li').forEach((el, i) => animateSkill(el, i)) })"
    class="mb-28 max-w-[53rem] scroll-mt-28 text-center sm:mb-40"
>
    @include('components.site.section-heading', ['title' => 'Tech Stack'])

    <div x-ref="skillsList" class="text-lg gap-y-3">
        @foreach ($skillsData as $category => $skills)
            <h3 class="mt-6 mb-4 text-2xl font-semibold text-cyan-500">{{ $category }}</h3>

            <!-- Skills List -->
            <ul class="flex flex-wrap justify-center gap-y-8 gap-x-8 text-gray-800">
                @foreach ($skills as $title => $image)
                    <li
                        x-show="skillsVisible"
                        style="opacity: 0; transform: translateY(10px); transition: opacity 0.3s ease-out, transform 0.3s ease-out;"
                        class="flex items-center bg-white border border-black shadow-lg dark:shadow-cyan-500 rounded-xl px-5 py-3 dark:bg-white/10 dark:text-white/80"
                    >
                        <img src="/tech/{{ $image }}" class="mr-2 object-contain rounded-full h-10 w-10" alt="">
                        {{ $title }}
                    </li>
                @endforeach
            </ul>
        @endforeach

        {{--@foreach ($aiTools as $category => $skills)
            <!-- Category Heading -->
            <h3 class="mt-6 mb-4 text-2xl font-semibold text-cyan-500">{{ $category }}</h3>

            <!-- Skills List -->
            <ul class="flex flex-wrap justify-center gap-2">
                @foreach ($skills as $title)
                    <li
                        x-show="skillsVisible"
                        style="opacity: 0; transform: translateY(10px); transition: opacity 0.3s ease-out, transform 0.3s ease-out;"
                        class="flex items-center bg-white border border-black shadow-lg dark:shadow-cyan-500 rounded-xl px-5 py-3 dark:bg-white/10 dark:text-white/80"
                    >
                        {{ $title }}
                    </li>
                @endforeach

            </ul>
        @endforeach--}}
    </div>
</section>
