<section class="about-one ">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-md-6">
                <div class="about-one__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="about-one__img-box">
                        <div class="about-one__img">
                            <img src="{{ asset($about_us->image1) }}" alt="About Us">
                        </div>
                        <div class="about-one__shape-2 float-bob-y">
                            <img src="{{ asset('front/assets/images/shapes/about-one-shape-2.png') }}" alt="">
                        </div>
                        {{-- <div class="about-one__img-2">
                            <img src="{{ asset($about_us->image2) }}" alt="About Us">
                        </div> --}}
                        
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-one__right">
                    <div class="section-title text-left sec-title-animation animation-style1">
                        <div class="section-title__tagline-box">
                            {{-- <div class="section-title__tagline-shape">
                                <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}"
                                    alt="">
                            </div> --}}
                            <span class="section-title__tagline">{{ $about_us->title }}</span>
                        </div>
                        <h2 class="section-title__title title-animation">{!! $about_us->subtitle !!}</h2>
                    </div>
                    <p class="about-one__text-1">{!! $about_us->description2 !!}</p>
                    <p class="about-one__text-2">{!! $about_us->description !!}</p>
                    
                    <div class="about-one__btn-box-and-call-box">
                        <div class="about-one__btn-box">
                            <a href="{{ route('front.about') }}" class="about-one__btn thm-btn">Mehr Lesen<span
                                    class="fas fa-arrow-right"></span></a>
                        </div>
                        <div class="about-one__call-box">
                            <div class="about-one__call-box-icon">
                                <span class="icon-call-2"></span>
                            </div>
                            <div class="about-one__call-box-content">
                                <p>Jederzeit anrufen</p>
                                <h4><a href="tel:{{ $setting->phone_no }}">{{ $setting->phone_no }}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
