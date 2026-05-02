<?php $__env->startSection('title', app()->getLocale() === 'en' ? 'About Us' : 'Über uns'); ?>

<?php $__env->startSection('meta_description',
    app()->getLocale() === 'en'
        ? 'Get to know StepNow Rides & Movers — owner Naeem Ahmad, our fleet, our regional service area, and how we work in Deizisau and the Esslingen / Stuttgart region.'
        : 'Lernen Sie StepNow Rides & Movers kennen — Inhaber Naeem Ahmad, unser Fuhrpark, unser regionales Einsatzgebiet und unsere Arbeitsweise in Deizisau und der Region Esslingen / Stuttgart.'
); ?>

<?php $__env->startSection('content'); ?>

<?php
    $isEN = app()->getLocale() === 'en';

    $phoneRaw   = optional($setting ?? null)->phone_no  ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);

    /* PLACEHOLDER fleet — replace with DB-driven Fleet model later */
    $fleet = [
        [
            'name'       => $isEN ? 'Mercedes-Benz E-Class' : 'Mercedes-Benz E-Klasse',
            'category'   => $isEN ? 'Limousine' : 'Limousine',
            'capacity'   => $isEN ? 'Up to 3 passengers · 3 suitcases' : 'Bis 3 Personen · 3 Koffer',
            'icon'       => 'car-side',
            'features'   => $isEN
                ? ['Air-conditioned', 'Leather seats', 'Bottled water', 'Phone charger']
                : ['Klimatisiert', 'Lederausstattung', 'Wasserflaschen', 'Handy-Ladegerät'],
        ],
        [
            'name'       => 'Volkswagen Sharan',
            'category'   => 'Van',
            'capacity'   => $isEN ? 'Up to 6 passengers · 4 suitcases' : 'Bis 6 Personen · 4 Koffer',
            'icon'       => 'shuttle-van',
            'features'   => $isEN
                ? ['Family-friendly', 'Child seats on request', 'Air-conditioned']
                : ['Familienfreundlich', 'Kindersitze auf Anfrage', 'Klimatisiert'],
        ],
        [
            'name'       => 'Mercedes-Benz Vito',
            'category'   => $isEN ? 'Cargo van' : 'Transporter',
            'capacity'   => $isEN ? 'Up to 1 m³ cargo · max 30 kg per parcel' : 'Bis 1 m³ Ladung · max. 30 kg pro Paket',
            'icon'       => 'truck',
            'features'   => $isEN
                ? ['Lockable cargo', 'Same-day delivery', 'Documents and fragile items']
                : ['Abschließbarer Laderaum', 'Taggleiche Zustellung', 'Dokumente & zerbrechliche Sendungen'],
        ],
    ];

    /* Commitments / KPIs (these should be real, not vanity numbers) */
    $kpis = [
        ['value' => '30 min',  'label' => $isEN ? 'Reply time during business hours' : 'Antwortzeit zur Geschäftszeit'],
        ['value' => '24/7',    'label' => $isEN ? 'Pre-booked airport transfers'      : 'Vorgebuchte Flughafentransfers'],
        ['value' => '10+',     'label' => $isEN ? 'Cities served regionally'           : 'Regionale Städte bedient'],
        ['value' => '€',       'label' => $isEN ? 'Fixed prices, no surprises'         : 'Festpreise, keine Überraschungen'],
    ];
?>


