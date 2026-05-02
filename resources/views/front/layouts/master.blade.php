<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?: 'de' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="theme-color" content="#0F4C81">

    {{-- ================================================================
         International SEO — declare DE/EN alternates of the current page

         The site uses session-based locale switching, so the same URL
         serves both languages depending on the visitor's session. These
         link tags tell Google explicitly that two language variants of
         this page exist, which version is the default, and what the
         canonical URL is.
         ================================================================ --}}
    @php
        $currentUrl = url()->current();
        $cleanUrl   = preg_replace('/([?&])lang=(de|en)(&|$)/', '$1', $currentUrl);
        $cleanUrl   = rtrim($cleanUrl, '?&');
        $sep        = parse_url($cleanUrl, PHP_URL_QUERY) ? '&' : '?';

        $baseTitle      = 'StepNow Rides &amp; Movers';
        $pageTitleRaw   = trim((string) View::yieldContent('title'));
        $fullTitle      = $pageTitleRaw ? ($pageTitleRaw . ' | ' . $baseTitle) : ($baseTitle . ' — Personenbeförderung · Mietwagen · Paketdienst');
        $metaDescRaw    = trim((string) View::yieldContent('meta_description'));
        $metaDescription = $metaDescRaw ?: (app()->getLocale() === 'en'
            ? 'StepNow Rides & Movers e.K. — passenger transport, hire car and parcel service from Deizisau. Transparent pricing, punctual, local.'
            : 'StepNow Rides & Movers e.K. — Personenbeförderung, Mietwagen und Paketdienst aus Deizisau. Transparente Preise, pünktlich, lokal.');
        $ogImage = isset($setting) && $setting && $setting->logo
            ? asset($setting->logo)
            : asset('front/assets/images/og-default.jpg');
        $phoneE164 = isset($setting) && $setting && !empty($setting->phone_e164)
            ? $setting->phone_e164
            : '+4915901228856';
    @endphp

    <link rel="alternate" hreflang="de"        href="{{ $cleanUrl }}{{ $sep }}lang=de">
    <link rel="alternate" hreflang="en"        href="{{ $cleanUrl }}{{ $sep }}lang=en">
    <link rel="alternate" hreflang="x-default" href="{{ $cleanUrl }}{{ $sep }}lang=de">
    <link rel="canonical"                      href="{{ $cleanUrl }}">

    <title>{!! $fullTitle !!}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots"      content="index,follow,max-image-preview:large">
    <meta name="author"      content="StepNow Rides & Movers">

    {{-- ----- Open Graph -------------------------------------------------- --}}
    <meta property="og:site_name"   content="StepNow Rides & Movers">
    <meta property="og:title"       content="{{ strip_tags($fullTitle) }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:locale"      content="{{ app()->getLocale() === 'en' ? 'en_GB' : 'de_DE' }}">
    <meta property="og:locale:alternate" content="{{ app()->getLocale() === 'en' ? 'de_DE' : 'en_GB' }}">
    <meta property="og:image"       content="{{ $ogImage }}">

    {{-- ----- Twitter Card ------------------------------------------------ --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ strip_tags($fullTitle) }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image"       content="{{ $ogImage }}">

    {{-- ----- Favicon ----------------------------------------------------- --}}
    @if(isset($setting) && $setting && $setting->fav_icon)
        <link rel="shortcut icon" href="{{ asset($setting->fav_icon) }}" type="image/x-icon">
    @endif

    {{-- ----- LocalBusiness JSON-LD (rich result eligibility) ------------- --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "StepNow Rides & Movers e.K.",
      "description": {!! json_encode($metaDescription) !!},
      "image": "{{ $ogImage }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $phoneE164 }}",
      "email": "{{ optional($setting ?? null)->email ?? 'info@step-now.de' }}",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Blumenstraße 8",
        "postalCode": "73779",
        "addressLocality": "Deizisau",
        "addressCountry": "DE"
      },
      "areaServed": [
        { "@type": "City", "name": "Esslingen am Neckar" },
        { "@type": "City", "name": "Stuttgart" },
        { "@type": "City", "name": "Plochingen" },
        { "@type": "City", "name": "Deizisau" }
      ],
      "priceRange": "€€"
    }
    </script>

    @include('front.layouts.partials.styles')
    @yield('css')
</head>

<body class="custom-cursor sn-locale-{{ app()->getLocale() }}">

    {{-- ----- Skip to content (BFSG / WCAG 2.4.1) ----------------------- --}}
    <a class="sn-skip" href="#content">{{ app()->getLocale() === 'en' ? 'Skip to content' : 'Zum Inhalt springen' }}</a>

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="loader js-preloader" aria-hidden="true">
        <div></div>
        <div></div>
        <div></div>
    </div>

    @include('front.layouts.partials.x-side-bar')

    {{-- ----- Site banners (soft-launch, safety notices) ---------------- --}}
    @include('front.partials.banner.site-banners')

    <div class="page-wrapper">
        @include('front.layouts.partials.header')

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div>
        </div>

        <main id="content" tabindex="-1">
            @yield('content')
        </main>

        @include('front.layouts.partials.footer')
    </div>

    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="{{ route('front.index') }}" aria-label="StepNow"><img src="{{ asset(optional($setting ?? null)->footer_logo ?? optional($setting ?? null)->logo) }}"
                        width="140" alt="StepNow" /></a>
            </div>
            <div class="mobile-nav__container"></div>

            <ul class="mobile-nav__contact list-unstyled">
                @if(!empty(optional($setting ?? null)->email))
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                    </li>
                @endif
                @if(!empty(optional($setting ?? null)->phone_no))
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $phoneE164 }}">{{ $setting->phone_no }}</a>
                    </li>
                @endif
            </ul>
            <div class="thm-social-link1">
                <ul class="social-box list-unstyled">
                    @if (!empty(optional($setting ?? null)->fb_link))
                        <li><a href="{{ $setting->fb_link }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->insta_link))
                        <li><a href="{{ $setting->insta_link }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->yt_link))
                        <li><a href="{{ $setting->yt_link }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->linkedin_link))
                        <li><a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- Cookie consent banner — must load before any non-essential script --}}
    @include('front.partials.legal.cookie-consent')

    {{-- All non-essential JS lives here. Tracking scripts must check the   --}}
    {{-- window.stepnowConsent.statistics / .marketing flags before firing. --}}
    @include('front.layouts.partials.scripts')

</body>

</html>

<style>
    /* Skip link — invisible until focused (BFSG WCAG 2.4.1) */
    .sn-skip {
        position: absolute; left: -9999px; top: -9999px;
        background: #0F4C81; color: #fff;
        padding: 12px 18px; border-radius: 0 0 8px 0;
        font-weight: 600; z-index: 100000;
    }
    .sn-skip:focus { left: 0; top: 0; outline: 3px solid #ffc107; outline-offset: 2px; }
    main:focus { outline: none; }
</style>
