@if ($testimonial)
    <div class="testimonials-page">
        <div class="container">

            <div class="section-title text-left sec-title-animation animation-style2">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">
                        {{ tr($testimonial, 'title') ?? __('Our Testimonial') }}
                    </span>
                </div>

                <h2 class="section-title__title title-animation">
                    {{ tr($testimonial, 'subtitle') ?? __('What People Say About Us') }}
                </h2>
            </div>

            <div class="testimonial-one__carousel owl-theme owl-carousel">

                @foreach ($testimonial->details as $detail)
                    <div class="item">
                        <div class="testimonial-one__single">

                            <div class="testimonial-one__client-info">

                                <div class="testimonial-one__img">
                                    <img src="{{ asset('storage/testimonial_details/' . $detail->image) }}" alt="">
                                </div>

                                <div class="testimonial-one__content">
                                    <h4 class="testimonial-one__client-name">
                                        <a href="javascript:void(0)">{{ $detail->name }}</a>
                                    </h4>

                                    <p class="testimonial-one__sub-title">
                                        {{ tr($detail, 'designation') ?? __('Customer') }}
                                    </p>
                                </div>
                            </div>

                            <p class="testimonial-one__text">
                                {!! tr($detail, 'feedback') !!}
                            </p>

                            @if ($detail->rating)
                                <div class="testimonial-one__rating">
                                    @for ($i = 1; $i <= $detail->rating; $i++)
                                        <span class="icon-star"></span>
                                    @endfor
                                </div>
                            @endif

                            <div class="testimonial-one__quote">
                                <span class="icon-quote"></span>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endif
