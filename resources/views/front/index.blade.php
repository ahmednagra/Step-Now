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
