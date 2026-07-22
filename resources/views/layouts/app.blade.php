<!DOCTYPE html>
{{-- The site is dark-only. The blog is the one surface that keeps the
     light/dark toggle (long-form reading is a legitimate light-mode case). --}}
@if (request()->is('blog*'))
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
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" x-data="{ darkMode: true }">
@endif
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

        @hasSection('meta')
            @yield('meta')
        @else
            <title>@yield('title', 'Alberto Rosas — AI & Agentic Systems Engineer')</title>
            <meta name="description" content="@yield('description', 'AI & Agentic Systems Engineer. 12+ years in software, 5+ in production AI. LangGraph + MCP agents, hybrid retrieval, eval-first. Based in Mexico.')">
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
        <a href="#main" class="skip-link">Skip to content</a>

        {{-- Header --}}
        @include('components.site.header')

        {{-- Main Content --}}
        <main id="main">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.site.footer')

        @livewireScripts

        <!-- GSAP + ScrollTrigger -->
        <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js"
                integrity="sha384-XmJ9SoHtVOHoQUcKvFAzVXwdkKo1Ie3bhmSoIAkcdsHGaIrVJIkmozyq0FJeb/Ly"
                crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js"
                integrity="sha384-wl5TeDVvOWt30Pbf8aSo2ZrzsOjddu3avOBvHe+p+OhJt9gP6w9YXmDkN5DK2/dF"
                crossorigin="anonymous"></script>

        <!-- Lenis Smooth Scroll -->
        <script defer src="https://cdn.jsdelivr.net/npm/lenis@1.3.23/dist/lenis.min.js"
                integrity="sha384-iiCtod6ZId6zT42Bar9EFXNKZh8X4VliWYWFOuY3/t1AxCvLejXExXcbluoc57CJ"
                crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && typeof Lenis !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);
                    // Native scrolling for reduced-motion users: Lenis is the one
                    // motion source the CSS reduced-motion block cannot reach.
                    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                        const lenis = new Lenis({ duration: 1.2, lerp: 0.1 });
                        lenis.on('scroll', ScrollTrigger.update);
                        gsap.ticker.add((time) => lenis.raf(time * 1000));
                        gsap.ticker.lagSmoothing(0);
                        window.__lenis = lenis;
                    }
                }
            });
        </script>

        @stack('scripts')

        {{-- Without JS the GSAP entrances never fire and their start states
             (masked lines, opacity-0) would hide the content permanently. --}}
        <noscript>
            <style>
                [data-fold], [data-fold-line], [data-trace], [data-fold] * { opacity: 1 !important; transform: none !important; }
                .translate-y-full { transform: none !important; }
                [data-verdict-line], [data-verdict-dot] { opacity: 1 !important; }
            </style>
        </noscript>
    </body>
</html>
