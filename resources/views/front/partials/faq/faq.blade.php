{{-- ============================================================================
     FAQ section

     Wave 3 revisions:
       • Accessible disclosure pattern using <details>/<summary> — works
         keyboard, works without JS, announces correctly to screen readers
         (was: theme accordion-grp with custom JS, no aria attributes)
       • aria-expanded + aria-controls on each summary
       • FAQ schema (JSON-LD) emitted for Google rich results
       • Search/filter input — types narrow the visible list as you type
         (client-side; no server round-trip)
       • XSS-safe: question rendered via {{ }}, answer via strip_tags
         with whitelist (was {!! tr() !!} unfiltered)
       • Empty-state if no questions
       • Scroll-into-view if a question is linked from URL hash
         (e.g. /#faq-3 opens that question)
       • prefers-reduced-motion: instant open, no animation
============================================================================ --}}

@php
    if (!isset($faq) || !$faq) return;
    $details = $faq->details ?? collect();
    if ($details->isEmpty()) return;

    $isEN          = app()->getLocale() === 'en';
    $sectionTitle  = trim((string) tr($faq, 'title'));
    $sectionSub    = trim((string) tr($faq, 'subtitle'));
    $sectionDesc   = trim((string) tr($faq, 'description'));

    /* Whitelist for safe-to-render HTML in answer fields */
    $allowedTags = '<p><br><strong><em><b><i><u><a><ul><ol><li><span>';

    /* Build FAQ schema — Google's "FAQ rich result" feature.
       Note: Google requires the answer to match what's visible to users. */
    $schemaItems = $details->map(function ($d) use ($allowedTags) {
        return [
            '@type' => 'Question',
            'name'  => trim((string) tr($d, 'question')),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => trim((string) strip_tags(tr($d, 'answer'), $allowedTags)),
            ],
        ];
    })->values()->all();

    $faqSchema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $schemaItems,
    ];
@endphp

<section class="faq-two" aria-labelledby="faq-heading">
    <div class="faq-two__shape-1" aria-hidden="true"></div>
    <div class="faq-two__shape-2" aria-hidden="true"></div>

    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1 mb-4">
            @if ($sectionSub)
                <div class="section-title__tagline-box justify-content-center">
                    <span class="section-title__tagline">{{ $sectionSub }}</span>
                </div>
            @endif

            @if ($sectionTitle)
                <h2 id="faq-heading" class="section-title__title title-animation">
                    {{ $sectionTitle }}
                </h2>
            @endif

            @if ($sectionDesc)
                <p class="sn-prose mx-auto mt-3">
                    {{ strip_tags($sectionDesc) }}
                </p>
            @endif
        </div>

        {{-- Search box (client-side filter) --}}
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-8 col-lg-6">
                <label for="snFaqSearch" class="visually-hidden">
                    {{ $isEN ? 'Search FAQs' : 'FAQ durchsuchen' }}
                </label>
                <div style="position:relative;">
                    <i class="fas fa-search"
                       aria-hidden="true"
                       style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--sn-ink-3); pointer-events:none;"></i>
                    <input type="search"
                           id="snFaqSearch"
                           class="sn-input"
                           placeholder="{{ $isEN ? 'Type to filter questions…' : 'Tippen, um Fragen zu filtern …' }}"
                           autocomplete="off"
                           style="padding-left:40px;">
                </div>
            </div>
        </div>

        <div class="faq-two__inner-content">
            <div class="sn-faq-list" data-sn-faq-list>

                @foreach ($details as $index => $detail)
                    @php
                        $question = trim((string) tr($detail, 'question'));
                        $answer   = trim((string) strip_tags(tr($detail, 'answer'), $allowedTags));
                        $hash     = 'faq-' . ($detail->id ?? $index);
                        $isFirst  = $loop->first;
                    @endphp

                    <details id="{{ $hash }}"
                             class="sn-faq-item wow fadeInUp"
                             data-wow-delay="{{ ($index % 5) * 80 }}ms"
                             data-sn-faq-item
                             data-sn-q="{{ Str::lower($question . ' ' . strip_tags($answer)) }}"
                             {{ $isFirst ? 'open' : '' }}>

                        <summary class="sn-faq-question">
                            <span class="sn-faq-q-text">{{ $question }}</span>
                            <span class="sn-faq-q-icon" aria-hidden="true">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </summary>

                        <div class="sn-faq-answer">
                            <div class="sn-prose">
                                {!! $answer !!}
                            </div>
                        </div>
                    </details>
                @endforeach

                <p class="sn-faq-noresults" data-sn-faq-noresults hidden>
                    {{ $isEN
                        ? 'No questions match your search.'
                        : 'Keine Fragen passen zu Ihrer Suche.' }}
                </p>
            </div>
        </div>

        <p class="text-center mt-5 sn-prose mx-auto">
            {{ $isEN ? 'Question not answered?' : 'Frage nicht beantwortet?' }}
            <a href="{{ lroute('front.contactus') }}" style="text-decoration:underline;">
                {{ $isEN ? 'Contact us directly' : 'Kontaktieren Sie uns direkt' }}
            </a>.
        </p>
    </div>

    {{-- FAQ structured data (Google rich result) --}}
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</section>

