<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"
      x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }"
      x-init="
          if (!darkMode) document.documentElement.classList.remove('dark');
          $watch('darkMode', value => {
              document.documentElement.classList.toggle('dark', value);
              localStorage.setItem('darkMode', value);
          });
      "
      :class="{ 'dark': darkMode }">
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title', config('app.name'))</title>
        <meta name="description" content="@yield('description', 'Alberto Rosas — AI Engineer, Strategic Consultant, and builder of intelligent systems.')">

        @hasSection('meta')
            @yield('meta')
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
        <link rel="preload" as="font" href="https://fonts.gstatic.com/s/inter/v18/UcCo3FwrK3iLTcviYwY.woff2" type="font/woff2" crossorigin>

        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('head')
    </head>
    <body class="bg-surface text-body font-body antialiased dark:bg-dark-surface dark:text-dark-body">
        {{-- Header --}}
        @include('components.site.header')

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.site.footer')

        @livewireScripts

        <!-- GSAP + ScrollTrigger -->
        <script defer src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>

        <!-- Lenis Smooth Scroll -->
        <script defer src="https://unpkg.com/lenis@1/dist/lenis.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && typeof Lenis !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);
                    const lenis = new Lenis({ duration: 1.2, lerp: 0.1 });
                    lenis.on('scroll', ScrollTrigger.update);
                    gsap.ticker.add((time) => lenis.raf(time * 1000));
                    gsap.ticker.lagSmoothing(0);
                    window.__lenis = lenis;
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>
