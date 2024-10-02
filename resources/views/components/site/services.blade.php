<section id="services" data-section="Services" class="scroll-mt-28 mb-28">
    @include('components.site.section-heading', ['title' => 'Services'])

    <div class="services-container flex flex-col items-center w-full px-4 sm:px-0 gap-y-4">
        @foreach ($services as $service)
            @include('components.site.service', ['service' => $service])
        @endforeach
    </div>
</section>
