{{--
    ============================================================================
    Front header — main navigation, top contact bar, language toggle.

    Wave 2A revisions:
      • Single source of truth for phone (settings → fallback +49 159 01228856)
      • Single source of truth for email (settings → fallback info@step-now.de)
      • Active-state on nav links via Route::is() — proper aria-current="page"
      • Language toggle uses .sn-lang-toggle (styled in custom-tokens.css)
      • [data-sn-lang] attribute → JS handler in scripts.blade.php writes
        the locale cookie. No more inline styles on the switcher.
      • Phone link uses E.164 format for tel: href, display format for label
      • Logo width as HTML attribute kept for LCP (browser allocates space)
      • Removed inline style="..." everywhere — class-driven now
    ============================================================================
--}}
@php
    use Illuminate\Support\Facades\Route;

    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';

    /* Single source of truth for contact details */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';

    /* URLs for the language toggle (locale_url_for handles all edge cases) */
    $deUrl = function_exists('locale_url_for') ? locale_url_for('de') : url(request()->path()) . '?lang=de';
    $enUrl = function_exists('locale_url_for') ? locale_url_for('en') : url(request()->path()) . '?lang=en';

    /* Logo source */
    $logoSrc = optional($setting ?? null)->logo
        ? asset($setting->logo)
        : asset('front/assets/images/logo.png');

    /* Active-route helper for aria-current */
    $isHome     = Route::is('front.index');
    $isAbout    = Route::is('front.about');
    $isServices = Route::is('front.services');
    $isPricing  = Route::is('front.pricing');
    $isContact  = Route::is('front.contactus');
@endphp

<header class="main-header" role="banner">

    {{-- ─── TOP CONTACT BAR ──────────────────────────────────────────── --}}
    <div class="main-menu__top">
        <div class="main-menu__top-inner">

            {{-- Left: contact details --}}
            <ul class="list-unstyled main-menu__contact-list">
                <li>
                    <div class="icon" aria-hidden="true"><i class="icon-call-2"></i></div>
                    <div class="text">
                        <p>
                            <a href="tel:{{ $phoneE164 }}" aria-label="{{ $isEN ? 'Call' : 'Anrufen' }} {{ $phoneRaw }}">
                                {{ $phoneRaw }}
                            </a>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="icon" aria-hidden="true"><i class="icon-envelope-2"></i></div>
                    <div class="text">
                        <p>
                            <a href="mailto:{{ $emailAddr }}" aria-label="{{ $isEN ? 'Email' : 'E-Mail an' }} {{ $emailAddr }}">
                                {{ $emailAddr }}
                            </a>
                        </p>
                    </div>
                </li>
            </ul>

            {{-- Right: language toggle + social --}}
            <div class="main-menu__top-right">

                {{-- Language toggle (DE/EN, equal weight) --}}
                <div class="sn-lang-toggle"
                     role="group"
                     aria-label="{{ $isEN ? 'Language' : 'Sprache' }}">
                    <a href="{{ $enUrl }}"
                       data-sn-lang="en"
                       class="sn-lang-toggle__btn"
                       aria-current="{{ $isEN ? 'true' : 'false' }}"
                       aria-label="English"
                       hreflang="en"
                       lang="en">EN</a>
                    <a href="{{ $deUrl }}"
                       data-sn-lang="de"
                       class="sn-lang-toggle__btn"
                       aria-current="{{ $isEN ? 'false' : 'true' }}"
                       aria-label="Deutsch"
                       hreflang="de"
                       lang="de">DE</a>
                </div>

                {{-- Social icons (only render if URL is set) --}}
                <div class="thm-social-link1">
                    <ul class="social-box list-unstyled" role="list">
                        @if (!empty(optional($setting ?? null)->fb_link))
                            <li><a href="{{ $setting->fb_link }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                        @endif
                        @if (!empty(optional($setting ?? null)->insta_link))
                            <li><a href="{{ $setting->insta_link }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        @endif
                        @if (!empty(optional($setting ?? null)->yt_link))
                            <li><a href="{{ $setting->yt_link }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                        @endif
                        @if (!empty(optional($setting ?? null)->tiktok_link))
                            <li><a href="{{ $setting->tiktok_link }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="bi bi-tiktok" aria-hidden="true"></i></a></li>
                        @endif
                        @if (!empty(optional($setting ?? null)->linkedin_link))
                            <li><a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- ─── MAIN NAV BAR ─────────────────────────────────────────────── --}}
    <nav class="main-menu" aria-label="{{ $isEN ? 'Primary navigation' : 'Hauptnavigation' }}">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">

                {{-- Logo --}}
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ lroute('front.index') }}" aria-label="{{ $isEN ? 'StepNow Rides & Movers — Home' : 'StepNow Rides & Movers — Startseite' }}">
                            <img src="{{ $logoSrc }}" width="200" height="56" alt="StepNow Rides & Movers">
                        </a>
                    </div>
                </div>

                {{-- Primary nav links --}}
                <div class="main-menu__middle-box">
                    <div class="main-menu__main-menu-box">
                        <button type="button"
                                class="mobile-nav__toggler"
                                aria-label="{{ $isEN ? 'Open menu' : 'Menü öffnen' }}"
                                aria-expanded="false"
                                aria-controls="mobile-nav-content">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>

                        <ul class="main-menu__list" role="menubar">
                            <li role="none">
                                <a href="{{ lroute('front.index') }}"
                                   role="menuitem"
                                   @if($isHome) aria-current="page" @endif>
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li role="none">
                                <a href="{{ lroute('front.about') }}"
                                   role="menuitem"
                                   @if($isAbout) aria-current="page" @endif>
                                    {{ __('About Us') }}
                                </a>
                            </li>
                            <li role="none">
                                <a href="{{ lroute('front.services') }}"
                                   role="menuitem"
                                   @if($isServices) aria-current="page" @endif>
                                    {{ __('Services') }}
                                </a>
                            </li>
                            <li role="none">
                                <a href="{{ lroute('front.pricing') }}"
                                   role="menuitem"
                                   @if($isPricing) aria-current="page" @endif>
                                    {{ __('Pricing') }}
                                </a>
                            </li>
                            <li role="none">
                                <a href="{{ lroute('front.contactus') }}"
                                   role="menuitem"
                                   @if($isContact) aria-current="page" @endif>
                                    {{ __('Contact') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Right: call-anytime CTA + side-panel toggle --}}
                <div class="main-menu__right">
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon" aria-hidden="true">
                            <i class="icon-call-3"></i>
                        </div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title">{{ __('Call anytime') }}</p>
                            <h5 class="main-menu__call-number">
                                <a href="tel:{{ $phoneE164 }}">{{ $phoneRaw }}</a>
                            </h5>
                        </div>
                    </div>

                    <a class="navSidebar-button main-menu__nav-sidebar-icon"
                       href="#"
                       role="button"
                       aria-label="{{ $isEN ? 'Open quick-info sidebar' : 'Schnellinfo-Sidebar öffnen' }}">
                        <span class="icon-dots-menu-one" aria-hidden="true"></span>
                        <span class="icon-dots-menu-two" aria-hidden="true"></span>
                        <span class="icon-dots-menu-three" aria-hidden="true"></span>
                    </a>
                </div>

            </div>
        </div>
    </nav>
</header>

{{-- Sticky-on-scroll header (populated by theme JS) --}}
<div class="stricky-header stricked-menu main-menu" aria-hidden="true">
    <div class="sticky-header__content"></div>
</div>
