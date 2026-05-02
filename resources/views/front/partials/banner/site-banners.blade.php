{{--
    Top-of-page banners. Rendered ABOVE the header in master.blade.php.
    Multiple banners stack. Severity controls the colour band.

    Variables in scope:
        $banners — Illuminate\Support\Collection of SiteBanner
                   (provided by AppServiceProvider; empty collection
                   when site_banners table doesn't exist yet)

    Severities:
        info     → soft brand blue
        warning  → amber
        success  → green
--}}
@if (isset($banners) && $banners->isNotEmpty())
    <div class="sn-banners" role="region" aria-label="{{ app()->getLocale() === 'en' ? 'Notices' : 'Hinweise' }}">
        @foreach ($banners as $banner)
            <div class="sn-banner sn-banner--{{ $banner->severity }}" role="status">
                <div class="sn-banner__inner">
                    <span class="sn-banner__icon" aria-hidden="true">
                        @switch($banner->severity)
                            @case('warning') ⚠ @break
                            @case('success') ✓ @break
                            @default ℹ
                        @endswitch
                    </span>
                    <span class="sn-banner__msg">{{ $banner->message }}</span>
                    @if ($banner->cta_url && $banner->cta_label)
                        <a class="sn-banner__cta"
                           href="{{ \Illuminate\Support\Str::startsWith($banner->cta_url, 'http')
                                    ? $banner->cta_url
                                    : url($banner->cta_url) }}">
                            {{ $banner->cta_label }} →
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif

<style>
    .sn-banners { font-family: 'Inter Tight', 'Roboto', system-ui, sans-serif; }
    .sn-banner {
        font-size: .92rem;
        line-height: 1.5;
        padding: 10px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, .06);
    }
    .sn-banner--info    { background: #EFF6FF; color: #0F4C81; }
    .sn-banner--warning { background: #FFF7E6; color: #8A4B00; }
    .sn-banner--success { background: #ECFDF5; color: #0F7B33; }
    .sn-banner__inner   {
        max-width: 1240px; margin: 0 auto;
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .sn-banner__icon    { font-size: 1.1rem; flex: 0 0 auto; }
    .sn-banner__msg     { flex: 1 1 auto; }
    .sn-banner__cta     {
        flex: 0 0 auto;
        font-weight: 600;
        text-decoration: underline;
        color: inherit;
    }
    .sn-banner__cta:hover { text-decoration: none; }
    @media (max-width: 600px) {
        .sn-banner { font-size: .86rem; padding: 8px 12px; }
        .sn-banner__inner { gap: 6px; }
    }
</style>