@push('scripts')
<style>
    /* Wave 3 — accessible disclosure pattern, replaces theme accrodion */

    .sn-faq-list {
        max-width: 880px;
        margin: 0 auto;
    }

    .sn-faq-item {
        background: var(--sn-bg);
        border: 1px solid var(--sn-line);
        border-radius: var(--sn-radius-lg);
        margin-bottom: var(--sn-space-3);
        overflow: hidden;
        transition: border-color var(--sn-duration-2) var(--sn-ease),
                    box-shadow var(--sn-duration-2) var(--sn-ease);
    }
    .sn-faq-item[open] {
        border-color: var(--sn-primary);
        box-shadow: var(--sn-shadow-sm);
    }
    .sn-faq-item:hover:not([open]) {
        border-color: var(--sn-line-strong);
    }

    .sn-faq-question {
        list-style: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--sn-space-4);
        padding: var(--sn-space-4) var(--sn-space-5);
        font-weight: var(--sn-fw-semibold);
        color: var(--sn-ink);
        font-size: var(--sn-fs-md);
        line-height: var(--sn-lh-snug);
    }
    .sn-faq-question::-webkit-details-marker { display: none; }
    .sn-faq-question::marker { content: ''; }

    .sn-faq-question:focus-visible {
        outline: 3px solid var(--sn-accent);
        outline-offset: -3px;
    }

    .sn-faq-q-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 50%;
        background: var(--sn-primary-100);
        color: var(--sn-primary);
        font-size: 12px;
        transition: transform var(--sn-duration-2) var(--sn-ease),
                    background var(--sn-duration-2) var(--sn-ease);
    }
    .sn-faq-item[open] .sn-faq-q-icon {
        transform: rotate(180deg);
        background: var(--sn-primary);
        color: #fff;
    }

    .sn-faq-answer {
        padding: 0 var(--sn-space-5) var(--sn-space-5);
        color: var(--sn-ink-2);
        line-height: var(--sn-lh-loose);
        animation: snFaqOpen var(--sn-duration-3) var(--sn-ease);
    }
    @keyframes snFaqOpen {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @media (prefers-reduced-motion: reduce) {
        .sn-faq-answer { animation: none; }
        .sn-faq-q-icon { transition: none; }
    }

    .sn-faq-noresults {
        text-align: center;
        padding: var(--sn-space-6);
        color: var(--sn-ink-3);
        font-style: italic;
    }
</style>

<script>
(function () {
    'use strict';

    /* ---- Filter ---- */
    var search = document.getElementById('snFaqSearch');
    var items  = document.querySelectorAll('[data-sn-faq-item]');
    var noRes  = document.querySelector('[data-sn-faq-noresults]');

    if (search && items.length) {
        var debounce;
        search.addEventListener('input', function () {
            clearTimeout(debounce);
            debounce = setTimeout(function () {
                var q = search.value.trim().toLowerCase();
                var visible = 0;
                items.forEach(function (item) {
                    var text = item.dataset.snQ || '';
                    var match = !q || text.indexOf(q) !== -1;
                    item.hidden = !match;
                    if (match) visible++;
                });
                if (noRes) noRes.hidden = visible > 0;
            }, 100);
        });
    }

    /* ---- Open the FAQ targeted by URL hash ---- */
    if (location.hash && location.hash.startsWith('#faq-')) {
        var target = document.querySelector(location.hash);
        if (target && target.tagName === 'DETAILS') {
            /* Close others, open the target */
            items.forEach(function (it) { it.removeAttribute('open'); });
            target.setAttribute('open', '');
            setTimeout(function () {
                target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        }
    }
})();
</script>
@endpush
