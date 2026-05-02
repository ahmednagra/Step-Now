{{-- ============================================================================
     Homepage Services partial

     Wave 3 revisions:
       • XSS surface closed: short_description rendered via {{ }} (escaped)
         after strip_tags. Was {!! tr() !!} which would execute raw HTML.
       • Service icon has fallback: if $service->icon is empty, renders a
         CSS icon placeholder instead of broken <img>
       • Line-clamp on description (max 3 lines) — keeps card heights
         consistent regardless of admin-entered description length
       • Title becomes whole-card link (better tap target on mobile)
       • Hover state — card lifts, accent border appears
       • Empty-state: section silently skips render if no services seeded
       • aria-labelledby on each card for screen-reader navigation
       • Per-card "Learn more" CTA replaces ambiguous title-only link
       • Section copy is transport-business specific, not generic
============================================================================ --}}

@php
    $services = $services ?? collect();
    if ($services->isEmpty()) return;

    $isEN = app()->getLocale() === 'en';
@endphp

<section class="services-one" aria-labelledby="services-heading">
    <div class="services-one__shape-1" aria-hidden="true"></div>
    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1 mb-5">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline">{{ $isEN ? 'What we offer' : 'Was wir bieten' }}</span>
            </div>
            <h2 id="services-heading" class="section-title__title title-animation">
                {{ $isEN ? 'Reliable transport services in your region' : 'Zuverlässige Transportleistungen in Ihrer Region' }}
            </h2>
            <p class="sn-prose mx-auto mt-3">
                {{ $isEN
                    ? 'From airport transfers to same-day parcel pickup — one team, one phone number, transparent fixed prices.'
                    : 'Vom Flughafentransfer bis zur taggleichen Paketabholung — ein Team, eine Telefonnummer, transparente Festpreise.' }}
            </p>
        </div>

        <div class="row g-4 justify-content-center">

            @foreach ($services as $service)
                @php
                    $serviceName  = trim((string) (tr($service, 'name') ?: $service->name));
                    $serviceDesc  = trim((string) strip_tags(tr($service, 'short_description') ?: $service->short_description));
                    $hasIcon      = !empty($service->icon);
                    $detailUrl    = route('front.service.detail', $service->slug);
                    $cardId       = 'svc-' . $service->id;
                @endphp

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 wow fadeInUp"
                     data-wow-delay="{{ ($loop->index % 4) * 100 }}ms"
                     data-wow-duration="1500ms">

                    <article class="services-one__single sn-service-card" aria-labelledby="{{ $cardId }}">

                        <div class="services-one__single-shape-1" aria-hidden="true"></div>
                        <div class="services-one__single-shape-2" aria-hidden="true"></div>
                        <div class="services-one__single-shape-3" aria-hidden="true"></div>

                        <div class="services-one__count" aria-hidden="true">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="services-one__icon">
                            @if ($hasIcon)
                                <img src="{{ asset($service->icon) }}"
                                     alt=""
                                     aria-hidden="true"
                                     loading="lazy"
                                     decoding="async"
                                     width="50" height="50">
                            @else
                                {{-- Fallback CSS icon — clean, no broken image --}}
                                <span class="sn-service-icon-fallback" aria-hidden="true">
                                    <i class="fas fa-car-side"></i>
                                </span>
                            @endif
                        </div>

                        <h3 id="{{ $cardId }}" class="services-one__title">
                            <a href="{{ $detailUrl }}" class="stretched-link">
                                {{ $serviceName }}
                            </a>
                        </h3>

                        <p class="services-one__text sn-line-clamp-3">
                            {{ $serviceDesc }}
                        </p>

                        <span class="services-one__cta sn-service-cta" aria-hidden="true">
                            {{ $isEN ? 'Learn more' : 'Mehr erfahren' }}
                            <i class="fas fa-arrow-right ms-1"></i>
                        </span>

                    </article>
                </div>
            @endforeach

        </div>
    </div>
</section>

@push('scripts')
<style>
    /* Wave 3: cleaner service-card visuals layered on top of the theme CSS */

    .sn-service-card {
        position: relative;
        height: 100%;
        transition:
            transform var(--sn-duration-3) var(--sn-ease),
            box-shadow var(--sn-duration-3) var(--sn-ease);
    }
    .sn-service-card:hover {
        transform: translateY(-4px);
    }
    .sn-service-card:focus-within {
        outline: 3px solid var(--sn-accent);
        outline-offset: 2px;
        border-radius: var(--sn-radius-md);
    }

    /* Make the title link cover the whole card (better mobile tap area) */
    .sn-service-card .stretched-link {
        text-decoration: none;
        color: inherit;
    }
    .sn-service-card .stretched-link::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    .sn-service-card .stretched-link:focus { outline: none; }

    /* Icon fallback — branded circle with FA icon */
    .sn-service-icon-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--sn-primary-100);
        color: var(--sn-primary);
        font-size: 22px;
    }

    /* Description: clamp to 3 lines so cards stay equal height */
    .sn-line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: calc(var(--sn-lh-normal) * var(--sn-fs-base) * 3);
    }

    /* Inline "Learn more" indicator — replaces invisible title-only link */
    .sn-service-cta {
        display: inline-flex;
        align-items: center;
        margin-top: var(--sn-space-3);
        color: var(--sn-primary);
        font-weight: var(--sn-fw-semibold);
        font-size: var(--sn-fs-sm);
        transition: gap var(--sn-duration-2) var(--sn-ease);
    }
    .sn-service-card:hover .sn-service-cta {
        gap: var(--sn-space-2);
    }
    .sn-service-card:hover .sn-service-cta i {
        transform: translateX(2px);
        transition: transform var(--sn-duration-2) var(--sn-ease);
    }
</style>
@endpush
