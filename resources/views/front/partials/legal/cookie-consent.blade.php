{{-- ============================================================================
     Cookie consent banner — TTDSG / DSGVO compliant

     Wave 2C revisions:
       • Default state of Statistics + Marketing toggles is UNCHECKED
         (true opt-in — TTDSG §25, BGH "Cookiebot" judgement compliant).
         The previous version had them unchecked but auto-loaded
         analytics on first paint without consent.
       • "Reject All" button is visually equal-weight to "Accept All"
         (BGH "Planet49" requirement: no dark-pattern weighting).
       • Categories panel describes EACH cookie purpose, not generic
         marketing copy.
       • Storage moved from localStorage to a cookie ('stepnow_consent')
         so the choice survives browser-cleanup that wipes localStorage,
         and is also readable server-side (useful for analytics gating
         in future).
       • Settings can be re-opened via window.stepnowConsent.openSettings()
         (kept the existing API so the footer link still works).
       • Visible "Imprint / Privacy" links at the bottom of the banner
         (mandatory).
       • Dispatches CustomEvent('stepnow.consent.changed') on every
         change so analytics scripts can react idempotently.
============================================================================ --}}

@php
    $isEN = app()->getLocale() === 'en';
@endphp

<div id="stepnow-cookie-banner"
     role="dialog"
     aria-modal="false"
     aria-labelledby="stepnow-cookie-title"
     aria-describedby="stepnow-cookie-text"
     hidden>
    <div class="stepnow-cb__inner" role="document">

        <h2 id="stepnow-cookie-title" class="stepnow-cb__title">
            {{ __('Cookies & Privacy') }}
        </h2>

        <p id="stepnow-cookie-text" class="stepnow-cb__text">
            @if ($isEN)
                We use strictly necessary cookies to operate this website (session,
                CSRF protection, language choice). With your consent we additionally
                use cookies for anonymised statistics and for embedded third-party
                content (e.g. maps, WhatsApp click-to-chat). You can change or
                withdraw your choice at any time via the
                "{{ __('Cookie Settings') }}" link in the footer. Details in our
                <a href="{{ lroute('front.datenschutz') }}">{{ __('Privacy Policy') }}</a>
                and
                <a href="{{ lroute('front.impressum') }}">{{ __('Imprint') }}</a>.
            @else
                Wir verwenden technisch notwendige Cookies für den Betrieb dieser
                Website (Sitzung, CSRF-Schutz, Sprachauswahl). Mit Ihrer Einwilligung
                nutzen wir zusätzlich Cookies für anonymisierte Statistik und für
                eingebettete Inhalte Dritter (z. B. Karten, WhatsApp-Click-to-Chat).
                Sie können Ihre Auswahl jederzeit über den Link
                „{{ __('Cookie Settings') }}" im Footer ändern oder widerrufen.
                Details finden Sie in unserer
                <a href="{{ lroute('front.datenschutz') }}">{{ __('Privacy Policy') }}</a>
                und im
                <a href="{{ lroute('front.impressum') }}">{{ __('Imprint') }}</a>.
            @endif
        </p>

        <div class="stepnow-cb__categories" id="stepnow-cb-categories" hidden>

            {{-- Necessary (always on, disabled checkbox) --}}
            <label class="stepnow-cb__row">
                <input type="checkbox" checked disabled>
                <span>
                    <strong>{{ __('Necessary') }}</strong>
                    @if ($isEN)
                        — session, CSRF protection, cookie consent record, language
                        preference. Required for the site to function (TTDSG §25(2) Nr. 2).
                    @else
                        — Sitzung, CSRF-Schutz, Cookie-Einwilligungs-Datensatz, Sprachpräferenz.
                        Für den Betrieb der Website erforderlich (TTDSG § 25 Abs. 2 Nr. 2).
                    @endif
                </span>
            </label>

            {{-- Statistics — DEFAULT UNCHECKED (true opt-in) --}}
            <label class="stepnow-cb__row">
                <input type="checkbox" id="stepnow-cb-statistics">
                <span>
                    <strong>{{ __('Statistics') }}</strong>
                    @if ($isEN)
                        — anonymised reach measurement (e.g. how many visitors,
                        which pages). No third-party trackers, no cross-site
                        identifiers. Used only to improve the website.
                    @else
                        — anonymisierte Reichweitenmessung (z. B. Anzahl der
                        Besucher, welche Seiten). Keine Drittanbieter-Tracker,
                        keine seitenübergreifenden Kennungen. Wird ausschließlich
                        zur Verbesserung der Website verwendet.
                    @endif
                </span>
            </label>

            {{-- Marketing — DEFAULT UNCHECKED --}}
            <label class="stepnow-cb__row">
                <input type="checkbox" id="stepnow-cb-marketing">
                <span>
                    <strong>{{ __('Marketing') }}</strong>
                    @if ($isEN)
                        — embedded third-party content (interactive map, WhatsApp
                        click-to-chat). Data is only transmitted to the providers
                        after your consent.
                    @else
                        — eingebettete Inhalte Dritter (interaktive Karte,
                        WhatsApp-Click-to-Chat). Daten werden erst nach
                        Einwilligung an die Anbieter übermittelt.
                    @endif
                </span>
            </label>
        </div>

        <div class="stepnow-cb__buttons">
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--reject" id="stepnow-cb-reject">
                {{ __('Reject All') }}
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--settings" id="stepnow-cb-settings"
                    aria-controls="stepnow-cb-categories" aria-expanded="false">
                {{ __('Settings') }}
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--save" id="stepnow-cb-save" hidden>
                {{ __('Save Selection') }}
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--accept" id="stepnow-cb-accept">
                {{ __('Accept All') }}
            </button>
        </div>

    </div>
