@extends('front.layouts.master')

@section('title', $service->meta_title ?? $service->name)
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/booking.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/listing.css') }}" />
@endsection
@section('content')

    <!-- ========================== PAGE HEADER =========================== -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image:url({{ asset($service->banner_image) }});"></div>

        

        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $service->banner_title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li><a href="{{ route('front.services') }}">Services</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ $service->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================== SERVICE DETAILS =========================== -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- Thumbnail -->
                    <img src="{{ asset($service->thumbnail) }}" class="img-fluid rounded mb-4" alt="">

                    <!-- Titles -->
                    <h2 class="fw-bold">{{ $service->service_title }}</h2>
                    <p class="text-muted">{{ $service->service_subtitle }}</p>

                    <!-- Short Description -->
                    <p class="mt-3">{!! nl2br($service->short_description) !!}</p>

                    <!-- Long Description -->
                    <div class="mt-4">
                        {!! nl2br($service->description) !!}
                    </div>

                    @if ($service->other_description)
                        <div class="mt-4">
                            {!! nl2br($service->other_description) !!}
                        </div>
                    @endif

                </div>



                <!-- RIGHT SIDE - SIDEBAR -->
                <div class="col-lg-4 text-center">
                    <div class="p-4 border rounded">

                        @if ($service->serviceCategory->icon)
                            <img src="{{ asset('assets/admin/uploads/service_category/' . $service->serviceCategory->icon) }}"
                                width="80" class="mb-3" alt="Category Icon">
                        @endif
                        <h5 class="fw-bold mb-3">Category Details</h5>
                        <p><strong>Category:</strong> {{ $service->serviceCategory->title }}</p>
                        <p class="text-muted">{{ $service->serviceCategory->description }}</p>


                    </div>
                </div>

            </div>

            @include('front.partials.booking.booking-1')


            <!-- ========================== RELATED SERVICES =========================== -->
            <div class="row mt-60">
                <div class="col-12 mb-4">
                    <h2 class="section-title__title title-animation mt-5">Related Services</h2>
                </div>

                @forelse($relatedServices as $rel)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__icon">
                                <img src="{{ asset($rel->icon) }}" width="50">
                            </div>
                            <h3 class="services-one__title">
                                <a href="{{ route('front.service.detail', $rel->slug) }}">{{ $rel->name }}</a>
                            </h3>
                            <p class="services-one__text">{{ $rel->short_description }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No related services</p>
                @endforelse

            </div>

        </div>
    </section>

@endsection
