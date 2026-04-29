<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?: 'de' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- ──────────────────────────────────────────────────────────────────
         International SEO: declare DE/EN alternates of the current page.

         The site uses session-based locale switching, so the same URL
         serves both languages depending on the visitor's session. These
         link tags tell Google explicitly that two language variants of
         this page exist, which version is the default, and what the
         canonical URL is.

         Logic:
           - $cleanUrl  : current URL with any existing ?lang=… stripped
           - hreflang=de : German variant (?lang=de)
           - hreflang=en : English variant (?lang=en)
           - hreflang=x-default : fallback (German, since DE is primary market)
           - canonical : the path itself, no lang param

         Verification after deploy:
           curl -s https://step-now.de/impressum | grep -E 'hreflang|canonical'
         ────────────────────────────────────────────────────────────────── --}}
    @php
        $currentUrl = url()->current();
        $cleanUrl   = preg_replace('/([?&])lang=(de|en)(&|$)/', '$1', $currentUrl);
        $cleanUrl   = rtrim($cleanUrl, '?&');
        $sep        = parse_url($cleanUrl, PHP_URL_QUERY) ? '&' : '?';
    @endphp
    <link rel="alternate" hreflang="de"        href="{{ $cleanUrl }}{{ $sep }}lang=de">
    <link rel="alternate" hreflang="en"        href="{{ $cleanUrl }}{{ $sep }}lang=en">
    <link rel="alternate" hreflang="x-default" href="{{ $cleanUrl }}{{ $sep }}lang=de">
    <link rel="canonical"                      href="{{ $cleanUrl }}">

    <title>@yield('title') | StepNow Rides &amp; Movers</title>

    {{-- Favicon (driven by settings, with fallback) --}}
    @if(isset($setting) && $setting && $setting->fav_icon)
        <link rel="shortcut icon" href="{{ asset($setting->fav_icon) }}" type="image/x-icon">
    @endif

    @include('front.layouts.partials.styles')

</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="loader js-preloader">
        <div></div>
        <div></div>
        <div></div>
    </div>

    @include('front.layouts.partials.x-side-bar')


    <div class="page-wrapper">
        @include('front.layouts.partials.header')

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        @yield('content')

        @include('front.layouts.partials.footer')

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="{{ route('front.index') }}" aria-label="logo image"><img src="{{ asset($setting->footer_logo) }}"
                        width="140" alt="" /></a>
            </div>
            <div class="mobile-nav__container"></div>

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                </li>
                <li>
                    <i class="fas fa-phone"></i>
                    <a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a>
                </li>
            </ul>
            <div class="thm-social-link1">
                <ul class="social-box list-unstyled">
                    @if (!empty($setting->fb_link))
                        <li><a href="{{ $setting->fb_link }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if (!empty($setting->insta_link))
                        <li><a href="{{ $setting->insta_link }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if (!empty($setting->yt_link))
                        <li><a href="{{ $setting->yt_link }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @if (!empty($setting->linkedin_link))
                        <li><a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- Cookie consent banner — must load before any non-essential script  --}}
    @include('front.partials.legal.cookie-consent')

    {{-- All non-essential JS lives here. Tracking scripts must check the   --}}
    {{-- window.stepnowConsent.statistics / .marketing flags before firing. --}}
    @include('front.layouts.partials.scripts')

</body>

</html>