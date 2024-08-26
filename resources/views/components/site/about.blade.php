<section
    x-data="{ show: false }"
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

    <p class="mb-3 mx-5 text-lg md:text-2xl">
        Hello! I'm Alberto, a <span class="font-medium">Senior Software Engineer</span> passionate about creating high-quality, secure systems. I specialize in enhancing <span class="font-medium">security, stability, and scalability</span>.

        I've worked across industries like cybersecurity, logistics, and real estate, learning how to effectively structure and secure data.
    </p>

    <p class="mb-3 mx-5 text-lg md:text-2xl">
        I enjoy working with <span class="font-medium">RAG (Retrieval-Augmented Generation) using Vector Stores</span> and building <span class="font-medium">AI agents</span> to automate tasks.
    </p>

    <p class="mb-3 mx-5 text-lg md:text-2xl">
        <span class="italic">When I'm not coding</span>, I love riding my Harley, spending time with my family, and <span class="font-medium">learning new things</span>.
    </p>

    <p class="mb-3 mx-5 text-lg md:text-2xl">
        I look forward to contributing to your team's success and building great products together 💪
    </p>

</section>
