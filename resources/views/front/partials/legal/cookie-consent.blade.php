{{--
    StepNow Cookie Consent Banner
    =============================

    Self-hosted, dependency-free TDDDG / DSGVO consent banner.

    Compliance design notes (DSK + IHK BW guidance):
      - Equal-prominence "Alle akzeptieren" + "Alle ablehnen" buttons
        (no dark patterns; reject must be as easy as accept).
      - Granular per-category toggle (notwendig is forced ON and locked,
        statistics + marketing default to OFF).
      - The banner does NOT cover Impressum / Datenschutz links — those
        sit in the footer, accessible while the banner is open.
      - Choices are persisted in localStorage under key `stepnow.consent`
        for 13 months (DSK recommendation), and re-prompted afterwards.
      - Triggers a custom DOM event `stepnow.consent.changed` so any
        future tracking integration can subscribe and gate itself
        properly. Until consent.statistics === true, no analytics
        scripts are allowed to load.

    Accessibility: dialog uses role="dialog", aria-modal="true",
    aria-labelledby. Keyboard navigation works without JS focus traps
    because the banner is non-blocking by design.
--}}
<div id="stepnow-cookie-banner"
     role="dialog"
     aria-modal="false"
     aria-labelledby="stepnow-cookie-title"
     style="display:none;">
    <div class="stepnow-cb__inner" role="document">

        <h2 id="stepnow-cookie-title" class="stepnow-cb__title">
            Cookies &amp; Datenschutz
        </h2>

        <p class="stepnow-cb__text">
            Diese Website verwendet Cookies und vergleichbare Technologien. Technisch notwendige Cookies sind
            für den Betrieb der Seite erforderlich. Mit Ihrer Einwilligung verwenden wir zusätzlich Cookies
            für Statistik- und Marketing-Zwecke. Sie können Ihre Auswahl jederzeit über den Link
            „Cookie-Einstellungen“ im Footer anpassen oder widerrufen.
            Weitere Informationen finden Sie in unserer
            <a href="{{ route('front.datenschutz') }}">Datenschutzerklärung</a>
            und im
            <a href="{{ route('front.impressum') }}">Impressum</a>.
        </p>

        <div class="stepnow-cb__categories" id="stepnow-cb-categories" style="display:none;">
            <label class="stepnow-cb__row">
                <input type="checkbox" checked disabled>
                <span><strong>Notwendig</strong> — Sitzung, CSRF-Schutz, Cookie-Einwilligung. Diese
                Cookies sind für den Betrieb der Website unverzichtbar (§ 25 Abs. 2 Nr. 2 TDDDG).</span>
            </label>
            <label class="stepnow-cb__row">
                <input type="checkbox" id="stepnow-cb-statistics">
                <span><strong>Statistik</strong> — anonymisierte Reichweitenmessung. Wir verwenden diese
                Daten ausschließlich, um die Website zu verbessern.</span>
            </label>
            <label class="stepnow-cb__row">
                <input type="checkbox" id="stepnow-cb-marketing">
                <span><strong>Marketing</strong> — z. B. eingebettete Inhalte Dritter (WhatsApp-Click-to-Chat,
                Karten). Erst nach Einwilligung werden Daten an die Anbieter übermittelt.</span>
            </label>
        </div>

        <div class="stepnow-cb__buttons">
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--reject" id="stepnow-cb-reject">
                Alle ablehnen
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--settings" id="stepnow-cb-settings">
                Einstellungen
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--save" id="stepnow-cb-save" style="display:none;">
                Auswahl speichern
            </button>
            <button type="button" class="stepnow-cb__btn stepnow-cb__btn--accept" id="stepnow-cb-accept">
                Alle akzeptieren
            </button>
        </div>

    </div>
</div>

