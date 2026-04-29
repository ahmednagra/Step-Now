{{--
    Front-end JS bundle.

    Compliance / i18n changes:
      - Notyf is loaded from /front/assets/js/vendor/notyf.min.js
        (was: cdn.jsdelivr.net). See public/front/assets/css/vendor/README.md.
      - A `stepnow.consent.changed` event listener is wired up so any
        analytics / marketing snippet only loads after consent is granted.
      - AJAX error toasts ("Too many requests…", "Something went wrong…")
        are pre-translated server-side via @json(__())) and stashed in
        `window.STEPNOW_I18N`. The locale at page load is the one used.
--}}

<script src="{{ asset('front/assets/js/vendor/notyf.min.js') }}"></script>

<script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jarallax.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.appear.min.js') }}"></script>
<script src="{{ asset('front/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.circle-progress.min.js') }}"></script>
<script src="{{ asset('front/assets/js/knob.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('front/assets/js/wNumb.min.js') }}"></script>
<script src="{{ asset('front/assets/js/wow.js') }}"></script>
<script src="{{ asset('front/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('front/assets/js/jquery-sidebar-content.js') }}"></script>
<script src="{{ asset('front/assets/js/gsap/gsap.js') }}"></script>
<script src="{{ asset('front/assets/js/gsap/ScrollTrigger.js') }}"></script>
<script src="{{ asset('front/assets/js/gsap/SplitText.js') }}"></script>
<script src="{{ asset('front/assets/js/marquee.min.js') }}"></script>
<script src="{{ asset('front/assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('front/assets/js/timePicker.js') }}"></script>
<script src="{{ asset('front/assets/js/typed-2.0.11.js') }}"></script>
<script src="{{ asset('front/assets/js/aos.js') }}"></script>

<script src="{{ asset('front/assets/js/script.js') }}"></script>

<script>
    // ---- i18n strings for client-side toasts -----------------------------
    // Server resolves these per the active locale and inlines them.
    window.STEPNOW_I18N = {
        tooManyRequests: @json(__('Too many requests. Please try again in a minute.')),
        genericError:    @json(__('Something went wrong. Please try again.')),
    };

    // Notyf — toast notification config (no external network call).
    var notyf = new Notyf({
        duration: 3000,
        position: { x: 'right', y: 'top' }
    });

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error(@json($error));
        @endforeach
    @endif

    @if (session('success'))
        notyf.success(@json(session('success')));
    @endif

    @if (session('error'))
        notyf.error(@json(session('error')));
    @endif

    /**
     * Consent-gated integration hook.
     *
     * Where any analytics / marketing snippet must be loaded — NOT in the
     * <head>. The cookie banner dispatches `stepnow.consent.changed`
     * whenever the user changes preferences, and at first page load
     * after the choice is read from localStorage.
     *
     * Example (when adding Plausible Analytics later):
     *   document.addEventListener('stepnow.consent.changed', function (e) {
     *     if (e.detail.statistics && !window.plausible) {
     *         var s = document.createElement('script');
     *         s.defer = true;
     *         s.src   = 'https://plausible.io/js/script.js';
     *         s.dataset.domain = 'step-now.de';
     *         document.head.appendChild(s);
     *     }
     *   });
     */
</script>

<script>
    // Contact form AJAX submit
    $(document).ready(function() {
        $("#contactForm").on("submit", function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            form.find(".is-invalid").removeClass("is-invalid");
            form.find(".invalid-feedback").remove();

            $.ajax({
                url: form.attr("action"),
                method: form.attr("method"),
                data: formData,
                success: function(response) {
                    notyf.success(response.message);
                    form[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = form.find('[name="' + key + '"]');
                            input.addClass("is-invalid");
                            input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    } else if (xhr.status === 429) {
                        notyf.error(window.STEPNOW_I18N.tooManyRequests);
                    } else {
                        notyf.error(window.STEPNOW_I18N.genericError);
                    }
                },
            });
        });
    });
</script>

<script>
    // Booking form AJAX submit
    $(document).ready(function() {
        $("#bookingForm").on("submit", function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            form.find(".is-invalid").removeClass("is-invalid");
            form.find(".invalid-feedback").remove();

            $.ajax({
                url: form.attr("action"),
                method: form.attr("method"),
                data: formData,
                success: function(response) {
                    notyf.success(response.message);
                    form[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            let input = form.find('[name="' + key + '"]');
                            input.addClass("is-invalid");
                            input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    } else if (xhr.status === 429) {
                        notyf.error(window.STEPNOW_I18N.tooManyRequests);
                    } else {
                        notyf.error(window.STEPNOW_I18N.genericError);
                    }
                },
            });
        });
    });
</script>

<script>
    // Newsletter form AJAX submit (Double-Opt-In)
    $(document).ready(function() {
        $("#newsletterForm").on("submit", function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: form.attr("action"),
                method: form.attr("method"),
                data: formData,
                success: function(response) {
                    notyf.success(response.message);
                    form[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let firstError = Object.values(xhr.responseJSON.errors)[0][0];
                        notyf.error(firstError);
                    } else if (xhr.status === 429) {
                        notyf.error(window.STEPNOW_I18N.tooManyRequests);
                    } else {
                        notyf.error(window.STEPNOW_I18N.genericError);
                    }
                },
            });
        });
    });
</script>
