@extends('admin.layouts.master')
@section('title', 'Add Service Project')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline mt-2">
                        <form class="form-horizontal" action="{{ route('admin.service.project.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body pb-0">
                                <div class="row">
                                    {{-- Service --}}
                                    <div class="col-md-4 mb-3">
                                        <label for="service_id">Service <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fas fa-list"></i></span></div>
                                            <select name="service_id" id="service_id" class="form-control form-control-sm"
                                                required>
                                                <option value="">Select Service </option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
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
                                            name="title" value="{{ old('title') }}" placeholder="Enter Title" required>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Is Feature --}}
                                    <div class="col-md-4">
                                        <label for="isfeature">{{ __('Is Feature') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="fas fa-toggle-on"></i></span></div>
                                            <select id="isfeature" name="isfeature" class="form-control form-control-sm">
                                                <option value="featured"
                                                    {{ old('isfeature') == 'featured' ? 'selected' : '' }}>Featured</option>
                                                <option value="unfeatured"
                                                    {{ old('isfeature') == 'unfeatured' ? 'selected' : '' }}>Unfeatured
                                                </option>
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
                                            placeholder="Enter Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Thumbnail --}}
                                    <div class="col-md-4 mb-3">
                                        <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            </div>
                                            <input type="file" class="form-control form-control-sm up-img"
                                                name="thumbnail" id="thumbnail">
                                        </div>
                                        <img class="mw-400 mt-2 show-img img-demo"
                                            src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                            width="50px">
                                        @error('thumbnail')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="image_gallery">Gallery Image <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            </div>
                                            <input type="file" class="form-control form-control-sm up-img"
                                                name="image_gallery[]" id="image_gallery" multiple>
                                        </div>
                                        <img class="mw-400 mt-2 show-img img-demo"
                                            src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                            width="50px">
                                        @error('image_gallery')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="show_on_home">Show On Home <span class="text-danger">*</span></label>
                                        <input type="show_on_home" id="show_on_home" class="form-control form-control-sm"
                                            name="show_on_home" value="{{ old('show_on_home') }}" placeholder="Enter show_on_home" required>
                                        @error('show_on_home')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{ __('Save Service Project') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                <div class="card card-primary card-outline mt-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mt-1">{{ __('List of Service Projects') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table-sm table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Service</th>
                                    <th>Is Feature</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service_project as $id => $project)
                                    <tr>
                                        <td>{{ ++$id }}</td>
                                        <td>
                                                <img src="{{ asset($project->thumbnail) }}" width="50">
                                        </td>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->service->name ?? '—' }}</td>
                                        <td>{{ $project->isfeature == 'featured' ? 'Featured' : 'Unfeatured' }}</td>
                                        <td>
                                            <div class="float-end">
                                                <a href="{{ route('admin.service.project.edit', $project->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>{{ __('Edit') }}
                                                </a>
                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.service.project.delete', $project->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                    </button>
                                                </form>

                                            </div>
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
