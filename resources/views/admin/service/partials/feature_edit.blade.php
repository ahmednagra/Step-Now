@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Edit Feature')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">

            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Edit Feature') }}</h3>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.service.feature.update', ['slug' => $slug, 'id' => $feature->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="title">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Enter Title" value="{{ old('title', $feature->title) }}" required>
                                    </div>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subtitle -->
                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">{{ __('Subtitle') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                        </div>
                                        <input type="text" id="subtitle" class="form-control" name="subtitle"
                                            placeholder="Enter Subtitle" required
                                            value="{{ old('subtitle', $feature->subtitle) }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" class="form-control summernote" name="description" rows="3"
                                        placeholder="Enter Description">{{ old('description', $feature->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image1 -->
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
                                    <img class="mw-400 mb-3 show-img img-demo" src="{{ asset($feature->image) }}"
                                        alt="" width="50px">

                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>


                                <div class="col-12">
                                    <div class="row">
                                        <!-- Features -->
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('Features') }}</label>
                                            <div id="features-container">
                                                @foreach ($feature->details as $index => $feature)
                                                    <div class="row mb-3 feature-group border rounded p-2">
                                                        <input type="hidden"
                                                                    name="features[{{ $index }}][id]"
                                                                    value="{{ $feature->id }}">
                                                        <div class="col-md-3 mb-3">
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="features[{{ $index }}][icon]">
                                                            @if ($feature->icon)
                                                                <img src="{{ asset($feature->icon) }}" width="50"
                                                                    class="mt-2">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-heading"></i></span>
                                                                </div>
                                                                <input type="text"
                                                                    name="features[{{ $index }}][title]"
                                                                    value="{{ $feature->title }}" class="form-control"
                                                                    placeholder="Enter Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-align-left"></i></span>
                                                                </div>
                                                                <input type="text"
                                                                    name="features[{{ $index }}][description]"
                                                                    value="{{ $feature->description }}"
                                                                    class="form-control" placeholder="Enter Description">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 text-end">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-secondary btn-sm" id="add-feature">Add
                                                Detail</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary float-right mt-3">Update</button>
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
        let featureIndex = {{ $feature->details }};

        $('#add-feature').click(function() {
            $('#features-container').append(`
            <div class="row mb-3 feature-group border rounded p-2">
                                                    <!-- Image1 -->
                                                    <div class="col-md-3 mb-3">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text p-1 px-2"><i
                                                                    class="fas fa-image"></i></span>
                                                            <input type="file"
                                                                class="form-control form-control-sm up-img" name="features[${featureIndex}][icon]" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-heading"></i></span>
                                                            </div>
                                                            <input type="text" name="features[${featureIndex}][title]"
                                                                class="form-control" placeholder="Enter Title" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-align-left"></i></span>
                                                            </div>
                                                            <input type="text" name="features[${featureIndex}][description]"
                                                                class="form-control" placeholder="Enter Description">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-end">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                    </div>
                                                </div>
        `);
            featureIndex++;
        });

        $(document).on('click', '.remove-feature', function() {
            $(this).closest('.feature-group').remove();
        });
    </script>
@endsection
