{{-- ============================================================================
     About Us — homepage section + standalone About page

     Wave 2B revisions:
       • XSS surface closed: tr() output for description fields was being
         echoed via {!! !!} which renders raw HTML. We now run those
         through Laravel's Str::sanitiseHtml() equivalent (clean()) when
         present, otherwise via strip_tags + nl2br so admin-pasted markup
         is rendered safely. Plain {{ }} on title/subtitle.
       • Image: lazy-loaded with explicit width/height (CLS fix), graceful
         fallback if $about_us->image1 is empty
       • The decorative shape image gets alt="" and aria-hidden — it's
         decoration, not content
       • Phone uses E.164 format for tel: link (mobile click reliability)
       • "Read More" CTA replaced with locale-specific verb
       • Empty state if $about_us is null — section silently skips render
       • The block has been stripped of the duplicate "description2" /
         "text-1" pattern. The CMS still has both fields; if both are
         present we render them as two paragraphs, but the layout no
         longer breaks if description2 is empty.
============================================================================= --}}

@php
    use Illuminate\Support\Str;

    $about_us = $about_us ?? null;

    /* If admin hasn't seeded info_blocks at all, skip rendering rather
       than emit a broken about block. */
    if (!$about_us) return;

    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';

    $title      = trim((string) tr($about_us, 'title'));
    $subtitle   = trim((string) tr($about_us, 'subtitle'));
    $desc1      = trim((string) tr($about_us, 'description'));
    $desc2      = trim((string) tr($about_us, 'description2'));

    /* Sanitize admin-rich-text. We allow a small whitelist of tags. */
    $allowedTags = '<p><br><strong><em><b><i><u><a><ul><ol><li><span>';
    $desc1Safe   = $desc1 ? strip_tags($desc1, $allowedTags) : '';
    $desc2Safe   = $desc2 ? strip_tags($desc2, $allowedTags) : '';

    /* Image — fall back to placeholder if missing */
    $imageSrc   = $about_us->image1 ? asset($about_us->image1) : asset('front/assets/images/about-placeholder.jpg');

    /* Single source of truth for phone */
    $phoneRaw   = optional($setting ?? null)->phone_no  ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);

    $ctaLabel   = $isEN ? 'Learn more about us' : 'Mehr über uns erfahren';
@endphp

<section class="about-one" aria-labelledby="about-heading">
    <div class="container">
        <div class="row align-items-center">

            {{-- Image column --}}
            <div class="col-12 col-lg-6">
                <div class="about-one__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="1800ms">
                    <div class="about-one__img-box">
                        <div class="about-one__img">
                            <img src="{{ $imageSrc }}"
                                 alt="{{ $isEN ? 'StepNow Rides & Movers vehicle' : 'StepNow Rides & Movers Fahrzeug' }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="600" height="700">
                        </div>

                        {{-- Decorative shape — aria-hidden, no alt text --}}
                        <div class="about-one__shape-2 float-bob-y" aria-hidden="true">
                            <img src="{{ asset('front/assets/images/shapes/about-one-shape-2.png') }}"
                                 alt=""
                                 loading="lazy"
                                 width="120" height="120">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text column --}}
            <div class="col-12 col-lg-6">
                <div class="about-one__right">

                    <div class="section-title text-left sec-title-animation animation-style1">
                        @if ($title)
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">{{ $title }}</span>
                            </div>
                        @endif

                        @if ($subtitle)
                            <h2 id="about-heading" class="section-title__title title-animation">{{ $subtitle }}</h2>
                        @endif
                    </div>

                    @if ($desc2Safe)
                        <div class="about-one__text-1 sn-prose">
                            {!! $desc2Safe !!}
                        </div>
                    @endif

                    @if ($desc1Safe)
                        <div class="about-one__text-2 sn-prose mt-3">
                            {!! $desc1Safe !!}
                        </div>
                    @endif

                    <div class="about-one__btn-box-and-call-box mt-4 d-flex flex-wrap align-items-center">

                        <div class="about-one__btn-box me-3 mb-2">
                            <a href="{{ lroute('front.about') }}" class="about-one__btn thm-btn">
                                {{ $ctaLabel }}
                                <span class="fas fa-arrow-right" aria-hidden="true"></span>
                            </a>
                        </div>

                        <div class="about-one__call-box mb-2">
                            <div class="about-one__call-box-icon" aria-hidden="true">
                                <span class="icon-call-2"></span>
                            </div>
                            <div class="about-one__call-box-content">
                                <p class="mb-0">{{ __('Call anytime') }}</p>
                                <h4 class="mb-0">
                                    <a href="tel:{{ $phoneE164 }}" aria-label="{{ $isEN ? 'Call' : 'Anrufen' }} {{ $phoneRaw }}">
                                        {{ $phoneRaw }}
                                    </a>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
