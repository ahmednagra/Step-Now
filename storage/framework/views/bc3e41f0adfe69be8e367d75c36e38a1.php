
<?php
    use Illuminate\Support\Facades\Route;

    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';

    /* Single source of truth for contact details */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';

    /* URLs for the language toggle */
    $deUrl = function_exists('locale_url_for') ? locale_url_for('de') : url(request()->path()) . '?lang=de';
    $enUrl = function_exists('locale_url_for') ? locale_url_for('en') : url(request()->path()) . '?lang=en';

    /* Logo source */
    $logoSrc = optional($setting ?? null)->logo
        ? asset($setting->logo)
        : asset('front/assets/images/logo.png');

    /* Active-route helper for aria-current */
    $isHome     = Route::is('front.index');
    $isAbout    = Route::is('front.about');
    $isServices = Route::is('front.services');
    $isPricing  = Route::is('front.pricing');
    $isContact  = Route::is('front.contactus');
?>

<header class="main-header" role="banner">

    
    <nav class="main-menu" aria-label="<?php echo e($isEN ? 'Primary navigation' : 'Hauptnavigation'); ?>">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">

                
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="<?php echo e(lroute('front.index')); ?>" aria-label="<?php echo e($isEN ? 'StepNow Rides & Movers — Home' : 'StepNow Rides & Movers — Startseite'); ?>">
                            <img src="<?php echo e($logoSrc); ?>" width="200" height="56" alt="StepNow Rides & Movers">
                        </a>
                    </div>
                </div>

                
                <div class="main-menu__middle-box">
                    <div class="main-menu__main-menu-box">
                        <button type="button"
                                class="mobile-nav__toggler"
                                aria-label="<?php echo e($isEN ? 'Open menu' : 'Menü öffnen'); ?>">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>

                        <ul class="main-menu__list" role="menubar">
                            <li role="none">
                                <a href="<?php echo e(lroute('front.index')); ?>"
                                   role="menuitem"
                                   <?php if($isHome): ?> aria-current="page" <?php endif; ?>>
                                    <?php echo e(__('Home')); ?>

                                </a>
                            </li>
                            <li role="none">
                                <a href="<?php echo e(lroute('front.about')); ?>"
                                   role="menuitem"
                                   <?php if($isAbout): ?> aria-current="page" <?php endif; ?>>
                                    <?php echo e(__('About Us')); ?>

                                </a>
                            </li>
                            <li role="none">
                                <a href="<?php echo e(lroute('front.services')); ?>"
                                   role="menuitem"
                                   <?php if($isServices): ?> aria-current="page" <?php endif; ?>>
                                    <?php echo e(__('Services')); ?>

                                </a>
                            </li>
                            <li role="none">
                                <a href="<?php echo e(lroute('front.pricing')); ?>"
                                   role="menuitem"
                                   <?php if($isPricing): ?> aria-current="page" <?php endif; ?>>
                                    <?php echo e(__('Pricing')); ?>

                                </a>
                            </li>
                            <li role="none">
                                <a href="<?php echo e(lroute('front.contactus')); ?>"
                                   role="menuitem"
                                   <?php if($isContact): ?> aria-current="page" <?php endif; ?>>
                                    <?php echo e(__('Contact')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="main-menu__right">

                    
                    <div class="sn-lang-toggle sn-lang-toggle--inline"
                         role="group"
                         aria-label="<?php echo e($isEN ? 'Language' : 'Sprache'); ?>">
                        <a href="<?php echo e($enUrl); ?>"
                           data-sn-lang="en"
                           class="sn-lang-toggle__btn"
                           aria-current="<?php echo e($isEN ? 'true' : 'false'); ?>"
                           aria-label="English"
                           hreflang="en"
                           lang="en">EN</a>
                        <a href="<?php echo e($deUrl); ?>"
                           data-sn-lang="de"
                           class="sn-lang-toggle__btn"
                           aria-current="<?php echo e($isEN ? 'false' : 'true'); ?>"
                           aria-label="Deutsch"
                           hreflang="de"
                           lang="de">DE</a>
                    </div>

                    
                    <div class="main-menu__call">
                        <div class="main-menu__call-icon" aria-hidden="true">
                            <i class="icon-call-3"></i>
                        </div>
                        <div class="main-menu__call-content">
                            <p class="main-menu__call-sub-title"><?php echo e(__('Call anytime')); ?></p>
                            <h5 class="main-menu__call-number">
                                <a href="tel:<?php echo e($phoneE164); ?>"><?php echo e($phoneRaw); ?></a>
                            </h5>
                        </div>
                    </div>

                    
                    <a class="navSidebar-button main-menu__nav-sidebar-icon"
                       href="#"
                       role="button"
                       aria-label="<?php echo e($isEN ? 'Open quick-info sidebar' : 'Schnellinfo-Sidebar öffnen'); ?>">
                        <span class="icon-dots-menu-one" aria-hidden="true"></span>
                        <span class="icon-dots-menu-two" aria-hidden="true"></span>
                        <span class="icon-dots-menu-three" aria-hidden="true"></span>
                    </a>
                </div>

            </div>
        </div>
    </nav>
</header>


<div class="stricky-header stricked-menu main-menu" aria-hidden="true">
    <div class="sticky-header__content"></div>
</div><?php /**PATH D:\laragon\www\Step-Now\resources\views/front/layouts/partials/header.blade.php ENDPATH**/ ?>