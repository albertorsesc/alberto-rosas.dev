<section id="contact" data-section="Contact" class="mb-20 sm:mb-28 w-[min(100%,38rem)] text-center">
    <!-- Section Heading Component -->
    @include('components.site.section-heading', ['title' => 'Contact me'])

    <p class="text-gray-700 -mt-6 dark:text-white/80">
        Contact me directly at
        <a class="underline text-cyan-500" href="mailto:alberto.rsesc@protonmail.com">alberto.rsesc@protonmail.com</a>
        or through this form.
    </p>

    <livewire:contact-form lazy></livewire:contact-form>
</section>
