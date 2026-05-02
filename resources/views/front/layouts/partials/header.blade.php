{{--
    Front header — main navigation, locale switcher, top-bar contact.

    HARDENED v2:
      • Menu links now use lroute() which derives locale from request,
        not just app()->getLocale(). This is bulletproof against view
        caching, response caching, and middleware-order edge cases.
      • Language switcher uses locale_url_for() (canonical method).
--}}

@php
    // Read the locale ONCE at the top of the partial so all blocks below
    // are guaranteed consistent (rather than each block calling
    // app()->getLocale() and possibly getting different answers if a
    // helper mutates state mid-render).
    $currentLocale = function_exists('_sn_current_locale')
        ? _sn_current_locale()
        : app()->getLocale();

    $deUrl = function_exists('locale_url_for')
        ? locale_url_for('de')
        : url(request()->path() === '/' ? '/' : '/' . request()->path());
    $enUrl = function_exists('locale_url_for')
        ? locale_url_for('en')
        : url(request()->path() === '/' ? '/' : '/' . request()->path()) . '?lang=en';

    $phoneE164 = isset($setting) && $setting && !empty($setting->phone_e164)
        ? $setting->phone_e164
        : (isset($setting) ? $setting->phone_no : '+4915901228856');
@endphp

<header class="main-header">
    <div class="main-menu__top">
        <div class="main-menu__top-inner">
            <ul class="list-unstyled main-menu__contact-list">
                <li>
                    <div class="icon"><i class="icon-call-2"></i></div>
                    <div class="text">
                        <p><a href="tel:{{ $phoneE164 }}">{{ optional($setting ?? null)->phone_no ?? '+49 159 01228856' }}</a></p>
                    </div>
                </li>
                <li>
                    <div class="icon"><i class="icon-envelope-2"></i></div>
                    <div class="text">
                        <p><a href="mailto:{{ optional($setting ?? null)->email ?? 'info@step-now.de' }}">{{ optional($setting ?? null)->email ?? 'info@step-now.de' }}</a></p>
                    </div>
                </li>
            </ul>
            <div class="main-menu__top-right">

                {{-- Language switcher: uses locale_url_for() canonical method --}}
                <div class="main-menu__lang-switcher"
                     style="display:inline-flex; gap:6px; align-items:center; margin-right:18px; font-size:.85rem;">
                    <a href="{{ $deUrl }}"
                       style="color:{{ $currentLocale === 'de' ? '#ffc107' : '#fff' }}; text-decoration:{{ $currentLocale === 'de' ? 'underline' : 'none' }}; font-weight:{{ $currentLocale === 'de' ? '700' : '400' }};"
                       aria-label="Deutsch" title="Deutsch">DE</a>
                    <span style="opacity:.5; color:#fff;">|</span>
                    <a href="{{ $enUrl }}"
                       style="color:{{ $currentLocale === 'en' ? '#ffc107' : '#fff' }}; text-decoration:{{ $currentLocale === 'en' ? 'underline' : 'none' }}; font-weight:{{ $currentLocale === 'en' ? '700' : '400' }};"
                       aria-label="English" title="English">EN</a>
                </div>

                <div class="main-menu__top-login-reg-box">
                    <a href="{{ function_exists('lroute') ? lroute('login') : route('login') }}">{{ __('Sign in') }}</a>
                </div>
                <div class="main-menu__social">
                    @if (!empty(optional($setting ?? null)->fb_link))
                        <a href="{{ $setting->fb_link }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (!empty(optional($setting ?? null)->insta_link))
                        <a href="{{ $setting->insta_link }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (!empty(optional($setting ?? null)->yt_link))
                        <a href="{{ $setting->yt_link }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if (!empty(optional($setting ?? null)->tiktok_link))
                        <a href="{{ $setting->tiktok_link }}" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>
                    @endif
                    @if (!empty(optional($setting ?? null)->linkedin_link))
                        <a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN NAVIGATION — every link uses lroute() so the menu keeps the locale --}}
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ lroute('front.index') }}">
                            <img src="{{ asset(optional($setting ?? null)->logo) }}" width="200px" alt="StepNow">
                        </a>
                    </div>
                </div>
                <div class="main-menu__middle-box">
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler" aria-label="Menu"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list">
                            <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ lroute('front.about') }}">{{ __('About Us') }}</a></li>
                            <li><a href="{{ lroute('front.services') }}">{{ __('Services') }}</a></li>
                            <li><a href="{{ lroute('front.pricing') }}">{{ __('Pricing') }}</a></li>
                            <li><a href="{{ lroute('front.contactus') }}">{{ __('Contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon"><i class="icon-call-3"></i></div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title">{{ __('Call anytime') }}</p>
                            <h5 class="main-menu__call-number">
                                <a href="tel:{{ $phoneE164 }}">{{ optional($setting ?? null)->phone_no ?? '+49 159 01228856' }}</a>
                            </h5>
                        </div>
                    </div>
                    <div class="main-menu__nav-sidebar-icon">
                        <a class="navSidebar-button" href="#" aria-label="Open sidebar">
                            <span class="icon-dots-menu-one"></span>
                            <span class="icon-dots-menu-two"></span>
                            <span class="icon-dots-menu-three"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div>
</div>
