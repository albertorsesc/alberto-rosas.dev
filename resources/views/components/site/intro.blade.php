<section id="home" data-section="Home" class="mb-28 max-w-full lg:max-w-[50rem] text-center sm:mb-0 scroll-mt-[100rem]">
    <div class="flex items-center justify-center">
        <div class="relative">
            <!-- Animated Image -->
            <div
                x-data="{ showImage: false }"
                x-init="showImage = true"
                x-show="showImage"
                x-transition:enter="transition transform duration-1000"
                x-transition:enter-start="opacity-0 scale-0"
                x-transition:enter-end="opacity-100 scale-100"
                class="h-32 w-32 md:h-24 md:w-24 rounded-full object-cover border-[0.20rem] border-white shadow-xl"
            >
                <img
                    src="https://avatars.githubusercontent.com/u/22654040?s=400&u=b4c45a0a60117314537fa0ef7aec04e2038e07da&v=4"
                    alt="Alberto Rosas"
                    width="auto"
                    height="auto"
                    class="h-32 w-32 md:h-24 md:w-24 rounded-full object-cover"
                />
            </div>

            <!-- Animated Emoji -->
            <span
                x-data="{ showEmoji: false }"
                x-init="setTimeout(() => showEmoji = true, 300)"
                x-show="showEmoji"
                x-transition:enter="transition transform duration-500"
                x-transition:enter-start="opacity-0 scale-0"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute bottom-0 right-0 text-3xl"
            >
                👋
            </span>
        </div>
    </div>

    <!-- Animated Heading -->
    <h1
        x-data="{ showHeading: false }"
        x-init="setTimeout(() => showHeading = true, 300)"
        x-show="showHeading"
        x-transition:enter="transition transform duration-700"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="mb-10 mt-8 md:mt-4 px-4 text-2xl md:text-4xl font-medium leading-8 sm:text-4xl text-center"
    >
        <span class="font-medium">Hello, I'm Alberto Rosas.</span> I'm a
        <span class="font-bold">Software Engineer</span> with
        <span class="font-bold">over a decade</span> of experience building
        <span class="italic">Web/Mobile apps</span>.
    </h1>

    <!-- Animated Buttons -->
    <div
        x-data="{ showButtons: false }"
        x-init="setTimeout(() => showButtons = true, 400)"
        x-show="showButtons"
        x-transition:enter="transition transform duration-700"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="flex flex-col sm:flex-row items-center justify-center gap-3 gap-y-4 px-4 text-lg font-medium"
    >
        <a
            href="#contact"
            class="group bg-white dark:bg-cyan-700 text-cyan-500 dark:text-white px-7 py-3 flex items-center shadow-xl gap-2 rounded-full outline-none focus:scale-110 hover:scale-110 hover:bg-gray-950 active:scale-105 transition"
            @click="showButtons = false"
        >
            Let's get to work
            <span class="opacity-70 group-hover:translate-x-1 transition">➡️</span>
        </a>

        <a
            class="group bg-white text-cyan-500 dark:text-cyan-500 font-bold px-7 py-3 flex items-center gap-2 rounded-full shadow-xl outline-none dark:outline-cyan-500 focus:scale-110 hover:scale-110 active:scale-105 transition cursor-pointer"
            href="/CV.pdf"
            download
        >
            Download CV
            <span class="opacity-60 group-hover:translate-y-1 transition">⬇️</span>
        </a>

        <div class="flex flex-row gap-3">
            <a
                class="bg-white dark:bg-white/10 p-4 text-gray-700 dark:text-white/60 hover:text-gray-950 dark:hover:text-white flex items-center gap-2 rounded-full shadow-lg focus:scale-[1.15] hover:scale-[1.15] active:scale-105 transition cursor-pointer"
                href="https://linkedin.com"
                target="_blank"
            >
                <i class="fa-brands fa-linkedin-in"></i>
            </a>

            <a
                class="bg-white dark:bg-white/10 p-4 text-gray-700 dark:text-white/60 hover:text-gray-950 dark:hover:text-white flex items-center gap-2 rounded-full shadow-lg focus:scale-[1.15] hover:scale-[1.15] active:scale-105 transition cursor-pointer"
                href="https://github.com"
                target="_blank"
            >
                <i class="fa-brands fa-github"></i>
            </a>

            <a
                class="bg-white dark:bg-white/10 p-4 text-gray-700 dark:text-white/60 hover:text-gray-950 dark:hover:text-white flex items-center gap-2 rounded-full shadow-lg focus:scale-[1.15] hover:scale-[1.15] active:scale-105 transition cursor-pointer"
                href="https://x.com/bcryp7"
                target="_blank"
            >
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </div>
    </div>
</section>
