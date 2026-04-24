<section class="services-one">
    <div class="services-one__shape-1"></div>
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box justify-content-center">
                {{-- <div class="section-title__tagline-shape">
                    <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}" alt="">
                </div> --}}
                <span class="section-title__tagline">Was wir anbieten</span>
            </div>
            <h2 class="section-title__title title-animation">
                Dienstleistungen, die wir unseren Kunden anbieten
            </h2>
        </div>
        <div class="row">

            @foreach ($services as $service)
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms"
                    data-wow-duration="1500ms">
                    <div class="services-one__single">
                        <div class="services-one__single-shape-1"></div>
                        <div class="services-one__single-shape-2"></div>
                        <div class="services-one__single-shape-3"></div>
                        <div class="services-one__count"></div>
                        <div class="services-one__icon">
                            <img src="{{ asset($service->icon) }}" alt="Icon" width="50">
                        </div>
                        <h3 class="services-one__title"><a
                                href="{{ route('front.service.detail', $service->slug) }}">{{ $service->name }}</a>
                        </h3>
                        <p class="services-one__text">{!! $service->short_description !!}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
