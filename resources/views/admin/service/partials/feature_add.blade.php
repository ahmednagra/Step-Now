@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Add Feature')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">

            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Feature Add') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.service.feature.store', ['slug' => $slug]) }}" method="post"
                            enctype="multipart/form-data">
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
                                            placeholder="Enter Title" value="{{ old('title') }}" required>
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
                                            placeholder="Enter Subtitle" required value="{{ old('subtitle') }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" class="form-control" name="description" rows="3"
                                        placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image1 -->
                                <div class="col-12 mb-3">
                                    <label class="col-form-label col-form-label-sm" for="image">{{ __('Image') }}</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                                        <input type="file" class="form-control form-control-sm up-img" name="image"
                                            id="image">
                                    </div>
                                    <img class="mw-400 show-img img-demo mt-2"
                                        src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="" width="50px">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="row">

                                        <!-- Features -->
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('Details') }}</label>
                                            <div id="features-container">

                                            </div>
                                            <button type="button" class="btn btn-secondary btn-sm" id="add-feature">Add
                                                Detail</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary float-right mt-3">Submit</button>
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
        $('.checkBtn').click(function() {
            $(this).toggleClass('btn-info').toggleClass('btn-warning');
            $('.checkBtnIcon').toggleClass('bi-check').toggleClass('bi-x');
            $('.otherInfo').toggleClass('d-none');
        });
    </script>
    <script>
        let featureIndex = 0;

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
