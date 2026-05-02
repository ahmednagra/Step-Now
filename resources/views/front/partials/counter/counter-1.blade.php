{{-- ============================================================================
     Counter section

     Wave 3 revisions:
       • Replaced the placeholder vanity numbers (1000+ vehicles, 10M miles,
         15K+ bookings, 50K+ pickup locations) — those were template demo
         data and made the site look fake. Replaced with HONEST, verifiable
         operating commitments.
       • New numbers reflect real business positioning:
            - 30 minutes  reply time
            - 24/7        airport transfers
            - 10+         cities served
            - 100%        DSGVO-compliant
       • If JS fails or odometer doesn't load, the static text shows
         immediately (no "00" placeholder forever)
       • Each counter has a visible static value + the odometer animates
         on top, so screen readers and no-JS users see the actual figure
       • aria-label per counter: "30 minutes — Reply time during hours"
       • Custom-cursor + reduced-motion respected (handled in tokens)
       • Animation only fires once when the section enters the viewport
============================================================================ --}}

@php
    $isEN = app()->getLocale() === 'en';

    /* Honest commitments matching the About-Us KPI block.
       Format: ['count' => numeric, 'suffix' => '+' / 'min' / etc.,
                'icon' => FA, 'label' => translated text]
       If you want to add a real metric (e.g. "237 trips this month"),
       store it in `settings` table and pull it in here. */
    $counters = [
        [
            'count'      => 30,
            'static'     => '30',
            'suffix'     => $isEN ? ' min' : ' Min',
            'icon'       => 'fas fa-clock',
            'label'      => $isEN ? 'Reply during business hours' : 'Antwort zur Geschäftszeit',
            'animation'  => 'fadeInLeft',
            'delay'      => '100ms',
        ],
        [
            'count'      => 24,
            'static'     => '24',
            'suffix'     => '/7',
            'icon'       => 'fas fa-plane-departure',
            'label'      => $isEN ? 'Pre-booked airport transfers' : 'Vorgebuchte Flughafentransfers',
            'animation'  => 'fadeInLeft',
            'delay'      => '200ms',
        ],
        [
            'count'      => 10,
            'static'     => '10',
            'suffix'     => '+',
            'icon'       => 'fas fa-map-marker-alt',
            'label'      => $isEN ? 'Cities & locations served' : 'Bediente Städte & Orte',
            'animation'  => 'fadeInRight',
            'delay'      => '300ms',
        ],
        [
            'count'      => 100,
            'static'     => '100',
            'suffix'     => '%',
            'icon'       => 'fas fa-shield-alt',
            'label'      => $isEN ? 'DSGVO-compliant operations' : 'DSGVO-konformer Betrieb',
            'animation'  => 'fadeInRight',
            'delay'      => '400ms',
        ],
    ];
@endphp

<section class="counter-two" aria-labelledby="counter-heading">
    <div class="visually-hidden" id="counter-heading">
        {{ $isEN ? 'Our commitments' : 'Unsere Verpflichtungen' }}
    </div>

    <div class="container">
        <div class="counter-two__inner">
            <ul class="list-unstyled counter-two__list" role="list">

                @foreach ($counters as $counter)
                    <li class="wow {{ $counter['animation'] }}"
                        data-wow-delay="{{ $counter['delay'] }}"
                        data-wow-duration="1500ms">
                        <div class="counter-two__single sn-counter-single">
                            <div class="counter-two__shape-1" aria-hidden="true"></div>
                            <div class="counter-two__shape-2" aria-hidden="true"></div>

                            <div class="counter-two__single-inner">
                                <div class="counter-two__icon" aria-hidden="true">
                                    <i class="{{ $counter['icon'] }}"></i>
                                </div>

                                <div class="counter-two__count-box"
                                     aria-label="{{ $counter['static'] . $counter['suffix'] . ' — ' . $counter['label'] }}">
                                    {{-- Static value (visible always; replaced by animation when JS loads) --}}
                                    <h3 class="odometer sn-counter-num"
                                        data-count="{{ $counter['count'] }}">{{ $counter['static'] }}</h3>
                                    <span aria-hidden="true">{{ $counter['suffix'] }}</span>
                                </div>

                                <p class="counter-two__count-text">{{ $counter['label'] }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</section>

@push('scripts')
<style>
    /* Wave 3 — defensive styling so the section never shows "00" forever */
    .sn-counter-num {
        font-variant-numeric: tabular-nums;
    }

    /* Reduced-motion: skip odometer animation entirely */
    @media (prefers-reduced-motion: reduce) {
        .sn-counter-num.odometer {
            animation: none !important;
        }
    }

    .sn-counter-single {
        transition: transform var(--sn-duration-3) var(--sn-ease);
    }
    .sn-counter-single:hover {
        transform: translateY(-2px);
    }
</style>
<script>
    /* Defensive odometer init — only animates if jQuery + odometer present.
       Otherwise the static $counter['static'] value is what the user sees,
       which is correct (no broken "00" placeholder).

       The theme's script.js usually wires up odometer via .appear(). We
       leave that path intact and only override the BEHAVIOR if reduced-
       motion is requested. */
    (function () {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.querySelectorAll('.sn-counter-num.odometer').forEach(function (el) {
                /* Force the final value immediately — no animation */
                el.classList.remove('odometer');
                el.textContent = el.dataset.count || el.textContent;
            });
        }
    })();
</script>
@endpush
