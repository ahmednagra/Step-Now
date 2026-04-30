@extends('front.layouts.master')
@section('title', __('Pricing'))
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/pricing.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/listing.css') }}" />
@endsection
@section('content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ __('Pricing') }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ __('Pricing') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-one pricing-page-one">
        <div class="container">

            @foreach ($package_categories as $category)
                <div class="category-section mb-5">
                    @if (tr($category, 'title') || tr($category, 'description'))
                        <div class="section-title text-center sec-title-animation animation-style1">
                            <div class="section-title__tagline-box justify-content-center">
                                <div class="section-title__tagline-shape">
                                    <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}"
                                        alt="">
                                </div>
                                @if (tr($category, 'title'))
                                    <span class="section-title__tagline">{{ tr($category, 'title') }}</span>
                                @endif
                            </div>
                            @if (tr($category, 'sub_title'))
                                <h2 class="section-title__title title-animation">{{ tr($category, 'sub_title') }}</h2>
                            @endif
                            @if (tr($category, 'description'))
                                <p class="text-center mt-3">{!! tr($category, 'description') !!}</p>
                            @endif
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($category->packages as $package)
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                                <div class="pricing-one__single">
                                    @if($package->icon)
                                        <div class="pricing-one__icon">
                                            <img src="{{ asset('assets/admin/uploads/package/' . $package->icon) }}" alt="" width="50">
                                        </div>
                                    @endif
                                    <h3 class="pricing-one__title">{{ tr($package, 'title') }}</h3>
                                    @if(tr($package, 'destination'))
                                        <p class="pricing-one__destination">
                                            <span class="icon-pin-2"></span> {{ tr($package, 'destination') }}
                                        </p>
                                    @endif
                                    @if(tr($package, 'subtitle'))
                                        <p class="pricing-one__subtitle">{{ tr($package, 'subtitle') }}</p>
                                    @endif
                                    <div class="pricing-one__price">
                                        @if($package->discounted_amount)
                                            <span class="pricing-one__amount-old"><del>{{ $package->currency_symbol }}{{ $package->amount }}</del></span>
                                            <span class="pricing-one__amount">{{ $package->currency_symbol }}{{ $package->discounted_amount }}</span>
                                        @else
                                            <span class="pricing-one__amount">{{ $package->currency_symbol }}{{ $package->amount }}</span>
                                        @endif
                                    </div>
                                    @if(count($package->details ?? []))
                                        <ul class="pricing-one__list">
                                            @foreach($package->details as $detail)
                                                <li class="{{ $detail->status === 'excluded' ? 'excluded' : '' }}">
                                                    {{ tr($detail, 'title') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a href="{{ route('front.rentnow', $package->id) }}" class="thm-btn">
                                        {{ __('Book Now') }}<span class="fas fa-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </section>

@endsection
