<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?: 'de' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Robots: NEVER index the admin panel --}}
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title', 'Admin') | StepNow Rides &amp; Movers</title>

    {{-- Favicon (driven by settings, with fallback) --}}
    @if(isset($setting) && $setting && $setting->fav_icon)
        <link rel="shortcut icon" href="{{ asset($setting->fav_icon) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    @include('admin.partials.styles')

    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Top navigation bar (notifications dropdown, user menu) --}}
        @include('admin.partials.top-navbar')

        {{-- Left sidebar (Wave 4: pending badges, grouped sections, accessibility) --}}
        @include('admin.partials.side-navbar')

        {{-- Page content --}}
        <div class="content-wrapper">
            @yield('content')
        </div>

        {{-- Admin footer — minimal, professional, no marketing copy --}}
        <footer class="main-footer text-sm">
            <div class="float-right d-none d-sm-inline">
                v{{ config('app.version', '1.0.0') }}
            </div>
            <strong>&copy; {{ date('Y') }} StepNow Rides &amp; Movers e.K.</strong>
            &mdash; {{ __('Admin panel') }}
        </footer>
    </div>

    @include('admin.partials.scripts')

    @if(session('notification'))
        @php
            $note  = session('notification');
            $type  = $note['alert'] ?? 'info';
            $msg   = $note['message'] ?? '';
            $type  = in_array($type, ['success','error','warning','info'], true) ? $type : 'info';
        @endphp
        <script>
            (function () {
                if (typeof toastr === 'undefined') return;
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 4000
                };
                toastr.{!! $type !!}({!! json_encode($msg) !!});
            })();
        </script>
    @endif

    @stack('scripts')
</body>
</html>