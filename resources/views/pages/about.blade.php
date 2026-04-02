@extends('layouts.app')

@section('title', 'About — Alberto Rosas')
@section('description', 'The story behind Alberto Rosas — from accounts receivable to building production AI systems. Philosophy, path, and the things that move me forward.')

@section('content')
<article class="pt-32 pb-20">

    {{-- Hero --}}
    <header class="mx-auto max-w-5xl px-6 mb-20" data-reveal>
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <img
                src="https://avatars.githubusercontent.com/u/22654040?v=4"
                alt="Alberto Rosas"
                class="w-40 h-40 md:w-52 md:h-52 rounded-3xl object-cover ring-4 ring-border dark:ring-dark-border shadow-lg flex-shrink-0"
                loading="eager"
            >
            <div>
                <h1 class="font-heading text-fluid-hero text-body dark:text-dark-body mb-4">My Story</h1>
                <p class="text-fluid-lg text-muted dark:text-dark-muted max-w-xl leading-relaxed">
                    Twelve years ago I couldn't write a line of code. I said yes anyway. Everything started from that.
                </p>
            </div>
        </div>
    </header>

    {{-- The Mushin Moment --}}
    <section class="mx-auto max-w-3xl px-6 mb-20" data-reveal>
        <h2 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-6">The Mushin Moment</h2>

        <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed mb-4">
            2014. Mexico. I was working accounts receivable. My only real skill was fluent English from growing up in the US.
        </p>
        <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed mb-4">
            My boss asked if I knew someone who could build an internal system. I didn't know anyone. I didn't know anything about coding.
        </p>
        <p class="text-fluid-base text-body dark:text-dark-body leading-relaxed font-medium mb-4">
            I said "I can do it."
        </p>
        <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed mb-4">
            Zero knowledge. Complete commitment. I taught myself, built the system, delivered it. No one noticed anything unusual. They just used it.
        </p>
        <p class="text-fluid-base text-muted dark:text-dark-muted leading-relaxed">
            Years later I found the word for what happened that day. The Japanese call it <span class="font-heading text-brand-amber">Mushin</span> &mdash; <span class="font-mono text-fluid-sm text-brand-amber/80">無心</span> &mdash; No-Mind. The state where you free yourself from every obstacle by refusing to acknowledge them in the first place.
        </p>
    </section>

    {{-- Divider Quote --}}
    <div class="mx-auto max-w-3xl px-6 mb-20" data-reveal>
        <blockquote class="border-l-2 border-brand-amber/40 pl-6 py-2">
            <p class="text-fluid-lg font-heading text-muted dark:text-dark-muted italic">
                "The mind must be freed from techniques and deliberation. Let it act on its own."
            </p>
            <cite class="text-fluid-sm text-brand-amber not-italic mt-2 block">&mdash; Miyamoto Musashi</cite>
        </blockquote>
    </div>

    {{-- The Obsidian Way --}}
    <section class="mx-auto max-w-5xl px-6 mb-20">
        <h2 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-4 text-center" data-reveal>The Obsidian Way</h2>
        <p class="text-fluid-base text-muted dark:text-dark-muted text-center max-w-2xl mx-auto mb-12" data-reveal>
            A personal operating system. Not a philosophy I read &mdash; one I built from experience, failure, and obsessive iteration.
        </p>

        <div class="grid gap-6 md:grid-cols-2">
            {{-- Mushin --}}
            <div class="bento-card" data-reveal>
                <p class="font-mono text-fluid-sm text-brand-cyan mb-2">01</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-3">Mushin <span class="font-mono text-fluid-sm text-brand-amber/80">無心</span></h3>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    Commit first. Learn in motion. The moment you decide, the obstacle stops being an obstacle and becomes terrain.
                </p>
            </div>

            {{-- Future Self Extraction --}}
            <div class="bento-card" data-reveal>
                <p class="font-mono text-fluid-sm text-brand-cyan mb-2">02</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-3">Future Self Extraction</h3>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    Inspired by the film <em>Arrival</em>. Pull certainty from the version of you that already succeeded. Time is not always linear in the mind. Use that.
                </p>
            </div>

            {{-- Consider vs. Believe --}}
            <div class="bento-card" data-reveal>
                <p class="font-mono text-fluid-sm text-brand-cyan mb-2">03</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-3">Consider vs. Believe</h3>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    I don't believe things. I consider them with probabilities. Belief is a cage. Consideration is a tool. One locks the mind. The other keeps it fluid.
                </p>
            </div>

            {{-- The Three Cages --}}
            <div class="bento-card" data-reveal>
                <p class="font-mono text-fluid-sm text-brand-cyan mb-2">04</p>
                <h3 class="font-heading text-fluid-lg text-body dark:text-dark-body mb-3">The Three Cages</h3>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    Belief. Certainty. Identity. Each one traps you deeper. Identity is the final boss &mdash; the cage you defend because you think it's you.
                </p>
            </div>
        </div>
    </section>

    {{-- Divider Quote --}}
    <div class="mx-auto max-w-3xl px-6 mb-20" data-reveal>
        <blockquote class="border-l-2 border-brand-cyan/40 pl-6 py-2">
            <p class="text-fluid-lg font-heading text-muted dark:text-dark-muted italic">
                "The delay is just processing time. Reality hasn't caught up to what you've already decided."
            </p>
        </blockquote>
    </div>

    {{-- The Path --}}
    <section class="mx-auto max-w-3xl px-6 mb-20" data-reveal>
        <h2 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-12 text-center">The Path</h2>

        <div class="relative">
            {{-- Vertical line --}}
            <div class="absolute left-[7px] md:left-[9px] top-2 bottom-2 w-px bg-border dark:bg-dark-border"></div>

            <div class="space-y-10">
                {{-- 2014 --}}
                <div class="flex gap-6 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-brand-amber border-2 border-surface-alt dark:border-dark-surface-alt"></div>
                    </div>
                    <div>
                        <span class="font-mono text-fluid-sm text-brand-cyan block mb-1">2014</span>
                        <p class="text-fluid-base text-body dark:text-dark-body font-medium">Accounts receivable &rarr; "I can do it"</p>
                        <p class="text-fluid-sm text-muted dark:text-dark-muted">Zero coding knowledge. Built the system. Delivered. No one noticed.</p>
                    </div>
                </div>

                {{-- 2014-2022 --}}
                <div class="flex gap-6 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-brand-cyan/60 border-2 border-surface-alt dark:border-dark-surface-alt"></div>
                    </div>
                    <div>
                        <span class="font-mono text-fluid-sm text-brand-cyan block mb-1">2014 &ndash; 2022</span>
                        <p class="text-fluid-base text-body dark:text-dark-body font-medium">Full-stack engineering across industries</p>
                        <p class="text-fluid-sm text-muted dark:text-dark-muted">Cybersecurity, healthcare, education. Global Cybersec, HQ Rental, Buddhi, Fulcrum Digital. Laravel, PHP, JS, microservices.</p>
                    </div>
                </div>

                {{-- 2022 --}}
                <div class="flex gap-6 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-brand-amber border-2 border-surface-alt dark:border-dark-surface-alt"></div>
                    </div>
                    <div>
                        <span class="font-mono text-fluid-sm text-brand-cyan block mb-1">2022</span>
                        <p class="text-fluid-base text-body dark:text-dark-body font-medium">The AI pivot at Bizee/IncFile</p>
                        <p class="text-fluid-sm text-muted dark:text-dark-muted">Tech Lead. Built multi-agent document processing handling 1,000+ daily requests.</p>
                    </div>
                </div>

                {{-- 2024 --}}
                <div class="flex gap-6 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-brand-cyan/60 border-2 border-surface-alt dark:border-dark-surface-alt"></div>
                    </div>
                    <div>
                        <span class="font-mono text-fluid-sm text-brand-cyan block mb-1">2024</span>
                        <p class="text-fluid-base text-body dark:text-dark-body font-medium">SADIE ships at Storage360</p>
                        <p class="text-fluid-sm text-muted dark:text-dark-muted">Natural Language to SQL engine. 14.3% to 86% query success rate. Sub-300ms response times.</p>
                    </div>
                </div>

                {{-- 2025 --}}
                <div class="flex gap-6 items-start">
                    <div class="relative flex-shrink-0">
                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-brand-amber border-2 border-surface-alt dark:border-dark-surface-alt"></div>
                    </div>
                    <div>
                        <span class="font-mono text-fluid-sm text-brand-cyan block mb-1">2025 &ndash; Present</span>
                        <p class="text-fluid-base text-body dark:text-dark-body font-medium">Unified Compliance + TRIAGE Ops</p>
                        <p class="text-fluid-sm text-muted dark:text-dark-muted">AI Engineer at Unified Compliance &mdash; building production AI chat pipelines over regulatory compliance data. Founder of TRIAGE Ops.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Divider Quote --}}
    <div class="mx-auto max-w-3xl px-6 mb-20" data-reveal>
        <blockquote class="border-l-2 border-brand-amber/40 pl-6 py-2">
            <p class="text-fluid-lg font-heading text-muted dark:text-dark-muted italic">
                "Absorb what is useful, discard what is useless, and add what is specifically your own."
            </p>
            <cite class="text-fluid-sm text-brand-amber not-italic mt-2 block">&mdash; Bruce Lee</cite>
        </blockquote>
    </div>

    {{-- Beyond the Code --}}
    <section class="mx-auto max-w-5xl px-6 mb-20">
        <h2 class="font-heading text-fluid-2xl text-body dark:text-dark-body mb-10 text-center" data-reveal>Beyond the Code</h2>

        <div class="grid gap-6 md:grid-cols-3">
            {{-- Harley + Katana --}}
            <div class="bento-card border-brand-amber/30 dark:border-brand-amber/20" data-reveal>
                <p class="text-brand-amber font-heading text-fluid-lg mb-3">The Harley & The Katana</p>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    I ride a Harley and own a katana. Not for aesthetics. If it sharpens your edge or moves you forward, it's a tool.
                </p>
            </div>

            {{-- 4:20 AM --}}
            <div class="bento-card border-brand-amber/30 dark:border-brand-amber/20" data-reveal>
                <p class="text-brand-amber font-heading text-fluid-lg mb-3">4:20 AM. Every Day.</p>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    The alarm hasn't failed yet. Structured routines are operational infrastructure. Discipline isn't motivation &mdash; it's architecture.
                </p>
            </div>

            {{-- Two Brands --}}
            <div class="bento-card border-brand-amber/30 dark:border-brand-amber/20 md:col-span-2" data-reveal>
                <p class="text-brand-amber font-heading text-fluid-lg mb-3">Two Brands</p>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed mb-2">
                    <span class="text-body dark:text-dark-body font-medium">El Arquitecto A.I.</span> &mdash; AI education for Spanish-speaking LATAM. Cyberpunk aesthetic. Teaching what I learned the hard way.
                </p>
                <p class="text-fluid-sm text-muted dark:text-dark-muted leading-relaxed">
                    <span class="text-body dark:text-dark-body font-medium">Obsidian Ronin</span> &mdash; Philosophy, consciousness, mental flexibility. Writing about Mushin, The Three Cages, and why I stopped being an atheist.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-3xl px-6 text-center" data-reveal>
        <div class="bento-card py-12">
            <p class="font-heading text-fluid-lg text-muted dark:text-dark-muted italic mb-6">
                "The delay is just processing time."
            </p>
            <a
                href="/#contact"
                class="inline-flex items-center gap-2 bg-brand-cyan text-white font-body font-medium px-8 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-brand-cyan/25"
            >
                Let's talk
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

</article>
@endsection
