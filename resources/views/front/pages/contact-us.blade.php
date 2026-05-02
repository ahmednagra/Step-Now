@extends('front.layouts.master')

{{-- ============================================================================
     Contact Us page

     Wave 2C revisions:
       • Leaflet map (OpenStreetMap, GDPR-friendly) instead of Google Maps
         iframe — no third-party tracking unless user opts in via cookie
         consent. Map only loads when consent.marketing is granted; before
         consent, a placeholder card with "Show map" button is shown.
       • Three contact channels surfaced: phone, WhatsApp deep-link, email
       • Opening hours block (mandatory for service businesses)
       • Service-area chip cloud (local SEO + visitor expectations)
       • Pre-fills the contact form from query params:
            ?service=ride            → subject defaults to "Ride request"
            ?service=parcel          → subject defaults to "Parcel pickup"
            ?service=quote           → subject defaults to "Quote request"
            ?route=A → B             → subject pre-filled with route
            ?distance=&weight=…      → message pre-filled with parcel estimate
       • The contact form is included from the existing partial
         (front.partials.contact-us.form), which we keep untouched in
         this wave to stay within the 6-file budget. The audit's Wave 4B
         can polish that partial later.
============================================================================ --}}

@section('title', app()->getLocale() === 'en' ? 'Contact' : 'Kontakt')

@section('meta_description',
    app()->getLocale() === 'en'
        ? 'Contact StepNow Rides & Movers — phone, WhatsApp, email, or visit us in Deizisau. Reply within 30 minutes during business hours.'
        : 'Kontaktieren Sie StepNow Rides & Movers — Telefon, WhatsApp, E-Mail oder besuchen Sie uns in Deizisau. Antwort innerhalb von 30 Minuten während der Geschäftszeiten.'
)

@section('content')

@php
    $isEN       = app()->getLocale() === 'en';

    $phoneRaw   = optional($setting ?? null)->phone_no ?? '+49 159 01228856';
    $phoneE164  = optional($setting ?? null)->phone_e164
        ?: '+' . preg_replace('/\D+/', '', $phoneRaw);
    $emailAddr  = optional($setting ?? null)->email ?? 'info@step-now.de';
    $address    = optional($setting ?? null)->address ?? 'Blumenstraße 8, 73779 Deizisau';

    /* WhatsApp deep-link — wa.me strips '+' from E.164 */
    $waNumber   = preg_replace('/\D+/', '', $phoneE164);
    $waMessage  = $isEN
        ? 'Hi, I would like to ask about a ride / parcel pickup.'
        : 'Hallo, ich habe eine Frage zu einer Fahrt / Paketabholung.';
    $waLink     = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage);

    /* Pre-fill from query params */
    $svcParam   = request('service');
    $routeParam = request('route');
    $distance   = request('distance');
    $weight     = request('weight');
    $express    = request('express') === '1';
    $estimate   = request('estimate');

    $prefillSubject = '';
    $prefillMessage = '';

    if ($svcParam === 'ride') {
        $prefillSubject = $isEN ? 'Ride request' : 'Fahrtanfrage';
        if ($routeParam) {
            $prefillSubject .= ' — ' . $routeParam;
        }
    } elseif ($svcParam === 'parcel') {
        $prefillSubject = $isEN ? 'Parcel pickup' : 'Paketabholung';
        if ($distance && $weight) {
            $prefillMessage = $isEN
                ? "Estimated from the parcel calculator:\n• Distance: {$distance} km\n• Weight: {$weight} kg"
                : "Vorberechnung aus dem Paket-Rechner:\n• Entfernung: {$distance} km\n• Gewicht: {$weight} kg";
            if ($express) $prefillMessage .= "\n• " . ($isEN ? 'Express requested' : 'Express gewünscht');
            if ($estimate) {
                $prefillMessage .= "\n• " . ($isEN ? 'Estimated price' : 'Geschätzter Preis')
                                . ': €' . number_format((float) $estimate, 2);
            }
        }
    } elseif ($svcParam === 'quote') {
        $prefillSubject = $isEN ? 'Custom quote request' : 'Individuelle Preisanfrage';
    }
@endphp

