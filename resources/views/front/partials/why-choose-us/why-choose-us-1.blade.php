@if ($why_choose_us)
   <section class="why-choose-one mt-5">
    <div class="why-choose-one__shape-1"></div>
    <div class="why-choose-one__shape-2"></div>
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style2">
            <div class="section-title__tagline-box justify-content-center">
                <div class="section-title__tagline-shape">
                    <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}" alt="">
                </div>
                <span class="section-title__tagline">{{ $why_choose_us->subtitle }}</span>
            </div>
            <h2 class="section-title__title title-animation">{{ $why_choose_us->title }}</h2>
        </div>
        <div class="row">
            @foreach ($why_choose_us->details as $index => $detail)
                @php
                    // Set animation classes based on index
                    $animationClass = '';
                    $delay = '';
                    
                    if($index == 0) {
                        $animationClass = 'fadeInLeft';
                        $delay = '100ms';
                    } elseif($index == 1) {
                        $animationClass = 'fadeInUp';
                        $delay = '300ms';
                    } else {
                        $animationClass = 'fadeInRight';
                        $delay = '500ms';
                    }
                @endphp
                
                <!-- Why Choose One Single Start -->
                <div class="col-xl-4 col-lg-6 col-md-6 wow {{ $animationClass }}" data-wow-delay="{{ $delay }}" data-wow-duration="1500ms">
                    <div class="why-choose-one__single">
                        <div class="why-choose-one__icon">
                            <img src="{{ asset($detail->icon) }}" alt="{{ $detail->title }}" width="50px">
                        </div>
                        <div class="why-choose-one__single-inner">
                            <h3 class="why-choose-one__title">{{ $detail->title }}</h3>
                            <p class="why-choose-one__text">
                                {{ $detail->description }}
                            </p>
                        </div>
                        <div class="why-choose-one__btn-box">
                            <a href="{{ route('front.contactus') }}" class="thm-btn">Get Quote<span class="fas fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <!-- Why Choose One Single End -->
            @endforeach
        </div>
    </div>
</section> 
@endif