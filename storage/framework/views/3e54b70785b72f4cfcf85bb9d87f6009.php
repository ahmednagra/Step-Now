

<?php
    if (!isset($why_choose_us) || !$why_choose_us) return;

    $details = $why_choose_us->details ?? collect();
    $isEN    = app()->getLocale() === 'en';

    $sectionTitle    = trim((string) tr($why_choose_us, 'title'));
    $sectionTagline  = trim((string) tr($why_choose_us, 'subtitle'));
    $sectionDesc     = trim((string) tr($why_choose_us, 'description'));
?>

<section class="why-choose-one mt-5" aria-labelledby="why-choose-heading">
    <div class="why-choose-one__shape-1" aria-hidden="true"></div>
    <div class="why-choose-one__shape-2" aria-hidden="true"></div>

    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style2 mb-5">
            <?php if($sectionTagline): ?>
                <div class="section-title__tagline-box justify-content-center">
                    <span class="section-title__tagline"><?php echo e($sectionTagline); ?></span>
                </div>
            <?php endif; ?>

            <?php if($sectionTitle): ?>
                <h2 id="why-choose-heading" class="section-title__title title-animation">
                    <?php echo e($sectionTitle); ?>

                </h2>
            <?php endif; ?>

            <?php if($sectionDesc): ?>
                <p class="sn-prose mx-auto mt-3">
                    <?php echo e(strip_tags($sectionDesc)); ?>

                </p>
            <?php endif; ?>
        </div>

        <?php if($details->count() > 0): ?>
            <ul class="row g-4 list-unstyled justify-content-center sn-why-list" role="list">
                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        /* Cycle through 3 animation directions — works for any card count */
                        $animations = ['fadeInLeft', 'fadeInUp', 'fadeInRight'];
                        $animationClass = $animations[$index % 3];
                        $delay = (($index % 3) * 200 + 100) . 'ms';

                        $title    = trim((string) tr($detail, 'title'));
                        $desc     = trim((string) strip_tags(tr($detail, 'description')));
                        $hasIcon  = !empty($detail->icon);
                    ?>

                    <li class="col-12 col-sm-6 col-lg-4 wow <?php echo e($animationClass); ?>"
                        data-wow-delay="<?php echo e($delay); ?>"
                        data-wow-duration="1500ms"
                        role="listitem">

                        <article class="why-choose-one__single h-100 sn-why-card">

                            <div class="why-choose-one__icon">
                                <?php if($hasIcon): ?>
                                    <img src="<?php echo e(asset($detail->icon)); ?>"
                                         alt=""
                                         aria-hidden="true"
                                         loading="lazy"
                                         decoding="async"
                                         width="50" height="50">
                                <?php else: ?>
                                    <span class="sn-why-icon-fallback" aria-hidden="true">
                                        <i class="fas fa-shield-alt"></i>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="why-choose-one__single-inner">
                                <?php if($title): ?>
                                    <h3 class="why-choose-one__title"><?php echo e($title); ?></h3>
                                <?php endif; ?>

                                <?php if($desc): ?>
                                    <p class="why-choose-one__text sn-line-clamp-4">
                                        <?php echo e($desc); ?>

                                    </p>
                                <?php endif; ?>
                            </div>
                        </article>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            
            <div class="text-center mt-5">
                <a href="<?php echo e(lroute('front.contactus')); ?>" class="thm-btn thm-btn--lg">
                    <?php echo e($isEN ? 'Get a free quote' : 'Kostenloses Angebot anfordern'); ?>

                    <span class="fas fa-arrow-right" aria-hidden="true"></span>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<style>
    /* Wave 3 polish on top of theme why-choose-one styles */
    .sn-why-card {
        transition:
            transform var(--sn-duration-3) var(--sn-ease),
            box-shadow var(--sn-duration-3) var(--sn-ease);
    }
    .sn-why-card:hover {
        transform: translateY(-4px);
    }

    .sn-why-icon-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--sn-accent-100);
        color: var(--sn-accent-700);
        font-size: 22px;
    }

    .sn-line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Bottom CTA gets a touch of breathing room from the cards */
    .why-choose-one .thm-btn--lg { box-shadow: var(--sn-shadow-md); }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/why-choose-us/why-choose-us-1.blade.php ENDPATH**/ ?>