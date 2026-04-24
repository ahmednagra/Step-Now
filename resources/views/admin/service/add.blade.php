@extends('admin.layouts.master')
@section('title', 'Add Services')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" action="{{ route('admin.service.store') }}" method="post"
                        enctype="multipart/form-data" id="serviceForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline mt-2">
                                    <div class="card-header">
                                        <div class="card-title">Add Service</div>
                                    </div>
                                    <div class="card-body py-3">
                                        <!-- Just paste this in your original Blade where form starts -->
                                        <div class="row">
                                            <!-- Service Category -->
                                            <div class="col-md-6 mb-3">
                                                <label for="service_category_id">Service Category <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-list"></i></span></div>
                                                    <select name="service_category_id" id="service_category_id"
                                                        class="form-control form-control-sm form-control form-control-sm-sm"
                                                        required>
                                                        <option value="">Select Service Category</option>
                                                        @foreach ($service_categories as $service_category)
                                                            <option value="{{ $service_category->id }}"
                                                                {{ old('service_category_id') == $service_category->id ? 'selected' : '' }}>
                                                                {{ $service_category->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('service_category_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Name -->
                                            <div class="col-md-6 mb-3">
                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-users"></i></span></div>
                                                    <input type="text" id="name"
                                                        class="form-control form-control-sm" name="name"
                                                        value="{{ old('name') }}" placeholder="Enter Name" required>
                                                </div>
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- Slug
                                            <div class="col-md-4 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fas fa-tasks"></i></span></div>
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
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
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
                                            <!-- Service Title -->
                                            <div class="col-md-6 mb-3">
                                                <label for="service_title">Service Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                    </div>

                                                    <input type="text" id="service_title"
                                                        class="form-control form-control-sm form-control form-control-sm-sm"
                                                        name="service_title" placeholder="Enter Service Title"
                                                        value="{{ old('service_title') }}" required>
                                                </div> @error('service_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- service Subtitle -->
                                            <div class="col-md-6 mb-3">
                                                <label for="service_subtitle">Service Subtitle <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-pencil-alt"></i></span>
                                                    </div>

                                                    <input type="text" id="service_subtitle"
                                                        class="form-control form-control-sm" name="service_subtitle"
                                                        placeholder="Enter Service Subtitle"
                                                        value="{{ old('service_subtitle') }}" required>
                                                </div> @error('service_subtitle')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- Description Section -->
                                        <div class="col-md-12 mb-3">
                                            <label for="short_description">Short Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea id="short_description" class="form-control form-control-sm summernote" name="short_description"
                                                rows="6" placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                                            @error('short_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Description Section -->
                                        <div class="col-md-12 mb-3">
                                            <label for="description"> Long Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea id="description" class="form-control form-control-sm summernote" name="description" rows="6"
                                                placeholder="Enter Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="other_description">Other Description</label>
                                            <textarea id="other_description" class="form-control form-control-sm summernote" name="other_description"
                                                rows="6" placeholder="Enter Other Description">{{ old('other_description') }}</textarea>
                                            @error('other_description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <!-- Uploads Section -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="icon">Icon</label>
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
                                            <div class="col-md-4 mb-3">
                                                <label for="thumbnail">Thumbnail <span
                                                        class="text-danger">*</span></label>
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
                                                <label for="banner_image">Banner Image <span
                                                        class="text-danger">*</span></label>
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
                                            <!-- Banner Title -->
                                            <div class="col-md-6 mb-3">
                                                <label for="banner_title">Banner Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                    </div>

                                                    <input type="text" id="banner_title"
                                                        class="form-control form-control-sm form-control form-control-sm-sm"
                                                        name="banner_title" placeholder="Enter Banner Title"
                                                        value="{{ old('banner_title') }}" required>
                                                </div> @error('banner_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Banner Subtitle -->
                                            <div class="col-md-6 mb-3">
                                                <label for="banner_subtitle">Banner Subtitle <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-pencil-alt"></i></span>
                                                    </div>

                                                    <input type="text" id="banner_subtitle"
                                                        class="form-control form-control-sm" name="banner_subtitle"
                                                        placeholder="Enter Banner Subtitle"
                                                        value="{{ old('banner_subtitle') }}" required>
                                                </div> @error('banner_subtitle')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>

                                        <!-- SEO Fields -->
                                        <div class="row">
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

                                            <div class="col-md-6 mb-3">
                                                <label for="meta_keywords">Meta Keywords</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                                    </div>

                                                    <input type="text" class="form-control form-control-sm"
                                                        name="meta_keywords" value="{{ old('meta_keywords') }}"
                                                        placeholder="Enter Meta Keywords">
                                                </div>
                                                @error('meta_keywords')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

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

                                            <div class="col-md-12 mb-3">
                                                <label for="meta_image">Meta Image</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                    </div>

                                                    <input type="file" class="form-control form-control-sm up-img"
                                                        name="meta_image" id="meta_image">
                                                </div>
                                                <img class="mw-400 mt-2 show-img img-demo"
                                                    src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt=""
                                                    width="50px">
                                                @error('meta_image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="text-center mb-5">
                                            <button type="submit" class="btn btn-success btn-lg"
                                                style="border-radius: 10px;">Add Service</button>
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