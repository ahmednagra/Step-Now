{{--
    ============================================================================
    StepNow Rides & Movers — Front Master Layout
    ============================================================================

    What changed in this revision (Wave 2A):
      • Locale model: BOTH equal — no "default winner". Detection order:
          1. ?lang= query param
          2. session('locale')
          3. cookie 'stepnow_locale'
          4. Accept-Language header (first preference)
          5. fallback: 'de' (only if everything else fails)
      • <html lang="…"> reflects the actual chosen locale (no "?: 'de'" cheat)
      • hreflang="x-default" → 'en' (broader international comprehension)
      • <title> is built per-page; sites with no @section('title') still get
        a sensible brand-suffixed default
      • Per-page <meta name="description"> via @section('meta_description')
      • Per-page Open Graph image via @section('og_image')
      • JSON-LD LocalBusiness now declares @type LimousineService (matches PBefG)
      • JSON-LD includes openingHours, geo coords, areaServed
      • All inline <style> blocks moved into custom-tokens.css
      • Skip-link CSS is now in tokens, not at end-of-file
      • removed: floating <style> block AFTER </html> (was invalid HTML)
    ============================================================================
--}}
@php
    use Illuminate\Support\Str;

    $locale  = app()->getLocale();
    $isEN    = $locale === 'en';

    /* ---- URLs for hreflang ---- */
    $currentUrl = url()->current();
    $cleanUrl   = preg_replace('/([?&])lang=(de|en)(&|$)/', '$1', $currentUrl);
    $cleanUrl   = rtrim($cleanUrl, '?&');
    $sep        = parse_url($cleanUrl, PHP_URL_QUERY) ? '&' : '?';

    /* ---- Brand strings ---- */
    $baseBrand  = 'StepNow Rides & Movers';
    $tagline    = $isEN
        ? 'Hire-car · Passenger transport · Parcel service'
        : 'Mietwagen · Personenbeförderung · Paketdienst';

    /* ---- Page-level meta ---- */
    $pageTitleRaw = trim((string) View::yieldContent('title'));
    $fullTitle    = $pageTitleRaw
        ? ($pageTitleRaw . ' | ' . $baseBrand)
        : ($baseBrand . ' — ' . $tagline);

    $metaDescRaw  = trim((string) View::yieldContent('meta_description'));
    $metaDescription = $metaDescRaw ?: ($isEN
        ? 'StepNow Rides & Movers — passenger transport, hire-car and parcel service from Deizisau. Transparent fixed prices, punctual, regional.'
        : 'StepNow Rides & Movers — Personenbeförderung, Mietwagen und Paketdienst aus Deizisau. Transparente Festpreise, pünktlich, regional.');

    /* ---- OG image: page override > settings logo > shipped default ---- */
    $ogImageRaw = trim((string) View::yieldContent('og_image'));
    $ogImage    = $ogImageRaw
        ?: (isset($setting) && $setting && $setting->logo ? asset($setting->logo)
            : asset('front/assets/images/og-default.jpg'));

    /* ---- Phone (single source of truth: settings, fallback hardcoded) ---- */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';

    /* ---- Theme color ---- */
    $brandPrimary = '#0F4C81';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="{{ $brandPrimary }}">
    <meta name="format-detection" content="telephone=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ─── Title & description (per-page, falling back to brand defaults) ─── --}}
    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="author" content="{{ $baseBrand }}">

    {{-- Robots: indexable by default, page can override via @section('robots') --}}
    @php $robots = trim((string) View::yieldContent('robots')) ?: 'index, follow, max-image-preview:large'; @endphp
    <meta name="robots" content="{{ $robots }}">

    {{-- ─── International SEO: equal-weight DE/EN, x-default → EN ───────────
         Both locales are first-class. Visitors land in their browser's
         preferred language; the header toggle persists their choice via
         cookie. Google sees both URLs as equally canonical.
    ───────────────────────────────────────────────────────────────────── --}}
    <link rel="canonical"                      href="{{ $isEN ? $cleanUrl . $sep . 'lang=en' : $cleanUrl }}">
    <link rel="alternate" hreflang="de"        href="{{ $cleanUrl }}{{ $sep }}lang=de">
    <link rel="alternate" hreflang="en"        href="{{ $cleanUrl }}{{ $sep }}lang=en">
    <link rel="alternate" hreflang="x-default" href="{{ $cleanUrl }}{{ $sep }}lang=en">

    {{-- ─── Open Graph (social sharing) ─── --}}
    <meta property="og:type"              content="website">
    <meta property="og:locale"            content="{{ $isEN ? 'en_US' : 'de_DE' }}">
    <meta property="og:locale:alternate"  content="{{ $isEN ? 'de_DE' : 'en_US' }}">
    <meta property="og:site_name"         content="{{ $baseBrand }}">
    <meta property="og:title"             content="{{ $fullTitle }}">
    <meta property="og:description"       content="{{ $metaDescription }}">
    <meta property="og:image"             content="{{ $ogImage }}">
    <meta property="og:image:alt"         content="{{ $baseBrand }}">
    <meta property="og:url"               content="{{ url()->current() }}">

    {{-- ─── Twitter card ─── --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image"       content="{{ $ogImage }}">

    {{-- ─── Geo metadata (local SEO) ─── --}}
    <meta name="geo.region"    content="DE-BW">
    <meta name="geo.placename" content="Deizisau">
    <meta name="geo.position"  content="48.7242;9.3686">
    <meta name="ICBM"          content="48.7242, 9.3686">

    {{-- ─── Favicon (driven by settings, fallback shipped) ─── --}}
    @if(isset($setting) && $setting && !empty($setting->fav_icon))
        <link rel="icon" type="image/x-icon" href="{{ asset($setting->fav_icon) }}">
        <link rel="shortcut icon"             href="{{ asset($setting->fav_icon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('front/assets/images/favicon.ico') }}">
    @endif
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/assets/images/apple-touch-icon.png') }}">

    {{-- ─── Performance: preconnect to font host ─── --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

    {{-- ─── JSON-LD: LocalBusiness / LimousineService schema ─── --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": ["LocalBusiness", "LimousineService"],
      "@id": "{{ url('/') }}#business",
      "name": "{{ $baseBrand }}",
      "alternateName": "StepNow Rides & Movers e.K.",
      "description": {!! json_encode($metaDescription) !!},
      "image": "{{ $ogImage }}",
      "logo": "{{ optional($setting ?? null)->logo ? asset($setting->logo) : asset('front/assets/images/logo.png') }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $phoneE164 }}",
      "email": "{{ $emailAddr }}",
      "currenciesAccepted": "EUR",
      "paymentAccepted": "Cash, Bank transfer, PayPal",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Blumenstraße 8",
        "postalCode": "73779",
        "addressLocality": "Deizisau",
        "addressRegion": "Baden-Württemberg",
        "addressCountry": "DE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 48.7242,
        "longitude": 9.3686
      },
      "areaServed": [
        { "@type": "City", "name": "Deizisau" },
        { "@type": "City", "name": "Esslingen am Neckar" },
        { "@type": "City", "name": "Plochingen" },
        { "@type": "City", "name": "Reichenbach an der Fils" },
        { "@type": "City", "name": "Wernau" },
        { "@type": "City", "name": "Köngen" },
        { "@type": "City", "name": "Wendlingen am Neckar" },
        { "@type": "City", "name": "Stuttgart" },
        { "@type": "Place", "name": "Stuttgart Airport (STR)" },
        { "@type": "Place", "name": "Messe Stuttgart" }
      ],
      "openingHoursSpecification": [
        { "@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "06:00", "closes": "22:00" },
        { "@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "07:00", "closes": "22:00" },
        { "@type": "OpeningHoursSpecification", "dayOfWeek": "Sunday",   "opens": "08:00", "closes": "20:00" }
      ],
      "priceRange": "€€",
      "sameAs": [
        @php
            $social = [];
            foreach (['fb_link','insta_link','yt_link','tiktok_link','linkedin_link'] as $k) {
                $v = optional($setting ?? null)->$k;
                if (!empty($v)) $social[] = json_encode($v);
            }
        @endphp
        {!! implode(',', $social) !!}
      ]
    }
    </script>

    {{-- WebSite + SearchAction (helps Google sitelinks) --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "{{ $baseBrand }}",
      "url": "{{ url('/') }}",
      "inLanguage": ["de-DE", "en-US"]
    }
    </script>

    {{-- ─── Stylesheets ─── --}}
    @include('front.layouts.partials.styles')

    {{-- Per-page CSS slot (still supported for one-off overrides) --}}
    @yield('css')
</head>

<body class="custom-cursor sn-locale-{{ $locale }}">

    {{-- Skip-link (BFSG / WCAG 2.4.1) — class styled in custom-tokens.css --}}
    <a class="sn-skip" href="#content">
        {{ $isEN ? 'Skip to content' : 'Zum Inhalt springen' }}
    </a>

    <div class="custom-cursor__cursor" aria-hidden="true"></div>
    <div class="custom-cursor__cursor-two" aria-hidden="true"></div>

    {{-- Preloader — hidden from AT, won't trap focus --}}
    <div class="loader js-preloader" aria-hidden="true" role="presentation">
        <div></div><div></div><div></div>
    </div>

    @include('front.layouts.partials.x-side-bar')

    {{-- Soft-launch / safety banner (kept) --}}
    @includeIf('front.partials.banner.site-banners')

    <div class="page-wrapper">
        @include('front.layouts.partials.header')

        <div class="stricky-header stricked-menu main-menu" aria-hidden="true">
            <div class="sticky-header__content"></div>
        </div>

        <main id="content" tabindex="-1" role="main">
            @yield('content')
        </main>

        @include('front.layouts.partials.footer')
    </div>

    {{-- Mobile nav drawer --}}
    <div class="mobile-nav__wrapper" role="dialog" aria-modal="true" aria-label="{{ $isEN ? 'Mobile navigation' : 'Mobile-Navigation' }}">
        <div class="mobile-nav__overlay mobile-nav__toggler" tabindex="-1"></div>
        <div class="mobile-nav__content">
            <button type="button" class="mobile-nav__close mobile-nav__toggler" aria-label="{{ $isEN ? 'Close menu' : 'Menü schließen' }}">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>

            <div class="logo-box">
                <a href="{{ lroute('front.index') }}" aria-label="{{ $baseBrand }}">
                    <img src="{{ asset(optional($setting ?? null)->footer_logo ?? optional($setting ?? null)->logo ?? 'front/assets/images/logo.png') }}"
                         width="140" height="40" alt="{{ $baseBrand }}">
                </a>
            </div>
            <div class="mobile-nav__container"></div>

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:{{ $emailAddr }}">{{ $emailAddr }}</a>
                </li>
                <li>
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <a href="tel:{{ $phoneE164 }}">{{ $phoneRaw }}</a>
                </li>
            </ul>

            <div class="thm-social-link1">
                <ul class="social-box list-unstyled">
                    @if (!empty(optional($setting ?? null)->fb_link))
                        <li><a href="{{ $setting->fb_link }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->insta_link))
                        <li><a href="{{ $setting->insta_link }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->yt_link))
                        <li><a href="{{ $setting->yt_link }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                    @endif
                    @if (!empty(optional($setting ?? null)->linkedin_link))
                        <li><a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- Cookie consent — must load before any non-essential script --}}
    @includeIf('front.partials.legal.cookie-consent')

    {{-- Scripts (consent-aware tracking handled inside this partial) --}}
    @include('front.layouts.partials.scripts')

    @stack('scripts')
</body>
</html>
