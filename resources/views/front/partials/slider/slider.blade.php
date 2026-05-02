{{-- ============================================================================
     Hero slider

     Wave 2B revisions:
       • LCP optimization: first slide gets <img loading="eager"
         fetchpriority="high"> — the rest are lazy-loaded
       • Background image moved from inline style to a <picture><img> so
         screen readers can announce alt text and the browser can preload
       • XSS-safe: titles rendered via {{ }} (escaped). HTML is not allowed
         in DB-managed slider titles — admin form should use plain text.
       • Pause/play control with aria-pressed for WCAG 2.2.2 (auto-play
         with pause requirement)
       • aria-roledescription="carousel" on the carousel container
       • aria-label per slide with index/total
       • CTA fallback now reads "Book Now" / "Jetzt buchen" instead of
         the meaningless "Read More"
       • prefers-reduced-motion respected — see custom-tokens.css
       • Fluid typography via custom-tokens.css; no more !important
       • Empty-state if no published sliders (renders a minimal hero)
============================================================================= --}}

@php
    $locale       = app()->getLocale();
    $isEN         = $locale === 'en';
    $sliders      = $sliders ?? collect();
    $hasSliders   = $sliders->count() > 0;
    $totalSlides  = $sliders->count();
    $defaultCta   = $isEN ? 'Book Now' : 'Jetzt buchen';
    $watchVideo   = $isEN ? 'Watch video' : 'Video ansehen';
    $pauseLabel   = $isEN ? 'Pause carousel' : 'Karussell pausieren';
    $playLabel    = $isEN ? 'Play carousel'  : 'Karussell abspielen';
    $prevLabel    = $isEN ? 'Previous slide' : 'Vorherige Folie';
    $nextLabel    = $isEN ? 'Next slide'     : 'Nächste Folie';
@endphp

<section class="main-slider"
         aria-roledescription="carousel"
         aria-label="{{ $isEN ? 'Featured services' : 'Ausgewählte Leistungen' }}">

    @if ($hasSliders)
        <div class="main-slider__carousel owl-carousel owl-theme"
             data-sn-carousel="hero"
             data-sn-total="{{ $totalSlides }}">

            @foreach ($sliders as $i => $slider)
                @php
                    $isFirst   = $loop->first;
                    $imgPath   = $slider->image ? asset($slider->image) : asset('front/assets/images/hero-placeholder.jpg');
                    $title     = trim((string) tr($slider, 'title'));
                    $subTitle  = trim((string) tr($slider, 'sub_title'));
                    $btnTitle  = trim((string) tr($slider, 'button_title'));
                    $btnUrl    = $slider->button_url ?: '#';
                    $videoUrl  = $slider->video_url ?: null;
                    $altText   = $title ?: ($isEN ? 'StepNow Rides & Movers' : 'StepNow Rides & Movers');
                @endphp

                <div class="item"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="{{ ($i + 1) . ' / ' . $totalSlides }}">

                    {{-- Background image as a real <img> for a11y + LCP preload --}}
                    <img class="main-slider__bg-img"
                         src="{{ $imgPath }}"
                         alt="{{ $altText }}"
                         width="1920" height="720"
                         loading="{{ $isFirst ? 'eager' : 'lazy' }}"
                         decoding="{{ $isFirst ? 'sync' : 'async' }}"
                         @if($isFirst) fetchpriority="high" @endif>

                    {{-- Visual overlay (kept for legibility against bg) --}}
                    <div class="main-slider__bg" aria-hidden="true"
                         style="background-image: url({{ $imgPath }});"></div>

                    <div class="container">
                        <div class="main-slider__content">

                            @if ($title)
                                <h2 class="main-slider__title">{{ $title }}</h2>
                            @endif

                            @if ($subTitle)
                                <div class="main-slider__sub-title-box mt-3">
                                    <p class="main-slider__sub-title">{{ $subTitle }}</p>
                                </div>
                            @endif

                            <div class="main-slider__btn-and-video-box mt-4">

                                <div class="main-slider__btn-box">
                                    <a href="{{ $btnUrl }}" class="thm-btn">
                                        {{ $btnTitle ?: $defaultCta }}
                                        <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                    </a>
                                </div>

                                @if ($videoUrl)
                                    <div class="main-slider__video-link">
                                        <a href="{{ $videoUrl }}"
                                           class="video-popup"
                                           aria-label="{{ $watchVideo }}">
                                            <span class="main-slider__video-icon" aria-hidden="true">
                                                <span class="icon-play-2"></span>
                                                <i class="ripple"></i>
                                            </span>
                                            <span class="main-slider__video-title">{{ $watchVideo }}</span>
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Carousel pause/play (WCAG 2.2.2) — JS toggles owl autoplay --}}
        <button type="button"
                class="main-slider__pause"
                data-sn-carousel-pause
                aria-pressed="false"
                aria-label="{{ $pauseLabel }}"
                data-label-pause="{{ $pauseLabel }}"
                data-label-play="{{ $playLabel }}">
            <i class="fas fa-pause" aria-hidden="true"></i>
        </button>

    @else
        {{-- Empty state — site renders even with no sliders configured --}}
        <div class="container">
            <div class="main-slider__content">
                <h2 class="main-slider__title">
                    {{ $isEN ? 'Hire-car · Passenger transport · Parcel service' : 'Mietwagen · Personenbeförderung · Paketdienst' }}
                </h2>
                <p class="main-slider__sub-title mt-3">
                    {{ $isEN
                        ? 'Reliable, regional, transparent pricing. Deizisau and the Esslingen / Stuttgart region.'
                        : 'Zuverlässig, regional, transparente Preise. Deizisau und die Region Esslingen / Stuttgart.' }}
                </p>
                <div class="mt-4">
                    <a href="{{ lroute('front.contactus') }}" class="thm-btn">
                        {{ $defaultCta }}
                        <span class="fas fa-arrow-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    @endif

