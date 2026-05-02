
<?php
    use Illuminate\Support\Str;

    $locale  = app()->getLocale();
    $isEN    = $locale === 'en';

    /* ---- URLs for hreflang ---- */
    $currentUrl = url()->current();
    $cleanUrl   = preg_replace('/([?&])lang=(de|en)(&|$)/', '$1', $currentUrl);
    $cleanUrl   = rtrim($cleanUrl, '?&');
    $sep        = parse_url($cleanUrl, PHP_URL_QUERY) ? '&' : '?';

    /* ---- Brand strings ---- */
    $baseBrand  = 'StepNow Rides & Movers';
    $tagline    = $isEN
        ? 'Hire-car · Passenger transport · Parcel service'
        : 'Mietwagen · Personenbeförderung · Paketdienst';

    /* ---- Page-level meta ---- */
    $pageTitleRaw = trim((string) View::yieldContent('title'));
    $fullTitle    = $pageTitleRaw
        ? ($pageTitleRaw . ' | ' . $baseBrand)
        : ($baseBrand . ' — ' . $tagline);

    $metaDescRaw  = trim((string) View::yieldContent('meta_description'));
    $metaDescription = $metaDescRaw ?: ($isEN
        ? 'StepNow Rides & Movers — passenger transport, hire-car and parcel service from Deizisau. Transparent fixed prices, punctual, regional.'
        : 'StepNow Rides & Movers — Personenbeförderung, Mietwagen und Paketdienst aus Deizisau. Transparente Festpreise, pünktlich, regional.');

    /* ---- OG image: page override > settings logo > shipped default ---- */
    $ogImageRaw = trim((string) View::yieldContent('og_image'));
    $ogImage    = $ogImageRaw
        ?: (isset($setting) && $setting && $setting->logo ? asset($setting->logo)
            : asset('front/assets/images/og-default.jpg'));

    /* ---- Phone (single source of truth: settings, fallback hardcoded) ---- */
    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';

    /* ---- Theme color ---- */
    $brandPrimary = '#0F4C81';
