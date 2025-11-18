<section id="experience" data-section="Experience" class="scroll-mt-28 mb-28 sm:mb-40"
         x-data="{
             initObserver() {
                 const observer = new IntersectionObserver((entries) => {
                     entries.forEach((entry) => {
                         if (entry.isIntersecting) {
                             entry.target.classList.add('show');
                             observer.unobserve(entry.target);
                         }
                     });
                 }, { threshold: 0.15 });

                 // Observe all timeline items that are rendered by Blade
                 this.$el.querySelectorAll('.timeline-item').forEach(el => observer.observe(el));
             }
         }"
         x-init="initObserver()">
    
    @include('components.site.section-heading', ['title' => 'Experience'])

    <div class="relative mx-auto max-w-6xl py-4">
        <!-- Vertical Line -->
        <div class="absolute left-8 top-0 h-full w-1 bg-gray-200 dark:bg-gray-700 md:left-1/2 md:-translate-x-1/2"></div>

        @foreach($experiences as $index => $item)
            <div class="timeline-item relative my-12 md:my-24 md:text-left group opacity-0 transition-all duration-700 ease-out {{ $index % 2 === 0 ? 'md:pr-[50%] -translate-x-20' : 'md:pl-[50%] translate-x-20' }}"
                 data-index="{{ $index }}">
                
                <!-- Timeline Icon -->
                <div class="absolute left-8 top-0 flex h-10 w-10 -translate-x-1/2 items-center justify-center rounded-full border-4 border-white bg-white shadow-md dark:border-gray-900 dark:bg-gray-800 md:left-1/2 z-10">
                    <span class="text-xl">
                        @if($item['icon'] === 'LuGraduationCap') 🎓
                        @elseif($item['icon'] === 'CgWorkAlt') 💼
                        @else 💻
                        @endif
                    </span>
                </div>

                <!-- Content Card -->
                <div class="relative ml-16 mr-4 rounded-lg border border-gray-100 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-white/10 dark:shadow-cyan-500/20 md:ml-0 md:mr-0 {{ $index % 2 === 0 ? 'md:mr-12' : 'md:ml-12' }}">
                    
                    <!-- Arrow (Desktop Only) -->
                    <div class="hidden md:block absolute top-3 h-4 w-4 rotate-45 border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800 {{ $index % 2 === 0 ? '-right-2 border-r border-t' : '-left-2 border-l border-b' }}">
                    </div>

                    <!-- Header Grid -->
                    <div class="flex flex-col md:flex-row gap-4 md:items-start justify-between">
                        
                        <!-- Logo & Title Group -->
                        <div class="flex items-start gap-4">
                             <!-- Logo / Placeholder -->
                            <div class="shrink-0">
                                @if(!empty($item['logo']))
                                    <img src="{{ $item['logo'] }}" alt="Company Logo" class="h-12 w-12 object-contain rounded bg-white p-1 shadow-sm border border-gray-100 dark:border-gray-700">
                                @else
                                    <div class="h-12 w-12 flex items-center justify-center rounded bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-700 shadow-sm">
                                        <span class="text-xl">🏢</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Title & Role -->
                            <div class="flex flex-col">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 capitalize leading-tight">{{ $item['title'] }}</h3>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mt-1">{{ $item['location'] }}</p>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="shrink-0">
                            <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $item['date'] }}</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4 pl-[4rem]">
                         <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">{{ $item['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
    /* Utility class for the show animation triggered by IntersectionObserver */
    .timeline-item.show {
        opacity: 1 !important;
        transform: translateX(0) !important;
    }
</style>
                </div>
            </div>
        </template>
    </div>
</section>

<style>
    /* Utility class for the show animation triggered by IntersectionObserver */
    .show {
        opacity: 1 !important;
        transform: translateX(0) !important;
    }
</style>
