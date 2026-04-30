<header class="main-header">
    <div class="main-menu__top">
        <div class="main-menu__top-inner">
            <ul class="list-unstyled main-menu__contact-list">
                <li>
                    <div class="icon">
                        <i class="icon-call-2"></i>
                    </div>
                    <div class="text">
                        <p><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></p>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <i class="icon-envelope-2"></i>
                    </div>
                    <div class="text">
                        <p><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                    </div>
                </li>
            </ul>
            <div class="main-menu__top-right">

                {{-- ====================================================================
                     Language switcher: clean direct-toggle URLs.
                     Each link points to the SAME current page, with ?lang=de or ?lang=en.
                     The SetLocale middleware reads ?lang= and persists it to session,
                     so subsequent navigation needs no URL parameter.
                     No redirect chain, no /locale/en URL, no return parameter.
                     ==================================================================== --}}
                @php
                    $currentLocale = app()->getLocale();

                    // Strip any existing ?lang= or &lang= from the current URL,
                    // then build clean DE and EN versions of the same page.
                    $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();
                    $existingQuery = request()->query();
                    unset($existingQuery['lang']); // remove any old lang param

                    $deUrl = url($currentPath) . (!empty($existingQuery) ? '?' . http_build_query(array_merge($existingQuery, ['lang' => 'de'])) : '?lang=de');
                    $enUrl = url($currentPath) . (!empty($existingQuery) ? '?' . http_build_query(array_merge($existingQuery, ['lang' => 'en'])) : '?lang=en');
                @endphp
                <div class="main-menu__lang-switcher" style="display:inline-flex; gap:6px; align-items:center; margin-right:18px; font-size:.85rem;">
                    <a href="{{ $deUrl }}"
                       style="color:{{ $currentLocale === 'de' ? '#ffc107' : '#fff' }}; text-decoration:{{ $currentLocale === 'de' ? 'underline' : 'none' }}; font-weight:{{ $currentLocale === 'de' ? '700' : '400' }};"
                       aria-label="Deutsch"
                       title="Deutsch">DE</a>
                    <span style="opacity:.5; color:#fff;">|</span>
                    <a href="{{ $enUrl }}"
                       style="color:{{ $currentLocale === 'en' ? '#ffc107' : '#fff' }}; text-decoration:{{ $currentLocale === 'en' ? 'underline' : 'none' }}; font-weight:{{ $currentLocale === 'en' ? '700' : '400' }};"
                       aria-label="English"
                       title="English">EN</a>
                </div>

                <div class="main-menu__top-login-reg-box">
                    <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                </div>
                <div class="main-menu__social">
                    @if (!empty($setting->fb_link))
                        <a href="{{ $setting->fb_link }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (!empty($setting->insta_link))
                        <a href="{{ $setting->insta_link }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (!empty($setting->yt_link))
                        <a href="{{ $setting->yt_link }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if (!empty($setting->tiktok_link))
                        <a href="{{ $setting->tiktok_link }}" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>
                    @endif
                    @if (!empty($setting->linkedin_link))
                        <a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
         MAIN NAVIGATION — logo + menu items
         ============================================================ --}}
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ asset($setting->logo) }}" width="200px" alt="StepNow">
                        </a>
                    </div>
                </div>
                <div class="main-menu__middle-box">
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler" aria-label="Menu"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list">
                            <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('front.about') }}">{{ __('About Us') }}</a></li>
                            <li><a href="{{ route('front.services') }}">{{ __('Services') }}</a></li>
                            <li><a href="{{ route('front.pricing') }}">{{ __('Pricing') }}</a></li>
                            <li><a href="{{ route('front.contactus') }}">{{ __('Contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon">
                            <i class="icon-call-3"></i>
                        </div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title">{{ __('Call anytime') }}</p>
                            <h5 class="main-menu__call-number">
                                <a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a>
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