{{-- ===== Page header ===== --}}
<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/contact-bg.jpg') }});" aria-hidden="true"></div>
    <div class="page-header__shape-1" aria-hidden="true"
         style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <h3>{{ __('Contact') }}</h3>
            <nav aria-label="{{ $isEN ? 'Breadcrumb' : 'Brotkrumen-Navigation' }}">
                <ol class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                    <li aria-hidden="true">›</li>
                    <li aria-current="page">{{ __('Contact') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- ===== Contact channel cards ===== --}}
<section>
    <div class="container">

        <div class="text-center mb-5">
            <span class="section-title__tagline">{{ __('Get in touch') }}</span>
            <h2 class="section-title__title mt-2">
                {{ $isEN ? 'Three ways to reach us' : 'Drei Wege uns zu erreichen' }}
            </h2>
            <p class="sn-prose mx-auto mt-3">
                {{ $isEN
                    ? 'During business hours we reply within 30 minutes. For urgent transport, calling is fastest.'
                    : 'Während der Geschäftszeiten antworten wir innerhalb von 30 Minuten. Bei dringenden Fahrten geht es am schnellsten per Anruf.' }}
            </p>
        </div>

        <div class="row g-4">

            {{-- Phone --}}
            <div class="col-12 col-md-4">
                <article class="sn-card sn-card--interactive text-center h-100">
                    <div class="mx-auto mb-3" style="width:64px;height:64px;border-radius:50%;background:var(--sn-primary);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-phone" style="color:#fff;font-size:24px;" aria-hidden="true"></i>
                    </div>
                    <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                        {{ $isEN ? 'Call us' : 'Anrufen' }}
                    </small>
                    <h3 class="mt-2 mb-3" style="font-size:var(--sn-fs-h5);">
                        <a href="tel:{{ $phoneE164 }}" style="color:var(--sn-primary);">{{ $phoneRaw }}</a>
                    </h3>
                    <p style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);margin:0;">
                        {{ $isEN ? 'Mon–Fri 06:00–22:00 · Sat 07:00–22:00 · Sun 08:00–20:00' : 'Mo–Fr 06:00–22:00 · Sa 07:00–22:00 · So 08:00–20:00' }}
                    </p>
                </article>
            </div>

            {{-- WhatsApp --}}
            <div class="col-12 col-md-4">
                <article class="sn-card sn-card--interactive text-center h-100">
                    <div class="mx-auto mb-3" style="width:64px;height:64px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;">
                        <i class="fab fa-whatsapp" style="color:#fff;font-size:28px;" aria-hidden="true"></i>
                    </div>
                    <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                        {{ $isEN ? 'Chat with us' : 'WhatsApp' }}
                    </small>
                    <h3 class="mt-2 mb-3" style="font-size:var(--sn-fs-h5);">
                        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" style="color:var(--sn-primary);">
                            {{ $isEN ? 'Open WhatsApp' : 'WhatsApp öffnen' }}
                        </a>
                    </h3>
                    <p style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);margin:0;">
                        {{ $isEN ? 'Quick replies, photos and route screenshots welcome' : 'Schnelle Antworten, gerne mit Foto- oder Routen-Screenshot' }}
                    </p>
                </article>
            </div>

            {{-- Email --}}
            <div class="col-12 col-md-4">
                <article class="sn-card sn-card--interactive text-center h-100">
                    <div class="mx-auto mb-3" style="width:64px;height:64px;border-radius:50%;background:var(--sn-accent);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-envelope" style="color:var(--sn-ink);font-size:24px;" aria-hidden="true"></i>
                    </div>
                    <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                        {{ $isEN ? 'Email us' : 'E-Mail' }}
                    </small>
                    <h3 class="mt-2 mb-3" style="font-size:var(--sn-fs-h5);">
                        <a href="mailto:{{ $emailAddr }}" style="color:var(--sn-primary);word-break:break-word;">{{ $emailAddr }}</a>
                    </h3>
                    <p style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);margin:0;">
                        {{ $isEN ? 'For quotes, business contracts, and detailed enquiries' : 'Für Angebote, Geschäftskunden und ausführliche Anfragen' }}
                    </p>
                </article>
            </div>
        </div>
    </div>