<style>
    #stepnow-cookie-banner {
        position: fixed;
        left: 16px; right: 16px; bottom: 16px;
        max-width: 720px;
        margin: 0 auto;
        background: #ffffff;
        color: #1d1d1d;
        border-radius: 10px;
        box-shadow: 0 16px 48px rgba(0,0,0,.18), 0 2px 8px rgba(0,0,0,.08);
        z-index: 99999;
        font-family: 'Inter Tight', 'Roboto', system-ui, -apple-system, sans-serif;
    }
    .stepnow-cb__inner { padding: 22px 24px; }
    .stepnow-cb__title { margin: 0 0 .5rem; font-size: 1.15rem; font-weight: 600; color: #111; }
    .stepnow-cb__text  { margin: 0 0 1rem; font-size: .92rem; line-height: 1.5; color: #333; }
    .stepnow-cb__text a { color: #0a58ca; text-decoration: underline; }
    .stepnow-cb__categories { margin: 12px 0 16px; }
    .stepnow-cb__row {
        display: flex; gap: 10px; align-items: flex-start;
        padding: 10px 0; border-top: 1px solid #f0f0f0;
        font-size: .9rem; line-height: 1.45;
    }
    .stepnow-cb__row:first-child { border-top: 0; }
    .stepnow-cb__row input[type="checkbox"] { margin-top: 4px; flex: 0 0 auto; }
    .stepnow-cb__buttons {
        display: flex; gap: 10px; flex-wrap: wrap;
        justify-content: flex-end; align-items: center;
    }
    .stepnow-cb__btn {
        appearance: none; border: 0; cursor: pointer;
        padding: 10px 18px; border-radius: 6px;
        font-size: .9rem; font-weight: 600;
        transition: opacity .15s ease, transform .05s ease;
    }
    .stepnow-cb__btn:active { transform: translateY(1px); }
    .stepnow-cb__btn--reject  { background: #f1f3f5; color: #111; }
    .stepnow-cb__btn--settings{ background: #ffffff; color: #111; border: 1px solid #d0d4d9; }
    .stepnow-cb__btn--save    { background: #198754; color: #fff; }
    .stepnow-cb__btn--accept  { background: #0d6efd; color: #fff; }
    .stepnow-cb__btn:hover    { opacity: .9; }

    @media (max-width: 600px) {
        #stepnow-cookie-banner { left: 8px; right: 8px; bottom: 8px; }
        .stepnow-cb__inner { padding: 18px; }
        .stepnow-cb__buttons { justify-content: stretch; }
        .stepnow-cb__buttons .stepnow-cb__btn { flex: 1 1 calc(50% - 5px); }
    }
</style>

<script>
(function () {
    'use strict';

    var STORAGE_KEY = 'stepnow.consent';
    var TTL_DAYS = 395; // ~13 months (DSK recommendation)

    function readConsent() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) return null;
            var data = JSON.parse(raw);
            if (!data || !data.savedAt) return null;
            var ageMs = Date.now() - data.savedAt;
            if (ageMs > TTL_DAYS * 86400000) return null;
            return data;
        } catch (e) {
            return null;
        }
    }

    function writeConsent(consent) {
        try {
            consent.savedAt = Date.now();
            localStorage.setItem(STORAGE_KEY, JSON.stringify(consent));
        } catch (e) { /* storage disabled — banner will reappear */ }
        // Notify any subscribed code (analytics integrations, embeds…)
        document.dispatchEvent(new CustomEvent('stepnow.consent.changed', {
            detail: consent
        }));
        // Convenient global access
        window.stepnowConsent = Object.assign(window.stepnowConsent || {}, {
            necessary: true,
            statistics: !!consent.statistics,
            marketing:  !!consent.marketing,
        });
    }

    function showBanner() {
        var el = document.getElementById('stepnow-cookie-banner');
        if (el) el.style.display = 'block';
    }
    function hideBanner() {
        var el = document.getElementById('stepnow-cookie-banner');
        if (el) el.style.display = 'none';
    }
    function showSettings() {
        var cats = document.getElementById('stepnow-cb-categories');
        var save = document.getElementById('stepnow-cb-save');
        if (cats) cats.style.display = 'block';
        if (save) save.style.display = 'inline-block';
        showBanner();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var existing = readConsent();
        // Set up the global API regardless — re-opening must work from the
        // footer link.
        window.stepnowConsent = {
            necessary:  true,
            statistics: existing ? !!existing.statistics : false,
            marketing:  existing ? !!existing.marketing  : false,
            openSettings: function () {
                // Reflect current state in checkboxes before opening
                var s = document.getElementById('stepnow-cb-statistics');
                var m = document.getElementById('stepnow-cb-marketing');
                if (s) s.checked = window.stepnowConsent.statistics;
                if (m) m.checked = window.stepnowConsent.marketing;
                showSettings();
            },
        };

        if (!existing) {
            showBanner();
        }

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
    });
})();
</script>
