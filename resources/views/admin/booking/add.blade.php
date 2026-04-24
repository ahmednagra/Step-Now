@extends('admin.layouts.master')
@section('title', 'Add Bookings')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Add Booking') }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Booking') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Add Booking') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.booking.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.booking.store') }}" method="post">
                                @csrf

                                {{-- Full Name --}}
                                <div class="form-group row">
                                    <label for="full_name" class="col-sm-12 control-label">
                                        {{ __('Full Name') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="full_name" class="form-control form-control-sm"
                                                name="full_name" value="{{ old('full_name') }}"
                                                placeholder="{{ __('Enter Full Name') }}">
                                        </div>
                                        @error('full_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-sm-12 control-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" id="email" class="form-control form-control-sm"
                                                name="email" value="{{ old('email') }}"
                                                placeholder="{{ __('Enter Email') }}">
                                        </div>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-12 control-label">{{ __('Phone') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" id="phone" class="form-control form-control-sm"
                                                name="phone" value="{{ old('phone') }}"
                                                placeholder="{{ __('Enter Phone Number') }}">
                                        </div>
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Offer ID --}}
                                <div class="form-group row">
                                    <label for="offer_id" class="col-sm-12 control-label">
                                        {{ __('Offer ID') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-gift"></i></span>
                                            </div>
                                            <input type="number" id="offer_id" class="form-control form-control-sm"
                                                name="offer_id" value="{{ old('offer_id') }}"
                                                placeholder="{{ __('Enter Offer ID') }}">
                                        </div>
                                        @error('offer_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pickup --}}
                                <div class="form-group row">
                                    <label for="pickup" class="col-sm-12 control-label">
                                        {{ __('Pickup') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" id="pickup" class="form-control form-control-sm"
                                                name="pickup" value="{{ old('pickup') }}"
                                                placeholder="{{ __('Enter Pickup Location') }}">
                                        </div>
                                        @error('pickup')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="destination" class="col-sm-12 control-label">{{ __('Destination') }} </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" id="destination" class="form-control form-control-sm"
                                                name="destination" value="{{ old('destination') }}"
                                                placeholder="{{ __('Enter Destination') }}">
                                        </div>
                                        @error('destination')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Booking Date --}}
                                <div class="form-group row">
                                    <label for="booking_date" class="col-sm-12 control-label">
                                        {{ __('Booking Date') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" id="booking_date" class="form-control form-control-sm"
                                                name="booking_date" value="{{ old('booking_date') }}">
                                        </div>
                                        @error('booking_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Booking Time --}}
                                <div class="form-group row">
                                    <label for="booking_time" class="col-sm-12 control-label">
                                        {{ __('Booking Time') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="time" id="booking_time" class="form-control form-control-sm"
                                                name="booking_time" value="{{ old('booking_time') }}">
                                        </div>
                                        @error('booking_time')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- No. of People --}}
                                <div class="form-group row">
                                    <label for="no_of_people" class="col-sm-12 control-label">
                                        {{ __('No. of People') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                            </div>
                                            <input type="number" id="no_of_people" class="form-control form-control-sm"
                                                name="no_of_people" min="1" value="{{ old('no_of_people') }}"
                                                placeholder="{{ __('Enter Number of People') }}">
                                        </div>
                                        @error('no_of_people')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Message --}}
                                <div class="form-group row">
                                    <label for="message" class="col-sm-12 control-label">
                                        Message
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-envelope-open-text"></i></span>
                                            </div>
                                            <textarea id="message" class="form-control form-control-sm" name="message" rows="4"
                                                placeholder="{{ __('Enter Message') }}">{{ old('message') }}</textarea>

                                        </div>
                                        @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="form-group row">
                                    <label for="status" class="col-sm-12 control-label">
                                        {{ __('Status') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                            </div>
                                            <select id="status" name="status" class="form-control form-control-sm">
                                                <option value="" disabled
                                                    {{ old('status') == '' ? 'selected' : '' }}>
                                                    Select Status
                                                </option>
                                                <option value="pending"
                                                    {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="inprocess"
                                                    {{ old('status') == 'inprocess' ? 'selected' : '' }}>
                                                    In Process
                                                </option>
                                                <option value="confirmed"
                                                    {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                                                    Confirmed
                                                </option>
                                                <option value="canceled"
                                                    {{ old('status') == 'canceled' ? 'selected' : '' }}>
                                                    Canceled
                                                </option>
                                                <option value="completed"
                                                    {{ old('status') == 'completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Admin Remarks --}}
                                <div class="form-group row">
                                    <label for="admin_remarks" class="col-sm-12 control-label">
                                        {{ __('Admin Remarks') }}
                                    </label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                                            </div>
                                            <textarea id="admin_remarks" class="form-control form-control-sm" name="admin_remarks" rows="3"
                                                placeholder="{{ __('Enter Admin Remarks') }}">{{ old('admin_remarks') }}</textarea>
                                        </div>
                                        @error('admin_remarks')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-paper-plane"></i> {{ __('Add') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
