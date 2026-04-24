<div class="top-bar-area bg-dark text-light">
    <div class="container">
        <div class="row align-center">
            <div class="col-xl-7 col-lg-7 info">
                <div class="address-info">
                    <ul class="item-flex">
                        <li>
                            <a href="mailto:{{ $setting->email }}"><i class="fas fa-envelope-open-text"></i>
                                {{ $setting->email }}</a>
                        </li>
                        <li>
                            <a href="tel:{{ $setting->phone_no }}"><i class="fas fa-phone"></i>
                                {{ $setting->phone_no }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 text-end">
                <div class="d-flex">
                    <div class="social">
                        <ul class="item-flex">

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
                                <li><a href="{{ $setting->yt_link }}" target="_blank"><i class="fab fa-youtube"></i></a>
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
                </div>
            </div>
        </div>
    </div>
</div>
