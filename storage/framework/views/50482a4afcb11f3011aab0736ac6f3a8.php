<section class="services-one">
    <div class="services-one__shape-1"></div>
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline"><?php echo e(__('What We Offer')); ?></span>
            </div>
            <h2 class="section-title__title title-animation">
                <?php echo e(__('Services we provide to our customers')); ?>

            </h2>
        </div>
        <div class="row">

            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms"
                    data-wow-duration="1500ms">
                    <div class="services-one__single">
                        <div class="services-one__single-shape-1"></div>
                        <div class="services-one__single-shape-2"></div>
                        <div class="services-one__single-shape-3"></div>
                        <div class="services-one__count"></div>
                        <div class="services-one__icon">
                            <img src="<?php echo e(asset($service->icon)); ?>" alt="Icon" width="50">
                        </div>
                        <h3 class="services-one__title">
                            <a href="<?php echo e(route('front.service.detail', $service->slug)); ?>">
                                <?php echo e(tr($service, 'name') ?? $service->name); ?>

                            </a>
                        </h3>
                        <p class="services-one__text">
                            <?php echo tr($service, 'short_description') ?? $service->short_description; ?>

                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/services/service-1.blade.php ENDPATH**/ ?>