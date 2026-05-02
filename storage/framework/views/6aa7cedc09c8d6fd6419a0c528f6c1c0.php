
<?php
    use Illuminate\Support\Facades\Route;

    $locale     = app()->getLocale();
    $isEN       = $locale === 'en';
    $year       = date('Y');

    /* Single source of truth */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';
    $address    = optional($setting ?? null)->address ?? 'Blumenstraße 8, 73779 Deizisau';

    $footerLogo = optional($setting ?? null)->footer_logo
        ?? optional($setting ?? null)->logo
        ?? 'front/assets/images/logo.png';
?>

<footer class="site-footer" role="contentinfo">

    
    <div class="site-footer__bg" aria-hidden="true"
         style="background-image: url(<?php echo e(asset('front/assets/images/video-pic1.jpg')); ?>);"></div>

    <div class="site-footer__top">
        <div class="container">
            <div class="site-footer__top-inner">
                <div class="row">

                    
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__about">
                            <div class="footer-widget__about-logo mb-3">
                                <a href="<?php echo e(lroute('front.index')); ?>" aria-label="StepNow Rides & Movers — <?php echo e($isEN ? 'Home' : 'Startseite'); ?>">
                                    <img src="<?php echo e(asset($footerLogo)); ?>" width="180" height="50" alt="StepNow Rides & Movers">
                                </a>
                            </div>

                            <p class="footer-widget__about-text">
                                <?php echo e($isEN
                                    ? 'Your reliable partner for hire-car passenger transport and parcel delivery in Deizisau and the Esslingen region. Punctual, transparent, regional.'
                                    : 'Ihr zuverlässiger Partner für Mietwagen-Personenbeförderung und Paketdienst in Deizisau und der Region Esslingen. Pünktlich, transparent, regional.'); ?>

                            </p>

                            <ul class="footer-widget__contact-list list-unstyled mt-3">
                                <li class="d-flex align-items-start mb-2">
                                    <i class="fas fa-map-marker-alt mt-1 me-2" aria-hidden="true"></i>
                                    <span><?php echo e($address); ?></span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone me-2" aria-hidden="true"></i>
                                    <a href="tel:<?php echo e($phoneE164); ?>"><?php echo e($phoneRaw); ?></a>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-envelope me-2" aria-hidden="true"></i>
                                    <a href="mailto:<?php echo e($emailAddr); ?>"><?php echo e($emailAddr); ?></a>
                                </li>
                            </ul>

                            <div class="thm-social-link1 mt-3">
                                <ul class="social-box list-unstyled" role="list">
                                    <?php if(!empty(optional($setting ?? null)->fb_link)): ?>
                                        <li><a href="<?php echo e($setting->fb_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(!empty(optional($setting ?? null)->insta_link)): ?>
                                        <li><a href="<?php echo e($setting->insta_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(!empty(optional($setting ?? null)->yt_link)): ?>
                                        <li><a href="<?php echo e($setting->yt_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(!empty(optional($setting ?? null)->tiktok_link)): ?>
                                        <li><a href="<?php echo e($setting->tiktok_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="bi bi-tiktok" aria-hidden="true"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(!empty(optional($setting ?? null)->linkedin_link)): ?>
                                        <li><a href="<?php echo e($setting->linkedin_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-2 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title"><?php echo e(__('Quick Links')); ?></h4>
                            <ul class="footer-widget__links-list list-unstyled" role="list">
                                <li><a href="<?php echo e(lroute('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.about')); ?>"><?php echo e(__('About Us')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.services')); ?>"><?php echo e(__('Services')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.pricing')); ?>"><?php echo e(__('Pricing')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.contactus')); ?>"><?php echo e(__('Contact')); ?></a></li>
                            </ul>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title"><?php echo e(__('Legal')); ?></h4>
                            <ul class="footer-widget__links-list list-unstyled" role="list">
                                <li><a href="<?php echo e(lroute('front.impressum')); ?>"><?php echo e(__('Imprint')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.datenschutz')); ?>"><?php echo e(__('Privacy Policy')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.agb')); ?>"><?php echo e(__('Terms & Conditions')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.widerruf')); ?>"><?php echo e(__('Right of Withdrawal')); ?></a></li>
                                <li><a href="<?php echo e(lroute('front.cookies')); ?>"><?php echo e(__('Cookie Policy')); ?></a></li>
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault(); if(window.stepnowConsent && typeof window.stepnowConsent.openSettings==='function'){window.stepnowConsent.openSettings();}"
                                       role="button">
                                        <?php echo e(__('Cookie Settings')); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                        <div class="footer-widget__links">
                            <h4 class="footer-widget__title"><?php echo e(__('Opening Hours')); ?></h4>
                            <ul class="footer-widget__hours-list list-unstyled" role="list">
                                <li class="d-flex justify-content-between">
                                    <span><?php echo e(__('Mon – Fri')); ?></span>
                                    <span>06:00 – 22:00</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span><?php echo e(__('Saturday')); ?></span>
                                    <span>07:00 – 22:00</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span><?php echo e(__('Sunday')); ?></span>
                                    <span>08:00 – 20:00</span>
                                </li>
                                <li class="mt-2">
                                    <small>
                                        <i class="fas fa-plane-departure me-1" aria-hidden="true"></i>
                                        <?php echo e($isEN
                                            ? '24/7 pre-booked airport transfers'
                                            : '24/7 vorgebuchte Flughafentransfers'); ?>

                                    </small>
                                </li>
                            </ul>

                            <h4 class="footer-widget__title mt-4"><?php echo e(__('Service Area')); ?></h4>
                            <p class="small">
                                <?php echo e($isEN
                                    ? 'Deizisau · Esslingen · Plochingen · Reichenbach · Wernau · Köngen · Wendlingen · Stuttgart · Stuttgart Airport (STR)'
                                    : 'Deizisau · Esslingen · Plochingen · Reichenbach · Wernau · Köngen · Wendlingen · Stuttgart · Flughafen Stuttgart (STR)'); ?>

                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="sn-trust-row" role="list" aria-label="<?php echo e($isEN ? 'Trust signals' : 'Vertrauenssignale'); ?>">
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                <?php echo e($isEN ? 'DSGVO compliant' : 'DSGVO-konform'); ?>

            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <?php echo e($isEN ? 'SSL secured' : 'SSL-gesichert'); ?>

            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-certificate" aria-hidden="true"></i>
                <?php echo e($isEN ? 'Licensed Mietwagen operator' : 'Konzessionierter Mietwagen-Betrieb'); ?>

            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="far fa-credit-card" aria-hidden="true"></i>
                <?php echo e($isEN ? 'Cash · Bank transfer · PayPal' : 'Bar · Überweisung · PayPal'); ?>

            </span>
            <span class="sn-trust-row__badge" role="listitem">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                <?php echo e($isEN ? 'Regional, Baden-Württemberg' : 'Regional, Baden-Württemberg'); ?>

            </span>
        </div>
    </div>

    
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner d-flex flex-wrap justify-content-between align-items-center py-3">
                <p class="site-footer__bottom-text mb-0">
                    &copy; <?php echo e($year); ?> <?php echo e(optional($setting ?? null)->company_name ?? 'StepNow Rides & Movers e.K.'); ?>. <?php echo e(__('All rights reserved.')); ?>

                </p>

                <ul class="site-footer__bottom-links list-unstyled d-flex flex-wrap mb-0" role="list">
                    <li class="ms-3"><a href="<?php echo e(lroute('front.impressum')); ?>"><?php echo e(__('Imprint')); ?></a></li>
                    <li class="ms-3"><a href="<?php echo e(lroute('front.datenschutz')); ?>"><?php echo e(__('Privacy Policy')); ?></a></li>
                    <li class="ms-3"><a href="<?php echo e(lroute('front.agb')); ?>"><?php echo e(__('Terms & Conditions')); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<a href="#top" class="scroll-to-top scroll-to-target" data-target="html"
   aria-label="<?php echo e($isEN ? 'Scroll to top' : 'Zum Seitenanfang'); ?>">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</a>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/layouts/partials/footer.blade.php ENDPATH**/ ?>