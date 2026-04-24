@extends('admin.layouts.master')
@section('title', 'Booking List')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Booking List') }}</h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.booking.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add Booking') }}
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">{{ __('#') }}</th>
                                        <th style="width: 12%;">{{ __('Offer Id') }}</th>
                                        <th style="width: 20%;">{{ __('Full Name') }}</th>
                                        <th style="width: 18%;">{{ __('Email') }}</th>
                                        <th style="width: 15%;">{{ __('Status') }}</th>
                                        <th style="width: 15%;">{{ __('Action') }}</th>
                                    </tr>


                                </thead>

                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $booking->offer_id }}</td>
                                            <td>{{ $booking->full_name }}</td>
                                            <td>{{ $booking->email }}</td>

                                            <td>
                                                @if ($booking->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($booking->status == 'inprocess')
                                                    <span class="badge badge-info">In Process</span>
                                                @elseif ($booking->status == 'confirmed')
                                                    <span class="badge badge-success">Confirmed</span>
                                                @elseif ($booking->status == 'canceled')
                                                    <span class="badge badge-danger">Canceled</span>
                                                @elseif ($booking->status == 'completed')
                                                    <span class="badge badge-primary">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>

                                                <form action="{{ route('admin.booking.delete', $booking->id) }}"
                                                    method="POST" class="d-inline-block" id="deleteform">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
