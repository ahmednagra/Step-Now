@extends('front.layouts.master')
@section('title', __('Contact'))
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/contact.css') }}" />
@endsection
@section('content')
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ __('Contact') }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ __('Contact') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-call"></span>
                        </div>
                        <p>{{ __('Call us') }}</p>
                        <h3><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></h3>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-email"></span>
                        </div>
                        <p>{{ __('Write to us') }}</p>
                        <h3><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></h3>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <div class="contact-info__single">
                        <div class="contact-info__icon">
                            <span class="icon-location"></span>
                        </div>
                        <p>{{ __('Our office location') }}</p>
                        <h3>{{ $setting->address }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.partials.contact-us.form')

@endsection
