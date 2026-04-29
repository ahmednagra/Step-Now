{{--
    Public booking form (homepage variant).

    Compliance fixes:
      - BFSG: every input now has an associated <label>, with a visible
        title that doubles as the screen-reader label.
      - Art. 13 DSGVO: a notice with a link to the Datenschutzerklärung
        sits directly above the submit button. The user is informed
        about purpose + legal basis at the moment of data collection.
      - Honeypot: hidden `website` field — bots fill it, humans don't see it.
        Server-side handler in FrontController@bookingStore short-circuits
        when this field is present.
--}}

<section class="booking-one">
    <div class="booking-one__wrap">
        <div class="booking-one__bg" style="background-image: url({{ asset('front/assets/images/booking-pic1.jpg') }});">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 p-5">
                    <div class="booking-one__right wow slideInRight m-0" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="booking-one__content">
                            <div class="booking-one__title-box">
                                <div class="booking-one__title-shape"
                                    style="background-image: url({{ asset('front/assets/images/shapes/book-one-title-shape-1.png') }});">
                                </div>
                                <h3 class="booking-one__title">Auto buchen</h3>
                            </div>
                            <form id="bookingForm" class="contact-form-validated booking-one__form"
                                action="{{ route('front.booking.store') }}" method="POST" novalidate="novalidate">
                                @csrf

                                {{-- Honeypot: keep this hidden from real users --}}
                                <div style="position:absolute; left:-9999px; top:-9999px; width:0; height:0; overflow:hidden;" aria-hidden="true">
                                    <label for="bf_website">Website</label>
                                    <input type="text" id="bf_website" name="website" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="row">

                                    <!-- Full Name -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_full_name">
                                                <span class="icon-user"></span> Vollständiger Name <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="text" id="bf_full_name"
                                                placeholder="Geben Sie Ihren vollständigen Namen ein"
                                                name="full_name"
                                                value="{{ old('full_name') }}"
                                                required
                                                autocomplete="name">
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_email">
                                                <span class="icon-email"></span> E-Mail <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="email" id="bf_email"
                                                placeholder="Geben Sie Ihre E-Mail-Adresse ein"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autocomplete="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_phone">
                                                <span class="icon-phone"></span> Telefonnummer <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="tel" id="bf_phone"
                                                placeholder="Geben Sie Ihre Telefonnummer ein"
                                                name="phone"
                                                value="{{ old('phone') }}"
                                                required
                                                autocomplete="tel">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pickup Location -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_pickup">
                                                <span class="icon-pin-2"></span> Abholort <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="text" id="bf_pickup"
                                                placeholder="Geben Sie den Abholort ein"
                                                name="pickup"
                                                value="{{ old('pickup') }}"
                                                required>
                                            @error('pickup')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Destination -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_destination">
                                                <span class="icon-pin-2"></span> Ziel
                                            </label>
                                            <input type="text" id="bf_destination"
                                                placeholder="Geben Sie das Ziel ein (optional)"
                                                name="destination"
                                                value="{{ old('destination') }}">
                                            @error('destination')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Booking Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_booking_date">
                                                <span class="icon-date"></span> Buchungsdatum <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="date" id="bf_booking_date"
                                                name="booking_date"
                                                value="{{ old('booking_date') }}"
                                                min="{{ now()->format('Y-m-d') }}"
                                                required>
                                            @error('booking_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Booking Time -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_booking_time">
                                                <span class="icon-time"></span> Buchungszeit <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="time" id="bf_booking_time"
                                                name="booking_time"
                                                value="{{ old('booking_time') }}"
                                                required>
                                            @error('booking_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- No of People -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_no_of_people">
                                                <span class="icon-user-2"></span> Anzahl der Personen <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="number" id="bf_no_of_people"
                                                placeholder="z. B. 1"
                                                name="no_of_people"
                                                value="{{ old('no_of_people') }}"
                                                min="1" max="20"
                                                required>
                                            @error('no_of_people')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-xl-12">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_message">
                                                <span class="fas fa-pen"></span> Zusätzliche Nachricht
                                            </label>
                                            <textarea id="bf_message" placeholder="Besondere Anforderungen oder Nachricht (optional)" name="message" rows="3">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Art. 13 DSGVO notice — REQUIRED at point of data collection --}}
                                    <div class="col-xl-12">
                                        <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 18px;">
                                            Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer Buchung
                                            gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet. Weitere Informationen zur
                                            Datenverarbeitung finden Sie in unserer
                                            <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration: underline;">Datenschutzerklärung</a>.
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
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
