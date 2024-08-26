<div>
    @if (session()->has('status'))
        <div class="mt-6 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Message Received!</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>{{ session()->get('status') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form class="mt-6 flex flex-col dark:text-black" wire:submit.blur="save">
        <input
            class="my-3 h-14 px-4 rounded-xl dark:bg-white dark:bg-opacity-80 dark:focus:bg-opacity-100 transition-all dark:outline-none active:border-cyan-400 focus:border-cyan-400 @error('message') border-4 border-red-500 @enderror"
            type="text"
            wire:model="name"
            placeholder="Please enter your name"
        />
        <div class="flex justify-start">
            @error('name')
                <span class="text-red-500 font-semibold">{{ $message }}</span>
            @enderror
        </div>

        <input
            class="my-3 h-14 px-4 rounded-xl dark:bg-white dark:bg-opacity-80 dark:focus:bg-opacity-100 transition-all dark:outline-none active:border-cyan-400 focus:border-cyan-400 @error('message') border-4 border-red-500 @enderror"
            type="email"
            wire:model="email"
            placeholder="Please enter your email"
        />
        <div class="flex justify-start">
            @error('email')
                <span class="text-red-500 font-semibold">{{ $message }}</span>
            @enderror
        </div>

        <textarea
            class="h-52 my-3 rounded-xl p-4 dark:bg-white dark:bg-opacity-80 dark:focus:bg-opacity-100 transition-all dark:outline-none active:border-cyan-400 focus:border-cyan-400 @error('message') border-4 border-red-500 @enderror"
            wire:model="message"
            placeholder="What should we work on together?"
        ></textarea>
        <div class="flex justify-start">
            @error('message')
                <span class="text-red-500 font-semibold">{{ $message }}</span>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-cyan-600 text-white rounded-xl px-4 py-4 mt-4 hover:bg-cyan-700 transition-colors"
        >Send Message</button>
    </form>
</div>
