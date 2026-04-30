@extends('front.layouts.master')
@section('title', __('Book Now'))
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
                <h3>{{ __('Book Now') }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li><a href="{{ route('front.pricing') }}">{{ __('Pricing') }}</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ __('Book Now') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="booking-one rent-now-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="booking-one__form-box">
                        <div class="booking-one__title-box">
                            <h3 class="booking-one__title">{{ __('Book Now') }}</h3>
                            <p class="booking-one__sub-title">
                                {{ tr($package, 'title') }} —
                                {{ $package->currency_symbol }}{{ $package->discounted_amount ?? $package->amount }}
                            </p>
                        </div>

                        <form action="{{ route('front.booking.store') }}" method="POST" class="booking-one__form">
                            @csrf

                            {{-- Honeypot --}}
                            <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
                                <label for="rn_website">Website</label>
                                <input type="text" id="rn_website" name="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="row">

                                {{-- Offer (read-only) --}}
                                <div class="col-12">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_offer">
                                            <span class="fas fa-ticket"></span> {{ __('Offer') }}
                                        </label>
                                        <input type="text" id="rn_offer"
                                               placeholder="{{ __('Offer') }}"
                                               value="{{ tr($package, 'title') }}" readonly>
                                        <input type="hidden" name="offer_id" value="{{ $package->id }}">
                                        @error('offer_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Full Name --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_full_name">
                                            <span class="icon-user"></span> {{ __('Full Name') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="text" id="rn_full_name"
                                               placeholder="{{ __('Enter your full name') }}"
                                               name="full_name" value="{{ old('full_name') }}"
                                               required autocomplete="name">
                                        @error('full_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_email">
                                            <span class="icon-email"></span> {{ __('Email') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="email" id="rn_email"
                                               placeholder="{{ __('Enter your email address') }}"
                                               name="email" value="{{ old('email') }}"
                                               required autocomplete="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_phone">
                                            <span class="icon-phone"></span> {{ __('Phone Number') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="tel" id="rn_phone"
                                               placeholder="{{ __('Enter your phone number') }}"
                                               name="phone" value="{{ old('phone') }}"
                                               required autocomplete="tel">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pickup --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_pickup">
                                            <span class="icon-pin-2"></span> {{ __('Pickup Location') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="text" id="rn_pickup"
                                               placeholder="{{ __('Enter the pickup location') }}"
                                               name="pickup" value="{{ old('pickup') }}" required>
                                        @error('pickup')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Destination --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_destination">
                                            <span class="icon-pin-2"></span> {{ __('Destination') }}
                                        </label>
                                        <input type="text" id="rn_destination"
                                               placeholder="{{ __('Enter the destination (optional)') }}"
                                               name="destination" value="{{ old('destination') }}">
                                        @error('destination')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Booking Date --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_booking_date">
                                            <span class="icon-date"></span> {{ __('Booking Date') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="date" id="rn_booking_date" name="booking_date"
                                               value="{{ old('booking_date') }}"
                                               min="{{ now()->format('Y-m-d') }}" required>
                                        @error('booking_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Booking Time --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_booking_time">
                                            <span class="icon-time"></span> {{ __('Booking Time') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="time" id="rn_booking_time" name="booking_time"
                                               value="{{ old('booking_time') }}" required>
                                        @error('booking_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Number of People --}}
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_no_of_people">
                                            <span class="icon-user-2"></span> {{ __('Number of People') }} <span aria-hidden="true">*</span>
                                        </label>
                                        <input type="number" id="rn_no_of_people"
                                               placeholder="{{ __('e.g. 1') }}"
                                               name="no_of_people" value="{{ old('no_of_people') }}"
                                               min="1" max="20" required>
                                        @error('no_of_people')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Message --}}
                                <div class="col-xl-12">
                                    <div class="booking-one__input-box">
                                        <label class="booking-one__input-title" for="rn_message">
                                            <span class="fas fa-pen"></span> {{ __('Additional Message') }}
                                        </label>
                                        <textarea id="rn_message" name="message" rows="3"
                                                  placeholder="{{ __('Special requirements or message (optional)') }}">{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Art. 13 GDPR notice (bilingual) --}}
                                <div class="col-xl-12">
                                    <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 18px;">
                                        @if(app()->getLocale() === 'en')
                                            By submitting your request, your information will be processed for handling
                                            your booking under Art. 6(1)(b) GDPR. More information in our
                                            <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration:underline;">{{ __('Privacy Policy') }}</a>.
                                        @else
                                            Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer
                                            Buchung gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet. Weitere Informationen
                                            in unserer
                                            <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration:underline;">Datenschutzerklärung</a>.
                                        @endif
                                    </p>
                                </div>

                                {{-- Submit --}}
                                <div class="col-xl-12">
                                    <div class="booking-one__btn-box">
                                        <button type="submit" class="thm-btn">
                                            {{ __('Book Now') }}
                                            <span class="fas fa-arrow-right"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
