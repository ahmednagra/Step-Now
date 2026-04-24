<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

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
    var notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top'
        }
    });

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    @endif

    @if (session('success'))
        notyf.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        notyf.error("{{ session('error') }}");
    @endif
</script>
<script>
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
                            input.after(
                                '<div class="invalid-feedback">' +
                                value[0] +
                                "</div>"
                            );
                        });
                    } else {
                        notyf.error("Something went wrong, please try again!");
                    }
                },
            });
        });
    });
</script>

<script>
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
                            input.after(
                                '<div class="invalid-feedback">' +
                                value[0] +
                                "</div>"
                            );
                        });
                    } else {
                        notyf.error("Something went wrong, please try again!");
                    }
                },
            });
        });
    });
</script>


<a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    <span class="scroll-to-top__text">Zurück nach oben</span>
</a>
