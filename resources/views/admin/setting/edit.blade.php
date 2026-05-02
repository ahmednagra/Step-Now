@extends('admin.layouts.master')

{{-- ============================================================================
     Admin — Settings (Wave 4)

     Replaces the single 30-row mega-form with a tabbed structure that
     groups related fields. Visitors no longer have to scroll through the
     entire form to update one social link.

     Tabs:
       1. General         — name, copyright text
       2. Branding        — logo, footer logo, fav icon, breadcrumb image
       3. Contact         — phone, phone 2, whatsapp, email, address
       4. Social          — Facebook, Instagram, YouTube, TikTok,
                            LinkedIn, Telegram, WhatsApp share link
       5. Legal           — placeholder note (legal text managed via
                            policies seeder, not the settings form)

     The form posts to the same admin.setting.update endpoint and the
     SettingController reads $request->phone_no / $request->fb_link / etc.
     exactly as before — no controller change needed for this tabbed UI.

     File-upload preview is consistent across all four image fields.
============================================================================= --}}

@section('title', 'Settings')

@section('content')

@php
    $setting = $setting ?? null;

    /* Helper to print "no image yet" placeholder vs current image */
    $imgUrl = function ($field) use ($setting) {
        $val = optional($setting)->{$field} ?? null;
        return $val ? asset($val) : null;
    };