?>
<!DOCTYPE html>
<html lang="<?php echo e($locale); ?>" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="<?php echo e($brandPrimary); ?>">
    <meta name="format-detection" content="telephone=yes">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo e($fullTitle); ?></title>
    <meta name="description" content="<?php echo e($metaDescription); ?>">
    <meta name="author" content="<?php echo e($baseBrand); ?>">

    
    <?php $robots = trim((string) View::yieldContent('robots')) ?: 'index, follow, max-image-preview:large'; ?>
    <meta name="robots" content="<?php echo e($robots); ?>">

    
    <link rel="canonical"                      href="<?php echo e($isEN ? $cleanUrl . $sep . 'lang=en' : $cleanUrl); ?>">
    <link rel="alternate" hreflang="de"        href="<?php echo e($cleanUrl); ?><?php echo e($sep); ?>lang=de">
    <link rel="alternate" hreflang="en"        href="<?php echo e($cleanUrl); ?><?php echo e($sep); ?>lang=en">
    <link rel="alternate" hreflang="x-default" href="<?php echo e($cleanUrl); ?><?php echo e($sep); ?>lang=en">

    
    <meta property="og:type"              content="website">
    <meta property="og:locale"            content="<?php echo e($isEN ? 'en_US' : 'de_DE'); ?>">
    <meta property="og:locale:alternate"  content="<?php echo e($isEN ? 'de_DE' : 'en_US'); ?>">
    <meta property="og:site_name"         content="<?php echo e($baseBrand); ?>">
    <meta property="og:title"             content="<?php echo e($fullTitle); ?>">
    <meta property="og:description"       content="<?php echo e($metaDescription); ?>">
    <meta property="og:image"             content="<?php echo e($ogImage); ?>">
    <meta property="og:image:alt"         content="<?php echo e($baseBrand); ?>">
    <meta property="og:url"               content="<?php echo e(url()->current()); ?>">

    
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo e($fullTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($metaDescription); ?>">
    <meta name="twitter:image"       content="<?php echo e($ogImage); ?>">

    
    <meta name="geo.region"    content="DE-BW">
    <meta name="geo.placename" content="Deizisau">
    <meta name="geo.position"  content="48.7242;9.3686">
    <meta name="ICBM"          content="48.7242, 9.3686">

    
    <?php if(isset($setting) && $setting && !empty($setting->fav_icon)): ?>
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset($setting->fav_icon)); ?>">
        <link rel="shortcut icon"             href="<?php echo e(asset($setting->fav_icon)); ?>">
    <?php else: ?>
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('front/assets/images/favicon.ico')); ?>">
    <?php endif; ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('front/assets/images/apple-touch-icon.png')); ?>">

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": ["LocalBusiness", "LimousineService"],
      "@id": "<?php echo e(url('/')); ?>#business",
      "name": "<?php echo e($baseBrand); ?>",
      "alternateName": "StepNow Rides & Movers e.K.",
      "description": <?php echo json_encode($metaDescription); ?>,
      "image": "<?php echo e($ogImage); ?>",
      "logo": "<?php echo e(optional($setting ?? null)->logo ? asset($setting->logo) : asset('front/assets/images/logo.png')); ?>",
      "url": "<?php echo e(url('/')); ?>",
      "telephone": "<?php echo e($phoneE164); ?>",
      "email": "<?php echo e($emailAddr); ?>",
      "currenciesAccepted": "EUR",
      "paymentAccepted": "Cash, Bank transfer, PayPal",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Blumenstraße 8",
        "postalCode": "73779",
        "addressLocality": "Deizisau",
        "addressRegion": "Baden-Württemberg",
        "addressCountry": "DE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 48.7242,
        "longitude": 9.3686
      },
      "areaServed": [
        { "@type": "City", "name": "Deizisau" },
        { "@type": "City", "name": "Esslingen am Neckar" },
        { "@type": "City", "name": "Plochingen" },
        { "@type": "City", "name": "Reichenbach an der Fils" },
        { "@type": "City", "name": "Wernau" },
        { "@type": "City", "name": "Köngen" },
        { "@type": "City", "name": "Wendlingen am Neckar" },
        { "@type": "City", "name": "Stuttgart" },
        { "@type": "Place", "name": "Stuttgart Airport (STR)" },
        { "@type": "Place", "name": "Messe Stuttgart" }
      ],
      "openingHoursSpecification": [
        { "@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "06:00", "closes": "22:00" },
        { "@type": "OpeningHoursSpecification", "dayOfWeek": "Saturday", "opens": "07:00", "closes": "22:00" },
        { "@type": "OpeningHoursSpecification", "dayOfWeek": "Sunday",   "opens": "08:00", "closes": "20:00" }
      ],
      "priceRange": "€€",
      "sameAs": [
        <?php
            $social = [];
            foreach (['fb_link','insta_link','yt_link','tiktok_link','linkedin_link'] as $k) {
                $v = optional($setting ?? null)->$k;
                if (!empty($v)) $social[] = json_encode($v);
            }
        ?>
        <?php echo implode(',', $social); ?>

      ]
    }
    </script>

    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "<?php echo e($baseBrand); ?>",
      "url": "<?php echo e(url('/')); ?>",
      "inLanguage": ["de-DE", "en-US"]
    }
    </script>

    
    <?php echo $__env->make('front.layouts.partials.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="custom-cursor sn-locale-<?php echo e($locale); ?>">

    
    <a class="sn-skip" href="#content">
        <?php echo e($isEN ? 'Skip to content' : 'Zum Inhalt springen'); ?>

    </a>

    <div class="custom-cursor__cursor" aria-hidden="true"></div>
    <div class="custom-cursor__cursor-two" aria-hidden="true"></div>

    
    <div class="loader js-preloader" aria-hidden="true" role="presentation">
        <div></div><div></div><div></div>
    </div>

    <?php echo $__env->make('front.layouts.partials.x-side-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php if ($__env->exists('front.partials.banner.site-banners')) echo $__env->make('front.partials.banner.site-banners', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="page-wrapper">
        <?php echo $__env->make('front.layouts.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="stricky-header stricked-menu main-menu" aria-hidden="true">
            <div class="sticky-header__content"></div>
        </div>

        <main id="content" tabindex="-1" role="main">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('front.layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    
    <div class="mobile-nav__wrapper" role="dialog" aria-modal="true" aria-label="<?php echo e($isEN ? 'Mobile navigation' : 'Mobile-Navigation'); ?>">
        <div class="mobile-nav__overlay mobile-nav__toggler" tabindex="-1"></div>
        <div class="mobile-nav__content">
            <button type="button" class="mobile-nav__close mobile-nav__toggler" aria-label="<?php echo e($isEN ? 'Close menu' : 'Menü schließen'); ?>">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>

            <div class="logo-box">
                <a href="<?php echo e(lroute('front.index')); ?>" aria-label="<?php echo e($baseBrand); ?>">
                    <img src="<?php echo e(asset(optional($setting ?? null)->footer_logo ?? optional($setting ?? null)->logo ?? 'front/assets/images/logo.png')); ?>"
                         width="140" height="40" alt="<?php echo e($baseBrand); ?>">
                </a>
            </div>
            <div class="mobile-nav__container"></div>

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:<?php echo e($emailAddr); ?>"><?php echo e($emailAddr); ?></a>
                </li>
                <li>
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <a href="tel:<?php echo e($phoneE164); ?>"><?php echo e($phoneRaw); ?></a>
                </li>
            </ul>

            <div class="thm-social-link1">
                <ul class="social-box list-unstyled">
                    <?php if(!empty(optional($setting ?? null)->fb_link)): ?>
                        <li><a href="<?php echo e($setting->fb_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty(optional($setting ?? null)->insta_link)): ?>
                        <li><a href="<?php echo e($setting->insta_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty(optional($setting ?? null)->yt_link)): ?>
                        <li><a href="<?php echo e($setting->yt_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty(optional($setting ?? null)->linkedin_link)): ?>
                        <li><a href="<?php echo e($setting->linkedin_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    
    <?php if ($__env->exists('front.partials.legal.cookie-consent')) echo $__env->make('front.partials.legal.cookie-consent', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('front.layouts.partials.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/layouts/master.blade.php ENDPATH**/ ?>