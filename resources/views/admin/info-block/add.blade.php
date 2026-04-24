@extends('admin.layouts.master')
@section('title', 'Add Info Block')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            {{-- content --}}
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">{{ __('Info Block Add') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.info-block.store') }}" method="post" enctype="multipart/form-data">
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
                                <label for="description">{{ __('Description') }}<span class="text-danger">*</span></label>
                                <textarea id="description" class="form-control summernote" name="description" rows="3"
                                    placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image1 -->
                            <div class="col-12 mb-3">
                                <label class="col-form-label col-form-label-sm" for="image1">{{ __('Image') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control form-control-sm up-img" name="image1"
                                        id="image1" required>
                                </div>
                                <img class="mw-400 show-img img-demo mt-2"
                                    src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="" width="50px">
                                @error('image1')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Toggle Button -->
                            <div class="col-12">
                                <a href="#" class="btn btn-sm btn-info mb-3 checkBtn">Show More <i class="checkBtnIcon bi bi-check"></i></a>
                            </div>

                            <!-- Other Info -->
                            <div class="col-12 otherInfo d-none">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="image2">{{ __('Image 2') }}</label>
                                        <input type="file" class="form-control form-control-sm up-img" name="image2" id="image2">
                                        @error('image2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="image3">{{ __('Image 3') }}</label>
                                        <input type="file" class="form-control form-control-sm up-img" name="image3" id="image3">
                                        @error('image3')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="description2">{{ __('Description 2') }}</label>
                                        <textarea id="description2" class="form-control summernote" name="description2" rows="3"
                                            placeholder="Enter Description 2">{{ old('description2') }}</textarea>
                                        @error('description2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="text1">{{ __('Text 1') }}</label>
                                        <input type="text" class="form-control" name="text1" value="{{ old('text1') }}" placeholder="Enter Text 1">
                                        @error('text1')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="text2">{{ __('Text 2') }}</label>
                                        <input type="text" class="form-control" name="text2" value="{{ old('text2') }}" placeholder="Enter Text 2">
                                        @error('text2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="text3">{{ __('Text 3') }}</label>
                                        <input type="text" class="form-control" name="text3" value="{{ old('text3') }}" placeholder="Enter Text 3">
                                        @error('text3')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Features -->
                            <div class="col-md-12 mb-3">
                                <label>{{ __('Features') }}</label>
                                <div id="features-container">
                                    {{-- Re-populate old features if validation fails --}}
                                    @if(old('features'))
                                        @foreach(old('features') as $i => $feature)
                                            <div class="row mb-3 feature-group border rounded p-2">
                                                <div class="col-md-3 mb-3">
                                                    <input type="file" class="form-control form-control-sm" name="features[{{ $i }}][icon]">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="features[{{ $i }}][title]" class="form-control"
                                                        value="{{ $feature['title'] ?? '' }}" placeholder="Enter Title">
                                                    @error("features.$i.title")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="features[{{ $i }}][description]" class="form-control"
                                                        value="{{ $feature['description'] ?? '' }}" placeholder="Enter Description">
                                                    @error("features.$i.description")
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" id="add-feature">Add Feature</button>
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
        $(this).toggleClass('btn-info btn-warning');
        $('.checkBtnIcon').toggleClass('bi-check bi-x');
        $('.otherInfo').toggleClass('d-none');
    });

    // Start index from old data count if exists
    let featureIndex = {{ old('features') ? count(old('features')) : 0 }};

    $('#add-feature').click(function() {
        $('#features-container').append(`
            <div class="row mb-3 feature-group border rounded p-2">
                <div class="col-md-3 mb-3">
                    <input type="file" class="form-control form-control-sm" name="features[${featureIndex}][icon]">
                </div>
                <div class="col-md-4">
                    <input type="text" name="features[${featureIndex}][title]" class="form-control" placeholder="Enter Title">
                </div>
                <div class="col-md-5">
                    <input type="text" name="features[${featureIndex}][description]" class="form-control" placeholder="Enter Description">
                </div>
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
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
