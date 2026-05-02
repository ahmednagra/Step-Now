<?php if($testimonial): ?>
    <div class="testimonials-page">
        <div class="container">

            <div class="section-title text-left sec-title-animation animation-style2">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">
                        <?php echo e(tr($testimonial, 'title') ?? __('Our Testimonial')); ?>

                    </span>
                </div>

                <h2 class="section-title__title title-animation">
                    <?php echo e(tr($testimonial, 'subtitle') ?? __('What People Say About Us')); ?>

                </h2>
            </div>

            <div class="testimonial-one__carousel owl-theme owl-carousel">

                <?php $__currentLoopData = $testimonial->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="testimonial-one__single">

                            <div class="testimonial-one__client-info">

                                <div class="testimonial-one__img">
                                    <img src="<?php echo e(asset('storage/testimonial_details/' . $detail->image)); ?>" alt="">
                                </div>

                                <div class="testimonial-one__content">
                                    <h4 class="testimonial-one__client-name">
                                        <a href="javascript:void(0)"><?php echo e($detail->name); ?></a>
                                    </h4>

                                    <p class="testimonial-one__sub-title">
                                        <?php echo e(tr($detail, 'designation') ?? __('Customer')); ?>

                                    </p>
                                </div>
                            </div>

                            <p class="testimonial-one__text">
                                <?php echo tr($detail, 'feedback'); ?>

                            </p>

                            <?php if($detail->rating): ?>
                                <div class="testimonial-one__rating">
                                    <?php for($i = 1; $i <= $detail->rating; $i++): ?>
                                        <span class="icon-star"></span>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>

                            <div class="testimonial-one__quote">
                                <span class="icon-quote"></span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/testimonial/testimonial-1.blade.php ENDPATH**/ ?>