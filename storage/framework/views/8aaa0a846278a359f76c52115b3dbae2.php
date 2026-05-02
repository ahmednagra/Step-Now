

<?php
    use Illuminate\Support\HtmlString;

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

    /* ------------------------------------------------------------------
     | sn_normalise_slider_title($raw)
     |
     | The DB currently has rows where the title contains the LITERAL
     | two-character sequence "\n" (backslash followed by lowercase n)
     | instead of a real newline byte (0x0A). This happens when a seeder
     | uses single-quoted PHP strings or when an admin pastes "\n" as
     | text. We normalise those literal sequences to real newlines BEFORE
     | the renderer sees them, so the smart parser below can apply its
     | line-break rule.
     |
     | We deliberately do NOT try to be clever about "literal backslash
     | + n" inside actual prose (that would be ambiguous) — we only
     | normalise sequences that are very likely intended as line breaks
     | in slider titles (which are short, single-purpose strings).
     ------------------------------------------------------------------ */
    if (!function_exists('sn_normalise_slider_title')) {
        function sn_normalise_slider_title(string $raw): string
        {
            // Convert literal "\r\n", "\n", "\r" sequences (2-char strings)
            // into real newlines. These are exactly the sequences a buggy
            // seeder run can leave in the DB.
            $raw = str_replace(['\\r\\n', '\\n', '\\r'], "\n", $raw);
            // Collapse multiple newlines down to one.
            $raw = preg_replace("/\n+/", "\n", $raw);
            return $raw;
        }
    }

    /* ------------------------------------------------------------------
     | sn_render_slider_title($raw)
     |
     | XSS-safe formatter for slider titles. Returns an HtmlString so
     | {!! !!} can render it without re-escaping, but EVERY user-provided
     | fragment is run through e() before insertion. The only HTML this
     | function ever emits is <span class="sn-hl"> and <br> — both are
     | hard-coded.
     |
     | Recognised input patterns (in priority order):
     |
     |   1. Legacy seeded markup:
     |        "<span class='in'>X</span><br> - Y"
     |        "<span class=\"in\">X</span><br/>Y"
     |      → <span class="sn-hl">{escaped X}</span><br>{escaped Y}
     |
     |   2. Shortcode for new entries:
     |        "[hl]X[/hl] - Y"
     |        "[hl]X[/hl]\n- Y"
     |      → <span class="sn-hl">{escaped X}</span> - Y   (or with <br>)
     |
     |   3. Real newlines:
     |        "X\n- Y"
     |      → {escaped X}<br>{escaped Y}
     |
     |   4. Plain text:
     |      → fully escaped, no markup at all.
     |
     | Anything else is just escaped. There is NO path where untrusted
     | HTML reaches the DOM.
     ------------------------------------------------------------------ */
    if (!function_exists('sn_render_slider_title')) {
        function sn_render_slider_title(string $raw): \Illuminate\Support\HtmlString
        {
            $raw = trim($raw);
            if ($raw === '') {
                return new \Illuminate\Support\HtmlString('');
            }

            /* ---- Pattern 1: legacy <span class='in'>...</span><br>... ---- */
            $legacy = '/^\s*<span\s+class\s*=\s*[\'"]in[\'"]\s*>(.*?)<\/span>\s*<br\s*\/?>\s*-?\s*(.*)$/is';
            if (preg_match($legacy, $raw, $m)) {
                $hl   = e(trim(strip_tags($m[1])));
                $rest = e(trim(strip_tags($m[2])));
                $html = '<span class="sn-hl">' . $hl . '</span>';
                if ($rest !== '') {
                    $html .= '<br>' . $rest;
                }
                return new \Illuminate\Support\HtmlString($html);
            }

            /* ---- Pattern 2: shortcode [hl]...[/hl] (with optional newlines) ---- */
            if (preg_match('/\[hl\](.*?)\[\/hl\]/s', $raw)) {
                // Escape EVERYTHING first.
                $escaped = e($raw);
                // Then convert real newlines to <br>.
                $escaped = nl2br($escaped, false);
                // Finally swap the (escaped) shortcode markers for our
                // trusted span. Because we escaped first, the inner
                // content is already safe.
                $rendered = preg_replace_callback(
                    '/\[hl\](.*?)\[\/hl\]/s',
                    function ($m) { return '<span class="sn-hl">' . $m[1] . '</span>'; },
                    $escaped
                );
                return new \Illuminate\Support\HtmlString($rendered);
            }

            /* ---- Pattern 3: plain text with real newlines ---- */
            if (str_contains($raw, "\n") || str_contains($raw, "\r")) {
                return new \Illuminate\Support\HtmlString(nl2br(e($raw), false));
            }

            /* ---- Pattern 4: pure plain text (or unrecognised HTML) ---- */
            return new \Illuminate\Support\HtmlString(e(trim(strip_tags($raw))));
        }
    }
?>