@endphp

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-2">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-cog"></i> {{ __('Site Settings') }}
                        </h3>
                    </div>

                    <form action="{{ route('admin.setting.update') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="snSettingsForm">
                        @csrf

                        <div class="card-body">

                            {{-- Validation summary --}}
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ __('Please correct the following:') }}</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- ===== Tabs ===== --}}
                            <ul class="nav nav-tabs sn-settings-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-general" role="tab">
                                        <i class="fas fa-info-circle"></i> {{ __('General') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-branding" role="tab">
                                        <i class="fas fa-palette"></i> {{ __('Branding') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-contact" role="tab">
                                        <i class="fas fa-phone"></i> {{ __('Contact') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-social" role="tab">
                                        <i class="fas fa-share-alt"></i> {{ __('Social') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-legal" role="tab">
                                        <i class="fas fa-balance-scale"></i> {{ __('Legal') }}
                                    </a>
                                </li>
                            </ul>

                            {{-- ===== Tab content ===== --}}
                            <div class="tab-content sn-settings-content pt-4">

                                {{-- ===== TAB 1: General ===== --}}
                                <div class="tab-pane fade show active" id="tab-general" role="tabpanel">

                                    <div class="form-group row">
                                        <label for="snAppName" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Site / App name') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" id="snAppName" class="form-control"
                                                   value="{{ config('app.name', 'StepNow') }}" disabled>
                                            <small class="text-muted">
                                                {{ __('Stored in') }} <code>.env</code> {{ __('as') }} <code>APP_NAME</code>.
                                                {{ __('Edit there to change.') }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Locale') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                   value="{{ config('app.locale') }} ({{ implode(', ', config('app.available_locales', ['de','en'])) }})" disabled>
                                            <small class="text-muted">
                                                {{ __('The default locale is configured in') }} <code>config/app.php</code>.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== TAB 2: Branding ===== --}}
                                <div class="tab-pane fade" id="tab-branding" role="tabpanel">

                                    @php
                                        $imgFields = [
                                            'logo'              => __('Header logo'),
                                            'footer_logo'       => __('Footer logo'),
                                            'fav_icon'          => __('Favicon'),
                                            'home_beadcrum_img' => __('Page-header background'),
                                        ];
                                    @endphp

                                    @foreach ($imgFields as $field => $label)
                                        <div class="form-group row sn-image-field">
                                            <label for="sn-{{ $field }}" class="col-md-3 col-form-label font-weight-bold">
                                                {{ $label }}
                                            </label>
                                            <div class="col-md-9">
                                                <div class="d-flex align-items-start gap-3 flex-wrap">
                                                    @if ($imgUrl($field))
                                                        <img src="{{ $imgUrl($field) }}"
                                                             alt="{{ $label }}"
                                                             class="sn-image-preview"
                                                             id="sn-preview-{{ $field }}">
                                                    @else
                                                        <div class="sn-image-empty" id="sn-preview-{{ $field }}">
                                                            <i class="fas fa-image"></i>
                                                            <small>{{ __('No image yet') }}</small>
                                                        </div>
                                                    @endif

                                                    <div class="flex-grow-1" style="min-width:200px;">
                                                        <input type="file"
                                                               id="sn-{{ $field }}"
                                                               name="{{ $field }}"
                                                               class="form-control form-control-sm sn-image-input"
                                                               accept="image/png, image/jpeg, image/webp, image/svg+xml, image/x-icon, image/vnd.microsoft.icon"
                                                               data-sn-preview-target="sn-preview-{{ $field }}">
                                                        <small class="text-muted d-block mt-2">
                                                            {{ __('Recommended formats: PNG, JPG, SVG, WebP. Max ~2 MB.') }}
                                                        </small>
                                                        @error($field)
                                                            <p class="text-danger mb-0">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- ===== TAB 3: Contact ===== --}}
                                <div class="tab-pane fade" id="tab-contact" role="tabpanel">

                                    <div class="form-group row">
                                        <label for="sn-phone_no" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Primary phone') }} <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="tel" id="sn-phone_no" name="phone_no" class="form-control form-control-sm"
                                                   value="{{ old('phone_no', optional($setting)->phone_no) }}"
                                                   placeholder="+49 159 01228856"
                                                   pattern="^[+0-9 ()/-]{6,30}$">
                                            <small class="text-muted">
                                                {{ __('Used in the header and footer. Format with leading +country-code for tel: links to work on iOS.') }}
                                            </small>
                                            @error('phone_no')<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sn-phone_no_2" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Secondary phone') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="tel" id="sn-phone_no_2" name="phone_no_2" class="form-control form-control-sm"
                                                   value="{{ old('phone_no_2', optional($setting)->phone_no_2) }}"
                                                   placeholder="{{ __('Optional') }}">
                                            @error('phone_no_2')<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sn-whatsapp_no" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('WhatsApp number') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="tel" id="sn-whatsapp_no" name="whatsapp_no" class="form-control form-control-sm"
                                                   value="{{ old('whatsapp_no', optional($setting)->whatsapp_no) }}"
                                                   placeholder="+49 159 01228856">
                                            <small class="text-muted">
                                                {{ __('If different from primary phone. Used by the WhatsApp click-to-chat link.') }}
                                            </small>
                                            @error('whatsapp_no')<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sn-email" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Email') }} <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" id="sn-email" name="email" class="form-control form-control-sm"
                                                   value="{{ old('email', optional($setting)->email) }}"
                                                   placeholder="info@step-now.de">
                                            @error('email')<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sn-address" class="col-md-3 col-form-label font-weight-bold">
                                            {{ __('Address') }} <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <textarea id="sn-address" name="address" class="form-control form-control-sm" rows="2"
                                                      placeholder="Blumenstraße 8, 73779 Deizisau">{{ old('address', optional($setting)->address) }}</textarea>
                                            @error('address')<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== TAB 4: Social ===== --}}
                                <div class="tab-pane fade" id="tab-social" role="tabpanel">

                                    @php
                                        $socials = [
                                            'fb_link'       => ['label' => 'Facebook',       'icon' => 'fab fa-facebook',  'placeholder' => 'https://facebook.com/...'],
                                            'insta_link'    => ['label' => 'Instagram',      'icon' => 'fab fa-instagram', 'placeholder' => 'https://instagram.com/...'],
                                            'yt_link'       => ['label' => 'YouTube',        'icon' => 'fab fa-youtube',   'placeholder' => 'https://youtube.com/@...'],
                                            'tiktok_link'   => ['label' => 'TikTok',         'icon' => 'fab fa-tiktok',    'placeholder' => 'https://tiktok.com/@...'],
                                            'linkedin_link' => ['label' => 'LinkedIn',       'icon' => 'fab fa-linkedin',  'placeholder' => 'https://linkedin.com/company/...'],
                                            'telegram_link' => ['label' => 'Telegram',       'icon' => 'fab fa-telegram',  'placeholder' => 'https://t.me/...'],
                                            'whatsapp_link' => ['label' => __('WhatsApp share link'), 'icon' => 'fab fa-whatsapp', 'placeholder' => 'https://wa.me/4915901228856'],
                                        ];
                                    @endphp

                                    @foreach ($socials as $field => $info)
                                        <div class="form-group row">
                                            <label for="sn-{{ $field }}" class="col-md-3 col-form-label font-weight-bold">
                                                <i class="{{ $info['icon'] }}"></i> {{ $info['label'] }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="url" id="sn-{{ $field }}" name="{{ $field }}"
                                                       class="form-control form-control-sm"
                                                       value="{{ old($field, optional($setting)->{$field}) }}"
                                                       placeholder="{{ $info['placeholder'] }}">
                                                @error($field)<p class="text-danger mb-0">{{ $message }}</p>@enderror
                                            </div>
                                        </div>
                                    @endforeach

                                    <small class="text-muted d-block mt-3">
                                        <i class="fas fa-info-circle"></i>
                                        {{ __('Social icons in the header and footer only render when a URL is set. Empty fields are silently hidden.') }}
                                    </small>
                                </div>

                                {{-- ===== TAB 5: Legal ===== --}}
                                <div class="tab-pane fade" id="tab-legal" role="tabpanel">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>{{ __('Legal text is managed separately.') }}</strong>
                                        <p class="mb-0 mt-2">
                                            {{ __('Impressum, Datenschutzerklärung, AGB, Widerrufsbelehrung and Cookie-Richtlinie are stored in the') }}
                                            <code>policies</code>
                                            {{ __('table and seeded via') }}
                                            <code>php artisan db:seed --class=PolicySeeder</code>.
                                        </p>
                                        <p class="mb-0 mt-2">
                                            {{ __('To update the contents, edit') }}
                                            <code>database/seeders/PolicySeeder.php</code>
                                            {{ __('and re-run the seeder. This keeps legally authoritative German wording in version control where it belongs.') }}
                                        </p>
                                    </div>

                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>{{ __('Action items still open in the Impressum:') }}</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>{{ __('USt-IdNr — currently set to "Kleinunternehmer §19 UStG"') }}</li>
                                            <li>{{ __('Handelsregister — HRA 742905, Amtsgericht Stuttgart') }}</li>
                                            <li>{{ __('PBefG concession — issued by Landratsamt Esslingen') }}</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="reset" class="btn btn-light btn-sm">
                                <i class="fas fa-undo"></i> {{ __('Reset') }}
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save"></i> {{ __('Save settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    .sn-settings-tabs .nav-link {
        color: #2c3e57;
        font-weight: 600;
        font-size: 14px;
    }
    .sn-settings-tabs .nav-link.active {
        color: #0F4C81;
        border-bottom-color: #0F4C81;
    }
    .sn-settings-tabs .nav-link i {
        margin-right: 6px;
        color: #5d6b80;
    }
    .sn-settings-tabs .nav-link.active i {
        color: #0F4C81;
    }

    /* Image preview boxes */
    .sn-image-preview {
        max-width: 140px;
        max-height: 90px;
        object-fit: contain;
        background: #f7f9fc;
        padding: 6px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
    }
    .sn-image-empty {
        width: 140px;
        height: 90px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        background: #f7f9fc;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        color: #94a3b8;
        font-size: 11px;
    }
    .sn-image-empty i {
        font-size: 24px;
    }

    /* Required-asterisk emphasis */
    .text-danger { color: #dc2626 !important; }

    /* Tab pane spacing */
    .sn-settings-content { min-height: 400px; }

    /* Social icons in labels — give them brand colors */
    .sn-settings-content .fa-facebook  { color: #1877F2; }
    .sn-settings-content .fa-instagram { color: #E4405F; }
    .sn-settings-content .fa-youtube   { color: #FF0000; }
    .sn-settings-content .fa-tiktok    { color: #000000; }
    .sn-settings-content .fa-linkedin  { color: #0A66C2; }
    .sn-settings-content .fa-telegram  { color: #26A5E4; }
    .sn-settings-content .fa-whatsapp  { color: #25D366; }
</style>

@push('scripts')
<script>
(function () {
    'use strict';

    /* Image preview on file selection */
    document.querySelectorAll('.sn-image-input').forEach(function (input) {
        input.addEventListener('change', function (e) {
            var file = e.target.files && e.target.files[0];
            if (!file) return;
            var targetId = input.dataset.snPreviewTarget;
            if (!targetId) return;
            var oldEl = document.getElementById(targetId);
            if (!oldEl) return;
            var reader = new FileReader();
            reader.onload = function (ev) {
                var img = document.createElement('img');
                img.src = ev.target.result;
                img.alt = '';
                img.id  = targetId;
                img.className = 'sn-image-preview';
                oldEl.replaceWith(img);
            };
            reader.readAsDataURL(file);
        });
    });

    /* Persist active tab across reloads via URL hash */
    var triggerTab = function (hash) {
        if (!hash) return;
        var trigger = document.querySelector('a[data-toggle="tab"][href="' + hash + '"]');
        if (trigger && typeof jQuery !== 'undefined') {
            jQuery(trigger).tab('show');
        }
    };
    if (location.hash) triggerTab(location.hash);

    document.querySelectorAll('a[data-toggle="tab"]').forEach(function (a) {
        a.addEventListener('click', function () {
            history.replaceState(null, '', a.getAttribute('href'));
        });
    });

    /* Warn before leaving with unsaved changes */
    var form = document.getElementById('snSettingsForm');
    if (!form) return;
    var dirty = false;
    form.addEventListener('input', function () { dirty = true; });
    form.addEventListener('change', function () { dirty = true; });
    form.addEventListener('submit', function () { dirty = false; });
    window.addEventListener('beforeunload', function (e) {
        if (dirty) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
})();
</script>
@endpush
@endsection
