@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Add Element')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">



        <div class="col-md-12">
            {{-- content --}}
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">{{ __('Element Add') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.service.element.store', ['slug' => $slug]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-6 mb-3">
                                <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" id="title" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                                </div>
                                @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <!-- Subtitle -->
                            <div class="col-md-6 mb-3">
                                <label for="subtitle">{{ __('Subtitle') }}</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                    </div>
                                    <input type="text" id="subtitle" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{ old('subtitle') }}">
                                </div>
                                @error('subtitle') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <!-- Image -->
                          <div class="col-md-6 mb-3">
    <label class="col-form-label col-form-label-sm" for="image">{{ __('Image') }}</label>
    <div class="input-group input-group-sm">
        <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
        <input type="file" class="form-control form-control-sm up-img" name="image" id="image">
    </div>
    <img class="mw-400 show-img img-demo mt-2" src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="" width="50px">
    @error('image')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>


                            <!-- Icon -->
                           <div class="col-md-6 mb-3">
    <label class="col-form-label col-form-label-sm" for="icon">{{ __('Icon') }}</label>
    <div class="input-group input-group-sm">
        <span class="input-group-text p-1 px-2"><i class="fas fa-icons"></i></span>
        <input type="file" class="form-control form-control-sm up-img" name="icon" id="icon">
    </div>
    <img class="mw-400 show-img img-demo mt-2" src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="" width="50px">
    @error('icon')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

                                
                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control summernote" name="description" rows="6" placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <!-- Features -->
                            <div class="col-md-12 mb-3">
                                <label>{{ __('Features') }}</label>
                                <div id="features-container">
                                    <div class="row mb-3 feature-group border rounded p-2">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                                </div>
                                                <input type="text" name="features[0][title]" class="form-control" placeholder="Enter Title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                                </div>
                                                <input type="number" name="features[0][order]" class="form-control" placeholder="Order No" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                                </div>
                                                <input type="text" name="features[0][description]" class="form-control" placeholder="Enter Description">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-end mt-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-feature">Add Feature</button>
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
    let featureIndex = 1;

    $('#add-feature').click(function () {
        $('#features-container').append(`
            <div class="row mb-3 feature-group border rounded p-2">
                <div class="col-md-8">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div>
                        <input type="text" name="features[${featureIndex}][title]" class="form-control" placeholder="Enter Title" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                        </div>
                        <input type="number" name="features[${featureIndex}][order]" class="form-control" placeholder="Order No" required>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        </div>
                        <input type="text" name="features[${featureIndex}][description]" class="form-control" placeholder="Enter Description">
                    </div>
                </div>
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                </div>
            </div>
        `);
        featureIndex++;
    });

    $(document).on('click', '.remove-feature', function () {
        $(this).closest('.feature-group').remove();
    });
</script>
@endsection
