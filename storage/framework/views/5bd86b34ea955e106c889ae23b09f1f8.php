

<?php
    $isEN = app()->getLocale() === 'en';

    /* Honest commitments matching the About-Us KPI block.
       Format: ['count' => numeric, 'suffix' => '+' / 'min' / etc.,
                'icon' => FA, 'label' => translated text]
       If you want to add a real metric (e.g. "237 trips this month"),
       store it in `settings` table and pull it in here. */
    $counters = [
        [
            'count'      => 30,
            'static'     => '30',
            'suffix'     => $isEN ? ' min' : ' Min',
            'icon'       => 'fas fa-clock',
            'label'      => $isEN ? 'Reply during business hours' : 'Antwort zur Geschäftszeit',
            'animation'  => 'fadeInLeft',
            'delay'      => '100ms',
        ],
        [
            'count'      => 24,
            'static'     => '24',
            'suffix'     => '/7',
            'icon'       => 'fas fa-plane-departure',
            'label'      => $isEN ? 'Pre-booked airport transfers' : 'Vorgebuchte Flughafentransfers',
            'animation'  => 'fadeInLeft',
            'delay'      => '200ms',
        ],
        [
            'count'      => 10,
            'static'     => '10',
            'suffix'     => '+',
            'icon'       => 'fas fa-map-marker-alt',
            'label'      => $isEN ? 'Cities & locations served' : 'Bediente Städte & Orte',
            'animation'  => 'fadeInRight',
            'delay'      => '300ms',
        ],
        [
            'count'      => 100,
            'static'     => '100',
            'suffix'     => '%',
            'icon'       => 'fas fa-shield-alt',
            'label'      => $isEN ? 'DSGVO-compliant operations' : 'DSGVO-konformer Betrieb',
            'animation'  => 'fadeInRight',
            'delay'      => '400ms',
        ],
    ];
?>

<section class="counter-two" aria-labelledby="counter-heading">
    <div class="visually-hidden" id="counter-heading">
        <?php echo e($isEN ? 'Our commitments' : 'Unsere Verpflichtungen'); ?>

    </div>

    <div class="container">
        <div class="counter-two__inner">
            <ul class="list-unstyled counter-two__list" role="list">

                <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="wow <?php echo e($counter['animation']); ?>"
                        data-wow-delay="<?php echo e($counter['delay']); ?>"
                        data-wow-duration="1500ms">
                        <div class="counter-two__single sn-counter-single">
                            <div class="counter-two__shape-1" aria-hidden="true"></div>
                            <div class="counter-two__shape-2" aria-hidden="true"></div>

                            <div class="counter-two__single-inner">
                                <div class="counter-two__icon" aria-hidden="true">
                                    <i class="<?php echo e($counter['icon']); ?>"></i>
                                </div>

                                <div class="counter-two__count-box"
                                     aria-label="<?php echo e($counter['static'] . $counter['suffix'] . ' — ' . $counter['label']); ?>">
                                    
                                    <h3 class="odometer sn-counter-num"
                                        data-count="<?php echo e($counter['count']); ?>"><?php echo e($counter['static']); ?></h3>
                                    <span aria-hidden="true"><?php echo e($counter['suffix']); ?></span>
                                </div>

                                <p class="counter-two__count-text"><?php echo e($counter['label']); ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<style>
    /* Wave 3 — defensive styling so the section never shows "00" forever */
    .sn-counter-num {
        font-variant-numeric: tabular-nums;
    }

    /* Reduced-motion: skip odometer animation entirely */
    @media (prefers-reduced-motion: reduce) {
        .sn-counter-num.odometer {
            animation: none !important;
        }
    }

    .sn-counter-single {
        transition: transform var(--sn-duration-3) var(--sn-ease);
    }
    .sn-counter-single:hover {
        transform: translateY(-2px);
    }
</style>
<script>
    /* Defensive odometer init — only animates if jQuery + odometer present.
       Otherwise the static $counter['static'] value is what the user sees,
       which is correct (no broken "00" placeholder).

       The theme's script.js usually wires up odometer via .appear(). We
       leave that path intact and only override the BEHAVIOR if reduced-
       motion is requested. */
    (function () {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.querySelectorAll('.sn-counter-num.odometer').forEach(function (el) {
                /* Force the final value immediately — no animation */
                el.classList.remove('odometer');
                el.textContent = el.dataset.count || el.textContent;
            });
        }
    })();
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/counter/counter-1.blade.php ENDPATH**/ ?>