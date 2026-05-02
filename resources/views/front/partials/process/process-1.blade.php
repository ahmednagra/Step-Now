{{-- ============================================================================
     Process / How-it-works section

     Wave 3 revisions:
       • Re-titled "Car Rental Process" → "How it works" (transport-business
         neutral, covers both rides and parcels)
       • Replaced 4 generic steps ("Choose Vehicle", "Get in Touch", "Choose
         Pickup Location", "Enjoy the Ride") with 4 truthful steps that
         reflect the actual booking flow:
            1. Get a price
            2. Confirm booking
            3. We pick you up / collect parcel
            4. You arrive / parcel delivered
       • Each step has a visible numbered badge (1-4) and an FA icon
         (no more theme icon-* font dependency that may not exist)
       • Reusable hardcoded background image swapped for a neutral gradient
         (was Listing-pic1.jpg on every card — visually monotonous)
       • Step cards have ordered semantics: <ol> + <li>
       • Connector line between cards on desktop (visual flow indicator)
       • Animations cycle every 3 steps, work for any count
============================================================================ --}}

@php
    $isEN = app()->getLocale() === 'en';

    $steps = [
        [
            'icon'   => 'fas fa-tags',
            'title'  => $isEN ? 'Get a price'     : 'Preis erhalten',
            'text'   => $isEN
                ? 'Browse fixed-price routes, calculate parcel costs, or request a custom quote.'
                : 'Festpreis-Strecken ansehen, Paketkosten berechnen oder individuelles Angebot anfordern.',
        ],
        [
            'icon'   => 'fas fa-check-circle',
            'title'  => $isEN ? 'Confirm booking' : 'Buchung bestätigen',
            'text'   => $isEN
                ? 'We confirm your booking by phone or email within 30 minutes during business hours.'
                : 'Wir bestätigen Ihre Buchung per Telefon oder E-Mail innerhalb von 30 Minuten.',
        ],
        [
            'icon'   => 'fas fa-map-pin',
            'title'  => $isEN ? 'We arrive on time' : 'Wir kommen pünktlich',
            'text'   => $isEN
                ? 'Driver or courier arrives at the agreed pickup time and location.'
                : 'Fahrer oder Kurier kommt zur vereinbarten Zeit an den Abholort.',
        ],
        [
            'icon'   => 'fas fa-flag-checkered',
            'title'  => $isEN ? 'Safe arrival'      : 'Sichere Ankunft',
            'text'   => $isEN
                ? 'You arrive safely at your destination — or your parcel is delivered into the recipient\'s hands.'
                : 'Sie erreichen Ihr Ziel sicher — oder Ihr Paket wird dem Empfänger persönlich übergeben.',
        ],
    ];
@endphp

<section class="process-one" aria-labelledby="process-heading">
    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style2 mb-5">
            <div class="section-title__tagline-box justify-content-center">
                <span class="section-title__tagline">{{ $isEN ? 'How it works' : 'So funktioniert es' }}</span>
            </div>
            <h2 id="process-heading" class="section-title__title title-animation">
                {{ $isEN ? 'Booking with StepNow in 4 steps' : 'Buchung in 4 Schritten' }}
            </h2>
        </div>

        <ol class="row g-4 list-unstyled sn-process-list">

            @foreach ($steps as $i => $step)
                @php
                    $animations = ['fadeInLeft', 'fadeInUp', 'fadeInUp', 'fadeInRight'];
                    $animationClass = $animations[$i] ?? 'fadeInUp';
                    $delay = (($i * 200) + 100) . 'ms';
                @endphp

                <li class="col-12 col-sm-6 col-lg-3 wow {{ $animationClass }}"
                    data-wow-delay="{{ $delay }}"
                    data-wow-duration="1500ms">

                    <article class="process-one__single sn-process-card">

                        <div class="sn-process-step-num" aria-hidden="true">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="process-one__icon-box sn-process-icon-wrap">
                            <span class="sn-process-icon" aria-hidden="true">
                                <i class="{{ $step['icon'] }}"></i>
                            </span>
                        </div>

                        <h3 class="process-one__title sn-process-title">
                            <span class="visually-hidden">
                                {{ $isEN ? 'Step' : 'Schritt' }} {{ $i + 1 }}:
                            </span>
                            {{ $step['title'] }}
                        </h3>

                        <p class="process-one__text">
                            {{ $step['text'] }}
                        </p>
                    </article>
                </li>
            @endforeach

        </ol>

        <div class="text-center mt-5">
            <a href="{{ lroute('front.contactus') }}" class="thm-btn thm-btn--lg">
                {{ $isEN ? 'Start your booking' : 'Buchung starten' }}
                <span class="fas fa-arrow-right" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</section>

@push('scripts')
<style>
    .sn-process-list {
        position: relative;
        counter-reset: sn-step;
    }

    /* Connector line between cards on desktop */
    @media (min-width: 992px) {
        .sn-process-list::before {
            content: "";
            position: absolute;
            top: 60px;
            left: 12.5%;
            right: 12.5%;
            height: 2px;
            background: linear-gradient(90deg,
                var(--sn-line) 0%,
                var(--sn-primary-100) 50%,
                var(--sn-line) 100%);
            z-index: 0;
        }
    }

    .sn-process-card {
        position: relative;
        background: var(--sn-bg);
        border: 1px solid var(--sn-line);
        border-radius: var(--sn-radius-lg);
        padding: var(--sn-space-6) var(--sn-space-5);
        text-align: center;
        height: 100%;
        z-index: 1;
        transition:
            transform var(--sn-duration-3) var(--sn-ease),
            box-shadow var(--sn-duration-3) var(--sn-ease),
            border-color var(--sn-duration-3) var(--sn-ease);
    }
    .sn-process-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--sn-shadow-md);
        border-color: var(--sn-primary-100);
    }

    .sn-process-step-num {
        position: absolute;
        top: -16px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--sn-accent);
        color: var(--sn-ink);
        font-weight: var(--sn-fw-bold);
        font-size: var(--sn-fs-sm);
        padding: 4px 12px;
        border-radius: var(--sn-radius-pill);
        letter-spacing: 0.05em;
        box-shadow: var(--sn-shadow-sm);
    }

    .sn-process-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px; height: 80px;
        margin: var(--sn-space-3) auto var(--sn-space-4);
        background: var(--sn-primary-100);
        color: var(--sn-primary);
        border-radius: 50%;
        font-size: 32px;
        transition: background var(--sn-duration-3) var(--sn-ease),
                    color      var(--sn-duration-3) var(--sn-ease);
    }
    .sn-process-card:hover .sn-process-icon-wrap {
        background: var(--sn-primary);
        color: #fff;
    }

    .sn-process-title {
        font-size: var(--sn-fs-h5);
        margin-bottom: var(--sn-space-3);
        color: var(--sn-ink);
    }
</style>
@endpush