</section>

{{-- ===== Address + map + hours ===== --}}
<section class="sn-section-alt">
    <div class="container">
        <div class="row g-4">

            {{-- Address & hours --}}
            <div class="col-12 col-lg-5">
                <h2 class="section-title__title" style="font-size:var(--sn-fs-h3);">
                    {{ $isEN ? 'Visit our office' : 'Besuchen Sie uns' }}
                </h2>

                <div class="d-flex align-items-start mt-4">
                    <div class="me-3" style="width:40px;height:40px;border-radius:50%;background:var(--sn-primary-100);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-map-marker-alt" style="color:var(--sn-primary);" aria-hidden="true"></i>
                    </div>
                    <div>
                        <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                            {{ $isEN ? 'Address' : 'Adresse' }}
                        </small>
                        <address style="font-style:normal;margin-bottom:0;">
                            <strong>StepNow Rides &amp; Movers e.K.</strong><br>
                            Blumenstraße 8<br>
                            73779 Deizisau<br>
                            Baden-Württemberg, {{ $isEN ? 'Germany' : 'Deutschland' }}
                        </address>
                    </div>
                </div>

                <div class="d-flex align-items-start mt-4">
                    <div class="me-3" style="width:40px;height:40px;border-radius:50%;background:var(--sn-primary-100);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="far fa-clock" style="color:var(--sn-primary);" aria-hidden="true"></i>
                    </div>
                    <div>
                        <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                            {{ __('Opening Hours') }}
                        </small>
                        <table style="width:100%;max-width:280px;font-size:var(--sn-fs-sm);">
                            <tbody>
                                <tr><td>{{ __('Mon – Fri') }}</td><td class="text-end"><strong>06:00 – 22:00</strong></td></tr>
                                <tr><td>{{ __('Saturday') }}</td><td class="text-end"><strong>07:00 – 22:00</strong></td></tr>
                                <tr><td>{{ __('Sunday') }}</td><td class="text-end"><strong>08:00 – 20:00</strong></td></tr>
                            </tbody>
                        </table>
                        <small style="color:var(--sn-ink-3);">
                            <i class="fas fa-plane-departure me-1" aria-hidden="true"></i>
                            {{ $isEN ? '24/7 pre-booked airport transfers' : '24/7 vorgebuchte Flughafentransfers' }}
                        </small>
                    </div>
                </div>

                <div class="d-flex align-items-start mt-4">
                    <div class="me-3" style="width:40px;height:40px;border-radius:50%;background:var(--sn-primary-100);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-globe" style="color:var(--sn-primary);" aria-hidden="true"></i>
                    </div>
                    <div>
                        <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                            {{ __('Service Area') }}
                        </small>
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            @foreach (['Deizisau','Esslingen','Plochingen','Reichenbach','Wernau','Köngen','Wendlingen','Stuttgart','STR Airport','Messe Stuttgart'] as $city)
                                <span class="sn-badge sn-badge--neutral">{{ $city }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Map --}}
            <div class="col-12 col-lg-7">
                <div id="snContactMap"
                     style="height:480px;border-radius:var(--sn-radius-lg);background:var(--sn-bg-tint);position:relative;overflow:hidden;"
                     role="region"
                     aria-label="{{ $isEN ? 'Map showing our office location' : 'Karte mit unserem Bürostandort' }}">

                    {{-- Pre-consent placeholder --}}
                    <div id="snMapPlaceholder"
                         style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:24px;">
                        <i class="fas fa-map" style="font-size:48px;color:var(--sn-primary);margin-bottom:16px;" aria-hidden="true"></i>
                        <p style="color:var(--sn-ink-2);max-width:360px;">
                            {{ $isEN
                                ? 'The map is provided by OpenStreetMap. Loading it transmits your IP to a third-party server. Click the button to load the map.'
                                : 'Die Karte wird von OpenStreetMap bereitgestellt. Beim Laden wird Ihre IP-Adresse an einen Drittanbieter übermittelt. Klicken Sie zum Laden auf den Knopf.' }}
                        </p>
                        <button type="button" id="snLoadMapBtn" class="thm-btn mt-3">
                            <i class="fas fa-map-marked-alt me-2" aria-hidden="true"></i>
                            {{ $isEN ? 'Show map' : 'Karte anzeigen' }}
                        </button>
                        <small style="color:var(--sn-ink-3);margin-top:12px;">
                            <a href="https://www.openstreetmap.org/?mlat=48.7242&mlon=9.3686#map=16/48.7242/9.3686"
                               target="_blank" rel="noopener noreferrer" style="text-decoration:underline;">
                                {{ $isEN ? 'Open in OpenStreetMap' : 'In OpenStreetMap öffnen' }}
                            </a>
                        </small>
                    </div>

                    {{-- Map container (Leaflet attaches here) --}}
                    <div id="snMapInner" style="position:absolute;inset:0;display:none;"></div>
                </div>

                <div class="mt-3 d-flex flex-wrap gap-2">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Blumenstra%C3%9Fe+8,+73779+Deizisau"
                       target="_blank" rel="noopener noreferrer"
                       class="thm-btn thm-btn--outline thm-btn--sm">
                        <i class="fas fa-directions me-1" aria-hidden="true"></i>
                        {{ $isEN ? 'Get directions (Google)' : 'Wegbeschreibung (Google)' }}
                    </a>
                    <a href="https://www.openstreetmap.org/?mlat=48.7242&mlon=9.3686#map=16/48.7242/9.3686"
                       target="_blank" rel="noopener noreferrer"
                       class="thm-btn thm-btn--outline thm-btn--sm">
                        <i class="fas fa-map me-1" aria-hidden="true"></i>
                        OpenStreetMap
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Contact form (kept from existing partial) ===== --}}
@php
    /* Pass prefill values down to the form partial via view-shared variables */
    View::share('contact_prefill', [
        'subject' => $prefillSubject,
        'message' => $prefillMessage,
    ]);
