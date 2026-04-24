      <!-- Faq Two Start -->
        @if($faq)
<section class="faq-two">
    <div class="faq-two__shape-1"></div>
    <div class="faq-two__shape-2"></div>
    <div class="container">

        {{-- Section Title --}}
        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box justify-content-center">
                {{-- <div class="section-title__tagline-shape">
                    <img src="{{ asset('front/assets/images/shapes/section-title-tagline-shape-1.png') }}" alt="">
                </div> --}}
                <span class="section-title__tagline">
                    {{ $faq->subtitle }}
                </span>
            </div>

            <h2 class="section-title__title title-animation">
                {{ $faq->title }}
            </h2>

            @if($faq->description)
                <p class="disc text-center">
                    {!! $faq->description !!}
                </p>
            @endif
        </div>

        {{-- Accordion --}}
        <div class="faq-two__inner-content">
            <div class="accrodion-grp" data-grp-name="faq-one-accrodion">

                @foreach($faq->details as $index => $detail)
                    @php
                        $isActive = $index === 0 ? 'active' : '';
                        $wowDelay = ($index * 100) . 'ms';
                        $wowDirection = $index % 2 === 0 ? 'fadeInLeft' : 'fadeInRight';
                    @endphp

                    <div class="accrodion {{ $isActive }} wow {{ $wowDirection }}"
                        data-wow-delay="{{ $wowDelay }}" data-wow-duration="1500ms">

                        <div class="accrodion-title">
                            <h4>{{ $detail->question }}</h4>
                        </div>

                        <div class="accrodion-content">
                            <div class="inner">
                                {!! $detail->answer !!}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
@endif
