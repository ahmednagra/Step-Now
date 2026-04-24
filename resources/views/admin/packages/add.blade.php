@extends('admin.layouts.master')
@section('title', 'Add Package')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card card-primary card-outline mt-3">
                    <div class="card-header">
                        <h3 class="card-title text-primary"><i class="fas fa-plus-circle"></i> Add New Package</h3>
                    </div>

                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="service_category_id">Package Category <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="fas fa-list"></i></span></div>
                                    <select name="package_category_id" id="package_category_id"
                                        class="form-control form-control-sm form-control form-control-sm-sm" required>
                                        <option value="">Select Package Category</option>
                                        @foreach ($package_categories as $package_category)
                                            <option value="{{ $package_category->id }}"
                                                {{ old('package_category_id') == $package_category->id ? 'selected' : '' }}>
                                                {{ $package_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('package_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" id="destination" name="destination" class="form-control form-control-sm"
                                        value="{{ old('destination') }}" required>
                                </div>
                                @error('destination')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- Title --}}
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" id="title" name="title" class="form-control form-control-sm"
                                        value="{{ old('title') }}" required>
                                </div>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Subtitle --}}
                            <div class="col-md-6 mb-3">
                                <label for="subtitle" class="form-label">Subtitle <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                    </div>
                                    <input type="text" id="subtitle" name="subtitle"
                                        class="form-control form-control-sm" value="{{ old('subtitle') }}" required>
                                </div>
                                @error('subtitle')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="order_no">Order No</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                    </div>
                                    <input type="number" class="form-control" name="order_no" id="order_no"
                                        value="{{ old('order_no') }}" placeholder="Order number">
                                </div>
                                @error('order_no')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Amount --}}
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" name="amount" step="0.01" class="form-control form-control-sm"
                                        value="{{ old('amount') }}" required>
                                </div>
                                @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Discount Percentage --}}
                            <div class="col-md-6 mb-3">
                                <label for="discount_percentage" class="form-label">Discount %</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    </div>

                                    <input type="number" name="discount_percentage" step="0.01"
                                        class="form-control form-control-sm" value="{{ old('discount_percentage') }}">
                                </div>
                                @error('discount_percentage')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Discounted Amount --}}
                            <div class="col-md-6 mb-3">
                                <label for="discounted_amount" class="form-label">Discounted Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>

                                    <input type="number" name="discounted_amount" step="0.01"
                                        class="form-control form-control-sm" value="{{ old('discounted_amount') }}">
                                </div>
                                @error('discounted_amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    </div>

                                    <select name="status" class="form-control form-control-sm" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Publish --}}
                            <div class="col-md-6 mb-3">
                                <label for="publish" class="form-label">Publish</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>

                                    <select name="publish" class="form-control form-control-sm">
                                        <option value="draft" {{ old('publish') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published" {{ old('publish') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                </div>
                                @error('publish')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Icon --}}
                            <div class="col-md-12 mb-3">
                                <label for="icon">Icon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-icons"></i></span>
                                    </div>
                                    <input type="file" class="form-control form-control-sm up-img" name="icon"
                                        id="icon">
                                </div>
                                <img class="mw-400 mt-1 show-img img-demo"
                                    src="{{ asset('assets/uploads/core/img-demo.jpg') }}" alt="icon preview"
                                    width="50px">
                                @error('icon')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>

                        {{-- Package Details --}}

                        <div class="mb-3">
                            <label>Package Details</label>
                            <div id="features-container">
                                <!-- Initially one row -->
                                <div class="row mb-3 feature-group">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                            </div>

                                            <input type="text" name="details[0][title]"
                                                class="form-control form-control-sm" placeholder="Detail Title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                            </div>

                                            <select name="details[0][status]" class="form-control form-control-sm">
                                                <option value="included">Included</option>
                                                <option value="excluded">Excluded</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa fa-sort-numeric-up"></i></span>
                                            </div>

                                            <input type="number" name="details[0][order_no]"
                                                class="form-control form-control-sm" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-feature">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary mt-2" id="add-feature">Add Details</button>
                        </div>


                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save Package</button>
                        </div>
                    </div>
            </form>
        </div>
    </section>
@endsection

{{-- JS for adding/removing details --}}
@section('js')

    <script>
        $(document).ready(function() {
            let featureIndex = 1;

            $('#add-feature').click(function() {
                $('#features-container').append(`
                <div class="row mb-3 feature-group">
                    <div class="col-md-5">
                                                                        <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                                    </div>

                        <input type="text" name="details[${featureIndex}][title]" class="form-control form-control-sm" placeholder="Detail Title" required>
                    </div>                                                    </div>


                    <div class="col-md-3">
                                                                        <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                                    </div>

                        <select name="details[${featureIndex}][status]" class="form-control form-control-sm">
                            <option value="included">Included</option>
                            <option value="excluded">Excluded</option>
                        </select>
                    </div>                                                    </div>

                    <div class="col-md-2">
                                                                        <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-sort-numeric-up"></i></span>
                                                    </div>

                        <input type="number" name="details[${featureIndex}][order_no]" class="form-control form-control-sm" value="0">
                    </div>                                                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                    </div>
                </div>
            `);
                featureIndex++;
            });

            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-group').remove();
            });
        });
    </script>
@endsection
