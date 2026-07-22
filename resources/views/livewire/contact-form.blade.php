<div>
    {{-- The live region exists on first render: a region injected together with
         its content is not announced by some screen reader / browser pairs. --}}
    <div role="status" aria-live="polite">
    @if (session()->has('status'))
        <div class="rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/40 p-5 mb-6">
            <div class="flex items-start gap-3">
                <svg class="h-5 w-5 text-green-500 mt-0.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-green-800 dark:text-green-300">Message Received!</h3>
                    <p class="mt-1 text-sm text-green-700 dark:text-green-400">{{ session()->get('status') }}</p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <form class="space-y-5" wire:submit.prevent="save">
        {{-- Honeypot --}}
        <div class="absolute opacity-0 -z-10" aria-hidden="true" tabindex="-1">
            <input type="text" wire:model="website" autocomplete="off" tabindex="-1" />
        </div>

        <p class="font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">All fields required</p>

        <div>
            <label for="contact-name" class="block mb-2 font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">Name</label>
            <input
                id="contact-name"
                class="w-full h-14 px-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-subtle focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-colors duration-200 @error('name') ring-2 ring-red-500 border-red-500 @enderror"
                type="text"
                wire:model="name"
                autocomplete="name"
                aria-required="true"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
            />
            @error('name')
                <p id="name-error" class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contact-email" class="block mb-2 font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">Email</label>
            <input
                id="contact-email"
                class="w-full h-14 px-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-subtle focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-colors duration-200 @error('email') ring-2 ring-red-500 border-red-500 @enderror"
                type="email"
                wire:model="email"
                autocomplete="email"
                aria-required="true"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
            />
            @error('email')
                <p id="email-error" class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contact-message" class="block mb-2 font-mono text-[10px] uppercase tracking-[0.18em] text-muted dark:text-dark-muted">Message</label>
            <textarea
                id="contact-message"
                class="w-full h-48 p-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-subtle focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-colors duration-200 resize-none @error('message') ring-2 ring-red-500 border-red-500 @enderror"
                wire:model="message"
                placeholder="What should we work on together?"
                aria-required="true"
                @error('message') aria-invalid="true" aria-describedby="message-error" @enderror
            ></textarea>
            @error('message')
                <p id="message-error" class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

        @error('form')
            <div class="rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 p-4" role="alert">
                <p class="text-sm text-red-700 dark:text-red-400">{{ $message }}</p>
            </div>
        @enderror

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="btn btn-primary w-full h-14"
        >
            <span wire:loading.remove>Send Message</span>
            <span wire:loading class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                Sending...
            </span>
        </button>
    </form>
</div>
