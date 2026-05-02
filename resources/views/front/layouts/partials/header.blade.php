{{--
    ============================================================================
    Front header — main navigation, language toggle in the nav bar.

    Wave 5g revisions:
      • Removed the dark blue top contact bar (phone + email + social).
        Phone is still shown via the right-side "Call anytime" CTA.
        Email is shown in the footer + side-bar drawer (untouched).
        Social icons are shown in the footer (untouched).
      • Language toggle moved INTO the white nav bar, sitting left of
        the "Call anytime" CTA. Same DE/EN buttons, same JS handler.
      • Header is now ~70px shorter — homepage hero rises into view sooner.
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

    /* URLs for the language toggle */
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
                                aria-label="{{ $isEN ? 'Open menu' : 'Menü öffnen' }}">
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

                {{-- Right: language toggle + call-anytime CTA + side-panel toggle --}}
                <div class="main-menu__right">

                    {{-- Language toggle (DE/EN) — moved here from old top bar --}}
                    <div class="sn-lang-toggle sn-lang-toggle--inline"
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

                    {{-- Call anytime CTA --}}
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

                    {{-- Side-panel hamburger (opens x-side-bar) --}}
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

{{-- Sticky-on-scroll header (populated by theme JS) — kept for theme compat --}}
<div class="stricky-header stricked-menu main-menu" aria-hidden="true">
    <div class="sticky-header__content"></div>
</div>