<section class="page-header">
    <div class="page-header__bg" style="background-image: url(<?php echo e(asset('front/assets/images/about-bg.jpg')); ?>);" aria-hidden="true"></div>
    <div class="page-header__shape-1" aria-hidden="true"
         style="background-image: url(<?php echo e(asset('front/assets/images/shapes/page-header-shape-1.png')); ?>);"></div>
    <div class="container">
        <div class="page-header__inner">
            <h3><?php echo e(__('About Us')); ?></h3>
            <nav aria-label="<?php echo e($isEN ? 'Breadcrumb' : 'Brotkrumen-Navigation'); ?>">
                <ol class="thm-breadcrumb list-unstyled">
                    <li><a href="<?php echo e(lroute('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
                    <li aria-hidden="true">›</li>
                    <li aria-current="page"><?php echo e(__('About Us')); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row align-items-center g-4">

            <div class="col-12 col-lg-5">
                <div style="position:relative;">
                    <img src="<?php echo e(asset('front/assets/images/owner-portrait.jpg')); ?>"
                         alt="<?php echo e($isEN ? 'Naeem Ahmad — owner of StepNow Rides & Movers' : 'Naeem Ahmad — Inhaber StepNow Rides & Movers'); ?>"
                         loading="lazy" decoding="async"
                         width="600" height="700"
                         style="width:100%;height:auto;border-radius:var(--sn-radius-lg);box-shadow:var(--sn-shadow-lg);">
                    <div class="position-absolute"
                         style="bottom:-24px;right:-24px;background:var(--sn-accent);padding:24px;border-radius:var(--sn-radius-lg);max-width:200px;box-shadow:var(--sn-shadow-md);">
                        <strong style="color:var(--sn-ink);font-size:var(--sn-fs-h6);">
                            <?php echo e($isEN ? 'Family-run since 2026' : 'Familienbetrieb seit 2026'); ?>

                        </strong>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <span class="section-title__tagline"><?php echo e($isEN ? 'About the owner' : 'Über den Inhaber'); ?></span>
                <h2 class="section-title__title mt-2">
                    <?php echo e($isEN ? 'Local, licensed, and personally accountable.' : 'Regional, konzessioniert und persönlich verantwortlich.'); ?>

                </h2>

                <div class="sn-prose mt-3">
                    <?php if($isEN): ?>
                        <p>
                            StepNow Rides &amp; Movers is run by <strong>Naeem Ahmad</strong> from our base in Deizisau.
                            We're not a faceless dispatch — when you call the number on this site, you're speaking
                            with the team that drives the route.
                        </p>
                        <p>
                            We hold a <strong>licensed Mietwagen passenger transport authorization</strong> under the
                            German Personenbeförderungsgesetz (PBefG), and we operate as
                            <strong>StepNow Rides &amp; Movers e.K.</strong>, registered with Amtsgericht Stuttgart
                            (HRA 742905). Every ride is insured and pre-booked — we are not a taxi operator.
                        </p>
                        <p>
                            For parcels, we run a regional same-day pickup service across the Esslingen district.
                            No depot stops, no anonymous warehouses — your shipment goes directly from the sender's
                            door to the recipient's.
                        </p>
                    <?php else: ?>
                        <p>
                            StepNow Rides &amp; Movers wird von <strong>Naeem Ahmad</strong> aus unserem Standort
                            in Deizisau geführt. Wir sind keine anonyme Vermittlung — wenn Sie die Nummer auf dieser
                            Website anrufen, sprechen Sie mit dem Team, das die Fahrt auch wirklich durchführt.
                        </p>
                        <p>
                            Wir verfügen über eine <strong>Konzession zur Mietwagen-Personenbeförderung</strong> nach
                            dem Personenbeförderungsgesetz (PBefG) und treten als
                            <strong>StepNow Rides &amp; Movers e.K.</strong> auf, eingetragen beim Amtsgericht Stuttgart
                            (HRA 742905). Jede Fahrt ist versichert und ausschließlich auf Vorbestellung — wir
                            betreiben kein Taxigewerbe.
                        </p>
                        <p>
                            Für Pakete betreiben wir einen regionalen Sofort-Abholdienst im Landkreis Esslingen.
                            Keine Depot-Umwege, keine anonymen Lager — Ihre Sendung geht direkt von der Tür des
                            Absenders zur Tür des Empfängers.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="<?php echo e(lroute('front.pricing')); ?>" class="thm-btn">
                        <?php echo e($isEN ? 'See our pricing' : 'Unsere Preise'); ?>

                        <span class="fas fa-arrow-right" aria-hidden="true"></span>
                    </a>
                    <a href="tel:<?php echo e($phoneE164); ?>" class="thm-btn thm-btn--outline">
                        <i class="fas fa-phone me-1" aria-hidden="true"></i>
                        <?php echo e($phoneRaw); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="sn-section-tint sn-section-tight">
    <div class="container">
        <div class="row g-4 text-center">
            <?php $__currentLoopData = $kpis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kpi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-3">
                    <div style="font-size:var(--sn-fs-h1);font-weight:var(--sn-fw-bold);color:var(--sn-primary);line-height:1;">
                        <?php echo e($kpi['value']); ?>

                    </div>
                    <p class="mt-2 mb-0" style="color:var(--sn-ink-2);font-size:var(--sn-fs-sm);">
                        <?php echo e($kpi['label']); ?>

                    </p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-title__tagline"><?php echo e($isEN ? 'Our fleet' : 'Unser Fuhrpark'); ?></span>
            <h2 class="section-title__title mt-2">
                <?php echo e($isEN ? 'The right vehicle for every trip' : 'Das passende Fahrzeug für jede Fahrt'); ?>

            </h2>
            <p class="sn-prose mx-auto mt-3">
                <?php echo e($isEN
                    ? 'We operate three vehicle classes covering most use cases. Special vehicle requests on request.'
                    : 'Wir betreiben drei Fahrzeugklassen, die die meisten Anwendungsfälle abdecken. Sonderfahrzeuge auf Anfrage.'); ?>

            </p>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $fleet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="sn-card sn-card--interactive h-100">
                        <div class="mb-3" style="width:64px;height:64px;border-radius:var(--sn-radius-lg);background:var(--sn-primary-100);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-<?php echo e($vehicle['icon']); ?>" style="color:var(--sn-primary);font-size:28px;" aria-hidden="true"></i>
                        </div>

                        <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                            <?php echo e($vehicle['category']); ?>

                        </small>
                        <h3 class="mt-1 mb-2" style="font-size:var(--sn-fs-h5);">
                            <?php echo e($vehicle['name']); ?>

                        </h3>
                        <p style="color:var(--sn-ink-2);font-size:var(--sn-fs-sm);">
                            <?php echo e($vehicle['capacity']); ?>

                        </p>

                        <ul class="list-unstyled mt-3 mb-0">
                            <?php $__currentLoopData = $vehicle['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="d-flex align-items-start mb-1">
                                    <i class="fas fa-check me-2 mt-1" style="color:var(--sn-success);font-size:12px;" aria-hidden="true"></i>
                                    <span style="font-size:var(--sn-fs-sm);color:var(--sn-ink-2);"><?php echo e($feat); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </article>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <p class="text-center mt-4" style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);">
            <?php echo e($isEN
                ? 'All vehicles non-smoking, climate-controlled, and serviced regularly. Child seats and accessibility features available on request.'
                : 'Alle Fahrzeuge nichtraucher, klimatisiert und regelmäßig gewartet. Kindersitze und barrierefreie Optionen auf Anfrage.'); ?>

        </p>
    </div>
