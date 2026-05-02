{{--
    ============================================================================
    Front-end stylesheet bundle.

    Compliance:
      • Google Fonts replaced by fonts.bunny.net (LG München I, Az. 3 O 17493/20)
      • All vendor CSS hosted locally under public/front/assets/css/

    Wave 2A revisions:
      • Removed duplicate <link> tags (was loading FA + bootstrap-icons twice)
      • Single icon system: Font Awesome (font-awesome-all.css) + Bootstrap Icons
        (vendor/bootstrap-icons.min.css). Flaticon dropped — was unused.
      • custom-tokens.css loaded BEFORE module CSS so var() resolves
      • Module CSS unchanged, but reordered to fix cascade
      • stepnow-brand.css remains the LAST stylesheet for final overrides

    Load order (top → bottom):
      1. Fonts (preconnected in master.blade.php)
      2. Icon fonts (FA + Bootstrap Icons)
      3. Vendor CSS (Bootstrap, Animate, Swiper, Magnific-Popup, Owl, Jarallax)
      4. Plugin CSS (Nice-Select, jQuery-UI, AOS, Odometer, TimePicker)
      5. *** custom-tokens.css ***  ← design system primitives
      6. Module CSS (slider, services, about, booking, ...)
      7. style.css                  ← theme catch-all
      8. Per-page @yield('css')     ← page-specific overrides
      9. responsive.css             ← media-query layer
     10. stepnow-brand.css          ← final brand polish
    ============================================================================
--}}

{{-- 1. Fonts --}}
<link href="https://fonts.bunny.net/css?family=roboto:100,300,400,500,700,900&family=inter-tight:100,200,300,400,500,600,700,800,900&display=swap"
      rel="stylesheet">

{{-- 2. Icon fonts — only TWO: Font Awesome + Bootstrap Icons --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/font-awesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap-icons.min.css') }}">

{{-- 3. Vendor CSS (Bootstrap & animation libs) --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/custom-animate.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/swiper.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/jarallax.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/jquery.magnific-popup.css') }}">

{{-- 4. Carousels & form widgets --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/odometer.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/timePicker.css') }}">

{{-- 5. Notyf (toast notifications, locally hosted) --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/vendor/notyf.min.css') }}">

{{-- 6. *** Design tokens — must come BEFORE module CSS *** --}}
<link rel="stylesheet" href="{{ asset('public/front/assets/css/custom-tokens.css') }}"
      onerror="this.onerror=null;this.href='{{ asset('front/assets/css/custom-tokens.css') }}';">

{{-- 7. Module CSS (one stylesheet per UI block) --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/slider.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/sliding-text.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/services.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/about.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/booking.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/counter.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/listing.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/video.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/pricing.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/popular-car.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/testimonial.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/faq.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/team.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/call.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/download-app.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/brand.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/blog.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/lets-talk.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/process.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/why-choose.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/gallery.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/module-css/page-header.css') }}">

{{-- 8. Theme catch-all --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">

{{-- 9. Responsive media-query layer --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">

{{-- 10. Brand polish — loaded LAST so it can override theme defaults --}}
<link rel="stylesheet" href="{{ asset('front/assets/css/stepnow-brand.css') }}">
