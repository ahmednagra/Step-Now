@extends('admin.layouts.master')
@section('title', 'Edit Package Category')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.package-category.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card card-primary card-outline mt-3">
                    <div class="card-header">
                        <h3 class="card-title text-primary"><i class="fas fa-edit"></i> Edit Package Category</h3>
                    </div>

                    <div class="card-body py-3">
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>

                                    <input type="text" name="name" class="form-control form-control-sm"
                                        value="{{ old('name', $category->name) }}" required>
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>

                                    <input type="text" name="slug" class="form-control form-control-sm"
                                        value="{{ old('slug', $category->slug) }}">
                                </div>
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            {{-- Title --}}
                            <div class="col-md-6 mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>

                                    <input type="text" name="title" class="form-control form-control-sm"
                                        value="{{ old('title', $category->title) }}" required>
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Sub Title --}}
                            <div class="col-md-6 mb-3">
                                <label for="sub_title">Sub Title</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                    </div>

                                    <input type="text" name="sub_title" class="form-control form-control-sm"
                                        value="{{ old('sub_title', $category->sub_title) }}">
                                </div>
                                @error('sub_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control form-control-sm summernote" rows="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Order No --}}
                            <div class="col-md-6 mb-3">
                                <label for="order_no">Order No <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-sort-numeric-up"></i></span>
                                    </div>

                                    <input type="number" name="order_no" class="form-control form-control-sm"
                                        value="{{ old('order_no', $category->order_no) }}" required>
                                </div>
                                @error('order_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    </div>

                                    <select name="status" class="form-control form-control-sm">
                                        <option value="active"
                                            {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Icon Upload --}}
                            <div class="col-md-12 mt-2">
                                <label for="icon">
                                    {{ __('Icon') }}
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                    </div>
                                    <input type="file" class="form-control form-control-sm up-img" name="icon"
                                        id="icon">
                                </div>
                                <img class="mw-400 mb-3 show-img img-demo"
                                    src="{{ asset('assets/admin/uploads/package-category/icon/' . $category->icon) }}"
                                    alt="" width="50px">

                                @if ($errors->has('icon'))
                                    <p class="text-danger">{{ $errors->first('icon') }}</p>
                                @endif
                            </div>

                            <div class="col-md-12 mt-2">
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
                                <img class="mw-400 mb-3 show-img img-demo"
                                    src="{{ asset('assets/admin/uploads/package-category/image/' . $category->image) }}"
                                    alt="" width="50px">

                                @if ($errors->has('image'))
                                    <p class="text-danger">{{ $errors->first('image') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
