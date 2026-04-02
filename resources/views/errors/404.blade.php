@extends('layouts.app')

@section('title', 'Road Ends Here — Alberto Rosas')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center px-6 pt-32 pb-20">
    <h1 class="font-heading text-fluid-3xl text-body dark:text-dark-body mb-4 text-center">This road's a dead end.</h1>
    <p class="text-fluid-base text-muted dark:text-dark-muted mb-10 text-center max-w-md">
        Even on the best routes, you hit a wrong turn sometimes.
    </p>
    <a
        href="/"
        class="inline-flex items-center gap-2 bg-brand-cyan text-white font-body font-medium px-8 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-brand-cyan/25"
    >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Take me home
    </a>
</div>
@endsection
