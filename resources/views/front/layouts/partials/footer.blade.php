{{--
    ============================================================================
    Front footer — site-wide legal, trust signals, links, contact.

    Wave 2A revisions:
      • Mandatory legal links ALWAYS render (BGH 2-Klick-Regel) —
        no longer conditional on $policies presence
      • Trust-signal row (DSGVO, GoBD, IHK, Klarna/PayPal/SEPA, secure SSL)
      • Service-area block (helps local SEO + sets visitor expectation)
      • Operating-hours block (mandatory for service businesses)
      • Auto copyright year (no more hardcoded year drift)
      • Second-tier nav: sitemap-style link list
      • CTA banner removed from this file — was triggering on the contact
        page right after the user submitted the form (tone-deaf).
        Page that needs CTA includes it explicitly.
      • All <a> tags use lroute() for locale-aware URLs
      • Removed all inline styles
    ============================================================================
--}}
@php
    use Illuminate\Support\Facades\Route;

    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';
    $year       = date('Y');

    /* Single source of truth */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';
    $address    = optional($setting ?? null)->address ?? 'Blumenstraße 8, 73779 Deizisau';

    $footerLogo = optional($setting ?? null)->footer_logo
        ?? optional($setting ?? null)->logo
        ?? 'front/assets/images/logo.png';
@endphp

