<?php $__env->startSection('title', app()->getLocale() === 'en' ? 'Home' : 'Startseite'); ?>

<?php $__env->startSection('meta_description',
    app()->getLocale() === 'en'
        ? 'StepNow Rides & Movers — fixed-price airport transfers, hire-car passenger transport and parcel delivery from Deizisau. Book online or call.'
        : 'StepNow Rides & Movers — Festpreis-Flughafentransfer, Mietwagen-Personenbeförderung und Paketdienst aus Deizisau. Online buchen oder anrufen.'
); ?>

<?php $__env->startSection('content'); ?>

    
    <?php echo $__env->make('front.partials.slider.slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.services.service-1')) echo $__env->make('front.partials.services.service-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('front.partials.about-us.about-2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.process.process-1')) echo $__env->make('front.partials.process.process-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('front.partials.booking.booking-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.why-choose-us.why-choose-us-1')) echo $__env->make('front.partials.why-choose-us.why-choose-us-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.counter.counter-1')) echo $__env->make('front.partials.counter.counter-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.testimonial.testimonial-1')) echo $__env->make('front.partials.testimonial.testimonial-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.faq.faq')) echo $__env->make('front.partials.faq.faq', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Step-Now\resources\views/front/index.blade.php ENDPATH**/ ?>