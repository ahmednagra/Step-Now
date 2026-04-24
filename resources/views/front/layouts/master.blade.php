<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') | Mini Car </title>

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
                        <li><a href="{{ $setting->fb_link }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                    @endif
                    @if (!empty($setting->insta_link))
                        <li><a href="{{ $setting->insta_link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                    @endif
                    @if (!empty($setting->yt_link))
                        <li><a href="{{ $setting->yt_link }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        </li>
                    @endif
                    @if (!empty($setting->tiktok_link))
                        <li><a href="{{ $setting->tiktok_link }}" target="_blank"> <i class="bi bi-tiktok"></i></a>
                        </li>
                    @endif
                    @if (!empty($setting->linkedin_link))
                        <li><a href="{{ $setting->linkedin_link }}" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>

    {{-- <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a> --}}

    @include('front.layouts.partials.scripts')

</body>

</html>
