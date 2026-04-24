@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Edit Block')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Block Edit') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('admin.service.block.update', $block->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Title Field -->
                                <div class="col-md-6 mb-3">
                                    <label class="col-form-label col-form-label-sm" for="title">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" id="title" class="form-control form-control-sm"
                                            name="title" placeholder="Enter Title"
                                            value="{{ old('title', $block->title) }}" required>
                                    </div>
                                    @error('title')
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
                                                {{ old('type', $block->type ?? '') == 'R-2-L' ? 'selected' : '' }}>
                                                Right To Left</option>
                                            <option value="L-2-R"
                                                {{ old('type', $block->type ?? '') == 'L-2-R' ? 'selected' : '' }}>
                                                Left To Right</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Subtitle Field -->
                                <div class="col-md-12 mb-3">
                                    <label class="col-form-label col-form-label-sm"
                                        for="subtitle">{{ __('Subtitle') }}</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        <input type="text" id="subtitle" class="form-control form-control-sm"
                                            name="subtitle" placeholder="Enter Subtitle"
                                            value="{{ old('subtitle', $block->subtitle) }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
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
                                    <img class="mw-400 mb-3 show-img img-demo" src="{{ asset($block->image) }}"
                                        alt="" width="50px">

                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>


                                <!-- Icon Upload -->
                                <div class="col-md-6 mb-3">
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
                                    <img class="mw-400 mb-3 show-img img-demo" src="{{ asset($block->icon) }}"
                                        alt="" width="50px">

                                    @if ($errors->has('icon'))
                                        <p class="text-danger">{{ $errors->first('icon') }}</p>
                                    @endif
                                </div>
                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" class="form-control summernote" name="description" rows="6">{{ old('description', $block->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- Features Fields -->
                                <div class="col-md-12 mb-3">
                                    <label class="col-form-label col-form-label-sm">{{ __('Features') }}</label>
                                    <div id="features-container">
                                        @foreach ($block->features as $index => $feature)
                                            <div class="feature-group mb-3 border rounded p-2">
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-heading"></i></span>
                                                            </div>
                                                            <input type="text"
                                                                name="features[{{ $index }}][title]"
                                                                class="form-control form-control-sm"
                                                                placeholder="Enter Title"
                                                                value="{{ old('features.' . $index . '.title', $feature->title) }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-sort-numeric-down"></i></span>
                                                            </div>
                                                            <input type="number"
                                                                name="features[{{ $index }}][order]"
                                                                class="form-control form-control-sm"
                                                                placeholder="Enter Order No"
                                                                value="{{ old('features.' . $index . '.order', $feature->order_no) }}"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 text-end mt-2">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-feature">Add
                                        Feature</button>
                                </div>



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


@section('js')
    <script>
        $(document).ready(function() {
            let featureIndex = $('#features-container .feature-group').length;

            $('#add-feature').click(function() {
                $('#features-container').append(`
                <div class="row mb-3 feature-group border rounded p-2">
                    <div class="col-md-6">
                                                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-heading"></i></span>
                                                            </div>

                        <input type="text" name="features[${featureIndex}][title]" class="form-control" placeholder="Feature Title" required>
                    </div>
                                                                                </div>

                    <div class="col-md-4">
                                                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-sort-numeric-down"></i></span>
                                                            </div>

                        <input type="number" name="features[${featureIndex}][order]" class="form-control" placeholder="Order No" required>
                    </div>
                    </div>
                    <div class="col-md-2 text-end">
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
