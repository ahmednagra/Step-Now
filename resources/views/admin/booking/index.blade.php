@extends('admin.layouts.master')

{{-- ============================================================================
     Admin — Booking list (Wave 4)

     Replaces the basic table with a productive operations view:

       • Status filter strip (All / Pending / In process / Confirmed /
         Completed / Cancelled) — count badges per filter
       • Search box (filters by name / email / pickup — client-side, fast)
       • Sortable columns (date, name, status) — vanilla JS, no DataTables dep
       • Each row's "Action" cell standardized: View, Edit, Delete with
         consistent button sizing and confirmation modal on Delete
       • Empty state when no rows
       • Status badge uses centralized .sn-status-* CSS from dashboard
       • Visible sort arrows for keyboard/screen-reader cue
       • The list still works without JS — filters and sort are
         progressive enhancements; the underlying <table> is HTML-correct.

     Backwards compat: the controller still does `Booking::all()`. To
     filter server-side based on ?status=pending (used by dashboard
     pipeline links), the controller can read $request->get('status')
     and add a where clause. Until then, the URL param is ignored —
     all bookings render and the client-side tabs handle the filter.
============================================================================= --}}

@section('title', 'Booking List')

@section('content')

@php
    $bookings = $bookings ?? collect();

    /* Status counts for the filter tabs (client-side count) */
    $countAll       = $bookings->count();
    $countPending   = $bookings->where('status', 'pending')->count();
    $countInProcess = $bookings->where('status', 'inprocess')->count();
    $countConfirmed = $bookings->where('status', 'confirmed')->count();
    $countCompleted = $bookings->where('status', 'completed')->count();
    $countCancelled = $bookings->where('status', 'canceled')->count();

    /* Active tab from URL ?status= or default 'all' */
    $activeStatus = request('status', 'all');
