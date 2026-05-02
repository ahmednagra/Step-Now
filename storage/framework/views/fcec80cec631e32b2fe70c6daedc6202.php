

<?php
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
?>

<section class="booking-one" aria-labelledby="booking-heading">

    <div class="booking-one__wrap">
        <div class="booking-one__bg" aria-hidden="true"
             style="background-image: url(<?php echo e(asset('front/assets/images/booking-pic1.jpg')); ?>);"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    <div class="booking-one__right wow slideInRight m-0" data-wow-delay="100ms" data-wow-duration="1800ms">

                        <div class="booking-one__content">

                            <div class="booking-one__title-box">
                                <div class="booking-one__title-shape" aria-hidden="true"
                                     style="background-image: url(<?php echo e(asset('front/assets/images/shapes/book-one-title-shape-1.png')); ?>);"></div>
                                <h3 id="booking-heading" class="booking-one__title">
                                    <?php echo e($isEN ? 'Book your ride or parcel' : 'Fahrt oder Paket buchen'); ?>

                                </h3>
                                <p class="booking-one__subtitle mt-2">
                                    <?php echo e($isEN
                                        ? 'Reply within 30 minutes during business hours. Fixed prices, no surprises.'
                                        : 'Antwort innerhalb von 30 Minuten während der Geschäftszeiten. Festpreise, keine Überraschungen.'); ?>

                                </p>
                            </div>

                            <form id="bookingForm"
                                  class="contact-form-validated booking-one__form"
                                  action="<?php echo e(route('front.booking.store')); ?>"
                                  method="POST"
                                  novalidate>
                                <?php echo csrf_field(); ?>

                                
                                <div class="visually-hidden" aria-hidden="true" tabindex="-1">
                                    <label for="bf_website">Website (leave blank)</label>
                                    <input type="text" id="bf_website" name="website"
                                           tabindex="-1" autocomplete="off">
                                </div>

                                <div class="row g-3">

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_service_type">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            <?php echo e(__('Service Type')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <select id="bf_service_type"
                                                name="service_type"
                                                required
                                                aria-required="true"
                                                data-sn-toggle-fields>
                                            <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e(old('service_type') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_vehicle_class">
                                            <span class="icon-car-2" aria-hidden="true"></span>
                                            <?php echo e(__('Vehicle Class')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <select id="bf_vehicle_class" name="vehicle_class" required aria-required="true">
                                            <?php $__currentLoopData = $vehicleClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php echo e(old('vehicle_class') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_full_name">
                                            <span class="icon-user" aria-hidden="true"></span>
                                            <?php echo e(__('Full Name')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="text"
                                               id="bf_full_name"
                                               name="full_name"
                                               value="<?php echo e(old('full_name')); ?>"
                                               placeholder="<?php echo e(__('Enter Full Name')); ?>"
                                               required
                                               aria-required="true"
                                               autocomplete="name"
                                               minlength="2"
                                               maxlength="120">
                                        <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_email">
                                            <span class="icon-email" aria-hidden="true"></span>
                                            <?php echo e(__('Email Address')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="email"
                                               id="bf_email"
                                               name="email"
                                               value="<?php echo e(old('email')); ?>"
                                               placeholder="<?php echo e(__('Enter Email')); ?>"
                                               required
                                               aria-required="true"
                                               autocomplete="email"
                                               inputmode="email"
                                               maxlength="254">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_phone">
                                            <span class="icon-phone" aria-hidden="true"></span>
                                            <?php echo e(__('Phone Number')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="tel"
                                               id="bf_phone"
                                               name="phone"
                                               value="<?php echo e(old('phone')); ?>"
                                               placeholder="<?php echo e(__('Enter Phone Number')); ?>"
                                               required
                                               aria-required="true"
                                               autocomplete="tel"
                                               inputmode="tel"
                                               pattern="^[+0-9 ()/-]{6,30}$"
                                               minlength="6"
                                               maxlength="30">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6" data-sn-field-for="ride_booking">
                                        <label class="booking-one__input-title" for="bf_no_of_people">
                                            <span class="icon-user-2" aria-hidden="true"></span>
                                            <?php echo e(__('No. of People')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="number"
                                               id="bf_no_of_people"
                                               name="no_of_people"
                                               value="<?php echo e(old('no_of_people', 1)); ?>"
                                               min="1"
                                               max="20"
                                               step="1"
                                               required
                                               aria-required="true"
                                               inputmode="numeric">
                                        <?php $__errorArgs = ['no_of_people'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_pickup">
                                            <span class="icon-pin-2" aria-hidden="true"></span>
                                            <?php echo e(__('Pickup Location')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="text"
                                               id="bf_pickup"
                                               name="pickup"
                                               value="<?php echo e(old('pickup')); ?>"
                                               placeholder="<?php echo e(__('Enter Pickup')); ?>"
                                               required
                                               aria-required="true"
                                               autocomplete="street-address"
                                               maxlength="255">
                                        <?php $__errorArgs = ['pickup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_destination">
                                            <span class="icon-pin-2" aria-hidden="true"></span>
                                            <?php echo e(__('Destination')); ?>

                                        </label>
                                        <input type="text"
                                               id="bf_destination"
                                               name="destination"
                                               value="<?php echo e(old('destination')); ?>"
                                               placeholder="<?php echo e(__('Enter Destination')); ?>"
                                               autocomplete="off"
                                               maxlength="255">
                                        <?php $__errorArgs = ['destination'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_booking_date">
                                            <span class="icon-date" aria-hidden="true"></span>
                                            <?php echo e(__('Booking Date')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="date"
                                               id="bf_booking_date"
                                               name="booking_date"
                                               value="<?php echo e(old('booking_date')); ?>"
                                               min="<?php echo e(now()->format('Y-m-d')); ?>"
                                               max="<?php echo e(now()->addYear()->format('Y-m-d')); ?>"
                                               required
                                               aria-required="true">
                                        <?php $__errorArgs = ['booking_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6">
                                        <label class="booking-one__input-title" for="bf_booking_time">
                                            <span class="icon-time" aria-hidden="true"></span>
                                            <?php echo e(__('Booking Time')); ?> <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="time"
                                               id="bf_booking_time"
                                               name="booking_time"
                                               value="<?php echo e(old('booking_time')); ?>"
                                               required
                                               aria-required="true">
                                        <?php $__errorArgs = ['booking_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12 col-md-6" data-sn-field-for="parcel_request" hidden>
                                        <label class="booking-one__input-title" for="bf_weight">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            <?php echo e(__('Weight')); ?>

                                        </label>
                                        <input type="number"
                                               id="bf_weight"
                                               name="weight"
                                               value="<?php echo e(old('weight')); ?>"
                                               min="0.1"
                                               max="30"
                                               step="0.1"
                                               inputmode="decimal"
                                               placeholder="0.0">
                                    </div>

                                    
                                    <div class="col-12">
                                        <label class="booking-one__input-title" for="bf_message">
                                            <span class="icon-stars" aria-hidden="true"></span>
                                            <?php echo e(__('Notes')); ?>

                                        </label>
                                        <textarea id="bf_message"
                                                  name="message"
                                                  rows="3"
                                                  placeholder="<?php echo e(__('Enter your message')); ?>"
                                                  maxlength="1000"><?php echo e(old('message')); ?></textarea>
                                    </div>

                                    
                                    <div class="col-12">
                                        <label class="d-flex align-items-start gap-2 booking-one__consent">
                                            <input type="checkbox"
                                                   name="consent_gdpr"
                                                   value="1"
                                                   required
                                                   aria-required="true"
                                                   <?php echo e(old('consent_gdpr') ? 'checked' : ''); ?>>
                                            <span class="sn-prose" style="font-size: var(--sn-fs-sm); margin: 0;">
                                                <?php if($isEN): ?>
                                                    I consent to the processing of my data for the purpose of handling
                                                    this booking request, in accordance with Art. 6 (1) lit. b GDPR.
                                                    For more information see our
                                                    <a href="<?php echo e(lroute('front.datenschutz')); ?>" target="_blank" rel="noopener">Privacy Policy</a>.
                                                <?php else: ?>
                                                    Ich willige in die Verarbeitung meiner Daten zur Bearbeitung dieser
                                                    Buchungsanfrage gemäß Art. 6 Abs. 1 lit. b DSGVO ein. Weitere
                                                    Informationen finden Sie in unserer
                                                    <a href="<?php echo e(lroute('front.datenschutz')); ?>" target="_blank" rel="noopener">Datenschutzerklärung</a>.
                                                <?php endif; ?>
                                            </span>
                                        </label>
                                        <?php $__errorArgs = ['consent_gdpr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="sn-error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div class="col-12">
                                        <div class="booking-one__btn-box">
                                            <button type="submit" class="thm-btn thm-btn--lg" data-sn-submit>
                                                <span class="sn-btn-label">
                                                    <?php echo e(__('Book Now')); ?>

                                                    <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                                </span>
                                                <span class="sn-btn-loading" hidden>
                                                    <i class="fas fa-circle-notch fa-spin" aria-hidden="true"></i>
                                                    <?php echo e(__('Loading…')); ?>

                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/booking/booking-1.blade.php ENDPATH**/ ?>