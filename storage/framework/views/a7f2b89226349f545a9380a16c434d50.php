


<script src="<?php echo e(asset('front/assets/js/vendor/notyf.min.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/jquery-3.6.0.min.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jarallax.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/swiper.min.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery.appear.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery.ajaxchimp.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/wNumb.min.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/wow.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/aos.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/gsap/gsap.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/gsap/ScrollTrigger.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/gsap/SplitText.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/odometer.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery.circle-progress.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/knob.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/timePicker.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/typed-2.0.11.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/marquee.min.js')); ?>"></script>
<script src="<?php echo e(asset('front/assets/js/jquery-sidebar-content.js')); ?>"></script>


<script src="<?php echo e(asset('front/assets/js/script.js')); ?>"></script>


<script>
    /* ---- Expose runtime locale to client-side widgets ---------------- */
    window.STEPNOW_LOCALE = <?php echo json_encode(app()->getLocale(), 15, 512) ?>;
    window.STEPNOW_BASE   = <?php echo json_encode(url('/'), 15, 512) ?>;

    /* ---- i18n strings used by AJAX toasts --------------------------- */
    window.STEPNOW_I18N = {
        tooManyRequests: <?php echo json_encode(__('Too many requests. Please try again in a minute.'), 15, 512) ?>,
        genericError:    <?php echo json_encode(__('Something went wrong. Please try again.'), 15, 512) ?>,
        formSuccess:     <?php echo json_encode(__('Thank you. We will get back to you shortly.'), 15, 512) ?>,
        formError:       <?php echo json_encode(__('Please correct the highlighted fields.'), 15, 512) ?>,
        loading:         <?php echo json_encode(__('Loading…'), 15, 512) ?>,
        confirmDelete:   <?php echo json_encode(__('Are you sure?'), 15, 512) ?>,
    };

    /* ---- Notyf — global toast notifier (no external network call) --- */
    window.STEPNOW_NOTYF = (typeof Notyf !== 'undefined') ? new Notyf({
        duration: 4500,
        position: { x: 'right', y: 'top' },
        ripple: false,
        dismissible: true,
        types: [
            { type: 'success', background: '#16a34a', icon: false },
            { type: 'error',   background: '#dc2626', icon: false, duration: 6000 },
            { type: 'info',    background: '#0F4C81', icon: false },
        ]
    }) : null;

    /* ---- Locale toggle handler (works with any [data-sn-lang] anchor) ---
       The cookie is the ONLY persistence mechanism for "no default winner"
       mode. It carries 1-year expiry, SameSite=Lax. Server middleware
       reads it on subsequent requests.
    ------------------------------------------------------------------- */
    document.addEventListener('click', function (e) {
        var el = e.target.closest('[data-sn-lang]');
        if (!el) return;
        var lang = el.getAttribute('data-sn-lang');
        if (lang !== 'de' && lang !== 'en') return;

        // 1-year cookie. Secure flag added in production via x-forwarded-proto.
        var maxAge = 60 * 60 * 24 * 365;
        var secure = (location.protocol === 'https:') ? '; Secure' : '';
        document.cookie = 'stepnow_locale=' + lang + '; Max-Age=' + maxAge +
                          '; Path=/; SameSite=Lax' + secure;
    });

    /* ---- Cookie consent: re-fire scripts once consent is granted ---- */
    window.addEventListener('stepnow.consent.changed', function (ev) {
        var c = ev.detail || {};
        if (c.statistics === true && typeof window.snInitAnalytics === 'function') {
            try { window.snInitAnalytics(); } catch (e) { console.error(e); }
        }
        if (c.marketing === true && typeof window.snInitMarketing === 'function') {
            try { window.snInitMarketing(); } catch (e) { console.error(e); }
        }
    });

    /* ---- Reduced-motion: kill WOW animations early ----------------- */
    (function () {
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduced && typeof WOW !== 'undefined') {
            document.documentElement.classList.add('sn-reduced-motion');
        }
    })();

    /* ---- Lazy-init: only run heavy libs when their target exists --- */
    document.addEventListener('DOMContentLoaded', function () {
        // Owl carousel — only on pages with .owl-carousel
        if (typeof jQuery !== 'undefined' && jQuery('.owl-carousel').length === 0) {
            // Free up the parser; nothing to do
        }
        // AOS — only init if elements exist
        if (typeof AOS !== 'undefined' && document.querySelectorAll('[data-aos]').length > 0) {
            AOS.init({
                duration: 700,
                once: true,
                disable: function () { return window.matchMedia('(prefers-reduced-motion: reduce)').matches; }
            });
        }
    });

    /* ---- Wave 5h: overlay header on homepage + dismissible banner ---- */
(function () {
    /* Mark the body as "homepage" so CSS in stepnow-brand.css can apply the
       overlay-header treatment ONLY on the home route. We detect homepage
       by checking for the presence of .main-slider as the first content. */
    var hasHero = document.querySelector('main#content > .main-slider')
               || document.querySelector('main#content section.main-slider:first-child');
    if (hasHero) {
        document.body.classList.add('sn-overlay-hero');
    }

    /* Dismissible banner — adds an × button, remembers the dismiss in
       sessionStorage so it doesn't re-appear on every page load this
       session, but does come back on next visit (so important notices
       still get seen). */
    var banners = document.querySelectorAll('.sn-banner');
    if (banners.length) {
        // If user already dismissed this session, hide immediately
        try {
            if (sessionStorage.getItem('sn_banner_dismissed') === '1') {
                document.body.classList.add('sn-banner-dismissed');
            }
        } catch (e) { /* sessionStorage blocked — fall through, banner stays */ }

        banners.forEach(function (banner) {
            // Avoid duplicate buttons on hot-reload
            if (banner.querySelector('.sn-banner__dismiss')) return;

            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'sn-banner__dismiss';
            btn.setAttribute('aria-label',
                document.documentElement.lang === 'en' ? 'Dismiss notice' : 'Hinweis schließen');
            btn.innerHTML = '×';
            btn.addEventListener('click', function () {
                document.body.classList.add('sn-banner-dismissed');
                try { sessionStorage.setItem('sn_banner_dismissed', '1'); } catch (e) {}
            });
            var inner = banner.querySelector('.sn-banner__inner') || banner;
            inner.appendChild(btn);
        });
    }
})();
</script>
<?php /**PATH D:\laragon\www\Step-Now\resources\views/front/layouts/partials/scripts.blade.php ENDPATH**/ ?>