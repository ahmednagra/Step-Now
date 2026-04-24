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
                    <div class="card-header ">
                        <h3 class="card-title mt-1">{{ __('Section Add') }}</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <form action="{{ route('admin.service.section.update', [$section->id, 'slug' => $slug]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Title and Subtitle -->
                                <div class="col-md-12 mb-3">
                                    <label for="title">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter Title" value="{{ old('title', $section->title) }}"
                                            required>
                                    </div>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">{{ __('Subtitle') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                        </div>
                                        <input type="text" id="subtitle" class="form-control" name="subtitle"
                                            placeholder="Enter Subtitle"
                                            value="{{ old('subtitle', $section->subtitle) }}" required>
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
                                            <option value="R-2-L"
                                                {{ old('type', $section->type ?? '') == 'R-2-L' ? 'selected' : '' }}>
                                                Right To Left</option>
                                            <option value="L-2-R"
                                                {{ old('type', $section->type ?? '') == 'L-2-R' ? 'selected' : '' }}>
                                                Left To Right</option>
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
                                        rows="6" required>{{ old('description', $section->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-12 mb-3">
                                    <label for="image">
                                        {{ __('Image') }}
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control form-control-sm up-img" name="image"
                                            id="image">
                                    </div>
                                    <img class="mw-400 mt-2 show-img img-demo" src="{{ asset($section->image) }}"
                                        alt="" width="50px">

                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>


                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-primary mt-2 float-right">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
