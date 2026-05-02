

<?php
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
                    $title     = trim((string) tr($slider, 'title'));
                    $subTitle  = trim((string) tr($slider, 'sub_title'));
                    $btnTitle  = trim((string) tr($slider, 'button_title'));
                    $btnUrl    = $slider->button_url ?: '#';
                    $videoUrl  = $slider->video_url ?: null;
                    $altText   = $title ?: ($isEN ? 'StepNow Rides & Movers' : 'StepNow Rides & Movers');
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

                            <?php if($title): ?>
                                <h2 class="main-slider__title"><?php echo e($title); ?></h2>
                            <?php endif; ?>

                            <?php if($subTitle): ?>
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

    /* Empty-state hero gets a brand-tinted background so it's not a blank box */
    .main-slider:not(:has(.main-slider__carousel)) {
        background: linear-gradient(135deg, var(--sn-primary-700) 0%, var(--sn-primary) 100%);
        color: #fff;
        padding: var(--sn-section-y) 0;
    }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__title { color: #fff; }
    .main-slider:not(:has(.main-slider__carousel)) .main-slider__sub-title { color: rgba(255,255,255,0.92); }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/slider/slider.blade.php ENDPATH**/ ?>