@endphp

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 mt-2">
                <div class="card card-primary card-outline">

                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-calendar-check"></i> {{ __('Booking List') }}
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.booking.add') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add Booking') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- ===== Filter tabs ===== --}}
                        <ul class="nav nav-pills sn-status-tabs flex-wrap mb-3"
                            role="tablist"
                            aria-label="{{ __('Booking status filter') }}">
                            @php
                                $tabs = [
                                    'all'       => ['label' => __('All'),         'count' => $countAll,       'class' => 'neutral'],
                                    'pending'   => ['label' => __('Pending'),     'count' => $countPending,   'class' => 'pending'],
                                    'inprocess' => ['label' => __('In process'),  'count' => $countInProcess, 'class' => 'inprocess'],
                                    'confirmed' => ['label' => __('Confirmed'),   'count' => $countConfirmed, 'class' => 'confirmed'],
                                    'completed' => ['label' => __('Completed'),   'count' => $countCompleted, 'class' => 'completed'],
                                    'canceled'  => ['label' => __('Cancelled'),   'count' => $countCancelled, 'class' => 'canceled'],
                                ];
                            @endphp
                            @foreach ($tabs as $key => $tab)
                                <li class="nav-item" role="presentation">
                                    <button type="button"
                                            class="nav-link sn-status-tab sn-status-tab--{{ $tab['class'] }} {{ $activeStatus === $key ? 'active' : '' }}"
                                            data-sn-filter="{{ $key }}"
                                            aria-pressed="{{ $activeStatus === $key ? 'true' : 'false' }}">
                                        {{ $tab['label'] }}
                                        <span class="badge sn-status-tab__count">{{ $tab['count'] }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        {{-- ===== Search box ===== --}}
                        <div class="row mb-3">
                            <div class="col-12 col-md-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="search"
                                           id="snBookingSearch"
                                           class="form-control"
                                           placeholder="{{ __('Search name, email, pickup, offer ID…') }}"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-md-right mt-2 mt-md-0">
                                <small class="text-muted">
                                    <span id="snBookingVisible">{{ $countAll }}</span> /
                                    <span>{{ $countAll }}</span> {{ __('bookings') }}
                                </small>
                            </div>
                        </div>

                        {{-- ===== Table ===== --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover sn-booking-table" id="snBookingTable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" scope="col">{{ __('#') }}</th>
                                        <th style="width: 12%;" scope="col" class="sn-sortable" data-sn-sort="offer_id">
                                            {{ __('Offer ID') }}
                                            <i class="fas fa-sort sn-sort-icon" aria-hidden="true"></i>
                                        </th>
                                        <th style="width: 18%;" scope="col" class="sn-sortable" data-sn-sort="full_name">
                                            {{ __('Full Name') }}
                                            <i class="fas fa-sort sn-sort-icon" aria-hidden="true"></i>
                                        </th>
                                        <th style="width: 18%;" scope="col">{{ __('Email') }}</th>
                                        <th style="width: 12%;" scope="col" class="sn-sortable" data-sn-sort="booking_date">
                                            {{ __('Date') }}
                                            <i class="fas fa-sort sn-sort-icon" aria-hidden="true"></i>
                                        </th>
                                        <th style="width: 12%;" scope="col" class="sn-sortable" data-sn-sort="status">
                                            {{ __('Status') }}
                                            <i class="fas fa-sort sn-sort-icon" aria-hidden="true"></i>
                                        </th>
                                        <th style="width: 18%;" scope="col">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        @php
                                            $statusKey = $booking->status ?? 'pending';
                                            $statusLabel = match ($statusKey) {
                                                'pending'   => __('Pending'),
                                                'inprocess' => __('In process'),
                                                'confirmed' => __('Confirmed'),
                                                'canceled'  => __('Cancelled'),
                                                'completed' => __('Completed'),
                                                default     => ucfirst($statusKey),
                                            };
                                            /* Search-text aggregator for filter */
                                            $rowSearch = mb_strtolower(implode(' ', array_filter([
                                                $booking->offer_id,
                                                $booking->full_name,
                                                $booking->email,
                                                $booking->phone,
                                                $booking->pickup,
                                                $booking->destination,
                                            ])));
                                        @endphp
                                        <tr data-sn-status="{{ $statusKey }}"
                                            data-sn-search="{{ $rowSearch }}"
                                            data-sn-offer_id="{{ $booking->offer_id ?? '' }}"
                                            data-sn-full_name="{{ mb_strtolower($booking->full_name ?? '') }}"
                                            data-sn-booking_date="{{ $booking->booking_date ?? '' }}">

                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if (!empty($booking->offer_id))
                                                    <code class="text-muted">#{{ $booking->offer_id }}</code>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $booking->full_name ?: '—' }}</strong>
                                                @if (!empty($booking->phone))
                                                    <br><small class="text-muted">
                                                        <i class="fas fa-phone fa-xs" aria-hidden="true"></i>
                                                        {{ $booking->phone }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($booking->email))
                                                    <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($booking->booking_date))
                                                    <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d.m.Y') }}</strong>
                                                    @if (!empty($booking->booking_time))
                                                        <br><small class="text-muted">{{ $booking->booking_time }}</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge sn-status-badge sn-status-{{ $statusKey }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('Actions') }}">
                                                    @if (Route::has('admin.booking.detail'))
                                                        <a href="{{ route('admin.booking.detail', $booking->id) }}"
                                                           class="btn btn-outline-secondary"
                                                           title="{{ __('View') }}">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                                       class="btn btn-outline-info"
                                                       title="{{ __('Edit') }}">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-outline-danger sn-delete-btn"
                                                            data-action="{{ route('admin.booking.delete', $booking->id) }}"
                                                            data-name="{{ $booking->full_name ?: ($booking->email ?: '#' . $booking->id) }}"
                                                            title="{{ __('Delete') }}">
                                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted p-5">
                                                <i class="fas fa-inbox fa-3x d-block mb-3"></i>
                                                {{ __('No bookings yet.') }}
                                                <br>
                                                <a href="{{ route('admin.booking.add') }}" class="btn btn-primary btn-sm mt-3">
                                                    <i class="fas fa-plus"></i> {{ __('Add the first booking') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- "No matches" message — toggled by JS --}}
                        <p id="snBookingNoMatches" class="text-center text-muted p-4" style="display:none;">
                            <i class="fas fa-search fa-2x d-block mb-2"></i>
                            {{ __('No bookings match your filter.') }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Confirm-delete modal (shared, single instance) ===== --}}
