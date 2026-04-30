<section class="about-one">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="about-one__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="about-one__img-box">
                        <div class="about-one__img">
                            <img src="{{ asset($about_us->image1) }}" alt="About Us">
                        </div>
                        <div class="about-one__shape-2 float-bob-y">
                            <img src="{{ asset('front/assets/images/shapes/about-one-shape-2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-one__right">
                    <div class="section-title text-left sec-title-animation animation-style1">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">{{ tr($about_us, 'title') }}</span>
                        </div>
                        <h2 class="section-title__title title-animation">{!! tr($about_us, 'subtitle') !!}</h2>
                    </div>
                    @if(tr($about_us, 'description2'))
                        <p class="about-one__text-1">{!! tr($about_us, 'description2') !!}</p>
                    @endif
                    <p class="about-one__text-2">{!! tr($about_us, 'description') !!}</p>

                    <div class="about-one__btn-box-and-call-box">
                        <div class="about-one__btn-box">
                            <a href="{{ route('front.about') }}" class="about-one__btn thm-btn">
                                {{ __('Read More') }}<span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                        <div class="about-one__call-box">
                            <div class="about-one__call-box-icon">
                                <span class="icon-call-2"></span>
                            </div>
                            <div class="about-one__call-box-content">
                                <p>{{ __('Call anytime') }}</p>
                                <h4><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
