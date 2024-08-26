<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="!scroll-smooth">
    <head>
        @production
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-H1NBRRQX1S"></script>
            <script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', 'G-H1NBRRQX1S');
            </script>
        @endproduction
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        @livewireStyles
        @vite('resources/css/app.css')
    </head>
    <body x-data="{ activeSection: 'Home' }"
          x-init="
            const sections = document.querySelectorAll('section[data-section]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        activeSection = entry.target.getAttribute('data-section');
                    }
                });
            }, { threshold: 0.6 }); // Adjust threshold as needed

            sections.forEach(section => observer.observe(section));
        "
          class="bg-gray-50 text-gray-950 relative pt-28 sm:pt-36 dark:bg-gray-900 dark:text-gray-50 dark:text-opacity-90">
        <div class="bg-cyan-200 absolute top-[-6rem] -z-10 right-[11rem] h-[31.25rem] w-[31.25rem] rounded-full blur-[10rem] sm:w-[68.75rem] dark:bg-cyan-400"></div>
        <div class="bg-cyan-400 absolute top-[-1rem] -z-10 left-[-35rem] h-[31.25rem] w-[50rem] rounded-full blur-[10rem] sm:w-[68.75rem] md:left-[-33rem] lg:left-[-28rem] xl:left-[-15rem] 2xl:left-[-5rem] dark:bg-cyan-900"></div>

        {{--Header--}}
        @include('components.site.header', ['links' => $links])

        <main class="flex flex-col items-center px-4">
            @include('components.site.intro')
            @include('components.site.section-divider')
            @include('components.site.about')
            @include('components.site.services', ['services' => $services])
            @include('components.site.experience', ['experiences' => $experiences])
            @include('components.site.skills', ['skillsData' => $skillsData])
            @include('components.site.contact')
        </main>

    @livewireScripts
    </body>
</html>