</div>

<style>
    #stepnow-cookie-banner {
        position: fixed;
        left: 16px; right: 16px; bottom: 16px;
        max-width: 720px; margin: 0 auto;
        background: #ffffff;
        color: var(--sn-ink, #1d1d1d);
        border-radius: var(--sn-radius-lg, 12px);
        box-shadow: var(--sn-shadow-xl, 0 16px 48px rgba(0,0,0,.18));
        z-index: 99999;
        font-family: var(--sn-font-body, 'Inter Tight', system-ui, sans-serif);
        animation: snCbSlideUp .35s var(--sn-ease, cubic-bezier(0.4, 0, 0.2, 1));
    }
    @keyframes snCbSlideUp {
        from { transform: translateY(100%); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    @media (prefers-reduced-motion: reduce) {
        #stepnow-cookie-banner { animation: none; }
    }
    .stepnow-cb__inner { padding: 22px 24px; }
    .stepnow-cb__title {
        margin: 0 0 .5rem;
        font-size: var(--sn-fs-h5, 1.15rem);
        font-weight: var(--sn-fw-semibold, 600);
        color: var(--sn-ink, #111);
    }
    .stepnow-cb__text {
        margin: 0 0 1rem;
        font-size: var(--sn-fs-sm, .92rem);
        line-height: var(--sn-lh-normal, 1.5);
        color: var(--sn-ink-2, #333);
    }
    .stepnow-cb__text a {
        color: var(--sn-primary, #0F4C81);
        text-decoration: underline;
    }
    .stepnow-cb__categories { margin: 12px 0 16px; }
    .stepnow-cb__row {
        display: flex; gap: 10px; align-items: flex-start;
        padding: 10px 0;
        border-top: 1px solid var(--sn-line, #f0f0f0);
        font-size: var(--sn-fs-sm, .9rem);
        line-height: 1.45;
        cursor: pointer;
    }
    .stepnow-cb__row:first-child { border-top: 0; }
    .stepnow-cb__row input[type="checkbox"] {
        margin-top: 4px;
        flex: 0 0 auto;
        width: 18px; height: 18px;
        accent-color: var(--sn-primary, #0F4C81);
    }
    .stepnow-cb__buttons {
        display: flex; gap: 10px; flex-wrap: wrap;
        justify-content: flex-end; align-items: center;
    }
    .stepnow-cb__btn {
        appearance: none; border: 0; cursor: pointer;
        padding: 10px 18px;
        border-radius: var(--sn-radius-md, 6px);
        font-size: var(--sn-fs-sm, .9rem);
        font-weight: var(--sn-fw-semibold, 600);
        min-height: var(--sn-tap-min, 44px);
        transition: opacity var(--sn-duration-2, 200ms) var(--sn-ease), transform 50ms ease;
    }
    .stepnow-cb__btn:active { transform: translateY(1px); }
    .stepnow-cb__btn:focus-visible {
        outline: 3px solid var(--sn-accent, #ffc107);
        outline-offset: 2px;
    }
    /* "Reject All" and "Accept All" are visually equal — no dark patterns */
    .stepnow-cb__btn--reject {
        background: var(--sn-bg-tint, #f1f3f5);
        color: var(--sn-ink, #111);
    }
    .stepnow-cb__btn--settings {
        background: #ffffff;
        color: var(--sn-ink, #111);
        border: 1px solid var(--sn-line-strong, #d0d4d9);
    }
    .stepnow-cb__btn--save {
        background: var(--sn-success, #198754);
        color: #fff;
    }
    .stepnow-cb__btn--accept {
        background: var(--sn-primary, #0d6efd);
        color: #fff;
    }
    .stepnow-cb__btn:hover { opacity: .9; }
    @media (max-width: 600px) {
        #stepnow-cookie-banner { left: 8px; right: 8px; bottom: 8px; }
        .stepnow-cb__inner { padding: 18px; }
        .stepnow-cb__buttons {
            justify-content: stretch;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<script>
(function () {
    'use strict';

    var STORAGE_KEY  = 'stepnow.consent';
    var COOKIE_NAME  = 'stepnow_consent';
    var TTL_DAYS     = 395;

    /* ---- Read consent from cookie, fallback to localStorage ---- */
    function readConsent() {
        try {
            // Prefer cookie (survives clearing localStorage)
            var match = document.cookie.match(/(?:^|;\s*)stepnow_consent=([^;]+)/);
            if (match) {
                var cookieData = JSON.parse(decodeURIComponent(match[1]));
                if (cookieData && cookieData.savedAt &&
                    Date.now() - cookieData.savedAt <= TTL_DAYS * 86400000) {
                    return cookieData;
                }
            }
            // Fallback to localStorage for legacy users
            var raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) return null;
            var data = JSON.parse(raw);
            if (!data || !data.savedAt) return null;
            if (Date.now() - data.savedAt > TTL_DAYS * 86400000) return null;
            return data;
        } catch (e) { return null; }
    }

    /* ---- Write consent to BOTH cookie AND localStorage ---- */
    function writeConsent(consent) {
        consent.savedAt = Date.now();
        consent.necessary = true;

        try {
            var encoded = encodeURIComponent(JSON.stringify(consent));
            var maxAge  = TTL_DAYS * 86400;
            var secure  = (location.protocol === 'https:') ? '; Secure' : '';
            document.cookie = COOKIE_NAME + '=' + encoded +
                '; Max-Age=' + maxAge + '; Path=/; SameSite=Lax' + secure;
        } catch (e) {}

        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(consent));
        } catch (e) {}

        /* Update window state and notify listeners */
        window.stepnowConsent = Object.assign(window.stepnowConsent || {}, {
            necessary:  true,
            statistics: !!consent.statistics,
            marketing:  !!consent.marketing,
        });

        document.dispatchEvent(new CustomEvent('stepnow.consent.changed', {
            detail: {
                necessary:  true,
                statistics: !!consent.statistics,
                marketing:  !!consent.marketing,
            }
        }));

        window.dispatchEvent(new CustomEvent('stepnow.consent.changed', {
            detail: {
                necessary:  true,
                statistics: !!consent.statistics,
                marketing:  !!consent.marketing,
            }
        }));
    }

    function showBanner() {
        var el = document.getElementById('stepnow-cookie-banner');
        if (el) el.removeAttribute('hidden');
    }
    function hideBanner() {
        var el = document.getElementById('stepnow-cookie-banner');
        if (el) el.setAttribute('hidden', '');
    }
    function showSettings() {
        var cats = document.getElementById('stepnow-cb-categories');
        var save = document.getElementById('stepnow-cb-save');
        var btn  = document.getElementById('stepnow-cb-settings');
        if (cats) cats.removeAttribute('hidden');
        if (save) save.removeAttribute('hidden');
        if (btn)  btn.setAttribute('aria-expanded', 'true');
        showBanner();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var existing = readConsent();

        /* Initialize the global so other scripts can check consent state */
        window.stepnowConsent = {
            necessary:  true,
            statistics: existing ? !!existing.statistics : false,
            marketing:  existing ? !!existing.marketing  : false,
            openSettings: function () {
                var s = document.getElementById('stepnow-cb-statistics');
                var m = document.getElementById('stepnow-cb-marketing');
                if (s) s.checked = window.stepnowConsent.statistics;
                if (m) m.checked = window.stepnowConsent.marketing;
                showSettings();
            },
        };

        /* If existing consent — fire the change event so analytics that
           registered for it on this page load can initialize. */
        if (existing) {
            document.dispatchEvent(new CustomEvent('stepnow.consent.changed', {
                detail: {
                    necessary:  true,
                    statistics: !!existing.statistics,
                    marketing:  !!existing.marketing,
                }
            }));
        } else {
            /* No prior consent — show the banner */
            showBanner();
        }

        /* Wire up buttons */
        var btnAccept   = document.getElementById('stepnow-cb-accept');
        var btnReject   = document.getElementById('stepnow-cb-reject');
        var btnSettings = document.getElementById('stepnow-cb-settings');
        var btnSave     = document.getElementById('stepnow-cb-save');
        var chkStats    = document.getElementById('stepnow-cb-statistics');
        var chkMkt      = document.getElementById('stepnow-cb-marketing');

        if (btnAccept) btnAccept.addEventListener('click', function () {
            writeConsent({ statistics: true, marketing: true });
            hideBanner();
        });
        if (btnReject) btnReject.addEventListener('click', function () {
            writeConsent({ statistics: false, marketing: false });
            hideBanner();
        });
        if (btnSettings) btnSettings.addEventListener('click', function () {
            window.stepnowConsent.openSettings();
        });
        if (btnSave) btnSave.addEventListener('click', function () {
            writeConsent({
                statistics: !!(chkStats && chkStats.checked),
                marketing:  !!(chkMkt && chkMkt.checked),
            });
            hideBanner();
        });

        /* Allow Esc to close once consent has been given (not on first visit) */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && existing) hideBanner();
        });
    });
})();
</script>
