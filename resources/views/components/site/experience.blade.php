<section id="experience" data-section="Experience" class="scroll-mt-28 mb-28 sm:mb-40"
         x-data="{
             experiences: {{ json_encode($experiences) }},
             observer: null,
             initObserver() {
                 this.observer = new IntersectionObserver((entries) => {
                     entries.forEach((entry) => {
                         if (entry.isIntersecting) {
                             entry.target.classList.add('show');
                             this.observer.unobserve(entry.target);
                         }
                     });
                 }, { threshold: 0.5 });
             }
         }"
         x-init="initObserver()">
    <!-- Section Heading Component -->
    @include('components.site.section-heading', ['title' => 'Experience'])

    <!-- Vertical Timeline -->
    <div class="vertical-timeline">
        <template x-for="(item, index) in experiences" :key="index">
            <div class="vertical-timeline-element"
                 :class="{ 'left': index % 2 === 0, 'right': index % 2 !== 0 }"
                 x-data="{ theme: 'dark', visible: false }"
                 x-init="$nextTick(() => observer.observe($el))">
                <div
                    class="content shadow-lg dark:shadow-cyan-500"
                    :class="{ 'from-left': index % 2 === 0, 'from-right': index % 2 !== 0 }"
                    :style="{
                        background: theme === 'light' ? '#f3f4f6' : 'rgba(255, 255, 255, 0.05)',
                        border: '2px solid rgba(0, 0, 0, 0.05)',
                        textAlign: 'left',
                        padding: '1.3rem 2rem'
                    }"
                >
                    <div class="content-arrow"
                         :style="{
                            borderRight: theme === 'light' ? '0.7rem solid #9ca3af' : '0.7rem solid rgba(255, 255, 255, 0.5)',
                         }"
                    ></div>

                    <div class="flex justify-between">
                        <h3 class="font-semibold capitalize" x-text="item.title"></h3>
                        <span class="date" x-text="item.date"></span>
                    </div>
                    <p class="font-normal" x-text="item.location"></p>
                    <p class="mt-1 font-normal text-gray-700 dark:text-white/75" x-text="item.description"></p>
                </div>

                <div class="icon"
                     :style="{
                        background: theme === 'light' ? 'white' : 'rgba(255, 255, 255, 0.15)',
                        fontSize: '1.5rem'
                     }"
                >
                    <span x-text="item.icon === 'LuGraduationCap' ? '🎓' : item.icon === 'CgWorkAlt' ? '💼' : '💻'"></span>

                </div>
            </div>
        </template>
    </div>
</section>

<style>
    .vertical-timeline {
        position: relative;
        margin: 0 auto;
        padding: 1rem 0;
        max-width: 1200px;
    }
    .vertical-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: #9ca3af;
    }
    .vertical-timeline-element {
        position: relative;
        margin: 6rem 0;
    }
    .vertical-timeline-element.left {
        padding-right: 50%;
    }
    .vertical-timeline-element.right {
        padding-left: 50%;
    }
    .vertical-timeline-element .icon {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 0 4px #f3f4f6;
        z-index: 10;
    }
    .vertical-timeline-element .content {
        position: relative;
        border-radius: 8px;
        opacity: 0;
        transform: translateX(-100px);
        transition: all 0.5s ease-out;
    }
    .vertical-timeline-element.right .content {
        transform: translateX(100px);
    }
    .vertical-timeline-element.show .content {
        opacity: 1;
        transform: translateX(0);
    }
    .vertical-timeline-element .content-arrow {
        position: absolute;
        top: 1.5rem;
        width: 0;
        height: 0;
        border-style: solid;
    }
    .vertical-timeline-element.left .content-arrow {
        right: -0.4rem;
        border-width: 0.5rem 0 0.5rem 0.4rem;
        border-color: transparent transparent transparent #9ca3af;
    }
    .vertical-timeline-element.right .content-arrow {
        left: -0.4rem;
        border-width: 0.5rem 0.4rem 0.5rem 0;
        border-color: transparent #9ca3af transparent transparent;
    }
    .vertical-timeline-element .date {
        font-size: 0.875rem;
        color: #6b7280;
        /*position: absolute;*/
        /*top: 0;*/
    }
    /*.vertical-timeline-element.left .date {
        right: 0;
        text-align: right;
        padding-right: 2rem;
    }
    .vertical-timeline-element.right .date {
        left: 0;
        text-align: left;
        padding-left: 2rem;
    }*/

    @media (max-width: 768px) {
        .vertical-timeline::before {
            left: 2rem;
        }
        .vertical-timeline-element {
            padding-left: 4rem !important;
            padding-right: 0 !important;
        }
        .vertical-timeline-element .icon {
            left: 2rem;
        }
        .vertical-timeline-element .content-arrow {
            display: none;
        }
        .vertical-timeline-element .date {
            position: static;
            margin-top: 0.5rem;
            display: block;
            text-align: left !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }
</style>
