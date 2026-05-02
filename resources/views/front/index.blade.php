@extends('front.layouts.master')

{{-- ============================================================================
     Homepage

     Wave 2B revisions:
       • Removed the inline <style> block that hardcoded slider heights with
         !important everywhere — moved to custom-tokens.css. The slider now
         scales fluidly via clamp() instead of media-query-and-override.
       • Removed the per-page <link> tags duplicating styles.blade.php's
         module CSS (those CSS files load globally now).
       • Per-page meta description for SEO.
       • Per-page Open Graph image override slot.
       • Section order: hero → what we do → about → booking → trust → faq.
         The previous order (slider → about → services → process → booking
         → testimonial → why-choose → counter → faq) buried the
         conversion-driving section. New order matches AIDA:
            attention (hero) → interest (services + about) →
            desire (booking + trust) → action (cta + faq).
============================================================================= --}}

@section('title', app()->getLocale() === 'en' ? 'Home' : 'Startseite')

@section('meta_description',
    app()->getLocale() === 'en'
        ? 'StepNow Rides & Movers — fixed-price airport transfers, hire-car passenger transport and parcel delivery from Deizisau. Book online or call.'
        : 'StepNow Rides & Movers — Festpreis-Flughafentransfer, Mietwagen-Personenbeförderung und Paketdienst aus Deizisau. Online buchen oder anrufen.'
)

@section('content')

    {{-- 1. Hero slider (LCP element) --}}
    @include('front.partials.slider.slider')

    {{-- 2. Services overview (what we do, above the fold on tablet) --}}
    @includeIf('front.partials.services.service-1')

    {{-- 3. About — who we are, why local matters --}}
    @include('front.partials.about-us.about-2')

    {{-- 4. How it works (process) --}}
    @includeIf('front.partials.process.process-1')

    {{-- 5. Booking form (the conversion event) --}}
    @include('front.partials.booking.booking-1')

    {{-- 6. Why choose us (trust signals near the form) --}}
    @includeIf('front.partials.why-choose-us.why-choose-us-1')

    {{-- 7. Counter (social proof) --}}
    @includeIf('front.partials.counter.counter-1')

    {{-- 8. Testimonials --}}
    @includeIf('front.partials.testimonial.testimonial-1')

    {{-- 9. FAQ (objections handler) --}}
    @includeIf('front.partials.faq.faq')

@endsection
