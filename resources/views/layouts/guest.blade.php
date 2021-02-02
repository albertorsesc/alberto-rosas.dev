<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🧑🏻‍💻</text></svg>">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            body { font-family: 'Roboto'; }
        </style>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GJD4HZ07VC"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-GJD4HZ07VC');
        </script>
    </head>
    <body class="antialiased">
        <div class="flex items-top justify-center min-h-screen dark:bg-gray-900 md:items-center md:pt-0"
             style="background-color: #a3ddcb" {{--a2d0c1--}}
             x-data="{ isOpen: false }"
             @close.stop="isOpen = false">
                <div class="fixed top-0 right-0 px-6 py-4 md:block">
                    <button class="py-2 px-2" @click="isOpen = ! isOpen">
                        <svg class="cursor-pointer h-8 w-8 md:h-10 md:w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

            @include('components.mobile-menu')

            <div class="max-w-6xl mx-auto md:px-6 lg:px-8">

                <div class="flex-wrap justify-center align-middle items-center text-center my-10">
                    @yield('content')
                </div>
            </div>
        </div>

    </body>
</html>