</section>

@push('scripts')
<script>
    /* Owl-carousel pause toggle (only attached when a hero slider is on the page) */
    (function () {
        var pauseBtn = document.querySelector('[data-sn-carousel-pause]');
        var carousel = document.querySelector('[data-sn-carousel="hero"]');
        if (!pauseBtn || !carousel || typeof jQuery === 'undefined') return;

        var $car = jQuery(carousel);
        var paused = false;

        pauseBtn.addEventListener('click', function () {
            paused = !paused;
            if (paused) {
                $car.trigger('stop.owl.autoplay');
                pauseBtn.setAttribute('aria-pressed', 'true');
                pauseBtn.setAttribute('aria-label', pauseBtn.dataset.labelPlay);
                pauseBtn.querySelector('i').className = 'fas fa-play';
            } else {
                $car.trigger('play.owl.autoplay');
                pauseBtn.setAttribute('aria-pressed', 'false');
                pauseBtn.setAttribute('aria-label', pauseBtn.dataset.labelPause);
                pauseBtn.querySelector('i').className = 'fas fa-pause';
            }
        });

        /* Honor prefers-reduced-motion: stop autoplay immediately */
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            $car.trigger('stop.owl.autoplay');
            pauseBtn.click(); // sync the button state
        }
    })();
</script>
<style>
    /* Slider-specific helpers (kept here so they ship with the carousel) */
    .main-slider { position: relative; overflow: hidden; }
    .main-slider .item { position: relative; }
    .main-slider__bg-img {
        position: absolute; inset: 0;
        width: 100%; height: 100%;
        object-fit: cover; object-position: center center;
        z-index: 0;
    }
    .main-slider__bg {
        position: absolute; inset: 0;
        background-color: rgba(14, 26, 43, 0.45);  /* ink overlay for legibility */
        background-blend-mode: multiply;
        z-index: 1;
    }
    .main-slider__content { position: relative; z-index: 2; color: #fff; }
    .main-slider__title { color: #fff; }
    .main-slider__sub-title { color: rgba(255, 255, 255, 0.92); }
    .main-slider__btn-and-video-box {
        display: flex; flex-wrap: wrap; gap: var(--sn-space-4); align-items: center;
    }
    .main-slider__video-link a {
        display: inline-flex; align-items: center; gap: var(--sn-space-3);
        color: #fff;
    }
    .main-slider__video-icon {
        width: 48px; height: 48px; border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        display: inline-flex; align-items: center; justify-content: center;
        position: relative;
    }
    .main-slider__pause {
        position: absolute; bottom: 24px; right: 24px;
        width: 44px; height: 44px; border-radius: 50%;
        background: rgba(0, 0, 0, 0.4); color: #fff;
        border: 0; cursor: pointer;
        z-index: 5;
        transition: background var(--sn-duration-2) var(--sn-ease);
    }
    .main-slider__pause:hover { background: rgba(0, 0, 0, 0.65); }
    .main-slider__pause:focus-visible { outline: 3px solid var(--sn-accent); outline-offset: 2px; }

    /* Empty-state hero gets a brand-tinted background so it's not a blank box */
    .main-slider:not(:has(.main-slider__carousel)) {
        background: linear-gradient(135deg, var(--sn-primary-700) 0%, var(--sn-primary) 100%);
        color: #fff;
        padding: var(--sn-section-y) 0;
    }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__title { color: #fff; }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__sub-title { color: rgba(255,255,255,0.92); }
</style>
@endpush
