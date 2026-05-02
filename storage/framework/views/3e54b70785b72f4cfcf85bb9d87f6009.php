<?php if($why_choose_us): ?>
<section class="why-choose-one mt-5">
    <div class="why-choose-one__shape-1"></div>
    <div class="why-choose-one__shape-2"></div>
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style2">
            <div class="section-title__tagline-box justify-content-center">
                <div class="section-title__tagline-shape">
                    <img src="<?php echo e(asset('front/assets/images/shapes/section-title-tagline-shape-1.png')); ?>" alt="">
                </div>
                <span class="section-title__tagline"><?php echo e(tr($why_choose_us, 'subtitle')); ?></span>
            </div>
            <h2 class="section-title__title title-animation"><?php echo e(tr($why_choose_us, 'title')); ?></h2>
        </div>
        <div class="row">
            <?php $__currentLoopData = $why_choose_us->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if($index == 0) { $animationClass = 'fadeInLeft';  $delay = '100ms'; }
                    elseif($index == 1) { $animationClass = 'fadeInUp'; $delay = '300ms'; }
                    else { $animationClass = 'fadeInRight'; $delay = '500ms'; }
                ?>

                <div class="col-xl-4 col-lg-6 col-md-6 wow <?php echo e($animationClass); ?>" data-wow-delay="<?php echo e($delay); ?>" data-wow-duration="1500ms">
                    <div class="why-choose-one__single">
                        <div class="why-choose-one__icon">
                            <img src="<?php echo e(asset($detail->icon)); ?>" alt="<?php echo e(tr($detail, 'title')); ?>" width="50px">
                        </div>
                        <div class="why-choose-one__single-inner">
                            <h3 class="why-choose-one__title"><?php echo e(tr($detail, 'title')); ?></h3>
                            <p class="why-choose-one__text">
                                <?php echo e(tr($detail, 'description')); ?>

                            </p>
                        </div>
                        <div class="why-choose-one__btn-box">
                            <a href="<?php echo e(route('front.contactus')); ?>" class="thm-btn">
                                <?php echo e(__('Get Quote')); ?><span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/why-choose-us/why-choose-us-1.blade.php ENDPATH**/ ?>