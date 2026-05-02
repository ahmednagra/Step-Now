<!-- Faq Two Start -->
<?php if($faq): ?>
<section class="faq-two">
    <div class="faq-two__shape-1"></div>
    <div class="faq-two__shape-2"></div>
    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline">
                    <?php echo e(tr($faq, 'subtitle')); ?>

                </span>
            </div>

            <h2 class="section-title__title title-animation">
                <?php echo e(tr($faq, 'title')); ?>

            </h2>

            <?php if(tr($faq, 'description')): ?>
                <p class="disc text-center">
                    <?php echo tr($faq, 'description'); ?>

                </p>
            <?php endif; ?>
        </div>

        <div class="faq-two__inner-content">
            <div class="accrodion-grp" data-grp-name="faq-one-accrodion">

                <?php $__currentLoopData = $faq->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isActive = $index === 0 ? 'active' : '';
                        $wowDelay = ($index * 100) . 'ms';
                        $wowDirection = $index % 2 === 0 ? 'fadeInLeft' : 'fadeInRight';
                    ?>

                    <div class="accrodion <?php echo e($isActive); ?> wow <?php echo e($wowDirection); ?>"
                        data-wow-delay="<?php echo e($wowDelay); ?>" data-wow-duration="1500ms">

                        <div class="accrodion-title">
                            <h4><?php echo e(tr($detail, 'question')); ?></h4>
                        </div>

                        <div class="accrodion-content">
                            <div class="inner">
                                <?php echo tr($detail, 'answer'); ?>

                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/faq/faq.blade.php ENDPATH**/ ?>