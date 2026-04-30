<!-- Faq Two Start -->
@if($faq)
<section class="faq-two">
    <div class="faq-two__shape-1"></div>
    <div class="faq-two__shape-2"></div>
    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline">
                    {{ tr($faq, 'subtitle') }}
                </span>
            </div>

            <h2 class="section-title__title title-animation">
                {{ tr($faq, 'title') }}
            </h2>

            @if(tr($faq, 'description'))
                <p class="disc text-center">
                    {!! tr($faq, 'description') !!}
                </p>
            @endif
        </div>

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
                            <h4>{{ tr($detail, 'question') }}</h4>
                        </div>

                        <div class="accrodion-content">
                            <div class="inner">
                                {!! tr($detail, 'answer') !!}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
@endif
