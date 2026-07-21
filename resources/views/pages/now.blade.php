@extends('layouts.app')

{{--
    ▸ /now page — update this single variable each time you revise content below.
    ▸ It feeds both the page header and the meta description automatically.
--}}
@php
    $lastUpdated = 'May 2026';
@endphp

@section('title', 'Now — Alberto Rosas')
@section('description', "What Alberto Rosas is building, learning, reading, and thinking about right now. Updated {$lastUpdated}.")

@section('content')
<article class="pt-32 pb-20">

    {{-- Header --}}
    <header class="mx-auto max-w-2xl px-6 mb-16" data-reveal>
        <h1 class="font-heading text-fluid-3xl text-body dark:text-dark-body mb-3">Now</h1>
        <p class="text-fluid-base text-muted dark:text-dark-muted">
            What I'd tell a friend I hadn't seen in a year. Last updated {{ $lastUpdated }}.
        </p>
    </header>

    {{-- Content --}}
    <div class="mx-auto max-w-2xl px-6 prose prose-stone dark:prose-invert prose-headings:font-heading prose-headings:tracking-tight prose-a:text-cyan-700 dark:prose-a:text-brand-cyan prose-a:no-underline hover:prose-a:underline">

        <section data-reveal>
            <h2>Building</h2>
            <p>
                Production AI chat pipelines. Multi-agent orchestration with LangGraph, hybrid retrieval with Qdrant + Neo4j, evaluation with Langfuse. Running <a href="https://triageops.com" target="_blank" rel="noopener noreferrer">TRIAGE Ops</a> on the consulting side.
            </p>
        </section>

        <section data-reveal>
            <h2>Learning</h2>
            <p>
                Deep in agent runtimes and harness architectures. Researching open-source compliant patterns for enterprise. Unified agentic-ops in local-first environments that can eventually scale to enterprise. Also: psychocybernetics &mdash; hacking the mind's self-image for self-improvement. The wetware is part of the stack.
            </p>
        </section>

        <section data-reveal>
            <h2>Reading</h2>
            <ul>
                <li><em>Building Applications with AI Agents</em> &mdash; Michael Albada</li>
                <li><em>Architecting AI Software Systems</em> &mdash; Richard D. Avila &amp; Imran Ahmad</li>
                <li><em>Meditations</em> &mdash; Marcus Aurelius</li>
                <li><em>The Way of Zen</em> &mdash; Alan Watts</li>
            </ul>
        </section>

        <section data-reveal>
            <h2>Thinking About</h2>
            <p>
                How to make AI agents truly reliable in production. The gap between demo and deployment is where the real engineering lives. Whether the concept of identity is the final cage. And what a unified agentic-ops layer looks like when you start local-first and design for enterprise from day one.
            </p>
        </section>

        <section data-reveal>
            <h2>Life</h2>
            <p>
                Riding season. 4:20 AM alarm hasn't failed yet. Coffee remains non-negotiable.
            </p>
        </section>

    </div>

    {{-- Inspired by --}}
    <div class="mx-auto max-w-2xl px-6 mt-16 pt-8 border-t border-border dark:border-dark-border" data-reveal>
        <p class="text-fluid-sm text-subtle dark:text-dark-muted">
            This is a <a href="https://nownownow.com/about" target="_blank" rel="noopener noreferrer" class="text-link text-muted dark:text-dark-muted">/now page</a>, inspired by Derek Sivers.
        </p>
    </div>

</article>
@endsection