@endphp

@includeIf('front.partials.contact-us.form')

@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin="" media="print" onload="this.media='all'">

<script>
(function () {
    'use strict';

    var btn      = document.getElementById('snLoadMapBtn');
    var ph       = document.getElementById('snMapPlaceholder');
    var inner    = document.getElementById('snMapInner');
    if (!btn || !ph || !inner) return;

    var loaded = false;

    function loadLeaflet() {
        if (loaded) return;
        loaded = true;

        /* Lazy-load Leaflet JS only when the user clicks "Show map" */
        var script = document.createElement('script');
        script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
        script.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
        script.crossOrigin = '';
        script.onload = function () {
            ph.style.display = 'none';
            inner.style.display = 'block';

            var map = L.map('snMapInner', { scrollWheelZoom: false }).setView([48.7242, 9.3686], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([48.7242, 9.3686]).addTo(map)
                .bindPopup('<strong>StepNow Rides &amp; Movers e.K.</strong><br>Blumenstraße 8<br>73779 Deizisau')
                .openPopup();
        };
        script.onerror = function () {
            inner.innerHTML = '<p style="text-align:center;padding:24px;color:var(--sn-danger);">Map could not be loaded.</p>';
            ph.style.display = 'none';
            inner.style.display = 'block';
        };
        document.body.appendChild(script);
    }

    btn.addEventListener('click', loadLeaflet);

    /* If the user has already granted marketing consent, auto-load the map */
    if (window.stepnowConsent && window.stepnowConsent.marketing === true) {
        loadLeaflet();
    }
    /* Listen for consent changes */
    document.addEventListener('stepnow.consent.changed', function (ev) {
        if (ev.detail && ev.detail.marketing === true) loadLeaflet();
    });

    /* Pre-fill contact form from query params */
    var subjectInput = document.querySelector('#cf_subject, [name="subject"]');
    var messageInput = document.querySelector('#cf_message, [name="enquiry_message"]');
    var prefill      = @json($prefillSubject ? ['subject' => $prefillSubject, 'message' => $prefillMessage] : null);
    if (prefill && subjectInput && !subjectInput.value) subjectInput.value = prefill.subject;
    if (prefill && messageInput && !messageInput.value && prefill.message) messageInput.value = prefill.message;
})();
</script>
@endpush
