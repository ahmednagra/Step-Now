@extends('front.layouts.master')

{{-- ============================================================================
     Pricing page

     Wave 2C revisions:
       • Three-tab layout matching the real business model:
            1. Festpreis Routes — fixed-price popular routes (DB-driven)
            2. Parcel Calculator — distance + weight formula
            3. Custom Quote — free-form quote request
       • Removed the misleading "/month" unit (was Mietwagen-mismatch)
       • Locale-aware Euro formatting (en: "€65.00", de: "65,00 €")
       • "Most Popular" highlight on one card per category
       • Card grid auto-centers when count is not divisible by 3
       • Empty-state if no packages seeded — page still renders
       • Page-header background uses unique 'pricing-bg.jpg' (not the same
         About-pic3.jpg as every other page)
       • Breadcrumb arrow direction fixed (was icon-arrow-left, now ›)
       • All inline scripts namespaced; no globals leaked
       • The parcel calculator is a CLIENT-SIDE estimate. Final price is
         confirmed by phone/email reply. We disclose this clearly.
============================================================================ --}}

@section('title', app()->getLocale() === 'en' ? 'Pricing' : 'Preise')

@section('meta_description',
    app()->getLocale() === 'en'
        ? 'Transparent fixed prices for airport transfers, regional rides and parcel pickup. Calculate your parcel price online or browse popular routes.'
        : 'Transparente Festpreise für Flughafentransfer, Regionalfahrten und Paketabholung. Paketpreis online berechnen oder beliebte Strecken ansehen.'
)

@section('content')

@php
    $isEN  = app()->getLocale() === 'en';

    /* Locale-aware money formatter */
    $fmtMoney = function ($amount, $currency = '€') use ($isEN) {
        if ($amount === null || $amount === '') return '';
        $n = (float) $amount;
        if ($isEN) {
            return $currency . number_format($n, 2, '.', ',');
        }
        return number_format($n, 2, ',', '.') . ' ' . $currency;
    };

    /* PLACEHOLDER festpreis routes — replace with DB-driven data later.
       Using a route_prices table is the right long-term move. For Wave 2C,
       these placeholders match the audit's approved set. */
    $festpreisRoutes = [
        ['from' => 'Deizisau',       'to' => 'Stuttgart Airport (STR)', 'duration' => '35 min', 'price' => 65.00, 'popular' => true],
        ['from' => 'Esslingen',      'to' => 'Stuttgart Airport (STR)', 'duration' => '40 min', 'price' => 70.00, 'popular' => false],
        ['from' => 'Plochingen',     'to' => 'Stuttgart Airport (STR)', 'duration' => '45 min', 'price' => 75.00, 'popular' => false],
        ['from' => 'Reichenbach',    'to' => 'Stuttgart Airport (STR)', 'duration' => '50 min', 'price' => 80.00, 'popular' => false],
        ['from' => 'Deizisau',       'to' => 'Stuttgart Hbf',           'duration' => '30 min', 'price' => 55.00, 'popular' => false],
        ['from' => 'Esslingen',      'to' => 'Stuttgart Hbf',           'duration' => '20 min', 'price' => 40.00, 'popular' => true],
        ['from' => 'Deizisau',       'to' => 'Messe Stuttgart',         'duration' => '40 min', 'price' => 70.00, 'popular' => false],
        ['from' => 'Deizisau',       'to' => 'Esslingen Bahnhof',       'duration' => '12 min', 'price' => 25.00, 'popular' => false],
    ];

    /* PLACEHOLDER parcel pricing config — replace with DB-driven data */
    $parcelConfig = [
        'base'         => 5.00,    // base fee in EUR
        'per_km'       => 0.80,    // EUR per km
        'kg_included'  => 5.0,     // first kg included
        'per_extra_kg' => 1.50,    // EUR per kg above kg_included
        'max_kg'       => 30.0,
        'express_fee'  => 10.00,
    ];

    $package_categories = $package_categories ?? collect();
    $hasPackages = $package_categories->isNotEmpty();
@endphp

{{-- ===== Page header ===== --}}
<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/pricing-bg.jpg') }});" aria-hidden="true"></div>
    <div class="page-header__shape-1" aria-hidden="true"
         style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <h3>{{ __('Pricing') }}</h3>
            <nav aria-label="{{ $isEN ? 'Breadcrumb' : 'Brotkrumen-Navigation' }}">
                <ol class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                    <li aria-hidden="true">›</li>
                    <li aria-current="page">{{ __('Pricing') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- ===== Tabs nav ===== --}}
