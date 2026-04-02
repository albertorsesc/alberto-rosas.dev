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

    <form class="space-y-5" wire:submit.blur="save">
        <div>
            <input
                class="w-full h-14 px-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-muted focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-all duration-200 @error('name') ring-2 ring-red-500 border-red-500 @enderror"
                type="text"
                wire:model="name"
                placeholder="Your name"
            />
            @error('name')
                <p class="mt-1.5 text-sm text-red-500 font-medium">{{ $message }}</p>
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
                <p class="mt-1.5 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <textarea
                class="w-full h-48 p-5 rounded-xl bg-surface-alt dark:bg-dark-surface-alt border border-border dark:border-dark-border text-body dark:text-dark-body placeholder:text-subtle dark:placeholder:text-dark-muted focus:outline-none focus:ring-2 focus:ring-brand-cyan/50 focus:border-brand-cyan transition-all duration-200 resize-none @error('message') ring-2 ring-red-500 border-red-500 @enderror"
                wire:model="message"
                placeholder="What should we work on together?"
            ></textarea>
            @error('message')
                <p class="mt-1.5 text-sm text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full h-14 rounded-xl bg-brand-cyan text-white font-medium text-fluid-sm shadow-lg shadow-brand-cyan/25 hover:shadow-brand-cyan/40 hover:opacity-90 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0"
        >
            Send Message
        </button>
    </form>
</div>
