@extends('admin.layouts.master')
@section('title', 'Add Service Category')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Service Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                                Home</a></li>
                        <li class="breadcrumb-item active">Service Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="{{ route('admin.service.category.store') }}" method="post"
                        enctype="multipart/form-data" id="serviceForm">
                        @csrf   
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title mt-1">{{ __('Add Service Category') }}</h3>
                                        <div class="card-tools">
                                            <a href="{{ route('admin.service.category.index') }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <!-- Title -->
                                            <div class="col-md-12 mb-3">
                                                <label for="title">Title <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-heading"></i></span></div>
                                                    <input type="text" id="title"
                                                        class="form-control form-control-sm" name="title"
                                                        value="{{ old('title') }}" placeholder="Enter Title" required>
                                                </div>
                                                @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- Slug
                                            <div class="col-md-6 mb-3">
                                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                    </div>

                                                    <input type="text" name="slug"
                                                        class="form-control form-control-sm" value="{{ old('slug') }}">
                                                </div>
                                                @error('slug')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

 --}}
                                            <!-- Order No -->
                                            <div class="col-md-6 mb-3">
                                                <label for="order_no">Order No <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-sort-numeric-up"></i></span></div>
                                                    <input type="number" id="order_no"
                                                        class="form-control form-control-sm" name="order_no"
                                                        value="{{ old('order_no') }}" placeholder="Enter Order No" required>
                                                </div>
                                                @error('order_no')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-6 mb-3">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-toggle-on"></i></span></div>
                                                    <select name="status" id="status"
                                                        class="form-control form-control-sm" required>
                                                        <option value="" disabled
                                                            {{ old('status') ? '' : 'selected' }}>Select Status</option>
                                                        <option value="publish"
                                                            {{ old('status') == 'publish' ? 'selected' : '' }}>Published
                                                        </option>
                                                        <option value="draft"
                                                            {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    </select>
                                                </div>
                                                @error('status')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            {{-- Featured --}}
                                            <div class="col-md-6">
                                                <label for="isfeature">{{ __('IsFeature  ') }} <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-toggle-on"></i></span></div>

                                                    <select id="isfeature" name="isfeature"
                                                        class="form-control form-control-sm">
                                                        <option value="featured"
                                                            {{ old('isfeature') == 'featured' ? 'selected' : '' }}>Featured
                                                        </option>
                                                        <option value="unfeatured"
                                                            {{ old('isfeature') == 'unfeatured' ? 'selected' : '' }}>
                                                            Unfeatured
                                                        </option>
                                                    </select>
                                                </div>

                                                @error('isfeature')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- Font Awesome Icon --}}
                                            <div class="col-md-6">
                                                <label for="font_awesome_icon">{{ __('Font Awesome Icon') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                                    </div>

                                                    <input type="text" id="font_awesome_icon"
                                                        class="form-control form-control-sm" name="font_awesome_icon"
                                                        value="{{ old('font_awesome_icon') }}"
                                                        placeholder="e.g., fa fa-home">
                                                </div>

                                                @error('font_awesome_icon')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>


                                        <!-- Description Section -->
                                        <div class="col-md-12">
                                            <label for="description">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea id="description" class="form-control form-control-sm summernote" name="description" rows="6"
                                                placeholder="Enter Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <!-- Uploads Section -->
                                        <div class="row">
                                            {{-- Icon --}}
                                            <div class="col-md-6 mb-3">
                                                <label for="icon">Icon <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                                    </div>

                                                    <input type="file" class="form-control form-control-sm up-img"
                                                        name="icon" id="icon">
                                                </div>
                                                <img class="mw-400 mt-2 show-img img-demo"
                                                    src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                                    width="50px">
                                                @error('icon')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            {{-- thumbnail --}}
                                            <div class="col-md-6 mb-3">
                                                <label for="icon">Thumbnail <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-icons"></i></span>
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


                                            <div class="col-md-6 mb-3">
                                                <label for="banner_image">Banner Image</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                    </div>

                                                    <input type="file" class="form-control form-control-sm up-img"
                                                        name="banner_image" id="banner_image">
                                                </div>
                                                <img class="mw-400 mt-2 show-img img-demo"
                                                    src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                                    width="50px">
                                                @error('banner_image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="meta_title">Meta Title</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-heading"></i></span>
                                                    </div>

                                                    <input type="text" class="form-control form-control-sm"
                                                        name="meta_title" value="{{ old('meta_title') }}"
                                                        placeholder="Enter Meta Title">
                                                </div>
                                                @error('meta_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>



                                        <!-- SEO Fields -->
                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <label for="meta_description">Meta Description</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-file-text"></i></span>
                                                    </div>

                                                    <textarea id="meta_description" class="form-control form-control-sm" name="meta_description" rows="4"
                                                        placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                                                </div>
                                                @error('meta_description')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- Submit -->
                                        <div class="text-center mb-5">
                                            <button type="submit" class="btn btn-success btn-lg"
                                                style="border-radius: 10px;">Add Service Category</button>
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
