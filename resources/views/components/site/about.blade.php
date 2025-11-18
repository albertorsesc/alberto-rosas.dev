<section
    x-data="{ show: false }"
    x-cloak
    x-init="setTimeout(() => show = true, 175)"
    x-show="show"
    x-transition:enter="transition transform duration-500"
    x-transition:enter-start="opacity-0 translate-y-10"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="mb-28 max-w-[45rem] text-justify leading-8 sm:mb-40 scroll-mt-28"
    id="about"
    data-section="About"
>
    @include('components.site.section-heading', ['title' => 'About me'])

    <p class="mb-4 mx-5 text-lg md:text-xl text-gray-700 dark:text-gray-300">
        Hello! I'm Alberto, an <span class="font-bold text-cyan-600 dark:text-cyan-400">AI Engineer and Strategic Consultant</span> with <span class="font-bold">12 years</span> of experience. I have bridged the gap between traditional software engineering and modern AI, shifting my focus from building standard web apps to architecting <span class="font-semibold">autonomous multi-agent systems</span> and <span class="font-semibold">enterprise-grade RAG pipelines</span>.
    </p>

    <p class="mb-4 mx-5 text-lg md:text-xl text-gray-700 dark:text-gray-300">
        Currently, I engineer intelligent solutions like <span class="font-semibold">SADIE</span> (a Natural Language to SQL engine) and automate complex business workflows handling thousands of daily requests. My passion lies in <span class="font-bold">productionizing AI</span>—moving beyond prototypes to build reliable, scalable systems using tools like <span class="italic">LangGraph, Pydantic AI, and Vector Databases</span>.
    </p>

    <p class="mb-4 mx-5 text-lg md:text-xl text-gray-700 dark:text-gray-300">
        When I'm not fine-tuning models or optimizing vector searches, I love riding my Harley, spending time with my family, and exploring the frontiers of multi-modal AI.
    </p>

    <p class="mb-4 mx-5 text-lg md:text-xl text-gray-700 dark:text-gray-300 font-medium">
        I don't just write code; I build <span class="text-cyan-600 dark:text-cyan-400">intelligent infrastructure</span> that drives real business value.
    </p>

</section>
