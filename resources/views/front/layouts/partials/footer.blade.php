@include('front.partials.cta.cta-1')
<footer class="site-footer">
    <div class="site-footer__bg" style="background-image: url({{ asset('front') }}/assets/images/video-pic1.jpg);">
    </div>
    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo">
                                <a href="{{ route('front.index') }}"><img src="{{ asset($setting->footer_logo) }}" width="150"
                                        alt=""></a>
                            </div>
                            <p class="footer-widget__about-text">
                                Car – Wo Frühadopter und Innovationssuchende lebendige, kreative Technik finden.
                            </p>
                            <form class="footer-widget__form">
                                <div class="thm-social-link1">
                                    <ul class="social-box list-unstyled">
                                        @if (!empty($setting->fb_link))
                                            <li><a href="{{ $setting->fb_link }}" target="_blank"><i
                                                        class="fab fa-facebook-f"></i></a>
                                            </li>
                                        @endif
                                        @if (!empty($setting->insta_link))
                                            <li><a href="{{ $setting->insta_link }}" target="_blank"><i
                                                        class="fab fa-instagram"></i></a></li>
                                        @endif
                                        @if (!empty($setting->yt_link))
                                            <li><a href="{{ $setting->yt_link }}" target="_blank"><i
                                                        class="fab fa-youtube"></i></a>
                                            </li>
                                        @endif
                                        @if (!empty($setting->tiktok_link))
                                            <li><a href="{{ $setting->tiktok_link }}" target="_blank"> <i
                                                        class="bi bi-tiktok"></i></a>
                                            </li>
                                        @endif
                                        @if (!empty($setting->linkedin_link))
                                            <li><a href="{{ $setting->linkedin_link }}" target="_blank"><i
                                                        class="fab fa-linkedin-in"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title">Schnellzugriff</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="{{ route('front.about') }}">Über uns</a></li>
                                <li><a href="{{ route('front.services') }}">Unsere Services</a></li>
                                <li><a href="{{ route('front.contactus') }}">Kontakt</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget__services">
                            <h4 class="footer-widget__title">Services</h4>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="#">Ihr zuverlässiger Transport</a></li>
                                <li><a href="#">Express Shuttle</a></li>
                                <li><a href="#">Reisen mit Stil</a></li>
                                <li><a href="#">Mietliste</a></li>
                                <li><a href="#">Dash Transport</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__contact">
                            <h3 class="footer-widget__title">Kontakt</h3>
                            <ul class="footer-widget__contact-list list-unstyled">
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <p>{{ $setting->address }}</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-call"></span>
                                    </div>
                                    <p><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-envelope"></span>
                                    </div>
                                    <p><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</footer>
