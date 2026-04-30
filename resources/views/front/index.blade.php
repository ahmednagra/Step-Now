@extends('front.layouts.master')
@section('title', 'Home')
@section('css')

    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/about.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/booking.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/counter.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/pricing.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/testimonial.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/faq.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/process.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/why-choose.css') }}" />

    {{-- Slider height override: cap the hero so it doesn't fill the entire viewport --}}
    <style>
        .main-slider,
        .main-slider .item {
            height: 600px !important;
            min-height: 600px !important;
            max-height: 600px !important;
        }
        .main-slider__bg {
            height: 600px !important;
            background-size: cover !important;
            background-position: center center !important;
        }
        .main-slider__content {
            padding-top: 80px;
            padding-bottom: 80px;
        }
        .main-slider__title {
            font-size: 48px !important;
            line-height: 1.15 !important;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .main-slider,
            .main-slider .item,
            .main-slider__bg {
                height: 450px !important;
                min-height: 450px !important;
                max-height: 450px !important;
            }
            .main-slider__title {
                font-size: 32px !important;
            }
        }
    </style>
    
@endsection
@section('content')

    @include('front.partials.slider.slider')

    @include('front.partials.about-us.about-2')

    @include('front.partials.services.service-1')

    @include('front.partials.process.process-1')

    @include('front.partials.booking.booking-1')

    @include('front.partials.testimonial.testimonial-1')

    @include('front.partials.why-choose-us.why-choose-us-1')

    @include('front.partials.counter.counter-1')

    @include('front.partials.faq.faq')

@endsection
