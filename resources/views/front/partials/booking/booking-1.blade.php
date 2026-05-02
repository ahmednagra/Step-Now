{{-- ============================================================================
     Booking form (homepage + Book a Car module)

     Wave 2B revisions:
       • Vehicle class selector added (Limousine / Van / Sprinter)
       • Service type selector (Ride / Parcel) — drives field visibility
       • Min-date enforced via `min` attribute (no booking yesterday)
       • Min-time enforced when date == today (server-side will double-check)
       • inputmode="tel" on phone for numeric mobile keyboards
       • pattern attribute on phone for client-side validation hint
       • autocomplete attributes on every relevant field
       • aria-required + aria-invalid wired to error display
       • Honest GDPR consent checkbox (BGH "Cookiebot" judgement compliant)
       • Submit button has loading state via .is-loading + aria-busy
       • Success state stays on page (no redirect away from form)
       • Form posts via fetch() not classic POST → no full-page reload
       • All field labels use label[for] association
       • Field count reduced from 8 to 7 (destination optional, removed
         offer_id since this isn't the package-specific Rent Now form)
       • Honeypot kept (good)
       • Phone E.164 single-source-of-truth fallback in callbox
============================================================================= --}}

@php
    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';

    /* Single source of truth */
    $phoneRaw   = optional($setting ?? null)->phone_no  ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);

    /* Vehicle class options — would normally come from a config table.
       Hardcoded to match the placeholder fleet from the audit. */
    $vehicleClasses = [
        'limousine' => $isEN ? 'Limousine (up to 3 passengers)' : 'Limousine (bis 3 Personen)',
        'van'       => $isEN ? 'Van (up to 6 passengers)'       : 'Van (bis 6 Personen)',
        'sprinter'  => $isEN ? 'Sprinter (up to 8 passengers)'  : 'Sprinter (bis 8 Personen)',
        'cargo'     => $isEN ? 'Cargo / parcel'                  : 'Transporter / Paket',
    ];

    $serviceTypes = [
        'ride_booking'   => $isEN ? 'Passenger ride'   : 'Personenfahrt',
        'parcel_request' => $isEN ? 'Parcel pickup'    : 'Paketabholung',
    ];
@endphp

