

<?php
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
?>

<section class="about-one" aria-labelledby="about-heading">
    <div class="container">
        <div class="row align-items-center">

            
            <div class="col-12 col-lg-6">
                <div class="about-one__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="1800ms">
                    <div class="about-one__img-box">
                        <div class="about-one__img">
                            <img src="<?php echo e($imageSrc); ?>"
                                 alt="<?php echo e($isEN ? 'StepNow Rides & Movers vehicle' : 'StepNow Rides & Movers Fahrzeug'); ?>"
                                 loading="lazy"
                                 decoding="async"
                                 width="600" height="700">
                        </div>

                        
                        <div class="about-one__shape-2 float-bob-y" aria-hidden="true">
                            <img src="<?php echo e(asset('front/assets/images/shapes/about-one-shape-2.png')); ?>"
                                 alt=""
                                 loading="lazy"
                                 width="120" height="120">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 col-lg-6">
                <div class="about-one__right">

                    <div class="section-title text-left sec-title-animation animation-style1">
                        <?php if($title): ?>
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline"><?php echo e($title); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($subtitle): ?>
                            <h2 id="about-heading" class="section-title__title title-animation"><?php echo e($subtitle); ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php if($desc2Safe): ?>
                        <div class="about-one__text-1 sn-prose">
                            <?php echo $desc2Safe; ?>

                        </div>
                    <?php endif; ?>

                    <?php if($desc1Safe): ?>
                        <div class="about-one__text-2 sn-prose mt-3">
                            <?php echo $desc1Safe; ?>

                        </div>
                    <?php endif; ?>

                    <div class="about-one__btn-box-and-call-box mt-4 d-flex flex-wrap align-items-center">

                        <div class="about-one__btn-box me-3 mb-2">
                            <a href="<?php echo e(lroute('front.about')); ?>" class="about-one__btn thm-btn">
                                <?php echo e($ctaLabel); ?>

                                <span class="fas fa-arrow-right" aria-hidden="true"></span>
                            </a>
                        </div>

                        <div class="about-one__call-box mb-2">
                            <div class="about-one__call-box-icon" aria-hidden="true">
                                <span class="icon-call-2"></span>
                            </div>
                            <div class="about-one__call-box-content">
                                <p class="mb-0"><?php echo e(__('Call anytime')); ?></p>
                                <h4 class="mb-0">
                                    <a href="tel:<?php echo e($phoneE164); ?>" aria-label="<?php echo e($isEN ? 'Call' : 'Anrufen'); ?> <?php echo e($phoneRaw); ?>">
                                        <?php echo e($phoneRaw); ?>

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
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/about-us/about-2.blade.php ENDPATH**/ ?>