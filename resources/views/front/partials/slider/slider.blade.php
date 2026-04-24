 <!-- Main Slider Start -->
        <section class="main-slider">
    <div class="main-slider__carousel owl-carousel owl-theme">

        @foreach($sliders as $slider)
            <div class="item">
                <div class="main-slider__bg"
                    style="background-image: url({{ asset($slider->image) }});">
                </div>

                <div class="container">
                    <div class="main-slider__content">

                       

                        @if($slider->title)
                            <h2 class="main-slider__title">
                                {!! $slider->title !!}
                            </h2>
                        @endif
                        @if($slider->sub_title)
                            <div class="main-slider__sub-title-box mt-3 ">
                                <p class="main-slider__sub-title ">
                                    {!! $slider->sub_title !!}
                                </p>
                            </div>
                        @endif

                        {{-- @if($slider->small_sub_title)
                            <p class="main-slider__sub-title-two">
                                {!! $slider->small_sub_title !!}
                            </p>
                        @endif --}}

                        <div class="main-slider__btn-and-video-box">

                            {{-- CTA BUTTON --}}
                            @if ($slider->button_title || $slider->button_url)
                                <div class="main-slider__btn-box">
                                    <a href="{{ $slider->button_url ?? '#' }}" class="thm-btn">
                                        {{ $slider->button_title ?? 'Read More' }}
                                        <span class="fas fa-arrow-right"></span>
                                    </a>
                                </div>
                            @endif

                            {{-- VIDEO LINK (IF EXISTS) --}}
                            @if ($slider->video_url)
                                <div class="main-slider__video-link">
                                    <a href="{{ $slider->video_url }}" class="video-popup">
                                        <div class="main-slider__video-icon">
                                            <span class="icon-play-2"></span>
                                            <i class="ripple"></i>
                                        </div>
                                    </a>
                                    <h4 class="main-slider__video-title">Watch Video</h4>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>

        <!--Main Slider Start -->