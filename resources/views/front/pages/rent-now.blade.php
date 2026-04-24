@extends('front.layouts.master')
@section('title', 'Rent Now')
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/booking.css') }}" />
@endsection
@section('content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="page-header__shape-1"
            style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $package->title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">Home</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>Rent Now</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="booking-one mb-5">
        <div class="booking-one__wrap">
            <div class="booking-one__bg"
                style="background-image: url({{ asset('front/assets/images/booking-pic1.jpg') }});">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 p-5">
                        <div class="booking-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                            <div class="booking-one__content">
                                <div class="booking-one__title-box">
                                    <div class="booking-one__title-shape"
                                        style="background-image: url({{ asset('front/assets/images/shapes/book-one-title-shape-1.png') }});">
                                    </div>
                                    <h3 class="booking-one__title">Book a car</h3>
                                </div>
                                <form id="bookingForm" class="contact-form-validated booking-one__form"
                                    action="{{ route('front.booking.store') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="row">
                                        <!-- Offer -->
                                        <div class="col-12">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="fas fa-ticket"></span>Offer</p>
                                                <input type="text" placeholder="Offer"
                                                    value="{{ $package->title }}" readonly>
                                                <input type="hidden" name="offer_id" value="{{ $package->id }}">
                                                @error('offer_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        

                                        <!-- Full Name -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-user"></span> Full
                                                    Name
                                                </p>
                                                <input type="text" placeholder="Enter your full name" name="full_name"
                                                    value="{{ old('full_name') }}">
                                                @error('full_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-email"></span> Email
                                                </p>
                                                <input type="email" placeholder="Enter your email" name="email"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-phone"></span> Phone
                                                </p>
                                                <input type="text" placeholder="Enter your phone number" name="phone"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Pickup Location -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-pin-2"></span> Pickup
                                                    Location</p>
                                                <input type="text" placeholder="Enter pickup location" name="pickup"
                                                    value="{{ old('pickup') }}">
                                                @error('pickup')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Destination -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-pin-2"></span>
                                                    Destination</p>
                                                <input type="text" placeholder="Enter destination (optional)"
                                                    name="destination" value="{{ old('destination') }}">
                                                @error('destination')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Booking Date -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-date"></span> Booking
                                                    Date</p>
                                                <input type="date" name="booking_date"
                                                    value="{{ old('booking_date') }}">
                                                @error('booking_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Booking Time -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="icon-clock"></span>
                                                    Booking
                                                    Time</p>
                                                <input type="time" name="booking_time"
                                                    value="{{ old('booking_time') }}">
                                                @error('booking_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Number of People -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="fas fa-users"></span>
                                                    Number of
                                                    People</p>
                                                <div class="select-box">
                                                    <input type="number" placeholder="Enter Number of Peoples"
                                                        name="no_of_people" value="{{ old('no_of_people') }}">
                                                </div>
                                                @error('no_of_people')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Message -->
                                        <div class="col-xl-12">
                                            <div class="booking-one__input-box">
                                                <p class="booking-one__input-title"> <span class="fas fa-pen"></span>
                                                    Additional Message</p>
                                                <textarea placeholder="Any special requirements or message (optional)" name="message" rows="3">{{ old('message') }}</textarea>
                                                @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-xl-12">
                                            <div class="booking-one__btn-box">
                                                <button type="submit" class="thm-btn">Book Now<span
                                                        class="fas fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
