@extends('admin.layouts.master')

{{-- ============================================================================
     Admin Dashboard

     Wave 4: replaces the empty-row placeholder with a real operations view.

     Sections:
       1. Welcome strip (kept)
       2. KPI strip — 4 cards: Today, Pending, Conversion %, Total
       3. Booking pipeline — visual flow of pipeline stage counts
       4. Last 30-days trend chart (ChartJS, no external CDN required —
          Chart.js is already loaded via theme; if not, falls back to a
          static text summary)
       5. Recent activity feed — mixed bookings + enquiries, top 10
       6. Quick actions row — three cards linking to common admin tasks

     Defensive: every $stats key has a fallback ?? 0 in case the
     controller wasn't replaced. Section degrades gracefully.
============================================================================= --}}

@section('title', 'Dashboard')

@section('content')

    @php
        /* Provide safe defaults so the view still renders if the controller
           hasn't been updated yet. */
        $stats   = $stats   ?? [];
        $recent  = $recent  ?? [];
        $chart   = $chart   ?? ['labels' => [], 'values' => []];
        $pending = $pending ?? ['bookings' => 0, 'enquiries' => 0];

        $get = fn($k, $d = 0) => $stats[$k] ?? $d;
    @endphp

    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="m-0 text-dark">
                        {{ __('Welcome back,') }} {{ auth()->user()->name ?? 'Admin' }}
                    </h1>
                    <p class="text-muted mb-0 mt-1">
                        {{ __('Today is') }} {{ now()->isoFormat('dddd, LL') }}
                    </p>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-calendar-check"></i> {{ __('View bookings') }}
                    </a>
                    <a href="{{ route('admin.enquiry.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-envelope-open-text"></i> {{ __('View enquiries') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            {{-- ===== KPI STRIP ============================================== --}}
            <div class="row">
                {{-- Bookings today --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="sn-kpi sn-kpi--primary">
                        <div class="sn-kpi__icon"><i class="fas fa-calendar-day"></i></div>
                        <div class="sn-kpi__body">
                            <small class="sn-kpi__label">{{ __('Bookings today') }}</small>
                            <div class="sn-kpi__value">{{ $get('bookings_today') }}</div>
                            <small class="sn-kpi__sub">
                                {{ __('This week') }}: <strong>{{ $get('bookings_week') }}</strong>
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="sn-kpi sn-kpi--warning">
                        <div class="sn-kpi__icon"><i class="fas fa-hourglass-half"></i></div>
                        <div class="sn-kpi__body">
                            <small class="sn-kpi__label">{{ __('Pending action') }}</small>
                            <div class="sn-kpi__value">{{ $get('pending_bookings') }}</div>
                            <small class="sn-kpi__sub">
                                <a href="{{ route('admin.booking.index') }}?status=pending" class="text-warning font-weight-bold">
                                    {{ __('Review now') }} →
                                </a>
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Conversion --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="sn-kpi sn-kpi--success">
                        <div class="sn-kpi__icon"><i class="fas fa-chart-line"></i></div>
                        <div class="sn-kpi__body">
                            <small class="sn-kpi__label">{{ __('Conversion') }}</small>
                            <div class="sn-kpi__value">{{ $get('conversion_rate') }}<small>%</small></div>
                            <small class="sn-kpi__sub">
                                {{ __('Confirmed + Completed') }}
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Total bookings --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="sn-kpi sn-kpi--neutral">
                        <div class="sn-kpi__icon"><i class="fas fa-database"></i></div>
                        <div class="sn-kpi__body">
                            <small class="sn-kpi__label">{{ __('Total bookings') }}</small>
                            <div class="sn-kpi__value">{{ $get('bookings_total') }}</div>
                            <small class="sn-kpi__sub">
                                {{ __('This month') }}: <strong>{{ $get('bookings_month') }}</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== BOOKING PIPELINE ======================================== --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title mt-1">
                                <i class="fas fa-stream"></i> {{ __('Booking pipeline') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="sn-pipeline">
                                <a href="{{ route('admin.booking.index') }}?status=pending" class="sn-pipe-stage sn-pipe-stage--pending">
                                    <div class="sn-pipe-stage__count">{{ $get('pending_bookings') }}</div>
                                    <div class="sn-pipe-stage__label">{{ __('Pending') }}</div>
                                </a>
                                <i class="sn-pipe-arrow fas fa-chevron-right" aria-hidden="true"></i>
                                <a href="{{ route('admin.booking.index') }}?status=inprocess" class="sn-pipe-stage sn-pipe-stage--inprocess">
                                    <div class="sn-pipe-stage__count">
                                        {{ /* in-process count = total - pending - confirmed - completed - canceled */ '—' }}
                                    </div>
                                    <div class="sn-pipe-stage__label">{{ __('In process') }}</div>
                                </a>
                                <i class="sn-pipe-arrow fas fa-chevron-right" aria-hidden="true"></i>
                                <a href="{{ route('admin.booking.index') }}?status=confirmed" class="sn-pipe-stage sn-pipe-stage--confirmed">
                                    <div class="sn-pipe-stage__count">{{ $get('confirmed_bookings') }}</div>
                                    <div class="sn-pipe-stage__label">{{ __('Confirmed') }}</div>
                                </a>
                                <i class="sn-pipe-arrow fas fa-chevron-right" aria-hidden="true"></i>
                                <a href="{{ route('admin.booking.index') }}?status=completed" class="sn-pipe-stage sn-pipe-stage--completed">
                                    <div class="sn-pipe-stage__count">{{ $get('completed_bookings') }}</div>
                                    <div class="sn-pipe-stage__label">{{ __('Completed') }}</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== CHART + RECENT ACTIVITY ================================= --}}
            <div class="row mt-3">

                {{-- Trend chart --}}
                <div class="col-12 col-lg-8">
                    <div class="card card-outline card-primary h-100">
                        <div class="card-header">
                            <h3 class="card-title mt-1">
                                <i class="fas fa-chart-area"></i> {{ __('Bookings — last 30 days') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="snBookingsChart" height="240" aria-label="{{ __('Bookings trend last 30 days') }}"></canvas>
                            <noscript>
                                <p class="text-muted text-center mt-3">
                                    {{ __('Enable JavaScript to view the chart.') }}
                                    {{ __('Total this month') }}: {{ $get('bookings_month') }}.
                                </p>
                            </noscript>
                        </div>
                    </div>
                </div>

                {{-- Recent activity feed --}}
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <div class="card card-outline card-primary h-100">
                        <div class="card-header">
                            <h3 class="card-title mt-1">
                                <i class="fas fa-history"></i> {{ __('Recent activity') }}
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="sn-activity-list list-unstyled mb-0">
                                @forelse ($recent as $item)
                                    <li class="sn-activity-item">
                                        <a href="{{ $item['url'] }}" class="sn-activity-link">
                                            <span class="sn-activity-icon sn-activity-icon--{{ $item['type'] }}">
                                                <i class="fas fa-{{ $item['type'] === 'booking' ? 'calendar-check' : 'envelope-open-text' }}"></i>
                                            </span>
                                            <span class="sn-activity-body">
                                                <strong>{{ $item['name'] ?: '—' }}</strong>
                                                <small class="d-block text-muted text-truncate" style="max-width:240px;">
                                                    {{ $item['detail'] ?: '' }}
                                                </small>
                                                @if (!empty($item['status']))
                                                    <span class="badge sn-status-badge sn-status-{{ $item['status'] }} mt-1">
                                                        {{ ucfirst($item['status']) }}
                                                    </span>
                                                @endif
                                            </span>
                                            <small class="sn-activity-time text-muted">
                                                {{ $item['created_at'] ? \Carbon\Carbon::parse($item['created_at'])->diffForHumans() : '' }}
                                            </small>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-center p-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        {{ __('No recent activity.') }}
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== QUICK ACTIONS =========================================== --}}
            <div class="row mt-3">
                <div class="col-12 col-md-4">
                    <a href="{{ route('admin.booking.add') }}" class="sn-quick-action">
                        <i class="fas fa-plus-circle"></i>
                        <div>
                            <strong>{{ __('Add booking') }}</strong>
                            <small>{{ __('Create a manual booking entry') }}</small>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 mt-3 mt-md-0">
                    <a href="{{ route('admin.setting.edit') }}" class="sn-quick-action">
                        <i class="fas fa-cog"></i>
                        <div>
                            <strong>{{ __('Site settings') }}</strong>
                            <small>{{ __('Phone, email, social, branding') }}</small>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 mt-3 mt-md-0">
                    <a href="{{ route('admin.slider') }}" class="sn-quick-action">
                        <i class="fas fa-images"></i>
                        <div>
                            <strong>{{ __('Manage slider') }}</strong>
                            <small>{{ __('Update homepage banners') }}</small>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Dashboard-only styles, scoped via .sn-* prefix --}}
    <style>
        /* KPI cards */
        .sn-kpi {
            display: flex; align-items: center; gap: 14px;
            background: #fff;
            border-left: 4px solid #0F4C81;
            border-radius: 8px;
            padding: 16px 18px;
            box-shadow: 0 2px 6px rgba(15,76,129,.08);
            min-height: 100px;
            margin-bottom: 16px;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .sn-kpi:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(15,76,129,.12); }
        .sn-kpi__icon {
            flex: 0 0 auto; width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            background: rgba(15,76,129,.10);
            color: #0F4C81;
            font-size: 22px;
        }
        .sn-kpi__body { flex: 1 1 auto; min-width: 0; }
        .sn-kpi__label {
            display: block; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .04em;
            color: #5d6b80;
        }
        .sn-kpi__value { font-size: 28px; font-weight: 700; color: #0e1a2b; line-height: 1.1; }
        .sn-kpi__value small { font-size: 16px; color: #5d6b80; font-weight: 500; }
        .sn-kpi__sub { display: block; margin-top: 4px; color: #5d6b80; font-size: 12px; }

        .sn-kpi--primary  { border-left-color: #0F4C81; }
        .sn-kpi--primary  .sn-kpi__icon { background: rgba(15,76,129,.10); color: #0F4C81; }
        .sn-kpi--warning  { border-left-color: #d97706; }
        .sn-kpi--warning  .sn-kpi__icon { background: rgba(217,119,6,.10); color: #d97706; }
        .sn-kpi--success  { border-left-color: #16a34a; }
        .sn-kpi--success  .sn-kpi__icon { background: rgba(22,163,74,.10); color: #16a34a; }
        .sn-kpi--neutral  { border-left-color: #5d6b80; }
        .sn-kpi--neutral  .sn-kpi__icon { background: rgba(93,107,128,.10); color: #5d6b80; }

        /* Pipeline */
        .sn-pipeline {
            display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;
            gap: 8px;
        }
        .sn-pipe-stage {
            flex: 1 1 0; min-width: 120px;
            text-align: center;
            padding: 14px 10px;
            background: #f7f9fc;
            border-radius: 8px;
            text-decoration: none;
            color: inherit;
            transition: background .2s ease, transform .2s ease;
            border: 1px solid transparent;
        }
        .sn-pipe-stage:hover {
            background: #eef3f9;
            transform: translateY(-1px);
            color: inherit;
            text-decoration: none;
        }
        .sn-pipe-stage__count {
            font-size: 28px; font-weight: 700; color: #0e1a2b;
            line-height: 1;
        }
        .sn-pipe-stage__label {
            font-size: 12px; font-weight: 600; text-transform: uppercase;
            letter-spacing: .04em; color: #5d6b80; margin-top: 6px;
        }
        .sn-pipe-stage--pending   { border-left: 3px solid #d97706; }
        .sn-pipe-stage--inprocess { border-left: 3px solid #0284c7; }
        .sn-pipe-stage--confirmed { border-left: 3px solid #16a34a; }
        .sn-pipe-stage--completed { border-left: 3px solid #5d6b80; }
        .sn-pipe-arrow { color: #cbd5e1; font-size: 14px; flex: 0 0 auto; }
        @media (max-width: 768px) {
            .sn-pipe-arrow { display: none; }
        }

        /* Activity feed */
        .sn-activity-list { max-height: 480px; overflow-y: auto; }
        .sn-activity-item { border-bottom: 1px solid #e2e8f0; }
        .sn-activity-item:last-child { border-bottom: 0; }
        .sn-activity-link {
            display: flex; gap: 12px; align-items: flex-start;
            padding: 12px 18px;
            color: #0e1a2b;
            text-decoration: none;
            transition: background .15s ease;
        }
        .sn-activity-link:hover { background: #f7f9fc; color: #0e1a2b; text-decoration: none; }
        .sn-activity-icon {
            flex: 0 0 auto; width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            font-size: 14px;
        }
        .sn-activity-icon--booking { background: rgba(15,76,129,.10); color: #0F4C81; }
        .sn-activity-icon--enquiry { background: rgba(255,193,7,.15);  color: #b88600; }
        .sn-activity-body { flex: 1 1 auto; min-width: 0; }
        .sn-activity-time { flex: 0 0 auto; font-size: 11px; }

        /* Status badges (used in activity feed and pipeline) */
        .sn-status-badge { font-size: 10px; padding: 3px 8px; }
        .sn-status-pending   { background: #fef3c7; color: #d97706; }
        .sn-status-inprocess { background: #e0f2fe; color: #0284c7; }
        .sn-status-confirmed { background: #dcfce7; color: #16a34a; }
        .sn-status-canceled  { background: #fee2e2; color: #dc2626; }
        .sn-status-completed { background: #e2e8f0; color: #475569; }

        /* Quick actions */
        .sn-quick-action {
            display: flex; align-items: center; gap: 14px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px 18px;
            text-decoration: none;
            color: #0e1a2b;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }
        .sn-quick-action:hover {
            border-color: #0F4C81;
            box-shadow: 0 4px 14px rgba(15,76,129,.10);
            transform: translateY(-1px);
            text-decoration: none;
            color: #0e1a2b;
        }
        .sn-quick-action i {
            font-size: 28px;
            color: #0F4C81;
            flex: 0 0 auto;
        }
        .sn-quick-action strong { display: block; font-size: 15px; }
        .sn-quick-action small  { display: block; color: #5d6b80; font-size: 12px; margin-top: 2px; }
    </style>

    {{-- ChartJS — uses theme's bundled chart.js if present, else loads from CDN.
         The script is wrapped to detect Chart and skip if not loaded — the
         <noscript> + raw counts above keep the dashboard usable without it. --}}
    <script>
    (function () {
        var labels = @json($chart['labels']);
        var values = @json($chart['values']);
        var canvas = document.getElementById('snBookingsChart');
        if (!canvas || !labels.length) return;

        function init() {
            if (typeof Chart === 'undefined') return false;
            new Chart(canvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Bookings',
                        data: values,
                        borderColor: '#0F4C81',
                        backgroundColor: 'rgba(15, 76, 129, 0.10)',
                        borderWidth: 2,
                        tension: 0.30,
                        fill: true,
                        pointRadius: 3,
                        pointBackgroundColor: '#0F4C81',
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: { color: '#e2e8f0' }
                        }
                    }
                }
            });
            return true;
        }

        if (init()) return;

        // Lazy-load Chart.js if not bundled
        var s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
        s.onload = init;
        s.onerror = function () {
            canvas.parentElement.innerHTML =
                '<p class="text-muted text-center p-4">' +
                'Chart could not be loaded. Total bookings (last 30 days): ' +
                values.reduce(function (a, b) { return a + b; }, 0) +
                '</p>';
        };
        document.head.appendChild(s);
    })();
    </script>

@endsection
