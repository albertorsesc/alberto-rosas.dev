<div
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 125)"
    x-show="show"
    x-transition:enter="transition transform duration-300"
    x-transition:enter-start="opacity-0 translate-y-10"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="bg-gray-200 my-24 h-16 w-1 rounded-full hidden sm:block dark:bg-opacity-20"
></div>
