@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Add Section')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">

            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Section Add') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.service.section.store', ['slug' => $slug]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Title and Subtitle in One Row -->
                                <div class="col-md-12 mb-3">
                                    <label for="title">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter Title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">{{ __('Subtitle') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" id="subtitle" class="form-control" name="subtitle"
                                            placeholder="Enter Subtitle" value="{{ old('subtitle') }}" required>
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type">{{ __('Type') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                                        </div>
                                        <select id="type" name="type" class="form-control" required>
                                            <option selected disabled>Select Type</option>
                                            <option value="R-2-L">Right To Left</option>
                                            <option value="L-2-R">Left To Right</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" class="form-control" name="description" placeholder="Enter Description"
                                        rows="6" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Image') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text p-1 px-2">
                                                    <i class="fas fa-image"></i>
                                                </span>
                                                <input type="file" class="form-control form-control-sm up-img"
                                                    name="image" id="image" required>
                                            </div>

                                            <img class="mw-400 show-img img-demo mt-2"
                                                src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                                width="50px">

                                            @error('image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-primary mt-2 float-right">Submit</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
