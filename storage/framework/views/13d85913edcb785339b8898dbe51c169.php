
<?php if(isset($banners) && $banners->isNotEmpty()): ?>
    <div class="sn-banners" role="region" aria-label="<?php echo e(app()->getLocale() === 'en' ? 'Notices' : 'Hinweise'); ?>">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sn-banner sn-banner--<?php echo e($banner->severity); ?>" role="status">
                <div class="sn-banner__inner">
                    <span class="sn-banner__icon" aria-hidden="true">
                        <?php switch($banner->severity):
                            case ('warning'): ?> ⚠ <?php break; ?>
                            <?php case ('success'): ?> ✓ <?php break; ?>
                            <?php default: ?> ℹ
                        <?php endswitch; ?>
                    </span>
                    <span class="sn-banner__msg"><?php echo e($banner->message); ?></span>
                    <?php if($banner->cta_url && $banner->cta_label): ?>
                        <a class="sn-banner__cta"
                           href="<?php echo e(\Illuminate\Support\Str::startsWith($banner->cta_url, 'http')
                                    ? $banner->cta_url
                                    : url($banner->cta_url)); ?>">
                            <?php echo e($banner->cta_label); ?> →
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<style>
    .sn-banners { font-family: 'Inter Tight', 'Roboto', system-ui, sans-serif; }
    .sn-banner {
        font-size: .92rem;
        line-height: 1.5;
        padding: 10px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, .06);
    }
    .sn-banner--info    { background: #EFF6FF; color: #0F4C81; }
    .sn-banner--warning { background: #FFF7E6; color: #8A4B00; }
    .sn-banner--success { background: #ECFDF5; color: #0F7B33; }
    .sn-banner__inner   {
        max-width: 1240px; margin: 0 auto;
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .sn-banner__icon    { font-size: 1.1rem; flex: 0 0 auto; }
    .sn-banner__msg     { flex: 1 1 auto; }
    .sn-banner__cta     {
        flex: 0 0 auto;
        font-weight: 600;
        text-decoration: underline;
        color: inherit;
    }
    .sn-banner__cta:hover { text-decoration: none; }
    @media (max-width: 600px) {
        .sn-banner { font-size: .86rem; padding: 8px 12px; }
        .sn-banner__inner { gap: 6px; }
    }
</style>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/partials/banner/site-banners.blade.php ENDPATH**/ ?>