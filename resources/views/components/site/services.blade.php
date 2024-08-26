<section id="services" data-section="Services" class="scroll-mt-28 mb-28">
    <!-- Section Heading Component -->
    @include('components.site.section-heading', ['title' => 'Services'])

    <div>
        @foreach ($services as $service)
            @include('components.site.service', ['service' => $service])
        @endforeach
    </div>
</section>
