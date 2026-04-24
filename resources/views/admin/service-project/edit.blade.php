@extends('admin.layouts.master')
@section('title', 'Edit Service Project')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline mt-2">
                    <form class="form-horizontal" action="{{ route('admin.service.project.update', $service_project->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body pb-0">
                            <div class="row">
                                {{-- Service --}}
                                <div class="col-md-4 mb-3">
                                    <label for="service_id">Service <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-list"></i></span></div>
                                        <select name="service_id" id="service_id" class="form-control form-control-sm" required>
                                            <option value="">Select Service </option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}"
                                                    {{ (old('service_id') ?? $service_project->service_id) == $service->id ? 'selected' : '' }}>
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('service_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Title --}}
                                <div class="col-md-4">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control form-control-sm"
                                        name="title" value="{{ old('title', $service_project->title) }}" placeholder="Enter Title" required>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Is Feature --}}
                                <div class="col-md-4">
                                    <label for="isfeature">{{ __('Is Feature') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-toggle-on"></i></span></div>
                                        <select id="isfeature" name="isfeature" class="form-control form-control-sm">
                                            <option value="featured" {{ (old('isfeature') ?? $service_project->isfeature) == 'featured' ? 'selected' : '' }}>Featured</option>
                                            <option value="unfeatured" {{ (old('isfeature') ?? $service_project->isfeature) == 'unfeatured' ? 'selected' : '' }}>Unfeatured</option>
                                        </select>
                                    </div>
                                    @error('isfeature')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea id="description" class="form-control form-control-sm summernote" name="description" rows="6"
                                        placeholder="Enter Description">{{ old('description', $service_project->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-image"></i></span></div>
                                                    <input type="file" class="form-control form-control-sm up-img" name="thumbnail" id="thumbnail">
                                                </div>
                                                <img class="mw-400 mt-2 show-img img-demo" src="{{ asset($service_project->thumbnail ?: 'assets/admin/img/img-demo.jpg') }}" alt=""
                                                    width="50px">
                                                @error('thumbnail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="banner_image">Gallery Image  <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-image"></i></span></div>
                                                    <input type="file" class="form-control form-control-sm up-img" name="image_gallery" id="image_gallery">
                                                </div>
                                                <img class="mw-400 mt-2 show-img img-demo" src="{{ asset($service_project->image_gallery ?: 'assets/admin/img/img-demo.jpg') }}" alt=""
                                                    width="50px">
                                                @error('image_gallery')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                {{-- Gallery --}}

                                {{-- Show on Home --}}
                                <div class="col-md-4">
                                    <label for="show_on_home">Show On Home <span class="text-danger">*</span></label>
                                    <select id="show_on_home" name="show_on_home" class="form-control form-control-sm" required>
                                        <option value="1" {{ (old('show_on_home') ?? $service_project->show_on_home) == 1 ? 'selected' : '' }}>Show</option>
                                        <option value="0" {{ (old('show_on_home') ?? $service_project->show_on_home) == 0 ? 'selected' : '' }}>Hide</option>
                                    </select>
                                    @error('show_on_home')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> {{ __('Update Service Project') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
