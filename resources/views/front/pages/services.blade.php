@extends('front.layouts.master')
@section('title', __('Services'))
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/listing.css') }}" />
@endsection
@section('content')

    {{-- Page Header --}}
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front') }}/assets/images/About-pic3.jpg);">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ __('Services') }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ __('Services') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA banner (now bilingual) --}}
    @include('front.partials.cta.cta-1')

    {{-- Service categories --}}
    @foreach ($serviceCategories as $category)
        <section class="services-one">
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box justify-content-center">
                        <div class="section-title__tagline-shape">
                            <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}" alt="">
                        </div>
                        <span class="section-title__tagline">{{ tr($category, 'description') }}</span>
                    </div>
                    <h2 class="section-title__title title-animation">{{ tr($category, 'title') }}</h2>
                </div>
                <div class="row">

                    @foreach ($category->services as $service)
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
                                <h3 class="services-one__title">
                                    <a href="{{ route('front.service.detail', $service->slug) }}">
                                        {{ tr($service, 'name') ?? $service->name }}
                                    </a>
                                </h3>
                                <p class="services-one__text">
                                    {!! tr($service, 'short_description') ?? $service->short_description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endforeach

@endsection