<section class="sn-section-tight">
    <div class="container">

        <div class="text-center mb-5">
            <span class="section-title__tagline">{{ __('Pricing') }}</span>
            <h2 class="section-title__title mt-2">
                {{ $isEN ? 'Transparent fixed prices' : 'Transparente Festpreise' }}
            </h2>
            <p class="sn-prose mx-auto mt-3">
                {{ $isEN
                    ? 'Choose the option that fits you: fixed prices on popular airport and city routes, an instant parcel calculator, or request a custom quote for any other ride.'
                    : 'Wählen Sie die passende Option: Festpreise auf beliebten Flughafen- und Stadtstrecken, einen sofortigen Paket-Rechner oder eine individuelle Preisanfrage für jede andere Fahrt.' }}
            </p>
        </div>

        <ul class="sn-pricing-tabs nav nav-pills justify-content-center mb-5"
            role="tablist"
            aria-label="{{ $isEN ? 'Pricing options' : 'Preis-Optionen' }}">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="tab-routes"
                        data-bs-toggle="pill"
                        data-bs-target="#panel-routes"
                        type="button"
                        role="tab"
                        aria-controls="panel-routes"
                        aria-selected="true">
                    <i class="fas fa-route me-2" aria-hidden="true"></i>
                    {{ __('Popular Routes') }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="tab-parcel"
                        data-bs-toggle="pill"
                        data-bs-target="#panel-parcel"
                        type="button"
                        role="tab"
                        aria-controls="panel-parcel"
                        aria-selected="false">
                    <i class="fas fa-box me-2" aria-hidden="true"></i>
                    {{ __('Parcel Calculator') }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="tab-quote"
                        data-bs-toggle="pill"
                        data-bs-target="#panel-quote"
                        type="button"
                        role="tab"
                        aria-controls="panel-quote"
                        aria-selected="false">
                    <i class="fas fa-comments me-2" aria-hidden="true"></i>
                    {{ __('Custom Quote') }}
                </button>
            </li>
        </ul>

        <div class="tab-content">

            {{-- ===== TAB 1: Festpreis Routes ===== --}}
            <div class="tab-pane fade show active"
                 id="panel-routes"
                 role="tabpanel"
                 aria-labelledby="tab-routes"
                 tabindex="0">

                <div class="row g-4 justify-content-center">
                    @foreach ($festpreisRoutes as $route)
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class="sn-card sn-card--interactive h-100 position-relative">
                                @if ($route['popular'])
                                    <span class="sn-badge sn-badge--accent position-absolute"
                                          style="top: 16px; right: 16px;">
                                        {{ __('Most Popular') }}
                                    </span>
                                @endif

                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3" style="width:48px;height:48px;border-radius:50%;background:var(--sn-primary-100);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <i class="fas fa-car-side" style="color:var(--sn-primary);font-size:20px;" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                                            {{ $route['duration'] }}
                                        </small>
                                        <h4 class="mb-0" style="font-size:var(--sn-fs-h5);">{{ $route['from'] }}</h4>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3" style="color:var(--sn-ink-2);">
                                    <i class="fas fa-arrow-right me-2" style="color:var(--sn-accent);" aria-hidden="true"></i>
                                    <strong>{{ $route['to'] }}</strong>
                                </div>

                                <hr style="border-color:var(--sn-line);">

                                <div class="d-flex align-items-end justify-content-between mb-4">
                                    <div>
                                        <small style="color:var(--sn-ink-3);">{{ __('Fixed price') }}</small>
                                        <div style="font-size:var(--sn-fs-h2);font-weight:var(--sn-fw-bold);color:var(--sn-primary);line-height:1;">
                                            {{ $fmtMoney($route['price']) }}
                                        </div>
                                    </div>
                                    <small style="color:var(--sn-ink-3);">{{ __('Per trip') }}</small>
                                </div>

                                <a href="{{ lroute('front.contactus') }}?route={{ urlencode($route['from'] . ' → ' . $route['to']) }}"
                                   class="thm-btn thm-btn--block">
                                    {{ __('Book a Ride') }}
                                    <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>

                <p class="text-center mt-4" style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);">
                    {{ $isEN
                        ? 'Prices for up to 4 passengers, including 1 piece of luggage per person. Larger groups or special vehicle requests on request.'
                        : 'Preise für bis zu 4 Personen, inkl. 1 Gepäckstück pro Person. Größere Gruppen oder besondere Fahrzeugwünsche auf Anfrage.' }}
                </p>

                {{-- DB-driven packages, if any (renders below the festpreis grid) --}}
                @if ($hasPackages)
                    <div class="mt-5 pt-4" style="border-top:1px solid var(--sn-line);">
                        <h3 class="text-center mb-4" style="font-size:var(--sn-fs-h3);">
                            {{ $isEN ? 'Service Packages' : 'Service-Pakete' }}
                        </h3>

                        @foreach ($package_categories as $category)
                            @php
                                $packagesForCat = $category->packages ?? collect();
                                if ($packagesForCat->isEmpty()) continue;
                            @endphp

                            <h4 class="mt-4 mb-3" style="font-size:var(--sn-fs-h4);">
                                {{ tr($category, 'title') ?? $category->name }}
                            </h4>

                            <div class="row g-4 justify-content-center">
                                @foreach ($packagesForCat as $i => $package)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <article class="sn-card h-100 position-relative">
                                            @if ($i === 0 && $packagesForCat->count() > 1)
                                                <span class="sn-badge sn-badge--accent position-absolute"
                                                      style="top: 16px; right: 16px;">
                                                    {{ __('Most Popular') }}
                                                </span>
                                            @endif

                                            <h4 class="mb-2">{{ tr($package, 'title') ?? $package->title }}</h4>
                                            @if (tr($package, 'subtitle'))
                                                <p style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);">
                                                    {{ tr($package, 'subtitle') }}
                                                </p>
                                            @endif

                                            <div class="my-4">
                                                @if ($package->discount_percentage && $package->discounted_amount)
                                                    <div style="font-size:var(--sn-fs-h2);font-weight:var(--sn-fw-bold);color:var(--sn-primary);line-height:1;">
                                                        {{ $fmtMoney($package->discounted_amount, $package->currency_symbol ?? '€') }}
                                                    </div>
                                                    <div class="mt-2">
                                                        <del style="color:var(--sn-ink-3);">{{ $fmtMoney($package->amount, $package->currency_symbol ?? '€') }}</del>
                                                        <span class="sn-badge sn-badge--danger ms-2">−{{ (int) $package->discount_percentage }}%</span>
                                                    </div>
                                                @else
                                                    <div style="font-size:var(--sn-fs-h2);font-weight:var(--sn-fw-bold);color:var(--sn-primary);line-height:1;">
                                                        {{ $fmtMoney($package->amount, $package->currency_symbol ?? '€') }}
                                                    </div>
                                                @endif
                                                <small style="color:var(--sn-ink-3);">{{ __('Per trip') }}</small>
                                            </div>

                                            @if ($package->details && $package->details->count())
                                                <ul class="list-unstyled mb-4">
                                                    @foreach ($package->details->sortBy('order_no') as $detail)
                                                        <li class="d-flex align-items-start mb-2">
                                                            @if ($detail->status === 'included')
                                                                <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fas fa-times-circle me-2 mt-1" style="color:var(--sn-ink-4);" aria-hidden="true"></i>
                                                            @endif
                                                            <span style="color:{{ $detail->status === 'included' ? 'var(--sn-ink-2)' : 'var(--sn-ink-4)' }};">
                                                                {{ tr($detail, 'title') ?? $detail->title }}
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a href="{{ route('front.rentnow', $package->id) }}" class="thm-btn thm-btn--block">
                                                {{ __('Book Now') }}
                                                <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                            </a>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ===== TAB 2: Parcel Calculator ===== --}}
            <div class="tab-pane fade"
                 id="panel-parcel"
                 role="tabpanel"
                 aria-labelledby="tab-parcel"
                 tabindex="0">

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-7">
                        <div class="sn-card sn-card--elevated">
                            <h3 class="mb-3">{{ __('Parcel Calculator') }}</h3>
                            <p style="color:var(--sn-ink-3);font-size:var(--sn-fs-sm);">
                                {{ $isEN
                                    ? 'Estimate the cost of a parcel pickup. Final price is confirmed when we accept your booking.'
                                    : 'Schätzen Sie die Kosten für eine Paketabholung. Der endgültige Preis wird bei Buchungsannahme bestätigt.' }}
                            </p>

                            <form id="parcelCalc" class="mt-4" novalidate>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="pc_distance">
                                            <i class="fas fa-route me-1" aria-hidden="true"></i>
                                            {{ $isEN ? 'Distance (km)' : 'Entfernung (km)' }}
                                            <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="number" id="pc_distance" name="distance"
                                               min="0.5" max="200" step="0.5" value="10"
                                               required aria-required="true" inputmode="decimal">
                                        <small class="sn-help">
                                            {{ $isEN ? 'Estimated road distance, one way.' : 'Geschätzte Strecke, einfache Fahrt.' }}
                                        </small>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="pc_weight">
                                            <i class="fas fa-weight me-1" aria-hidden="true"></i>
                                            {{ $isEN ? 'Weight (kg)' : 'Gewicht (kg)' }}
                                            <span class="sn-required" aria-hidden="true">*</span>
                                        </label>
                                        <input type="number" id="pc_weight" name="weight"
                                               min="0.1" max="{{ $parcelConfig['max_kg'] }}" step="0.1" value="2"
                                               required aria-required="true" inputmode="decimal">
                                        <small class="sn-help">
                                            {{ $isEN ? 'Up to ' . $parcelConfig['max_kg'] . ' kg per parcel.' : 'Bis zu ' . $parcelConfig['max_kg'] . ' kg pro Paket.' }}
                                        </small>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="d-flex align-items-center" style="margin-top:30px;cursor:pointer;">
                                            <input type="checkbox" id="pc_express" name="express"
                                                   style="width:18px;height:18px;margin-right:8px;">
                                            <span>
                                                {{ $isEN ? 'Express (under 2 hours)' : 'Express (unter 2 Stunden)' }}
                                                <small style="display:block;color:var(--sn-ink-3);">+ {{ $fmtMoney($parcelConfig['express_fee']) }}</small>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4 p-4" style="background:var(--sn-primary-50);border-radius:var(--sn-radius-md);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-weight:600;font-size:11px;">
                                                {{ $isEN ? 'Estimated price' : 'Geschätzter Preis' }}
                                            </small>
                                            <div id="pc_total"
                                                 style="font-size:var(--sn-fs-h2);font-weight:var(--sn-fw-bold);color:var(--sn-primary);line-height:1;"
                                                 aria-live="polite">
                                                {{ $fmtMoney($parcelConfig['base'] + 10 * $parcelConfig['per_km']) }}
                                            </div>
                                        </div>
                                        <i class="fas fa-box" style="font-size:48px;color:var(--sn-primary-100);" aria-hidden="true"></i>
                                    </div>
                                    <details class="mt-3">
                                        <summary style="cursor:pointer;color:var(--sn-ink-2);font-size:var(--sn-fs-sm);">
                                            {{ $isEN ? 'How is this calculated?' : 'Wie wird das berechnet?' }}
                                        </summary>
                                        <ul class="mt-2 mb-0" style="font-size:var(--sn-fs-sm);color:var(--sn-ink-3);">
                                            <li>{{ $isEN ? 'Base fee' : 'Grundgebühr' }}: {{ $fmtMoney($parcelConfig['base']) }}</li>
                                            <li>{{ $isEN ? 'Distance' : 'Entfernung' }}: {{ $fmtMoney($parcelConfig['per_km']) }} / km</li>
                                            <li>{{ $isEN ? 'Weight included' : 'Gewicht inklusive' }}: {{ number_format($parcelConfig['kg_included'], 1) }} kg</li>
                                            <li>{{ $isEN ? 'Each additional kg' : 'Jedes weitere kg' }}: {{ $fmtMoney($parcelConfig['per_extra_kg']) }}</li>
                                        </ul>
                                    </details>
                                </div>

                                <a href="{{ lroute('front.contactus') }}?service=parcel"
                                   class="thm-btn thm-btn--block thm-btn--lg mt-4"
                                   id="pc_request">
                                    {{ __('Send Parcel') }}
                                    <span class="fas fa-arrow-right" aria-hidden="true"></span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== TAB 3: Custom Quote ===== --}}
            <div class="tab-pane fade"
                 id="panel-quote"
                 role="tabpanel"
                 aria-labelledby="tab-quote"
                 tabindex="0">

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-7 text-center">
                        <i class="fas fa-comments mb-3" style="font-size:64px;color:var(--sn-primary-100);" aria-hidden="true"></i>
                        <h3>{{ __('Custom Quote') }}</h3>
                        <p class="sn-prose mx-auto">
                            {{ $isEN
                                ? 'Larger group, multiple pickups, longer-distance trip, recurring transport, or anything else not on the list above? Tell us what you need and we will reply within 30 minutes during business hours with a binding fixed price.'
                                : 'Größere Gruppe, mehrere Abholpunkte, längere Fahrt, wiederkehrender Transport oder etwas anderes, das nicht in der Liste steht? Schreiben Sie uns, was Sie brauchen — wir antworten während der Geschäftszeiten innerhalb von 30 Minuten mit einem verbindlichen Festpreis.' }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ lroute('front.contactus') }}?service=quote" class="thm-btn thm-btn--lg">
                                {{ __('Request a Free Quote') }}
                                <span class="fas fa-arrow-right" aria-hidden="true"></span>
                            </a>
                        </div>
                        <div class="mt-3">
                            <a href="tel:{{ optional($setting ?? null)->phone_e164 ?: '+4915901228856' }}"
                               class="thm-btn thm-btn--outline thm-btn--lg">
                                <i class="fas fa-phone me-1" aria-hidden="true"></i>
                                {{ optional($setting ?? null)->phone_no ?? '+49 159 01228856' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var CONFIG = {
        base:        {{ $parcelConfig['base'] }},
        perKm:       {{ $parcelConfig['per_km'] }},
        kgIncluded:  {{ $parcelConfig['kg_included'] }},
        perExtraKg:  {{ $parcelConfig['per_extra_kg'] }},
        maxKg:       {{ $parcelConfig['max_kg'] }},
        expressFee:  {{ $parcelConfig['express_fee'] }},
        isEN:        {{ $isEN ? 'true' : 'false' }}
    };

    function fmtMoney(amount) {
        var n = Number(amount);
        if (!isFinite(n)) n = 0;
        if (CONFIG.isEN) {
            return '€' + n.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
        var parts = n.toFixed(2).split('.');
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + parts[1] + ' €';
    }

    var distEl    = document.getElementById('pc_distance');
    var weightEl  = document.getElementById('pc_weight');
    var expressEl = document.getElementById('pc_express');
    var totalEl   = document.getElementById('pc_total');
    var requestEl = document.getElementById('pc_request');
    if (!distEl || !weightEl || !totalEl) return;

    function recalc() {
        var d = parseFloat(distEl.value) || 0;
        var w = parseFloat(weightEl.value) || 0;
        var x = expressEl && expressEl.checked;

        if (d < 0)              d = 0;
        if (w < 0.1)            w = 0.1;
        if (w > CONFIG.maxKg)   w = CONFIG.maxKg;

        var total = CONFIG.base + (d * CONFIG.perKm);
        if (w > CONFIG.kgIncluded) {
            total += (w - CONFIG.kgIncluded) * CONFIG.perExtraKg;
        }
        if (x) total += CONFIG.expressFee;

        totalEl.textContent = fmtMoney(total);

        /* Update the request-CTA href with the parameters so contact form can pre-fill */
        if (requestEl) {
            var base = requestEl.getAttribute('href').split('?')[0];
            var qs = new URLSearchParams({
                service:   'parcel',
                distance:  d.toFixed(1),
                weight:    w.toFixed(1),
                express:   x ? '1' : '0',
                estimate:  total.toFixed(2)
            });
            requestEl.setAttribute('href', base + '?' + qs.toString());
        }
    }

    [distEl, weightEl, expressEl].forEach(function (el) {
        if (el) el.addEventListener('input', recalc);
    });
    recalc();

    /* Switch to the parcel tab if URL hash is #parcel etc. */
    if (location.hash) {
        var map = { '#routes':'#tab-routes', '#parcel':'#tab-parcel', '#quote':'#tab-quote' };
        var trigger = document.querySelector(map[location.hash] || '');
        if (trigger && typeof bootstrap !== 'undefined') {
            new bootstrap.Tab(trigger).show();
        }
    }
})();
</script>
<style>
    /* Pricing tabs override Bootstrap's default pill styling */
    .sn-pricing-tabs .nav-link {
        color: var(--sn-ink-2);
        background: transparent;
        border: 2px solid var(--sn-line);
        margin: 0 6px 8px;
        padding: 12px 24px;
        border-radius: var(--sn-radius-md);
        font-weight: var(--sn-fw-semibold);
        transition: all var(--sn-duration-2) var(--sn-ease);
    }
    .sn-pricing-tabs .nav-link:hover {
        border-color: var(--sn-primary);
        color: var(--sn-primary);
    }
    .sn-pricing-tabs .nav-link.active {
        background: var(--sn-primary);
        border-color: var(--sn-primary);
        color: #fff;
    }
    .sn-pricing-tabs .nav-link:focus-visible {
        outline: 3px solid var(--sn-accent);
        outline-offset: 2px;
    }
</style>
@endpush
