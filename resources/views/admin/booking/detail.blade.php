@extends('admin.layouts.master')

@section('title', 'Booking Detail')

@section('content')

@php
    $statusKey = $booking->status ?? 'pending';
    $statusLabel = match ($statusKey) {
        'pending'   => __('Pending'),
        'inprocess' => __('In process'),
        'confirmed' => __('Confirmed'),
        'canceled'  => __('Cancelled'),
        'completed' => __('Completed'),
        default     => ucfirst((string) $statusKey),
    };
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-calendar-check"></i>
                    {{ __('Booking') }} #{{ $booking->id }}
                </h1>
                <ol class="breadcrumb mb-0 mt-1 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.booking.index') }}">{{ __('Bookings') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Detail') }}</li>
                </ol>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="{{ route('admin.booking.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> {{ __('Back to list') }}
                </a>
                <a href="{{ route('admin.booking.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">

            {{-- ===== Customer + Trip ===== --}}
            <div class="col-lg-8">
                <div class="card card-primary card-outline mt-2">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-user"></i> {{ __('Customer & Trip') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Full name') }}</small>
                                <div class="sn-detail-value"><strong>{{ $booking->full_name ?: '—' }}</strong></div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Offer ID') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->offer_id))
                                        <code>#{{ $booking->offer_id }}</code>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Email') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->email))
                                        <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Phone') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->phone))
                                        <a href="tel:{{ $booking->phone }}">{{ $booking->phone }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Pickup location') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->pickup))
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        {{ $booking->pickup }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Destination') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->destination))
                                        <i class="fas fa-flag-checkered text-success"></i>
                                        {{ $booking->destination }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Date') }}</small>
                                <div class="sn-detail-value">
                                    @if (!empty($booking->booking_date))
                                        <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('dddd, LL') }}</strong>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Time') }}</small>
                                <div class="sn-detail-value">
                                    {{ !empty($booking->booking_time) ? $booking->booking_time : '—' }}
                                </div>
                            </div>
                            <div class="col-md-4 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Number of people') }}</small>
                                <div class="sn-detail-value">
                                    <i class="fas fa-users text-muted"></i>
                                    {{ $booking->no_of_people ?: '—' }}
                                </div>
                            </div>
                            <div class="col-md-12 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Customer message') }}</small>
                                <div class="sn-detail-value sn-detail-prose">
                                    {!! !empty($booking->message)
                                        ? nl2br(e($booking->message))
                                        : '<span class="text-muted">' . __('No message provided.') . '</span>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== Status + Admin remarks ===== --}}
            <div class="col-lg-4">
                <div class="card card-primary card-outline mt-2">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-flag"></i> {{ __('Status') }}
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <span class="sn-status-pill sn-status-{{ $statusKey }}">
                            {{ $statusLabel }}
                        </span>
                        <p class="text-muted mt-3 mb-0">
                            <small>
                                {{ __('Last updated') }}:
                                {{ $booking->updated_at ? \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() : '—' }}
                            </small>
                        </p>
                    </div>
                </div>

                <div class="card card-warning card-outline mt-3">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-sticky-note"></i> {{ __('Admin remarks') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="sn-detail-prose">
                            {!! !empty($booking->admin_remarks)
                                ? nl2br(e($booking->admin_remarks))
                                : '<span class="text-muted">' . __('No internal notes.') . '</span>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Audit / metadata ===== --}}
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-outline mt-2">
                    <div class="card-header">
                        <h3 class="card-title mt-1">
                            <i class="fas fa-clock"></i> {{ __('Audit') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Created') }}</small>
                                <div class="sn-detail-value">
                                    {{ $booking->created_at ? $booking->created_at->isoFormat('LLLL') : '—' }}
                                    @if ($booking->created_at)
                                        <small class="text-muted">({{ $booking->created_at->diffForHumans() }})</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 sn-detail-block">
                                <small class="sn-detail-label">{{ __('Last update') }}</small>
                                <div class="sn-detail-value">
                                    {{ $booking->updated_at ? $booking->updated_at->isoFormat('LLLL') : '—' }}
                                    @if ($booking->updated_at)
                                        <small class="text-muted">({{ $booking->updated_at->diffForHumans() }})</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .sn-detail-block {
        margin-bottom: 18px;
    }
    .sn-detail-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #5d6b80;
        margin-bottom: 4px;
    }
    .sn-detail-value {
        font-size: 15px;
        color: #0e1a2b;
        word-wrap: break-word;
    }
    .sn-detail-prose {
        font-size: 14px;
        line-height: 1.5;
        color: #1f2937;
        white-space: pre-wrap;
    }

    /* Big status pill on the side panel */
    .sn-status-pill {
        display: inline-block;
        padding: 8px 22px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: .02em;
    }
    .sn-status-pending   { background: #fef3c7; color: #d97706; }
    .sn-status-inprocess { background: #e0f2fe; color: #0284c7; }
    .sn-status-confirmed { background: #dcfce7; color: #16a34a; }
    .sn-status-canceled  { background: #fee2e2; color: #dc2626; }
    .sn-status-completed { background: #e2e8f0; color: #475569; }

    .breadcrumb { font-size: 13px; }
</style>

@endsection