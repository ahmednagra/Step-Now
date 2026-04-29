@extends('front.layouts.master')
@section('title', $package->title)
@section('css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/module-css/booking.css') }}" />
@endsection
@section('content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/About-pic3.jpg') }});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $package->title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('front.index') }}">Startseite</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li><a href="{{ route('front.pricing') }}">Preise</a></li>
                        <li><span class="icon-arrow-left"></span></li>
                        <li>{{ $package->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="booking-one">
        <div class="booking-one__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 p-5">
                        <div class="booking-one__right">
                            <div class="booking-one__content">
                                <div class="booking-one__title-box">
                                    <h3 class="booking-one__title">{{ $package->title }} buchen</h3>
                                </div>
                                <form id="bookingForm" class="contact-form-validated booking-one__form"
                                      action="{{ route('front.booking.store') }}" method="POST" novalidate="novalidate">
                                    @csrf

                                    {{-- Honeypot --}}
                                    <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
                                        <label for="rn_website">Website</label>
                                        <input type="text" id="rn_website" name="website" tabindex="-1" autocomplete="off">
                                    </div>

                                    <div class="row">

                                        <!-- Offer (read-only) -->
                                        <div class="col-12">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_offer">
                                                    <span class="fas fa-ticket"></span> Angebot
                                                </label>
                                                <input type="text" id="rn_offer" placeholder="Angebot"
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
                                                <label class="booking-one__input-title" for="rn_full_name">
                                                    <span class="icon-user"></span> Vollständiger Name <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="text" id="rn_full_name"
                                                       placeholder="Geben Sie Ihren vollständigen Namen ein"
                                                       name="full_name" value="{{ old('full_name') }}"
                                                       required autocomplete="name">
                                                @error('full_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_email">
                                                    <span class="icon-email"></span> E-Mail <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="email" id="rn_email"
                                                       placeholder="Geben Sie Ihre E-Mail-Adresse ein"
                                                       name="email" value="{{ old('email') }}"
                                                       required autocomplete="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_phone">
                                                    <span class="icon-phone"></span> Telefonnummer <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="tel" id="rn_phone"
                                                       placeholder="Geben Sie Ihre Telefonnummer ein"
                                                       name="phone" value="{{ old('phone') }}"
                                                       required autocomplete="tel">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Pickup -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_pickup">
                                                    <span class="icon-pin-2"></span> Abholort <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="text" id="rn_pickup"
                                                       placeholder="Geben Sie den Abholort ein"
                                                       name="pickup" value="{{ old('pickup') }}" required>
                                                @error('pickup')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Destination -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_destination">
                                                    <span class="icon-pin-2"></span> Ziel
                                                </label>
                                                <input type="text" id="rn_destination"
                                                       placeholder="Geben Sie das Ziel ein (optional)"
                                                       name="destination" value="{{ old('destination') }}">
                                                @error('destination')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Date -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_booking_date">
                                                    <span class="icon-date"></span> Buchungsdatum <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="date" id="rn_booking_date" name="booking_date"
                                                       value="{{ old('booking_date') }}"
                                                       min="{{ now()->format('Y-m-d') }}" required>
                                                @error('booking_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Time -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_booking_time">
                                                    <span class="icon-time"></span> Buchungszeit <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="time" id="rn_booking_time" name="booking_time"
                                                       value="{{ old('booking_time') }}" required>
                                                @error('booking_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Number of People -->
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_no_of_people">
                                                    <span class="icon-user-2"></span> Anzahl der Personen <span aria-hidden="true">*</span>
                                                </label>
                                                <input type="number" id="rn_no_of_people"
                                                       placeholder="z. B. 1"
                                                       name="no_of_people" value="{{ old('no_of_people') }}"
                                                       min="1" max="20" required>
                                                @error('no_of_people')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Message -->
                                        <div class="col-xl-12">
                                            <div class="booking-one__input-box">
                                                <label class="booking-one__input-title" for="rn_message">
                                                    <span class="fas fa-pen"></span> Zusätzliche Nachricht
                                                </label>
                                                <textarea id="rn_message" name="message" rows="3"
                                                          placeholder="Besondere Anforderungen oder Nachricht (optional)">{{ old('message') }}</textarea>
                                                @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Art. 13 DSGVO --}}
                                        <div class="col-xl-12">
                                            <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 18px;">
                                                Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer
                                                Buchung gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet. Weitere Informationen
                                                in unserer
                                                <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration:underline;">Datenschutzerklärung</a>.
                                            </p>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-xl-12">
                                            <div class="booking-one__btn-box">
                                                <button type="submit" class="thm-btn">
                                                    Jetzt buchen
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
            </div>
        </div>
    </section>

@endsection
