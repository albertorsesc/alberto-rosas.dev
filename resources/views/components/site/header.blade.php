<header class="z-[999] relative"
        x-data="{
            activeSection: 'Home', // Initialize the activeSection here
            darkMode: localStorage.getItem('darkMode') === 'true',
            showHeader: false,
            links: {{ json_encode($links) }},
            menuOpen: false
        }"
        x-init="
            setTimeout(() => showHeader = true, 100);
            $watch('darkMode', value => {
                document.documentElement.classList.toggle('dark', value);
                localStorage.setItem('darkMode', value);
            });
            $watch('menuOpen', value => {
                document.body.style.overflowY = value ? 'hidden' : '';
            });
        ">
    <!-- Animated Background -->
    <div
            x-show="showHeader"
            x-transition:enter="transition transform duration-1000"
            x-transition:enter-start="translate-y-[-100%] opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            class="hidden sm:flex fixed top-0 left-1/4 2xl:left-1/3 h-[4.5rem] sm:h-[3.25rem] w-full sm:w-[46rem] rounded-none border border-white border-opacity-40 bg-white bg-opacity-80 shadow-2xl shadow-black/[0.03] backdrop-blur-[2.5rem] sm:top-6 sm:rounded-full dark:bg-gray-950 dark:border-2 dark:border-cyan-300 dark:bg-opacity-75"
    ></div>

    <!-- Desktop Navigation - Hidden on Mobile -->
    <nav class="hidden sm:flex fixed top-[0.15rem] left-1/2 lg:-ml-3 2xl:ml-12 h-12 -translate-x-1/2 py-2 sm:top-[1.7rem] sm:h-[initial] sm:py-0">
        <ul class="flex w-full flex-wrap items-center justify-center gap-y-1 text-[0.9rem] font-medium sm:flex-nowrap sm:gap-5">
            <template x-for="(link, index) in links" :key="index">
                <li
                        x-show="showHeader"
                        x-transition:enter="transition transform duration-1000"
                        x-transition:enter-start="translate-y-[-100%] opacity-0"
                        x-transition:enter-end="translate-y-0 opacity-100"
                        class="h-3/4 flex items-center justify-center relative"
                >
                    <a
                            :href="link.hash"
                            class="flex w-full items-center justify-center px-3 py-3 transition duration-700 hover:text-cyan-500 dark:hover:text-cyan-400"
                            :class="{
                            'text-gray-900 dark:text-gray-200 font-semibold': activeSection === link.name,
                            'text-gray-800 dark:text-gray-300 font-normal': activeSection !== link.name
                        }"
                            x-text="link.name"
                            @click="activeSection = link.name"
                    ></a>
                    <span
                            x-show="activeSection === link.name"
                            x-transition:enter="transition transform duration-700"
                            class="bg-white dark:bg-cyan-700 border-2 border-cyan-500 dark:border-none rounded-full absolute inset-0 -z-10"
                    ></span>
                </li>
            </template>
            {{--Toggle--}}
            <li class="h-3/4 flex">
                <div x-data="{
                darkMode: false,
                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode);
                    this.updateTheme();
                },
                updateTheme() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }"
                     x-init="
                darkMode = localStorage.getItem('darkMode') === 'true' ||
                          (localStorage.getItem('darkMode') === null &&
                           window.matchMedia('(prefers-color-scheme: dark)').matches);
                updateTheme();
            "
                     class="items-center transition-colors duration-300">
                    <button @click="toggleDarkMode()"
                            class="relative inline-flex items-center w-16 h-8 rounded-full bg-gray-300 dark:bg-gray-700 dark:border-2 dark:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors duration-300">
                        <span class="absolute left-1 w-6 h-6 bg-white dark:bg-gray-700 rounded-full shadow-md transform transition-transform duration-300"
                              :class="{ 'translate-x-8': darkMode, 'translate-x-0': !darkMode }">
                        </span>
                        <span class="absolute left-1 flex items-center justify-center w-6 h-6 transition-opacity duration-300"
                              :class="{ 'opacity-0': darkMode, 'opacity-100': !darkMode }">☀️</span>
                        <span class="absolute right-1 flex items-center justify-center w-6 h-6 transition-opacity duration-300"
                              :class="{ 'opacity-100': darkMode, 'opacity-0': !darkMode }">🌙</span>
                    </button>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Mobile Drawer Menu - Visible on Mobile -->
    <div x-data="{ open: false }" class="sm:hidden relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" x-transition.opacity></div>

        <!-- Drawer Container -->
        <div x-show="open" class="fixed inset-0 flex items-end justify-center overflow-hidden">
            <!-- Mobile Drawer -->
            <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-y-full"
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave="transform transition ease-in-out duration-500"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full"
                    class="pointer-events-auto w-full max-w-md bg-white dark:bg-gray-900 shadow-3xl rounded-t-3xl"
            >
                <div class="flex h-full flex-col overflow-y-scroll bg-white dark:bg-gray-800 py-6 rounded-t-xl">
                    <div class="px-4 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-200" id="slide-over-title">Menu</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button
                                        @click="open = false"
                                        type="button"
                                        class="relative rounded-md bg-white dark:bg-gray-900 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <!-- Mobile Menu Content -->
                        <ul class="flex flex-col items-start gap-y-4">
                            <template x-for="(link, index) in links" :key="index">
                                <li class="flex items-center">
                                    <svg x-show="link.hash === '#home'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                    </svg>

                                    <svg x-show="link.hash === '#about'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <svg x-show="link.hash === '#services'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                    </svg>

                                    <svg x-show="link.hash === '#blog'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                                    </svg>

                                    <svg x-show="link.hash === '#experience'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                                    </svg>

                                    <svg x-show="link.hash === '#tech-stack'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                    </svg>

                                    <svg x-show="link.hash === '#contact'"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                    </svg>





                                    <a
                                            :href="link.hash"
                                            class="text-xl text-gray-900 dark:text-gray-200 px-4 py-2 transition duration-300 hover:text-cyan-500 dark:hover:text-cyan-400"
                                            @click="activeSection = link.name; open = false"
                                            x-text="link.name"
                                    ></a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trigger Button -->
        <button
                @click="open = !open; menuOpen = open"
                class="fixed top-4 right-6 p-3 bg-gray-800 text-white rounded-full shadow-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2"
        >
            <!-- Hamburger Icon -->
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</header>
