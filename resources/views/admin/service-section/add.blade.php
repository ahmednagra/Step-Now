@extends('admin.layouts.master')
@section('title', 'Add Service Section')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Add Service Section') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                                {{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Service Section') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="{{ route('admin.service.section.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="">{{ __('Add Service Section') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <input type="hidden" name="service_id" value="{{ $service->id }}">

                                            <!-- Title Fields -->
                                            <div class="col-md-6 mb-3">
                                                <label for="service_title">Service Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                    </div>

                                                    <input type="text" id="title"
                                                        class="form-control form-control-sm form-control form-control-sm-sm"
                                                        name="title" placeholder="Enter  Title"
                                                        value="{{ old('title') }}" required>
                                                </div> @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- SubTitle Fields -->
                                            <div class="col-md-6 mb-3">
                                                <label for="subtitle"> Subtitle <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-pencil-alt"></i></span>
                                                    </div>

                                                    <input type="text" id="subtitle"
                                                        class="form-control form-control-sm" name="subtitle"
                                                        placeholder="Enter  Subtitle"
                                                        value="{{ old('subtitle') }}" required>
                                                </div> @error('subtitle')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Order Number -->
                                            <div class="col-md-6 mb-3">
                                                <label for="order_no">Order No <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-sort-numeric-up"></i></span></div>
                                                    <input type="number" id="order_no"
                                                        class="form-control form-control-sm" name="order_no"
                                                        value="{{ old('order_no') }}" placeholder="Enter Order No"
                                                        required>
                                                </div>
                                                @error('order_no')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- type -->
                                            <div class="col-md-6 mb-3">
                                                <label for="type">{{ __('Type') }}<span
                                                        class="text-danger">*</span></label>
                                                <select id="type" name="type" class="form-control">
                                                    <option value="" selected disabled>Select Type</option>
                                                    <option value="rtl">Right To Left</option>
                                                    <option value="ltr">Left To Right</option>
                                                </select>
                                                @error('type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Description Fields -->
                                            <div class="col-md-12 mb-3">
                                                <label for="description">{{ __('Description ') }}<span
                                                        class="text-danger">*</span></label>
                                                <textarea id="description" class="form-control summernote" name="description"
                                                    placeholder="Enter Description " rows="6" required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- image -->
                                            <div class="col-md-12">
                                                <label for="image">{{ __('Image') }}<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label class="custom-file-label"
                                                            for="image">{{ __('Choose New Image') }}</label>
                                                        <input type="file"
                                                            class="custom-file-input up-img form-control" name="image"
                                                            id="image">
                                                        <img class="mw-400 mb-3 show-img img-demo mt-2"
                                                            src="{{ asset('assets/admin/img/img-demo.jpg') }}"
                                                            alt="">
                                                        @error('image')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success btn-lg"
                                                style="border-radius: 10px;">{{ __('Add Service Section') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