</section>


<section class="sn-section-alt">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-12 col-lg-6">
                <span class="section-title__tagline"><?php echo e(__('Service Area')); ?></span>
                <h2 class="section-title__title mt-2">
                    <?php echo e($isEN ? 'Where we operate' : 'Wo wir unterwegs sind'); ?>

                </h2>
                <p class="sn-prose mt-3">
                    <?php echo e($isEN
                        ? 'Our regular service area covers Deizisau, the surrounding Esslingen district, the city of Stuttgart, and Stuttgart Airport (STR). Trips outside this area are available on request — we serve all of Baden-Württemberg with advance booking.'
                        : 'Unser regelmäßiges Einsatzgebiet umfasst Deizisau, den Landkreis Esslingen, Stuttgart und den Flughafen Stuttgart (STR). Fahrten außerhalb dieses Gebiets auf Anfrage — wir bedienen ganz Baden-Württemberg mit Vorbestellung.'); ?>

                </p>

                <div class="d-flex flex-wrap gap-1 mt-4">
                    <?php $__currentLoopData = ['Deizisau','Esslingen am Neckar','Plochingen','Reichenbach an der Fils','Wernau','Köngen','Wendlingen am Neckar','Altbach','Lichtenwald','Stuttgart','Stuttgart Airport (STR)','Messe Stuttgart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="sn-badge sn-badge--primary"><?php echo e($city); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <a href="<?php echo e(lroute('front.contactus')); ?>" style="display:block;text-decoration:none;">
                    <div class="sn-card sn-card--interactive text-center" style="padding:48px 24px;">
                        <i class="fas fa-map-marked-alt" style="font-size:64px;color:var(--sn-primary);margin-bottom:16px;" aria-hidden="true"></i>
                        <h3 style="font-size:var(--sn-fs-h4);">
                            <?php echo e($isEN ? 'See exact pickup point on the map' : 'Abholpunkt auf der Karte ansehen'); ?>

                        </h3>
                        <p style="color:var(--sn-ink-3);">
                            <?php echo e($isEN
                                ? 'Open the contact page to view our office location with directions.'
                                : 'Öffnen Sie die Kontaktseite, um den Standort mit Wegbeschreibung anzuzeigen.'); ?>

                        </p>
                        <span class="thm-btn thm-btn--ghost">
                            <?php echo e($isEN ? 'Open contact page' : 'Kontaktseite öffnen'); ?>

                            <span class="fas fa-arrow-right" aria-hidden="true"></span>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<?php if(isset($why_choose_us) && $why_choose_us): ?>
    <?php if ($__env->exists('front.partials.why-choose-us.why-choose-us-1')) echo $__env->make('front.partials.why-choose-us.why-choose-us-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php if(isset($testimonial) && $testimonial && $testimonial->details && $testimonial->details->count()): ?>
    <?php if ($__env->exists('front.partials.testimonial.testimonial-1')) echo $__env->make('front.partials.testimonial.testimonial-1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>


<section class="sn-section-tint">
    <div class="container text-center">
        <h2 class="section-title__title">
            <?php echo e($isEN ? 'Ready when you are' : 'Wir sind bereit, wenn Sie es sind'); ?>

        </h2>
        <p class="sn-prose mx-auto mt-3">
            <?php echo e($isEN
                ? 'Pre-booked rides, regional parcel pickup, and free quotes for anything else. Reply within 30 minutes during business hours.'
                : 'Fahrten auf Vorbestellung, regionaler Paketdienst und kostenlose Angebote für alles andere. Antwort innerhalb von 30 Minuten zur Geschäftszeit.'); ?>

        </p>
        <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
            <a href="<?php echo e(lroute('front.pricing')); ?>" class="thm-btn">
                <?php echo e($isEN ? 'See pricing' : 'Preise ansehen'); ?>

                <span class="fas fa-arrow-right" aria-hidden="true"></span>
            </a>
            <a href="<?php echo e(lroute('front.contactus')); ?>" class="thm-btn thm-btn--outline">
                <?php echo e($isEN ? 'Contact us' : 'Kontaktieren Sie uns'); ?>

            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Step-Now\resources\views/front/pages/about-us.blade.php ENDPATH**/ ?>