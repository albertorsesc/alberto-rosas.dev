<div>
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

    <form class="space-y-5" wire:submit.prevent="save">
        {{-- Honeypot --}}
        <div class="absolute opacity-0 -z-10" aria-hidden="true" tabindex="-1">
            <input type="text" wire:model="website" autocomplete="off" tabindex="-1" />
        </div>

        <div>
            <input
                class="w-full h-14 px-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-muted focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-all duration-200 @error('name') ring-2 ring-red-500 border-red-500 @enderror"
                type="text"
                wire:model="name"
                placeholder="Your name"
            />
            @error('name')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input
                class="w-full h-14 px-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-muted focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-all duration-200 @error('email') ring-2 ring-red-500 border-red-500 @enderror"
                type="email"
                wire:model="email"
                placeholder="Your email"
            />
            @error('email')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <textarea
                class="w-full h-48 p-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-muted focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-all duration-200 resize-none @error('message') ring-2 ring-red-500 border-red-500 @enderror"
                wire:model="message"
                placeholder="What should we work on together?"
            ></textarea>
            @error('message')
                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
            @enderror
        </div>

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
