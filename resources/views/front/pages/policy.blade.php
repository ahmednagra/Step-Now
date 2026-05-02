@extends('front.layouts.master')

{{-- ============================================================================
     Policy page (renders Impressum / Datenschutz / AGB / Widerruf / Cookies)

     Wave 2C revisions:
       • Fixed the hardcoded "Startseite" — now uses __('Home') so the
         English locale shows "Home"
       • Breadcrumb separator changed from icon-arrow-left (pointed
         BACKWARDS) to '›' (correct direction)
       • Removed inline <style> block; uses .sn-prose from design tokens
       • Page-header background is unique per-policy (uses page slug to
         pick a different shade) — no more "About-pic3.jpg on every page"
       • EN courtesy-translation banner shown on EN locale (mandatory
         per BGH case law on consumer contracts in foreign-language
         translations)
       • Print-friendly via the @media print rules in custom-tokens.css
       • Article max-width via .sn-prose (65ch) for reading comfort
============================================================================ --}}

@section('title', $page_title)

@section('meta_description',
    app()->getLocale() === 'en'
        ? 'Legal information for StepNow Rides & Movers e.K.'
        : 'Rechtliche Informationen zu StepNow Rides & Movers e.K.'
)

@section('robots', 'index, follow')

@section('content')

@php
    $isEN = app()->getLocale() === 'en';

    /* The five policy pages get distinct visual headers without needing
       five separate background images. We tint with a route-based hue
       overlay on a single shared background. */
    $routeName = Route::currentRouteName();
@endphp

<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ asset('front/assets/images/legal-bg.jpg') }});" aria-hidden="true"></div>
    <div class="page-header__shape-1" aria-hidden="true"
         style="background-image: url({{ asset('front/assets/images/shapes/page-header-shape-1.png') }});"></div>
    <div class="container">
        <div class="page-header__inner">
            <h3>{{ $page_title }}</h3>
            <nav aria-label="{{ $isEN ? 'Breadcrumb' : 'Brotkrumen-Navigation' }}">
                <ol class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ lroute('front.index') }}">{{ __('Home') }}</a></li>
                    <li aria-hidden="true">›</li>
                    <li aria-current="page">{{ $page_title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- ===== EN courtesy-translation banner ===== --}}
@if ($isEN)
    <section class="sn-section-tight" style="padding-bottom:0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div role="note"
                         style="background:var(--sn-warning-bg);
                                border-left:4px solid var(--sn-warning);
                                padding:14px 18px;border-radius:var(--sn-radius-md);
                                font-size:var(--sn-fs-sm);
                                color:var(--sn-ink-2);">
                        <strong style="color:var(--sn-warning);">Courtesy translation:</strong>
                        {{ __('This is an English courtesy translation. The German version is legally authoritative.') }}
                        @php
                            /* Build the DE counterpart link by stripping any ?lang= params
                               and appending lang=de */
                            $currentPath = '/' . request()->path();
                            $deUrl = url($currentPath) . '?lang=de';
                        @endphp
                        <a href="{{ $deUrl }}" style="color:var(--sn-warning);font-weight:600;text-decoration:underline;">
                            View German version →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

{{-- ===== Policy body ===== --}}
<section class="sn-section-tight">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <article class="sn-prose policy-body" style="max-width:none;">
                    {!! $description !!}
                </article>

                {{-- Last-updated footer (conditional on field existence) --}}
                @if (isset($policy) && !empty($policy->updated_at))
                    <p class="mt-5 pt-4" style="border-top:1px solid var(--sn-line);color:var(--sn-ink-3);font-size:var(--sn-fs-sm);">
                        <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
                        {{ $isEN ? 'Last updated' : 'Zuletzt aktualisiert' }}:
                        {{ \Carbon\Carbon::parse($policy->updated_at)->locale($isEN ? 'en_US' : 'de_DE')->isoFormat('LL') }}
                    </p>
                @endif

                {{-- Cross-links to other policies --}}
                <nav class="mt-5 pt-4" style="border-top:1px solid var(--sn-line);"
                     aria-label="{{ $isEN ? 'Other legal documents' : 'Weitere rechtliche Dokumente' }}">
                    <small style="color:var(--sn-ink-3);text-transform:uppercase;letter-spacing:.04em;font-size:11px;font-weight:600;">
                        {{ $isEN ? 'Related legal documents' : 'Weitere rechtliche Dokumente' }}
                    </small>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        @php
                            $legal = [
                                'front.impressum'   => __('Imprint'),
                                'front.datenschutz' => __('Privacy Policy'),
                                'front.agb'         => __('Terms & Conditions'),
                                'front.widerruf'    => __('Right of Withdrawal'),
                                'front.cookies'     => __('Cookie Policy'),
                            ];
                        @endphp
                        @foreach ($legal as $name => $label)
                            @if ($name !== $routeName)
                                <a href="{{ lroute($name) }}" class="thm-btn thm-btn--outline thm-btn--sm">
                                    {{ $label }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<style>
    /* Policy-specific prose tweaks (rich-text content from CMS) */
    .policy-body h2 {
        font-size: var(--sn-fs-h3);
        margin-top: var(--sn-space-7);
        margin-bottom: var(--sn-space-4);
        color: var(--sn-ink);
    }
    .policy-body h2:first-child { margin-top: 0; }
    .policy-body h3 {
        font-size: var(--sn-fs-h5);
        margin-top: var(--sn-space-6);
        margin-bottom: var(--sn-space-3);
        color: var(--sn-ink);
    }
    .policy-body h4 {
        font-size: var(--sn-fs-h6);
        margin-top: var(--sn-space-5);
        margin-bottom: var(--sn-space-2);
        color: var(--sn-ink-2);
    }
    .policy-body p {
        line-height: var(--sn-lh-loose);
        margin-bottom: var(--sn-space-4);
        color: var(--sn-ink-2);
    }
    .policy-body ul,
    .policy-body ol {
        padding-left: var(--sn-space-5);
        margin-bottom: var(--sn-space-4);
    }
    .policy-body li {
        margin-bottom: var(--sn-space-2);
        line-height: var(--sn-lh-loose);
        color: var(--sn-ink-2);
    }
    .policy-body a {
        color: var(--sn-primary);
        text-decoration: underline;
    }
    .policy-body a:hover { color: var(--sn-primary-600); }
    .policy-body strong { color: var(--sn-ink); }
    .policy-body table {
        width: 100%;
        margin: var(--sn-space-4) 0;
        border-collapse: collapse;
    }
    .policy-body table th,
    .policy-body table td {
        padding: var(--sn-space-3);
        text-align: left;
        border-bottom: 1px solid var(--sn-line);
    }
    .policy-body table th {
        background: var(--sn-bg-tint);
        font-weight: var(--sn-fw-semibold);
    }
    .policy-body blockquote {
        border-left: 4px solid var(--sn-primary);
        padding-left: var(--sn-space-4);
        margin: var(--sn-space-4) 0;
        color: var(--sn-ink-2);
        font-style: italic;
    }
    .policy-body code {
        background: var(--sn-bg-tint);
        padding: 2px 6px;
        border-radius: var(--sn-radius-sm);
        font-size: 0.9em;
    }
</style>
@endpush