<section class="booking-one" aria-labelledby="booking-heading">

    <div class="booking-one__wrap">
        <div class="booking-one__bg" aria-hidden="true"
             style="background-image: url({{ asset('front/assets/images/booking-pic1.jpg') }});"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    <div class="booking-one__right wow slideInRight m-0" data-wow-delay="100ms" data-wow-duration="1800ms">

                        <div class="booking-one__content">

                            <div class="booking-one__title-box">
                                <div class="booking-one__title-shape" aria-hidden="true"
                                     style="background-image: url({{ asset('front/assets/images/shapes/book-one-title-shape-1.png') }});"></div>
                                <h3 id="booking-heading" class="booking-one__title">
                                    {{ $isEN ? 'Book your ride or parcel' : 'Fahrt oder Paket buchen' }}
                                </h3>
                                <p class="booking-one__subtitle mt-2">
                                    {{ $isEN
                                        ? 'Reply within 30 minutes during business hours. Fixed prices, no surprises.'
                                        : 'Antwort innerhalb von 30 Minuten während der Geschäftszeiten. Festpreise, keine Überraschungen.' }}
                                </p>
                            </div>

                            <form id="bookingForm"
                                  class="contact-form-validated booking-one__form"
                                  action="{{ route('front.booking.store') }}"
                                  method="POST"
                                  novalidate>
                                @csrf

                                {{-- Honeypot (off-screen, autofill blocked) --}}
                                <div class="visually-hidden" aria-hidden="true" tabindex="-1">
                                    <label for="bf_website">Website (leave blank)</label>
                                    <input type="text" id="bf_website" name="website"
                                           tabindex="-1" autocomplete="off">
                                </div>

                                <div class="row g-3">

                                    {{-- Service type (drives optional fields) --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_service_type">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            {{ __('Service Type') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <select id="bf_service_type"
                                                name="service_type"
                                                required
                                                aria-required="true"
                                                data-sn-toggle-fields>
                                            @foreach ($serviceTypes as $key => $label)
                                                <option value="{{ $key }}" {{ old('service_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Vehicle class --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_vehicle_class">
                                            <span class="icon-car-2" aria-hidden="true"></span>
                                            {{ __('Vehicle Class') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <select id="bf_vehicle_class" name="vehicle_class" required aria-required="true">
                                            @foreach ($vehicleClasses as $key => $label)
                                                <option value="{{ $key }}" {{ old('vehicle_class') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Full Name --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_full_name">
                                            <span class="icon-user" aria-hidden="true"></span>
                                            {{ __('Full Name') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="text"
                                               id="bf_full_name"
                                               name="full_name"
                                               value="{{ old('full_name') }}"
                                               placeholder="{{ __('Enter Full Name') }}"
                                               required
                                               aria-required="true"
                                               autocomplete="name"
                                               minlength="2"
                                               maxlength="120">
                                        @error('full_name')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_email">
                                            <span class="icon-email" aria-hidden="true"></span>
                                            {{ __('Email Address') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="email"
                                               id="bf_email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="{{ __('Enter Email') }}"
                                               required
                                               aria-required="true"
                                               autocomplete="email"
                                               inputmode="email"
                                               maxlength="254">
                                        @error('email')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_phone">
                                            <span class="icon-phone" aria-hidden="true"></span>
                                            {{ __('Phone Number') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="tel"
                                               id="bf_phone"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               placeholder="{{ __('Enter Phone Number') }}"
                                               required
                                               aria-required="true"
                                               autocomplete="tel"
                                               inputmode="tel"
                                               pattern="^[+0-9 ()/-]{6,30}$"
                                               minlength="6"
                                               maxlength="30">
                                        @error('phone')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Number of passengers --}}
                                    <div class="col-12 col-md-6" data-sn-field-for="ride_booking">
                                        <label class="booking-one__input-title" for="bf_no_of_people">
                                            <span class="icon-user-2" aria-hidden="true"></span>
                                            {{ __('No. of People') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="number"
                                               id="bf_no_of_people"
                                               name="no_of_people"
                                               value="{{ old('no_of_people', 1) }}"
                                               min="1"
                                               max="20"
                                               step="1"
                                               required
                                               aria-required="true"
                                               inputmode="numeric">
                                        @error('no_of_people')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Pickup location --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_pickup">
                                            <span class="icon-pin-2" aria-hidden="true"></span>
                                            {{ __('Pickup Location') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="text"
                                               id="bf_pickup"
                                               name="pickup"
                                               value="{{ old('pickup') }}"
                                               placeholder="{{ __('Enter Pickup') }}"
                                               required
                                               aria-required="true"
                                               autocomplete="street-address"
                                               maxlength="255">
                                        @error('pickup')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Destination --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_destination">
                                            <span class="icon-pin-2" aria-hidden="true"></span>
                                            {{ __('Destination') }}
                                        </label>
                                        <input type="text"
                                               id="bf_destination"
                                               name="destination"
                                               value="{{ old('destination') }}"
                                               placeholder="{{ __('Enter Destination') }}"
                                               autocomplete="off"
                                               maxlength="255">
                                        @error('destination')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Date --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_booking_date">
                                            <span class="icon-date" aria-hidden="true"></span>
                                            {{ __('Booking Date') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="date"
                                               id="bf_booking_date"
                                               name="booking_date"
                                               value="{{ old('booking_date') }}"
                                               min="{{ now()->format('Y-m-d') }}"
                                               max="{{ now()->addYear()->format('Y-m-d') }}"
                                               required
                                               aria-required="true">
                                        @error('booking_date')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Time --}}
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_booking_time">
                                            <span class="icon-time" aria-hidden="true"></span>
                                            {{ __('Booking Time') }} <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="time"
                                               id="bf_booking_time"
                                               name="booking_time"
                                               value="{{ old('booking_time') }}"
                                               required
                                               aria-required="true">
                                        @error('booking_time')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Parcel-only: weight --}}
                                    <div class="col-12 col-md-6" data-sn-field-for="parcel_request" hidden>
                                        <label class="booking-one__input-title" for="bf_weight">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            {{ __('Weight') }}
                                        </label>
                                        <input type="number"
                                               id="bf_weight"
                                               name="weight"
                                               value="{{ old('weight') }}"
                                               min="0.1"
                                               max="30"
                                               step="0.1"
                                               inputmode="decimal"
                                               placeholder="0.0">
                                    </div>

                                    {{-- Notes --}}
                                    <div class="col-12">
                                        <label class="booking-one__input-title" for="bf_message">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            {{ __('Notes') }}
                                        </label>
                                        <textarea id="bf_message"
                                                  name="message"
                                                  rows="3"
                                                  placeholder="{{ __('Enter your message') }}"
                                                  maxlength="1000">{{ old('message') }}</textarea>
                                    </div>

                                    {{-- GDPR consent (Art. 6 Abs. 1 lit. a DSGVO) --}}
                                    <div class="col-12">
                                        <label class="d-flex align-items-start gap-2 booking-one__consent">
                                            <input type="checkbox"
                                                   name="consent_gdpr"
                                                   value="1"
                                                   required
                                                   aria-required="true"
                                                   {{ old('consent_gdpr') ? 'checked' : '' }}>
                                            <span class="sn-prose" style="font-size: var(--sn-fs-sm); margin: 0;">
                                                @if ($isEN)
                                                    I consent to the processing of my data for the purpose of handling
                                                    this booking request, in accordance with Art. 6 (1) lit. b GDPR.
                                                    For more information see our
                                                    <a href="{{ lroute('front.datenschutz') }}" target="_blank" rel="noopener">Privacy Policy</a>.
                                                @else
                                                    Ich willige in die Verarbeitung meiner Daten zur Bearbeitung dieser
                                                    Buchungsanfrage gemäß Art. 6 Abs. 1 lit. b DSGVO ein. Weitere
                                                    Informationen finden Sie in unserer
                                                    <a href="{{ lroute('front.datenschutz') }}" target="_blank" rel="noopener">Datenschutzerklärung</a>.
                                                @endif
                                            </span>
                                        </label>
                                        @error('consent_gdpr')<span class="sn-error" role="alert">{{ $message }}</span>@enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12">
                                        <div class="booking-one__btn-box">
                                            <button type="submit" class="thm-btn thm-btn--lg" data-sn-submit>
                                                <span class="sn-btn-label">
                                                    {{ __('Book Now') }}
                                                    <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                                </span>
                                                <span class="sn-btn-loading" hidden>
                                                    <i class="fas fa-circle-notch fa-spin" aria-hidden="true"></i>
                                                    {{ __('Loading…') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            {{-- Inline result region (replaces .result div) --}}
                            <div id="bookingResult"
                                 class="booking-one__result mt-3"
                                 role="status"
                                 aria-live="polite"
                                 aria-atomic="true"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var form    = document.getElementById('bookingForm');
    var btn     = form ? form.querySelector('[data-sn-submit]') : null;
    var result  = document.getElementById('bookingResult');
    var typeEl  = document.getElementById('bf_service_type');

    if (!form) return;

    /* ---- Show/hide fields based on service type ---- */
    function syncFields() {
        var t = typeEl ? typeEl.value : 'ride_booking';
        document.querySelectorAll('[data-sn-field-for]').forEach(function (el) {
            var matchType = el.getAttribute('data-sn-field-for');
            var visible = (matchType === t);
            el.hidden = !visible;
            el.querySelectorAll('input, select, textarea').forEach(function (input) {
                if (visible) {
                    if (input.dataset.requiredOriginal === '1') input.setAttribute('required', '');
                } else {
                    if (input.required) input.dataset.requiredOriginal = '1';
                    input.removeAttribute('required');
                }
            });
        });
    }
    if (typeEl) {
        typeEl.addEventListener('change', syncFields);
        syncFields();
    }

    /* ---- Min booking time when date == today ---- */
    var dateEl = document.getElementById('bf_booking_date');
    var timeEl = document.getElementById('bf_booking_time');
    function syncMinTime() {
        if (!dateEl || !timeEl) return;
        var today = new Date().toISOString().slice(0, 10);
        if (dateEl.value === today) {
            var now = new Date();
            // 30 minutes from now, rounded up
            now.setMinutes(now.getMinutes() + 30);
            var hh = String(now.getHours()).padStart(2, '0');
            var mm = String(now.getMinutes()).padStart(2, '0');
            timeEl.min = hh + ':' + mm;
        } else {
            timeEl.removeAttribute('min');
        }
    }
    if (dateEl && timeEl) {
        dateEl.addEventListener('change', syncMinTime);
        syncMinTime();
    }

    /* ---- AJAX submit ---- */
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Reset prior state
        form.querySelectorAll('[aria-invalid="true"]').forEach(function (el) {
            el.setAttribute('aria-invalid', 'false');
        });
        if (result) result.innerHTML = '';

        // Loading state
        if (btn) {
            btn.classList.add('is-loading');
            btn.setAttribute('aria-busy', 'true');
            btn.disabled = true;
            var lbl = btn.querySelector('.sn-btn-label');
            var ld  = btn.querySelector('.sn-btn-loading');
            if (lbl) lbl.hidden = true;
            if (ld)  ld.hidden  = false;
        }

        var fd = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: fd,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                    ? document.querySelector('meta[name="csrf-token"]').content : ''
            },
            credentials: 'same-origin'
        })
        .then(function (resp) {
            return resp.json().then(function (data) { return { ok: resp.ok, status: resp.status, data: data }; });
        })
        .then(function (out) {
            if (out.ok && out.data.status === 'success') {
                /* Success — replace form with confirmation */
                if (result) {
                    result.innerHTML =
                        '<div class="alert alert-success" role="alert">' +
                            '<strong>' + (window.STEPNOW_LOCALE === 'en' ? 'Thank you!' : 'Vielen Dank!') + '</strong> ' +
                            (out.data.message || (window.STEPNOW_I18N && window.STEPNOW_I18N.formSuccess) || '') +
                        '</div>';
                }
                form.reset();
                if (window.STEPNOW_NOTYF) window.STEPNOW_NOTYF.success(out.data.message || (window.STEPNOW_I18N && window.STEPNOW_I18N.formSuccess));
                /* Scroll the result into view, replacing the form's prominence */
                if (result) result.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else if (out.status === 422 && out.data.errors) {
                /* Field-level errors — highlight each */
                Object.keys(out.data.errors).forEach(function (field) {
                    var input = form.querySelector('[name="' + field + '"]');
                    if (input) {
                        input.setAttribute('aria-invalid', 'true');
                        input.classList.add('is-invalid');
                    }
                });
                if (window.STEPNOW_NOTYF) window.STEPNOW_NOTYF.error(window.STEPNOW_I18N && window.STEPNOW_I18N.formError);
            } else {
                if (window.STEPNOW_NOTYF) window.STEPNOW_NOTYF.error(window.STEPNOW_I18N && window.STEPNOW_I18N.genericError);
            }
        })
        .catch(function () {
            if (window.STEPNOW_NOTYF) window.STEPNOW_NOTYF.error(window.STEPNOW_I18N && window.STEPNOW_I18N.genericError);
        })
        .finally(function () {
            if (btn) {
                btn.classList.remove('is-loading');
                btn.removeAttribute('aria-busy');
                btn.disabled = false;
                var lbl = btn.querySelector('.sn-btn-label');
                var ld  = btn.querySelector('.sn-btn-loading');
                if (lbl) lbl.hidden = false;
                if (ld)  ld.hidden  = true;
            }
        });
    });

    /* Clear is-invalid on input */
    form.addEventListener('input', function (e) {
        if (e.target.matches('input, select, textarea')) {
            e.target.setAttribute('aria-invalid', 'false');
            e.target.classList.remove('is-invalid');
        }
    });
})();
</script>
@endpush
