@extends('front.layouts.master')
@section('title', 'About Us')
@section('css')

    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/about.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/testimonial.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/why-choose.css') }}" />

@endsection
@section('content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
            <h3>Über uns</h3>
            <div class="thm-breadcrumb__inner">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ route('front.index') }}">Startseite</a></li>
                    <li><span class="icon-arrow-left"></span></li>
                    <li>Über uns</li>
                </ul>
            </div>
        </div>

        </div>
    </section>

    @include('front.partials.about-us.about-2')

    @include('front.partials.why-choose-us.why-choose-us-1')

    @include('front.partials.testimonial.testimonial-1')

@endsection
