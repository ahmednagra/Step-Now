<section class="call-one">
    <div class="container">
        <div class="call-one__inner wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="call-one__inner-content">
                <div class="call-one__bg"></div>
                <div class="call-one__left">
                    <p class="call-one__sub-title"><?php echo e(__('Available 24/7')); ?></p>
                    <h4 class="call-one__title"><?php echo e(__('Call anytime for bookings')); ?></h4>
                </div>
                <div class="call-one__details">
                    <div class="call-one__icon">
                        <span class="icon-call-2"></span>
                    </div>
                    <div class="call-one__content">
                        <p><?php echo e(__('Hotline')); ?></p>
                        <h4><a href="tel:<?php echo e($setting->phone_no); ?>"><?php echo e($setting->phone_no); ?></a></h4>
                    </div>
                </div>
                <div class="call-one__btn-box">
                    <a href="<?php echo e(route('front.contactus')); ?>" class="thm-btn">
                        <?php echo e(__('Rent Now')); ?><span class="fas fa-arrow-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/cta/cta-1.blade.php ENDPATH**/ ?>