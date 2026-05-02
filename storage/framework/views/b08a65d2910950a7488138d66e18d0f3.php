

<?php
    $isEN = app()->getLocale() === 'en';

    $steps = [
        [
            'icon'   => 'fas fa-tags',
            'title'  => $isEN ? 'Get a price'     : 'Preis erhalten',
            'text'   => $isEN
                ? 'Browse fixed-price routes, calculate parcel costs, or request a custom quote.'
                : 'Festpreis-Strecken ansehen, Paketkosten berechnen oder individuelles Angebot anfordern.',
        ],
        [
            'icon'   => 'fas fa-check-circle',
            'title'  => $isEN ? 'Confirm booking' : 'Buchung bestätigen',
            'text'   => $isEN
                ? 'We confirm your booking by phone or email within 30 minutes during business hours.'
                : 'Wir bestätigen Ihre Buchung per Telefon oder E-Mail innerhalb von 30 Minuten.',
        ],
        [
            'icon'   => 'fas fa-map-pin',
            'title'  => $isEN ? 'We arrive on time' : 'Wir kommen pünktlich',
            'text'   => $isEN
                ? 'Driver or courier arrives at the agreed pickup time and location.'
                : 'Fahrer oder Kurier kommt zur vereinbarten Zeit an den Abholort.',
        ],
        [
            'icon'   => 'fas fa-flag-checkered',
            'title'  => $isEN ? 'Safe arrival'      : 'Sichere Ankunft',
            'text'   => $isEN
                ? 'You arrive safely at your destination — or your parcel is delivered into the recipient\'s hands.'
                : 'Sie erreichen Ihr Ziel sicher — oder Ihr Paket wird dem Empfänger persönlich übergeben.',
        ],
    ];
?>

<section class="process-one" aria-labelledby="process-heading">
    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style2 mb-5">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline"><?php echo e($isEN ? 'How it works' : 'So funktioniert es'); ?></span>
            </div>
            <h2 id="process-heading" class="section-title__title title-animation">
                <?php echo e($isEN ? 'Booking with StepNow in 4 steps' : 'Buchung in 4 Schritten'); ?>

            </h2>
        </div>

        <ol class="row g-4 list-unstyled sn-process-list">

            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $animations = ['fadeInLeft', 'fadeInUp', 'fadeInUp', 'fadeInRight'];
                    $animationClass = $animations[$i] ?? 'fadeInUp';
                    $delay = (($i * 200) + 100) . 'ms';
                ?>

                <li class="col-12 col-sm-6 col-lg-3 wow <?php echo e($animationClass); ?>"
                    data-wow-delay="<?php echo e($delay); ?>"
                    data-wow-duration="1500ms">

                    <article class="process-one__single sn-process-card">

                        <div class="sn-process-step-num" aria-hidden="true">
                            <?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?>

                        </div>

                        <div class="process-one__icon-box sn-process-icon-wrap">
                            <span class="sn-process-icon" aria-hidden="true">
                                <i class="<?php echo e($step['icon']); ?>"></i>
                            </span>
                        </div>

                        <h3 class="process-one__title sn-process-title">
                            <span class="visually-hidden">
                                <?php echo e($isEN ? 'Step' : 'Schritt'); ?> <?php echo e($i + 1); ?>:
                            </span>
                            <?php echo e($step['title']); ?>

                        </h3>

                        <p class="process-one__text">
                            <?php echo e($step['text']); ?>

                        </p>
                    </article>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ol>

        <div class="text-center mt-5">
            <a href="<?php echo e(lroute('front.contactus')); ?>" class="thm-btn thm-btn--lg">
                <?php echo e($isEN ? 'Start your booking' : 'Buchung starten'); ?>

                <span class="fas fa-arrow-right" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<style>
    .sn-process-list {
        position: relative;
        counter-reset: sn-step;
    }

    /* Connector line between cards on desktop */
    @media (min-width: 992px) {
        .sn-process-list::before {
            content: "";
            position: absolute;
            top: 60px;
            left: 12.5%;
            right: 12.5%;
            height: 2px;
            background: linear-gradient(90deg,
                var(--sn-line) 0%,
                var(--sn-primary-100) 50%,
                var(--sn-line) 100%);
            z-index: 0;
        }
    }

    .sn-process-card {
        position: relative;
        background: var(--sn-bg);
        border: 1px solid var(--sn-line);
        border-radius: var(--sn-radius-lg);
        padding: var(--sn-space-6) var(--sn-space-5);
        text-align: center;
        height: 100%;
        z-index: 1;
        transition:
            transform var(--sn-duration-3) var(--sn-ease),
            box-shadow var(--sn-duration-3) var(--sn-ease),
            border-color var(--sn-duration-3) var(--sn-ease);
    }
    .sn-process-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--sn-shadow-md);
        border-color: var(--sn-primary-100);
    }

    .sn-process-step-num {
        position: absolute;
        top: -16px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--sn-accent);
        color: var(--sn-ink);
        font-weight: var(--sn-fw-bold);
        font-size: var(--sn-fs-sm);
        padding: 4px 12px;
        border-radius: var(--sn-radius-pill);
        letter-spacing: 0.05em;
        box-shadow: var(--sn-shadow-sm);
    }

    .sn-process-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px; height: 80px;
        margin: var(--sn-space-3) auto var(--sn-space-4);
        background: var(--sn-primary-100);
        color: var(--sn-primary);
        border-radius: 50%;
        font-size: 32px;
        transition: background var(--sn-duration-3) var(--sn-ease),
                    color      var(--sn-duration-3) var(--sn-ease);
    }
    .sn-process-card:hover .sn-process-icon-wrap {
        background: var(--sn-primary);
        color: #fff;
    }

    .sn-process-title {
        font-size: var(--sn-fs-h5);
        margin-bottom: var(--sn-space-3);
        color: var(--sn-ink);
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/process/process-1.blade.php ENDPATH**/ ?>