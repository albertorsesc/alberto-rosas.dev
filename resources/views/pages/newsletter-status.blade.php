@extends('layouts.app')

@php
    seo()
        ->title(($state === 'confirmed' ? 'Subscribed' : 'Unsubscribed').' · Alberto Rosas')
        ->url(url()->current());
@endphp

@section('content')
<article class="pt-32 pb-24 px-6">
    <div class="mx-auto max-w-2xl text-center" data-reveal>
        @if ($state === 'confirmed')
            <p class="font-mono text-xs uppercase tracking-[0.3em] text-cyan-700 dark:text-cyan-400 mb-5 font-normal">
                <span class="text-cyan-700 dark:text-cyan-400/70" aria-hidden="true">//</span> confirmed
            </p>
            <h1 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4">You're on the list.</h1>
            <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed">
                That's it, you're confirmed. From here, the occasional note on shipping production AI, no filler.
            </p>
            <a href="/blog" class="btn btn-primary group mt-8">
                Read the blog
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </a>
        @else
            <p class="font-mono text-xs uppercase tracking-[0.3em] text-muted dark:text-dark-muted mb-5 font-normal">
                <span aria-hidden="true">//</span> unsubscribed
            </p>
            <h1 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4">You're unsubscribed.</h1>
            <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed">
                No more emails. No hard feelings, the writing stays open on the site whenever you want it.
            </p>
            <a href="/" class="btn btn-ghost mt-8">Back to the site</a>
        @endif
    </div>
</article>
@endsection
