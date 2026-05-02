

<?php
    if (!isset($testimonial) || !$testimonial) return;
    $details = $testimonial->details ?? collect();
    if ($details->isEmpty()) return;

    $isEN          = app()->getLocale() === 'en';
    $sectionTitle  = trim((string) (tr($testimonial, 'title')    ?: __('Our Testimonial')));
    $sectionSub    = trim((string) (tr($testimonial, 'subtitle') ?: __('What People Say About Us')));
    $totalSlides   = $details->count();

    /* Image-path resolver: try multiple locations, return first that
       looks valid. Empty string → use initials fallback in template. */
    $resolveImg = function ($detail) {
        if (empty($detail->image)) return '';
        $img = $detail->image;
        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) return $img;

        $candidates = [
            $img,                                                  // already a relative path
            'storage/testimonial_details/' . $img,                 // legacy
            'assets/admin/uploads/testimonial_details/' . $img,    // current admin convention
        ];
        foreach ($candidates as $rel) {
            if (file_exists(public_path($rel))) {
                return asset($rel);
            }
        }
        return asset($candidates[0]);  /* let the browser try the first; fallback handled by onerror */
    };

    /* Initials helper for the no-image fallback */
    $initials = function ($name) {
        $parts = preg_split('/\s+/', trim((string) $name));
        $initials = '';
        foreach ($parts as $p) {
            if (!empty($p)) $initials .= mb_strtoupper(mb_substr($p, 0, 1));
            if (mb_strlen($initials) >= 2) break;
        }
        return $initials ?: '?';
    };
?>

<section class="testimonials-page" aria-labelledby="testimonials-heading">
    <div class="container">

        <div class="section-title text-left sec-title-animation animation-style2 mb-5">
            <div class="section-title__tagline-box">
                <span class="section-title__tagline"><?php echo e($sectionTitle); ?></span>
            </div>
            <h2 id="testimonials-heading" class="section-title__title title-animation">
                <?php echo e($sectionSub); ?>

            </h2>
        </div>

        <div class="testimonial-one__carousel owl-theme owl-carousel sn-testimonial-carousel"
             role="region"
             aria-roledescription="carousel"
             aria-label="<?php echo e($isEN ? 'Customer testimonials' : 'Kundenstimmen'); ?>">

            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $name        = trim((string) $detail->name);
                    $designation = trim((string) (tr($detail, 'designation') ?: __('Customer')));
                    $feedback    = trim((string) strip_tags(tr($detail, 'feedback')));
                    $rating      = max(1, min(5, (int) ($detail->rating ?? 5)));
                    $imgUrl      = $resolveImg($detail);
                ?>

                <div class="item"
                     role="group"
                     aria-roledescription="slide"
                     aria-label="<?php echo e(($loop->iteration) . ' / ' . $totalSlides); ?>">

                    <div class="testimonial-one__single sn-testimonial-card">

                        <div class="testimonial-one__client-info">

                            <div class="testimonial-one__img sn-testimonial-img">
                                <?php if($imgUrl): ?>
                                    <img src="<?php echo e($imgUrl); ?>"
                                         alt="<?php echo e($name); ?>"
                                         loading="lazy"
                                         decoding="async"
                                         width="64" height="64"
                                         onerror="this.outerHTML='<span class=\'sn-testimonial-initials\' aria-hidden=\'true\'><?php echo e(addslashes($initials($name))); ?></span>';">
                                <?php else: ?>
                                    <span class="sn-testimonial-initials" aria-hidden="true">
                                        <?php echo e($initials($name)); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="testimonial-one__content">
                                <h4 class="testimonial-one__client-name mb-0">
                                    <?php echo e($name); ?>

                                </h4>
                                <p class="testimonial-one__sub-title mb-0">
                                    <?php echo e($designation); ?>

                                </p>
                            </div>
                        </div>

                        <?php if($feedback): ?>
                            <p class="testimonial-one__text mt-3">
                                <?php echo e($feedback); ?>

                            </p>
                        <?php endif; ?>

                        <div class="testimonial-one__rating mt-3" role="img"
                             aria-label="<?php echo e($rating . ' / 5 ' . ($isEN ? 'stars' : 'Sterne')); ?>">
                            <span class="visually-hidden">
                                <?php echo e($rating); ?> <?php echo e($isEN ? 'out of 5 stars' : 'von 5 Sternen'); ?>

                            </span>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= $rating): ?>
                                    <i class="fas fa-star sn-star sn-star--filled" aria-hidden="true"></i>
                                <?php else: ?>
                                    <i class="far fa-star sn-star" aria-hidden="true"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>

                        <div class="testimonial-one__quote" aria-hidden="true">
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <p class="text-center mt-4" style="color:var(--sn-ink-3); font-size:var(--sn-fs-xs);">
            <?php echo e($isEN
                ? 'Real customer feedback. Some names shortened or changed at customer request.'
                : 'Echte Kundenstimmen. Manche Namen auf Kundenwunsch gekürzt oder geändert.'); ?>

        </p>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<style>
    /* Image fallback — initials circle with brand color */
    .sn-testimonial-initials {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px; height: 64px;
        border-radius: 50%;
        background: var(--sn-primary);
        color: #fff;
        font-weight: var(--sn-fw-bold);
        font-size: var(--sn-fs-h6);
        letter-spacing: 0.02em;
    }
    .sn-testimonial-img img {
        width: 64px; height: 64px;
        border-radius: 50%;
        object-fit: cover;
        background: var(--sn-bg-tint);
    }

    /* Star rating colors */
    .sn-star {
        color: var(--sn-line-strong);
        font-size: 14px;
        margin-right: 2px;
    }
    .sn-star--filled {
        color: var(--sn-accent);
    }

    /* Polished card */
    .sn-testimonial-card {
        transition: transform var(--sn-duration-3) var(--sn-ease),
                    box-shadow var(--sn-duration-3) var(--sn-ease);
    }
    .sn-testimonial-card:hover {
        transform: translateY(-2px);
    }

    /* Pause-on-keyboard-focus (theme handles hover; we add focus parity) */
    .sn-testimonial-carousel:focus-within .owl-stage {
        animation-play-state: paused;
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/testimonial/testimonial-1.blade.php ENDPATH**/ ?>