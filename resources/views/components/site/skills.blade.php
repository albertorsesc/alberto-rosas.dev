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
                        class="flex items-center bg-white border border-black shadow-lg dark:shadow-cyan-500 rounded-xl px-5 py-3 dark:bg-white/10 dark:text-white/80 gap-2"
                    >
                        @if(!empty($image) && file_exists(public_path('tech/' . $image)))
                            <img src="/tech/{{ $image }}" class="object-contain rounded-full h-10 w-10" alt="{{ $title }}">
                        @else
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-800 text-cyan-600 dark:text-cyan-400">
                                <i class="fa-solid fa-code text-xl"></i>
                            </div>
                        @endif
                        <span class="font-medium">{{ $title }}</span>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</section>
