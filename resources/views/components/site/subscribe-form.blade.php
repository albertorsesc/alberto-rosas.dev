@props(['source' => 'site', 'cta' => 'Subscribe'])

@php
    // `$errors` is shared by the web group's session-error middleware, which does
    // not run on cached, cookie-stripped blog pages. Default it so the component
    // renders anywhere.
    $errors ??= new \Illuminate\Support\ViewErrorBag;

    // Any non-footer subscribe form marks the page as already having one, so the
    // global footer form suppresses itself (see components/site/footer.blade.php).
    // Content renders before the footer, so the flag is set in time.
    if ($source !== 'footer') {
        app('view')->share('pageHasInlineSubscribe', true);
    }
@endphp

{{-- Cache-safe newsletter capture: a plain POST form (works without JS) that
     app.js enhances with fetch + inline feedback. Lives on cached, cookie-stripped
     blog pages where Livewire/session can't. Tagged by `source` for segmentation. --}}
<div data-subscribe-wrap>
    @if (session('subscribed') === $source)
        <p role="status" class="font-mono text-sm text-cyan-700 dark:text-brand-cyan">
            Check your inbox to confirm your subscription.
        </p>
    @else
        <form data-subscribe method="POST" action="{{ route('newsletter.subscribe') }}"
              data-source="{{ $source }}" class="flex max-w-md flex-col gap-3 sm:flex-row">
            <input type="hidden" name="source" value="{{ $source }}">
            {{-- Honeypot: hidden from people, tempting to bots. A filled value is
                 dropped server-side. aria-hidden + tabindex keep humans out of it. --}}
            <div class="sr-only" aria-hidden="true">
                <label for="sub-hp-{{ $source }}">Leave this field empty</label>
                <input id="sub-hp-{{ $source }}" type="text" name="website" tabindex="-1" autocomplete="off" value="">
            </div>
            <label for="sub-{{ $source }}" class="sr-only">Email address</label>
            <input
                id="sub-{{ $source }}"
                name="email"
                type="email"
                required
                placeholder="you@company.com"
                autocomplete="email"
                value="{{ old('source') === $source ? old('email') : '' }}"
                class="flex-1 rounded-lg border border-border bg-surface-alt px-4 py-3 text-sm text-body placeholder:text-muted transition-colors focus:border-cyan-700 focus:outline-none dark:border-dark-border dark:bg-dark-surface-alt dark:text-dark-body dark:focus:border-brand-cyan"
            />
            <button type="submit" class="btn btn-primary shrink-0" data-subscribe-btn>
                <span data-label>{{ $cta }}</span>
                <span data-loading hidden>Sending&hellip;</span>
            </button>
        </form>

        <p data-subscribe-success role="status" hidden class="mt-2 font-mono text-sm text-cyan-700 dark:text-brand-cyan">
            Check your inbox to confirm your subscription.
        </p>

        @if ($errors->has('email') && old('source') === $source)
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('email') }}</p>
        @endif
        <p data-subscribe-error role="alert" hidden class="mt-2 text-sm text-red-600 dark:text-red-400"></p>

        <p class="mt-2 text-xs text-muted dark:text-dark-muted">
            Occasional notes on production AI. Unsubscribe anytime.
        </p>
    @endif
</div>
