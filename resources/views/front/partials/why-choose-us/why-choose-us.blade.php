<div class="rts-service-area mt--50 pt--50 pb--50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-style-five center">
                    <span class="pre">{{ $why_choose_us->subtitle }}</span>
                    <h2 class="title">{{ $why_choose_us->title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--10">
            @foreach ($why_choose_us->details as $detail)
                <div class="col-lg-4 col-md-6 col-sm-12" data-animation="fadeInUp" data-delay="0.0" data-duration="1.2"
                    style="transform: translate(0px, 0px); opacity: 1;">
                    <div class="service-single-main-wrapper-five">
                        <div class="icon">
                            <img src="{{ asset($detail->icon) }}" width="50px">
                        </div>
                        <div class="inner-content">
                            <a>
                                <h5 class="title">{{ $detail->title }}</h5>
                            </a>
                            <p class="disc">
                                {{ $detail->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
