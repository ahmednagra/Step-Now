@extends('front.layouts.master')
@section('title', 'Pricing')
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
                <h3>Preise</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">Startseite</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>Preise</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-one pricing-page-one">
        <div class="container">

            @foreach ($package_categories as $category)
                <div class="category-section mb-5">
                    @if ($category->title || $category->description)
                        <div class="section-title text-center sec-title-animation animation-style1">
                            <div class="section-title__tagline-box justify-content-center">
                                <div class="section-title__tagline-shape">
                                    <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}"
                                        alt="">
                                </div>
                                @if ($category->title)
                                    <span class="section-title__tagline">{{ $category->title }}</span>
                                @endif
                            </div>
                            @if ($category->sub_title)
                                <h2 class="section-title__title title-animation">{{ $category->sub_title }}
                                </h2>
                            @endif
                            @if ($category->description)
                                <p>{{ $category->description }}</p>
                            @endif
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($category->packages->where('status', 'active')->where('publish', 'published')->sortBy('order_no') as $package)
                            <!-- Pricing One Single Start -->
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms"
                                data-wow-duration="1500ms">
                                <div class="pricing-one__single">
                                    <div class="pricing-one__title-box">
                                        <h2 class="pricing-one__title">{{ $package->title }}</h2>
                                        <p class="pricing-one__text">
                                            {{ $package->subtitle ?? 'Car service is essential for maintaining performance and longevity of vehicle. From oil changes' }}
                                        </p>
                                    </div>
                                    <div class="pricing-one__price-and-icon-box">
                                        <div class="pricing-one__price-box">
                                            @if ($package->discount_percentage && $package->discounted_amount)
                                                <h3 class="pricing-one__price">
                                                    {{ $package->currency_symbol }}{{ $package->discounted_amount }}
                                                    <span>/month</span>
                                                </h3>
                                                <div class="original-price">
                                                    <del>{{ $package->currency_symbol }}{{ $package->amount }}</del>
                                                    <span class="discount-badge">{{ $package->discount_percentage }}%
                                                        OFF</span>
                                                </div>
                                            @else
                                                <h3 class="pricing-one__price">
                                                    {{ $package->currency_symbol }}{{ $package->amount }}
                                                    <span>/month</span>
                                                </h3>
                                            @endif
                                        </div>
                                        <div class="pricing-one__icon-box">
                                            @if ($package->icon)
                                                <img src="{{ asset('assets/admin/uploads/package/' . $package->icon) }}"
                                                    alt="{{ $package->title }}" width="40px">
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
                                                        <p>{{ $detail->title }}</p>
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
                                        <p class="listing-one__car-rent fs-6">{{ $package->destination }}</p>
                                    </div>

                                    <div class="pricing-one__btn-box">
                                        <a href="{{ route('front.rentnow', $package->id) }}" class="thm-btn">
                                            Jetzt mieten<span class="fas fa-arrow-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Pricing One Single End -->
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
