@extends('front.layouts.master')

{{-- ============================================================================
     Services page

     Wave 2C revisions:
       • Hard-coded the two services that match the Gewerbeanmeldung:
            1. Mietwagen-Personenbeförderung (passenger transport)
            2. Paketdienst (parcel delivery)
         If $serviceCategories is empty (admin hasn't seeded), this page
         still renders something useful — the previous version showed
         empty space.
       • If $serviceCategories has data, it's rendered BELOW the fixed
         feature blocks (so admin-managed services are an enhancement,
         not the only content).
       • Page-header background uses 'services-bg.jpg' (not the same
         About-pic3.jpg as every other page)
       • Breadcrumb separator '›'
       • CTA section uses the booking form, not a generic "Get Quote"
       • All copy reflects passenger-transport + parcel, not a workshop
       • Each fixed service has: icon, title, description, key features
         (bullets), CTA to the relevant tab on /pricing
============================================================================ --}}

@section('title', app()->getLocale() === 'en' ? 'Services' : 'Leistungen')

@section('meta_description',
    app()->getLocale() === 'en'
        ? 'Hire-car passenger transport and parcel delivery from Deizisau. Airport transfers, business rides, regional and same-day parcel pickup.'
        : 'Mietwagen-Personenbeförderung und Paketdienst aus Deizisau. Flughafentransfer, Geschäftsfahrten, regionale und taggleiche Paketabholung.'
)

@section('content')

@php
    $isEN = app()->getLocale() === 'en';
@endphp

{{-- ===== Page header ===== --}}
<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/services-bg.jpg') }});" aria-hidden="true"></div>
    <div class="page-header__shape-1" aria-hidden="true"
         style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <h3>{{ __('Our Services') }}</h3>
            <nav aria-label="{{ $isEN ? 'Breadcrumb' : 'Brotkrumen-Navigation' }}">
                <ol class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                    <li aria-hidden="true">›</li>
                    <li aria-current="page">{{ __('Services') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- ===== Two-pillar service grid ===== --}}
<section>
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-title__tagline">{{ $isEN ? 'What we do' : 'Was wir leisten' }}</span>
            <h2 class="section-title__title mt-2">
                {{ $isEN ? 'Two services. One reliable team.' : 'Zwei Leistungen. Ein zuverlässiges Team.' }}
            </h2>
            <p class="sn-prose mx-auto mt-3">
                {{ $isEN
                    ? 'StepNow Rides & Movers covers two licensed activities under our German trade registration: hire-car passenger transport (Mietwagen-Personenbeförderung) and parcel delivery (Paketdienst). Both are operated by the same team from our base in Deizisau.'
                    : 'StepNow Rides & Movers betreibt zwei gewerblich angemeldete Tätigkeiten: Mietwagen-Personenbeförderung und Paketdienst. Beide Leistungen werden vom selben Team aus unserem Standort Deizisau erbracht.' }}
            </p>
        </div>

        <div class="row g-4">

            {{-- Service 1 — Passenger transport --}}
            <div class="col-12 col-lg-6">
                <article class="sn-card sn-card--elevated h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3" style="width:64px;height:64px;border-radius:var(--sn-radius-lg);background:var(--sn-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-car-side" style="color:#fff;font-size:28px;" aria-hidden="true"></i>
                        </div>
                        <div>
                            <small style="color:var(--sn-primary);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                                {{ $isEN ? 'Service 1' : 'Leistung 1' }}
                            </small>
                            <h3 class="mb-0" style="font-size:var(--sn-fs-h3);">
                                {{ $isEN ? 'Passenger Transport' : 'Personenbeförderung' }}
                            </h3>
                        </div>
                    </div>

                    <p style="color:var(--sn-ink-2);">
                        {{ $isEN
                            ? 'Licensed Mietwagen passenger transport for individuals, families, and small groups. Pre-booked only — we are not a taxi.'
                            : 'Konzessionierte Mietwagen-Personenbeförderung für Privatpersonen, Familien und kleine Gruppen. Nur auf Vorbestellung — wir sind kein Taxi.' }}
                    </p>

                    <h4 class="mt-4 mb-2" style="font-size:var(--sn-fs-h6);text-transform:uppercase;letter-spacing:.04em;color:var(--sn-ink-3);">
                        {{ $isEN ? 'We cover' : 'Wir bedienen' }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Airport transfers (Stuttgart STR)' : 'Flughafentransfer (Stuttgart STR)' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Business rides and meetings' : 'Geschäftsfahrten und Termine' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Regional rides — Deizisau, Esslingen, Plochingen, Stuttgart' : 'Regionalfahrten — Deizisau, Esslingen, Plochingen, Stuttgart' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Special occasions (weddings, events, medical visits)' : 'Besondere Anlässe (Hochzeiten, Events, Arztbesuche)' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Up to 8 passengers (Sprinter on request)' : 'Bis zu 8 Personen (Sprinter auf Anfrage)' }}</span>
                        </li>
                    </ul>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="{{ lroute('front.pricing') }}#routes" class="thm-btn">
                            {{ $isEN ? 'See fixed prices' : 'Festpreise ansehen' }}
                            <span class="fas fa-arrow-right" aria-hidden="true"></span>
                        </a>
                        <a href="{{ lroute('front.contactus') }}?service=ride" class="thm-btn thm-btn--outline">
                            {{ __('Book a Ride') }}
                        </a>
                    </div>
                </article>
            </div>

            {{-- Service 2 — Parcel delivery --}}
            <div class="col-12 col-lg-6">
                <article class="sn-card sn-card--elevated h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3" style="width:64px;height:64px;border-radius:var(--sn-radius-lg);background:var(--sn-accent);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-box" style="color:var(--sn-ink);font-size:28px;" aria-hidden="true"></i>
                        </div>
                        <div>
                            <small style="color:var(--sn-accent-700);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                                {{ $isEN ? 'Service 2' : 'Leistung 2' }}
                            </small>
                            <h3 class="mb-0" style="font-size:var(--sn-fs-h3);">
                                {{ $isEN ? 'Parcel & Courier' : 'Paketdienst & Kurier' }}
                            </h3>
                        </div>
                    </div>

                    <p style="color:var(--sn-ink-2);">
                        {{ $isEN
                            ? 'Direct, regional parcel pickup and delivery. No depot stops — we collect from sender and hand to recipient on the same day where possible.'
                            : 'Direkter, regionaler Paketdienst. Keine Depot-Umwege — wir holen direkt beim Absender ab und liefern wenn möglich am gleichen Tag.' }}
                    </p>

                    <h4 class="mt-4 mb-2" style="font-size:var(--sn-fs-h6);text-transform:uppercase;letter-spacing:.04em;color:var(--sn-ink-3);">
                        {{ $isEN ? 'We handle' : 'Wir übernehmen' }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Same-day pickup within Esslingen district' : 'Taggleiche Abholung im Landkreis Esslingen' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Express delivery (under 2 hours)' : 'Express-Zustellung (unter 2 Stunden)' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Up to 30 kg per parcel, 120 × 80 × 80 cm' : 'Bis 30 kg pro Paket, 120 × 80 × 80 cm' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Business contracts (recurring routes)' : 'Geschäftskunden (wiederkehrende Strecken)' }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check-circle me-2 mt-1" style="color:var(--sn-success);" aria-hidden="true"></i>
                            <span>{{ $isEN ? 'Documents, fragile items, urgent shipments' : 'Dokumente, zerbrechliche Sendungen, dringende Lieferungen' }}</span>
                        </li>
                    </ul>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="{{ lroute('front.pricing') }}#parcel" class="thm-btn">
                            {{ $isEN ? 'Calculate price' : 'Preis berechnen' }}
                            <span class="fas fa-arrow-right" aria-hidden="true"></span>
                        </a>
                        <a href="{{ lroute('front.contactus') }}?service=parcel" class="thm-btn thm-btn--outline">
                            {{ __('Send Parcel') }}
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

{{-- ===== Admin-managed services (optional, only if seeded) ===== --}}
@if (isset($serviceCategories) && $serviceCategories->isNotEmpty())
    <section class="sn-section-alt">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-title__tagline">
                    {{ $isEN ? 'Additional offerings' : 'Weitere Leistungen' }}
                </span>
                <h2 class="section-title__title mt-2">
                    {{ $isEN ? 'More from StepNow' : 'Mehr von StepNow' }}
                </h2>
            </div>

            @foreach ($serviceCategories as $category)
                @php
                    $servicesForCat = $category->services ?? collect();
                    if ($servicesForCat->isEmpty()) continue;
                @endphp

                <h3 class="mb-4">{{ tr($category, 'title') ?? $category->name }}</h3>

                <div class="row g-4 mb-5">
                    @foreach ($servicesForCat as $service)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                            <article class="sn-card sn-card--interactive h-100">
                                @if ($service->icon)
                                    <div class="mb-3">
                                        <img src="{{ asset($service->icon) }}"
                                             alt=""
                                             aria-hidden="true"
                                             width="48" height="48"
                                             loading="lazy">
                                    </div>
                                @endif
                                <h4 class="mb-2" style="font-size:var(--sn-fs-h5);">
                                    <a href="{{ route('front.service.detail', $service->slug) }}" style="color:inherit;">
                                        {{ tr($service, 'name') ?? $service->name }}
                                    </a>
                                </h4>
                                <p style="color:var(--sn-ink-2);font-size:var(--sn-fs-sm);">
                                    {{ Str::limit(strip_tags(tr($service, 'short_description') ?? $service->short_description), 120) }}
                                </p>
                                <a href="{{ route('front.service.detail', $service->slug) }}"
                                   class="thm-btn thm-btn--ghost thm-btn--sm">
                                    {{ __('Learn More') }}
                                    <span class="fas fa-arrow-right ms-1" aria-hidden="true"></span>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@endif

{{-- ===== CTA strip ===== --}}
<section class="sn-section-tint">
    <div class="container text-center">
        <h2 class="section-title__title">
            {{ $isEN ? 'Need a quick price?' : 'Sie möchten schnell einen Preis?' }}
        </h2>
        <p class="sn-prose mx-auto mt-3">
            {{ $isEN
                ? 'See our fixed-price routes, calculate your parcel price, or call us directly during business hours.'
                : 'Sehen Sie unsere Festpreis-Strecken, berechnen Sie Ihren Paketpreis oder rufen Sie uns während der Geschäftszeiten direkt an.' }}
        </p>
        <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
            <a href="{{ lroute('front.pricing') }}" class="thm-btn">
                {{ $isEN ? 'See pricing' : 'Preise ansehen' }}
                <span class="fas fa-arrow-right" aria-hidden="true"></span>
            </a>
            <a href="tel:{{ optional($setting ?? null)->phone_e164 ?: '+4915901228856' }}" class="thm-btn thm-btn--outline">
                <i class="fas fa-phone me-1" aria-hidden="true"></i>
                {{ optional($setting ?? null)->phone_no ?? '+49 159 01228856' }}
            </a>
        </div>
    </div>
</section>

@endsection