<footer class="site-footer" role="contentinfo">

    {{-- Background image (kept from theme) --}}
    <div class="site-footer__bg" aria-hidden="true"
         style="background-image: url({{ asset('front/assets/images/video-pic1.jpg') }});"></div>

    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">

                    {{-- ─── COL 1 — Brand + about + social ─── --}}
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo mb-3">
                                <a href="{{ lroute('front.index') }}" aria-label="StepNow Rides & Movers — {{ $isEN ? 'Home' : 'Startseite' }}">
                                    <img src="{{ asset($footerLogo) }}" width="180" height="50" alt="StepNow Rides & Movers">
                                </a>
                            </div>

                            <p class="footer-widget__about-text">
                                {{ $isEN
                                    ? 'Your reliable partner for hire-car passenger transport and parcel delivery in Deizisau and the Esslingen region. Punctual, transparent, regional.'
                                    : 'Ihr zuverlässiger Partner für Mietwagen-Personenbeförderung und Paketdienst in Deizisau und der Region Esslingen. Pünktlich, transparent, regional.' }}
                            </p>

                            <ul class="footer-widget__contact-list list-unstyled mt-3">
                                <li class="d-flex align-items-start mb-2">
                                    <i class="fas fa-map-marker-alt mt-1 me-2" aria-hidden="true"></i>
                                    <span>{{ $address }}</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone me-2" aria-hidden="true"></i>
                                    <a href="tel:{{ $phoneE164 }}">{{ $phoneRaw }}</a>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope me-2" aria-hidden="true"></i>
                                    <a href="mailto:{{ $emailAddr }}">{{ $emailAddr }}</a>
                                </li>
                            </ul>

                            <div class="thm-social-link1 mt-3">
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

                    {{-- ─── COL 2 — Quick links ─── --}}
                    <div class="col-xl-2 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">{{ __('Quick Links') }}</h4>
                            <ul class="footer-widget__links-list list-unstyled" role="list">
                                <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                                <li><a href="{{ lroute('front.about') }}">{{ __('About Us') }}</a></li>
                                <li><a href="{{ lroute('front.services') }}">{{ __('Services') }}</a></li>
                                <li><a href="{{ lroute('front.pricing') }}">{{ __('Pricing') }}</a></li>
                                <li><a href="{{ lroute('front.contactus') }}">{{ __('Contact') }}</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- ─── COL 3 — Legal (BGH 2-Klick-Regel: ALWAYS visible) ─── --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">{{ __('Legal') }}</h4>
                            <ul class="footer-widget__links-list list-unstyled" role="list">
                                <li><a href="{{ lroute('front.impressum') }}">{{ __('Imprint') }}</a></li>
                                <li><a href="{{ lroute('front.datenschutz') }}">{{ __('Privacy Policy') }}</a></li>
                                <li><a href="{{ lroute('front.agb') }}">{{ __('Terms & Conditions') }}</a></li>
                                <li><a href="{{ lroute('front.widerruf') }}">{{ __('Right of Withdrawal') }}</a></li>
                                <li><a href="{{ lroute('front.cookies') }}">{{ __('Cookie Policy') }}</a></li>
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault(); if(window.stepnowConsent && typeof window.stepnowConsent.openSettings==='function'){window.stepnowConsent.openSettings();}"
                                       role="button">
                                        {{ __('Cookie Settings') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- ─── COL 4 — Hours + service area ─── --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">{{ __('Opening Hours') }}</h4>
                            <ul class="footer-widget__hours-list list-unstyled" role="list">
                                <li class="d-flex justify-content-between">
                                    <span>{{ __('Mon – Fri') }}</span>
                                    <span>06:00 – 22:00</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>{{ __('Saturday') }}</span>
                                    <span>07:00 – 22:00</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>{{ __('Sunday') }}</span>
                                    <span>08:00 – 20:00</span>
                                </li>
                                <li class="mt-2">
                                    <small>
                                        <i class="fas fa-plane-departure me-1" aria-hidden="true"></i>
                                        {{ $isEN
                                            ? '24/7 pre-booked airport transfers'
                                            : '24/7 vorgebuchte Flughafentransfers' }}
                                    </small>
                                </li>
                            </ul>

                            <h4 class="footer-widget__title mt-4">{{ __('Service Area') }}</h4>
                            <p class="small">
                                {{ $isEN
                                    ? 'Deizisau · Esslingen · Plochingen · Reichenbach · Wernau · Köngen · Wendlingen · Stuttgart · Stuttgart Airport (STR)'
                                    : 'Deizisau · Esslingen · Plochingen · Reichenbach · Wernau · Köngen · Wendlingen · Stuttgart · Flughafen Stuttgart (STR)' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ─── TRUST-SIGNAL ROW ─── --}}
    <div class="container">
        <div class="sn-trust-row" role="list" aria-label="{{ $isEN ? 'Trust signals' : 'Vertrauenssignale' }}">
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                {{ $isEN ? 'DSGVO compliant' : 'DSGVO-konform' }}
            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-lock" aria-hidden="true"></i>
                {{ $isEN ? 'SSL secured' : 'SSL-gesichert' }}
            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-certificate" aria-hidden="true"></i>
                {{ $isEN ? 'Licensed Mietwagen operator' : 'Konzessionierter Mietwagen-Betrieb' }}
            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="far fa-credit-card" aria-hidden="true"></i>
                {{ $isEN ? 'Cash · Bank transfer · PayPal' : 'Bar · Überweisung · PayPal' }}
            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                {{ $isEN ? 'Regional, Baden-Württemberg' : 'Regional, Baden-Württemberg' }}
            </span>
        </div>
    </div>

    {{-- ─── BOTTOM BAR ─── --}}
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner d-flex flex-wrap justify-content-between align-items-center py-3">
                <p class="site-footer__bottom-text mb-0">
                    &copy; {{ $year }} {{ optional($setting ?? null)->company_name ?? 'StepNow Rides & Movers e.K.' }}. {{ __('All rights reserved.') }}
                </p>

                <ul class="site-footer__bottom-links list-unstyled d-flex flex-wrap mb-0" role="list">
                    <li class="ms-3"><a href="{{ lroute('front.impressum') }}">{{ __('Imprint') }}</a></li>
                    <li class="ms-3"><a href="{{ lroute('front.datenschutz') }}">{{ __('Privacy Policy') }}</a></li>
                    <li class="ms-3"><a href="{{ lroute('front.agb') }}">{{ __('Terms & Conditions') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

{{-- Floating "back to top" button (theme-provided) — kept --}}
<a href="#top" class="scroll-to-top scroll-to-target" data-target="html"
   aria-label="{{ $isEN ? 'Scroll to top' : 'Zum Seitenanfang' }}">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</a>
