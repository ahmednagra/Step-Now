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
                                <div class="row">

                                    <!-- Full Name -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-user"></span> Vollständiger Name
                                            </p>
                                            <input type="text" placeholder="Geben Sie Ihren vollständigen Namen ein" name="full_name"
                                                value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-email"></span> E-Mail
                                            </p>
                                            <input type="email" placeholder="Geben Sie Ihre E-Mail-Adresse ein" name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-phone"></span> Telefonnummer
                                            </p>
                                            <input type="text" placeholder="Geben Sie Ihre Telefonnummer ein" name="phone"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pickup Location -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-pin-2"></span> Abholort
                                            </p>
                                            <input type="text" placeholder="Geben Sie den Abholort ein" name="pickup"
                                                value="{{ old('pickup') }}">
                                            @error('pickup')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Destination -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-pin-2"></span> Ziel
                                            </p>
                                            <input type="text" placeholder="Geben Sie das Ziel ein (optional)"
                                                name="destination" value="{{ old('destination') }}">
                                            @error('destination')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Booking Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="booking-one__input-box">
                                            <p class="booking-one__input-title">
                                                <span class="icon-date"></span> Buchungsdatum
                                            </p>
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
                                            <p class="booking-one__input-title">
                                                <span class="icon-clock"></span> Buchungszeit
                                            </p>
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
                                            <p class="booking-one__input-title">
                                                <span class="fas fa-users"></span> Anzahl der Personen
                                            </p>
                                            <div class="select-box">
                                                <input type="number" placeholder="Anzahl der Personen eingeben"
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
                                            <p class="booking-one__input-title">
                                                <span class="fas fa-pen"></span> Zusätzliche Nachricht
                                            </p>
                                            <textarea placeholder="Besondere Anforderungen oder Nachricht (optional)" name="message" rows="3">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
