@include('front.partials.cta.cta-1')
<footer class="site-footer">
    <div class="site-footer__bg" style="background-image: url({{ asset('front') }}/assets/images/video-pic1.jpg);"></div>
    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">

                    {{-- About / Social --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo">
                                <a href="{{ lroute('front.index') }}">
                                    <img src="{{ asset($setting->footer_logo) }}" width="150" alt="StepNow Rides Logo">
                                </a>
                            </div>
                            <p class="footer-widget__about-text">
                                {{ __('Your reliable partner for hire-car passenger transport and parcel delivery in Deizisau and the Esslingen region.') }}
                            </p>
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
                                    @if (!empty($setting->tiktok_link))
                                        <li><a href="{{ $setting->tiktok_link }}" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a></li>
                                    @endif
                                    @if (!empty($setting->linkedin_link))
                                        <li><a href="{{ $setting->linkedin_link }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">{{ __('Quick Links') }}</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="{{ lroute('front.about') }}">{{ __('About us') }}</a></li>
                                <li><a href="{{ lroute('front.services') }}">{{ __('Our Services') }}</a></li>
                                <li><a href="{{ lroute('front.pricing') }}">{{ __('Pricing') }}</a></li>
                                <li><a href="{{ lroute('front.contactus') }}">{{ __('Contact') }}</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Legal — REQUIRED on every page (BGH 2-Klick-Regel) --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">{{ __('Legal') }}</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                @if(isset($policies) && $policies->has('Impressum'))
                                    <li><a href="{{ lroute('front.impressum') }}">{{ __('Imprint') }}</a></li>
                                @endif
                                @if(isset($policies) && $policies->has('Datenschutzerklärung'))
                                    <li><a href="{{ lroute('front.datenschutz') }}">{{ __('Privacy Policy') }}</a></li>
                                @endif
                                @if(isset($policies) && $policies->has('Allgemeine Geschäftsbedingungen'))
                                    <li><a href="{{ lroute('front.agb') }}">{{ __('Terms & Conditions') }}</a></li>
                                @endif
                                @if(isset($policies) && $policies->has('Widerrufsbelehrung'))
                                    <li><a href="{{ lroute('front.widerruf') }}">{{ __('Right of Withdrawal') }}</a></li>
                                @endif
                                @if(isset($policies) && $policies->has('Cookie-Richtlinie'))
                                    <li><a href="{{ lroute('front.cookies') }}">{{ __('Cookie Policy') }}</a></li>
                                @endif
                                <li>
                                    <a href="#" onclick="event.preventDefault(); if(window.stepnowConsent){window.stepnowConsent.openSettings();}">
                                        {{ __('Cookie Settings') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget__contact">
                            <h3 class="footer-widget__title">{{ __('Contact') }}</h3>
                            <ul class="footer-widget__contact-list list-unstyled">
                                <li>
                                    <div class="icon"><span class="icon-pin"></span></div>
                                    <p>{{ $setting->address }}</p>
                                </li>
                                <li>
                                    <div class="icon"><span class="icon-call"></span></div>
                                    <p><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></p>
                                </li>
                                <li>
                                    <div class="icon"><span class="icon-envelope"></span></div>
                                    <p><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="site-footer__bottom" style="border-top: 1px solid rgba(255,255,255,.08); padding: 18px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <p style="margin: 0; font-size: 0.85rem; opacity: 0.85;">
                        &copy; {{ date('Y') }} StepNow Rides &amp; Movers e.K. &middot; {{ __('All rights reserved.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
