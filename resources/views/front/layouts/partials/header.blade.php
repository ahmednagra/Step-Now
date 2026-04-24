<header class="main-header">
    <div class="main-menu__top">
        <div class="main-menu__top-inner">
            <ul class="list-unstyled main-menu__contact-list">
                <li>
                    <div class="icon">
                        <i class="icon-call-2"></i>
                    </div>
                    <div class="text">
                        <p><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="icon">
                        <i class="icon-envelope-2"></i>
                    </div>
                    <div class="text">
                        <p><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        </p>
                    </div>
                </li>
            </ul>
            <div class="main-menu__top-right">
                <div class="main-menu__top-login-reg-box">
                    <a href="{{ route('login') }}">Anmelden</a>
                </div>
                <div class="main-menu__social">

                    @if (!empty($setting->fb_link))
                        <a href="{{ $setting->fb_link }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (!empty($setting->insta_link))
                        <a href="{{ $setting->insta_link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (!empty($setting->yt_link))
                        <a href="{{ $setting->yt_link }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if (!empty($setting->tiktok_link))
                        <li><a href="{{ $setting->tiktok_link }}" target="_blank"> <i class="bi bi-tiktok"></i></a>
                    @endif
                    @if (!empty($setting->linkedin_link))
                        <a href="{{ $setting->linkedin_link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ route('front.index') }}"><img src="{{ asset($setting->logo) }}"
                                width="200px"></a>
                    </div>
                </div>
                <div class="main-menu__middle-box">
                    <div class="main-menu__main-menu-box">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        <ul class="main-menu__list">
                            <li>
                                <a href="{{ route('front.index') }}">Startseite</a>
                            </li>
                            <li>
                                <a href="{{ route('front.about') }}">Über uns</a>
                            </li>
                            <li>
                                <a href="{{ route('front.services') }}">Dienstleistungen</a>
                            </li>
                            <li>
                                <a href="{{ route('front.pricing') }}">Preise</a>
                            </li>
                            <li>
                                <a href="{{ route('front.contactus') }}">Kontakt</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon">
                            <i class="icon-call-3"></i>
                        </div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title">Jederzeit anrufen</p>
                            <h5 class="main-menu__call-number"><a
                                    href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a>
                            </h5>
                        </div>
                    </div>
                    <div class="main-menu__nav-sidebar-icon">
                        <a class="navSidebar-button" href="#">
                            <span class="icon-dots-menu-one"></span>
                            <span class="icon-dots-menu-two"></span>
                            <span class="icon-dots-menu-three"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- /.mobile-nav__wrapper -->
</header>


<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->
