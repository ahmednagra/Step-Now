<section class="booking-one">
    <div class="booking-one__wrap">
        <div class="booking-one__bg" style="background-image: url({{ asset('front/assets/images/booking-pic1.jpg') }});"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 p-5">
                    <div class="booking-one__right wow slideInRight m-0" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="booking-one__content">
                            <div class="booking-one__title-box">
                                <div class="booking-one__title-shape"
                                    style="background-image: url({{ asset('front/assets/images/shapes/book-one-title-shape-1.png') }});"></div>
                                <h3 class="booking-one__title">{{ __('Book a Car') }}</h3>
                            </div>
                            <form id="bookingForm" class="contact-form-validated booking-one__form"
                                action="{{ route('front.booking.store') }}" method="POST" novalidate="novalidate">
                                @csrf

                                {{-- Honeypot --}}
                                <div style="position:absolute; left:-9999px; top:-9999px; width:0; height:0; overflow:hidden;" aria-hidden="true">
                                    <label for="bf_website">Website</label>
                                    <input type="text" id="bf_website" name="website" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="row">

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_full_name">
                                                <span class="icon-user"></span> {{ __('Full Name') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="text" id="bf_full_name"
                                                placeholder="{{ __('Enter your full name') }}"
                                                name="full_name" value="{{ old('full_name') }}"
                                                required autocomplete="name">
                                            @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_email">
                                                <span class="icon-email"></span> {{ __('Email') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="email" id="bf_email"
                                                placeholder="{{ __('Enter your email address') }}"
                                                name="email" value="{{ old('email') }}"
                                                required autocomplete="email">
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_phone">
                                                <span class="icon-phone"></span> {{ __('Phone Number') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="tel" id="bf_phone"
                                                placeholder="{{ __('Enter your phone number') }}"
                                                name="phone" value="{{ old('phone') }}"
                                                required autocomplete="tel">
                                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_pickup">
                                                <span class="icon-pin-2"></span> {{ __('Pickup Location') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="text" id="bf_pickup"
                                                placeholder="{{ __('Enter the pickup location') }}"
                                                name="pickup" value="{{ old('pickup') }}" required>
                                            @error('pickup')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_destination">
                                                <span class="icon-pin-2"></span> {{ __('Destination') }}
                                            </label>
                                            <input type="text" id="bf_destination"
                                                placeholder="{{ __('Enter the destination (optional)') }}"
                                                name="destination" value="{{ old('destination') }}">
                                            @error('destination')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_booking_date">
                                                <span class="icon-date"></span> {{ __('Booking Date') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="date" id="bf_booking_date" name="booking_date"
                                                value="{{ old('booking_date') }}"
                                                min="{{ now()->format('Y-m-d') }}" required>
                                            @error('booking_date')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_booking_time">
                                                <span class="icon-time"></span> {{ __('Booking Time') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="time" id="bf_booking_time" name="booking_time"
                                                value="{{ old('booking_time') }}" required>
                                            @error('booking_time')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_no_of_people">
                                                <span class="icon-user-2"></span> {{ __('Number of People') }} <span aria-hidden="true">*</span>
                                            </label>
                                            <input type="number" id="bf_no_of_people"
                                                placeholder="{{ __('e.g. 1') }}"
                                                name="no_of_people" value="{{ old('no_of_people') }}"
                                                min="1" max="20" required>
                                            @error('no_of_people')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="booking-one__input-box">
                                            <label class="booking-one__input-title" for="bf_message">
                                                <span class="fas fa-pen"></span> {{ __('Additional Message') }}
                                            </label>
                                            <textarea id="bf_message" name="message" rows="3"
                                                placeholder="{{ __('Special requirements or message (optional)') }}">{{ old('message') }}</textarea>
                                            @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    {{-- Art. 13 GDPR notice --}}
                                    <div class="col-xl-12">
                                        <p style="font-size: .85rem; color: #666; line-height: 1.55; margin: 12px 0 18px;">
                                            @if(app()->getLocale() === 'en')
                                                By submitting your request, your information will be processed for handling
                                                your booking under Art. 6(1)(b) GDPR. More information in our
                                                <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration: underline;">{{ __('Privacy Policy') }}</a>.
                                            @else
                                                Mit dem Absenden Ihrer Anfrage werden Ihre Angaben zur Bearbeitung Ihrer Buchung
                                                gemäß Art. 6 Abs. 1 lit. b DSGVO verarbeitet. Weitere Informationen zur
                                                Datenverarbeitung finden Sie in unserer
                                                <a href="{{ route('front.datenschutz') }}" target="_blank" rel="noopener" style="text-decoration: underline;">Datenschutzerklärung</a>.
                                            @endif
                                        </p>
                                    </div>

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
        </div>
    </div>
</section>
