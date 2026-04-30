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
                                    <div class="pricing-one__title-box">
                                        <h2 class="pricing-one__title">{{ tr($package, 'title') }}</h2>
                                        <p class="pricing-one__text">
                                            {{ tr($package, 'subtitle') ?? __('Car service is essential for maintaining performance and longevity of vehicle.') }}
                                        </p>
                                    </div>
                                    <div class="pricing-one__price-and-icon-box">
                                        <div class="pricing-one__price-box">
                                            @if ($package->discount_percentage && $package->discounted_amount)
                                                <h3 class="pricing-one__price">
                                                    {{ $package->currency_symbol }}{{ $package->discounted_amount }}
                                                    <span>/{{ __('month') }}</span>
                                                </h3>
                                                <div class="original-price">
                                                    <del>{{ $package->currency_symbol }}{{ $package->amount }}</del>
                                                    <span class="discount-badge">{{ $package->discount_percentage }}% {{ __('OFF') }}</span>
                                                </div>
                                            @else
                                                <h3 class="pricing-one__price">
                                                    {{ $package->currency_symbol }}{{ $package->amount }}
                                                    <span>/{{ __('month') }}</span>
                                                </h3>
                                            @endif
                                        </div>
                                        <div class="pricing-one__icon-box">
                                            @if ($package->icon)
                                                <img src="{{ asset('assets/admin/uploads/package/' . $package->icon) }}"
                                                    alt="{{ tr($package, 'title') }}" width="40px">
                                            @else
                                                <span class="icon-taxi"></span>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($package->details->count() > 0)
                                        <ul class="list-unstyled pricing-one__points">
                                            @foreach ($package->details->sortBy('order_no') as $detail)
                                                <li>
                                                    <div class="text">
                                                        <p>{{ tr($detail, 'title') ?? $detail->title }}</p>
                                                    </div>
                                                    <div class="price">
                                                        {!! $detail->status == 'included'
                                                            ? '<i class="fas fa-check-circle text-success"></i>'
                                                            : '<i class="fas fa-times-circle text-danger"></i>' !!}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <div class="listing-one__car-rent-box">
                                        <p class="listing-one__car-rent fs-6">{{ tr($package, 'destination') ?? $package->destination }}</p>
                                    </div>

                                    <div class="pricing-one__btn-box">
                                        <a href="{{ route('front.rentnow', $package->id) }}" class="thm-btn">
                                            {{ __('Rent Now') }}<span class="fas fa-arrow-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