<div class="modal fade" id="snDeleteModal" tabindex="-1" role="dialog" aria-labelledby="snDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="snDeleteTitle">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    {{ __('Confirm deletion') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {{ __('Are you sure you want to delete this booking?') }}
                    <br>
                    <strong id="snDeleteName">—</strong>
                </p>
                <small class="text-muted">{{ __('This action cannot be undone.') }}</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form id="snDeleteForm" method="POST" action="" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Status filter tabs (replaces ad-hoc pill styling) */
    .sn-status-tabs .nav-link {
        background: #f7f9fc;
        color: #2c3e57;
        border: 1px solid #e2e8f0;
        margin: 0 4px 4px 0;
        font-size: 13px;
        font-weight: 600;
        transition: all .15s ease;
    }
    .sn-status-tabs .nav-link:hover {
        border-color: #0F4C81;
        color: #0F4C81;
    }
    .sn-status-tabs .nav-link.active {
        background: #0F4C81;
        color: #fff;
        border-color: #0F4C81;
    }
    .sn-status-tabs .nav-link.active .badge {
        background: rgba(255,255,255,.25);
        color: #fff;
    }
    .sn-status-tab__count {
        margin-left: 6px;
        background: #cbd5e1;
        color: #0e1a2b;
        font-size: 10px;
    }

    /* Status badges (in table cells) */
    .sn-status-badge { font-size: 11px; padding: 4px 10px; }
    .sn-status-pending   { background: #fef3c7; color: #d97706; }
    .sn-status-inprocess { background: #e0f2fe; color: #0284c7; }
    .sn-status-confirmed { background: #dcfce7; color: #16a34a; }
    .sn-status-canceled  { background: #fee2e2; color: #dc2626; }
    .sn-status-completed { background: #e2e8f0; color: #475569; }

    /* Sortable columns */
    .sn-sortable {
        cursor: pointer;
        user-select: none;
        position: relative;
    }
    .sn-sortable:hover { background: #f1f5f9; }
    .sn-sort-icon { color: #cbd5e1; font-size: 11px; margin-left: 4px; }
    .sn-sortable[data-sn-direction="asc"]  .sn-sort-icon::before { content: "\f0de"; color: #0F4C81; }
    .sn-sortable[data-sn-direction="desc"] .sn-sort-icon::before { content: "\f0dd"; color: #0F4C81; }

    /* Action button group */
    .btn-group-sm > .btn { padding: 4px 9px; font-size: 12px; }
</style>

@push('scripts')
<script>
(function () {
    'use strict';

    var table   = document.getElementById('snBookingTable');
    if (!table) return;

    var tbody   = table.querySelector('tbody');
    var rows    = Array.from(tbody.querySelectorAll('tr[data-sn-search]'));
    var search  = document.getElementById('snBookingSearch');
    var visible = document.getElementById('snBookingVisible');
    var noMatch = document.getElementById('snBookingNoMatches');
    var tabs    = document.querySelectorAll('[data-sn-filter]');
    var sorts   = document.querySelectorAll('[data-sn-sort]');

    var state   = {
        status: '{{ $activeStatus }}',
        query:  ''
    };

    function applyFilter() {
        var shown = 0;
        var q = state.query.trim().toLowerCase();
        rows.forEach(function (row) {
            var matchesStatus = (state.status === 'all') || (row.dataset.snStatus === state.status);
            var matchesQuery  = !q || (row.dataset.snSearch || '').indexOf(q) !== -1;
            var visible = matchesStatus && matchesQuery;
            row.style.display = visible ? '' : 'none';
            if (visible) shown++;
        });
        if (visible) visible.textContent = shown;
        if (noMatch) noMatch.style.display = (shown === 0 && rows.length > 0) ? 'block' : 'none';
    }

    /* Status tabs */
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) {
                t.classList.remove('active');
                t.setAttribute('aria-pressed', 'false');
            });
            tab.classList.add('active');
            tab.setAttribute('aria-pressed', 'true');
            state.status = tab.dataset.snFilter;
            applyFilter();
        });
    });

    /* Search */
    if (search) {
        var t;
        search.addEventListener('input', function () {
            clearTimeout(t);
            t = setTimeout(function () {
                state.query = search.value;
                applyFilter();
            }, 100);
        });
    }

    /* Sorting */
    sorts.forEach(function (th) {
        th.addEventListener('click', function () {
            var key = th.dataset.snSort;
            var direction = th.dataset.snDirection === 'asc' ? 'desc' : 'asc';
            sorts.forEach(function (other) { other.removeAttribute('data-sn-direction'); });
            th.dataset.snDirection = direction;

            var sorted = rows.slice().sort(function (a, b) {
                var av = (a.dataset['sn' + key.charAt(0).toUpperCase() + key.slice(1).replace(/_(.)/g, function(_, c){return c.toUpperCase();})] || '').toString();
                var bv = (b.dataset['sn' + key.charAt(0).toUpperCase() + key.slice(1).replace(/_(.)/g, function(_, c){return c.toUpperCase();})] || '').toString();
                if (av < bv) return direction === 'asc' ? -1 : 1;
                if (av > bv) return direction === 'asc' ? 1 : -1;
                return 0;
            });
            sorted.forEach(function (r) { tbody.appendChild(r); });
        });
    });

    /* Confirm-delete modal */
    document.querySelectorAll('.sn-delete-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var modal     = document.getElementById('snDeleteModal');
            var form      = document.getElementById('snDeleteForm');
            var nameLabel = document.getElementById('snDeleteName');
            if (form) form.action = btn.dataset.action;
            if (nameLabel) nameLabel.textContent = btn.dataset.name || '—';
            if (typeof jQuery !== 'undefined' && modal) {
                jQuery(modal).modal('show');
            } else if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
            }
        });
    });

    /* Initial filter pass */
    applyFilter();
})();
</script>
@endpush
@endsection