<section class="main-slider"
         aria-roledescription="carousel"
         aria-label="<?php echo e($isEN ? 'Featured services' : 'Ausgewählte Leistungen'); ?>">

    <?php if($hasSliders): ?>
        <div class="main-slider__carousel owl-carousel owl-theme"
             data-sn-carousel="hero"
             data-sn-total="<?php echo e($totalSlides); ?>">

            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isFirst   = $loop->first;
                    $imgPath   = $slider->image ? asset($slider->image) : asset('front/assets/images/hero-placeholder.jpg');

                    /* Read translated values via tr() if available, else raw column */
                    $titleRaw  = trim((string) (function_exists('tr') ? tr($slider, 'title') : ($slider->title ?? '')));
                    $subTitle  = trim((string) (function_exists('tr') ? tr($slider, 'sub_title') : ($slider->sub_title ?? '')));
                    $btnTitle  = trim((string) (function_exists('tr') ? tr($slider, 'button_title') : ($slider->button_title ?? '')));

                    /* Wave 5c: normalise literal "\n" before the renderer sees it */
                    $titleRaw  = sn_normalise_slider_title($titleRaw);

                    /* Render-ready title (HtmlString — safe, see helper above) */
                    $titleHtml  = sn_render_slider_title($titleRaw);

                    /* Plain-text version of title for alt= and aria-label */
                    $titlePlain = trim(strip_tags((string) $titleHtml));

                    $btnUrl    = $slider->button_url ?: '#';
                    $videoUrl  = $slider->video_url ?? null;
                    $altText   = $titlePlain ?: 'StepNow Rides & Movers';
                ?>

                <div class="item"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="<?php echo e(($i + 1) . ' / ' . $totalSlides); ?>">

                    
                    <img class="main-slider__bg-img"
                         src="<?php echo e($imgPath); ?>"
                         alt="<?php echo e($altText); ?>"
                         width="1920" height="720"
                         loading="<?php echo e($isFirst ? 'eager' : 'lazy'); ?>"
                         decoding="<?php echo e($isFirst ? 'sync' : 'async'); ?>"
                         <?php if($isFirst): ?> fetchpriority="high" <?php endif; ?>>

                    
                    <div class="main-slider__bg" aria-hidden="true"
                         style="background-image: url(<?php echo e($imgPath); ?>);"></div>

                    <div class="container">
                        <div class="main-slider__content">

                            <?php if($titlePlain !== ''): ?>
                                
                                <h2 class="main-slider__title"><?php echo $titleHtml; ?></h2>
                            <?php endif; ?>

                            <?php if($subTitle !== ''): ?>
                                <div class="main-slider__sub-title-box mt-3">
                                    <p class="main-slider__sub-title"><?php echo e($subTitle); ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="main-slider__btn-and-video-box mt-4">

                                <div class="main-slider__btn-box">
                                    <a href="<?php echo e($btnUrl); ?>" class="thm-btn">
                                        <?php echo e($btnTitle ?: $defaultCta); ?>

                                        <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                    </a>
                                </div>

                                <?php if($videoUrl): ?>
                                    <div class="main-slider__video-link">
                                        <a href="<?php echo e($videoUrl); ?>"
                                           class="video-popup"
                                           aria-label="<?php echo e($watchVideo); ?>">
                                            <span class="main-slider__video-icon" aria-hidden="true">
                                                <span class="icon-play-2"></span>
                                                <i class="ripple"></i>
                                            </span>
                                            <span class="main-slider__video-title"><?php echo e($watchVideo); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <button type="button"
                class="main-slider__pause"
                data-sn-carousel-pause
                aria-pressed="false"
                aria-label="<?php echo e($pauseLabel); ?>"
                data-label-pause="<?php echo e($pauseLabel); ?>"
                data-label-play="<?php echo e($playLabel); ?>">
            <i class="fas fa-pause" aria-hidden="true"></i>
        </button>

    <?php else: ?>
        
        <div class="container">
            <div class="main-slider__content">
                <h2 class="main-slider__title">
                    <?php echo e($isEN ? 'Hire-car · Passenger transport · Parcel service' : 'Mietwagen · Personenbeförderung · Paketdienst'); ?>

                </h2>
                <p class="main-slider__sub-title mt-3">
                    <?php echo e($isEN
                        ? 'Reliable, regional, transparent pricing. Deizisau and the Esslingen / Stuttgart region.'
                        : 'Zuverlässig, regional, transparente Preise. Deizisau und die Region Esslingen / Stuttgart.'); ?>

                </p>
                <div class="mt-4">
                    <a href="<?php echo e(lroute('front.contactus')); ?>" class="thm-btn">
                        <?php echo e($defaultCta); ?>

                        <span class="fas fa-arrow-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>

<?php $__env->startPush('scripts'); ?>
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

    /* Wave 5b: brand-accent highlight for [hl]…[/hl] in titles */
    .main-slider__title .sn-hl {
        position: relative;
        color: inherit;
        white-space: nowrap;
    }
    .main-slider__title .sn-hl::after {
        content: "";
        position: absolute;
        left: 0; right: 0; bottom: -.05em;
        height: .12em;
        background: #ffc107;
        border-radius: 2px;
        z-index: -1;
        opacity: .85;
    }

    /* Empty-state hero gets a brand-tinted background so it's not a blank box */
    .main-slider:not(:has(.main-slider__carousel)) {
        background: linear-gradient(135deg, var(--sn-primary-700) 0%, var(--sn-primary) 100%);
        color: #fff;
        padding: var(--sn-section-y) 0;
    }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__title { color: #fff; }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__sub-title { color: rgba(255,255,255,0.92); }
</style>
<?php $__env->stopPush(); ?><?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/slider/slider.blade.php ENDPATH**/ ?>