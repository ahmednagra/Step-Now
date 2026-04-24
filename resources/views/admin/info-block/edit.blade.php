@extends('admin.layouts.master')
@section('title', ' Edit Info Block')
@section('content')


    <section class="content">
        <div class="row">

            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Edit Info Block') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.info-block.update', $info_block->id) }}" method="post"
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
                                            placeholder="Enter Title" value="{{ old('title', $info_block->title) }}"
                                            required>
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
                                            value="{{ old('subtitle', $info_block->subtitle) }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}<span
                                            class="text-danger">*</span></label>
                                    <textarea required id="description" class="form-control summernote" name="description" rows="3"
                                        placeholder="Enter Description">{{ old('description', $info_block->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Show On -->
                                <div class="col-md-6 mb-3">
                                    <label for="show_on">{{ __('Show On') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                        </div>
                                        <select name="show_on" id="show_on" class="form-control">
                                            <option value="home" {{ $info_block->show_on == 'home' ? 'selected' : '' }}>Home</option>
                                            <option value="about_us" {{ $info_block->show_on == 'about_us' ? 'selected' : '' }}>About Us</option>
                                        </select>
                                    </div>
                                    @error('show_on')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image1 -->
                                <div class="col-md-6 mt-2">
                                    <label for="image1">
                                        {{ __('Image1') }} <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control form-control-sm up-img" name="image1"
                                            id="image1">
                                    </div>
                                    <img class="mw-400 mb-3 show-img img-demo" src="{{ asset($info_block->image1) }}"
                                        alt="" width="50px">

                                    @if ($errors->has('image1'))
                                        <p class="text-danger">{{ $errors->first('image1') }}</p>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <a href="#" class="btn btn-sm btn-info mb-3 checkBtn">Show More <i
                                            class="checkBtnIcon bi bi-check"></i></a>
                                </div>

                                <div
                                    class="col-12 otherInfo {{ $info_block->image2 || $info_block->image3 || $info_block->text1 || $info_block->text2 || $info_block->text3 ? '' : 'd-none' }}">
                                    <div class="row">
                                        <!-- Image2 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="image2">
                                                {{ __('Image2') }}
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control form-control-sm up-img"
                                                    name="image2" id="image2">
                                            </div>
                                            <img class="mw-400 mb-3 show-img img-demo"
                                                src="{{ asset($info_block->image2) }}" alt="" width="50px">

                                            @if ($errors->has('image2'))
                                                <p class="text-danger">{{ $errors->first('image2') }}</p>
                                            @endif
                                        </div>

                                        <!-- Image3 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="image3">
                                                {{ __('Image3') }}
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control form-control-sm up-img"
                                                    name="image3" id="image3">
                                            </div>
                                            <img class="mw-400 mb-3 show-img img-demo"
                                                src="{{ asset($info_block->image3) }}" alt="" width="50px">

                                            @if ($errors->has('image3'))
                                                <p class="text-danger">{{ $errors->first('image3') }}</p>
                                            @endif
                                        </div>

                                        <!-- Description 2 -->
                                        <div class="col-md-12 mb-3">
                                            <label for="description2">{{ __('Description 2') }}</label>
                                            <textarea id="description2" class="form-control summernote" name="description2" rows="3"
                                                placeholder="Enter Description 2">{{ old('description2', $info_block->description2) }}</textarea>
                                            @error('description2')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Text Fields -->
                                        <!-- Text Fields with Icons -->
                                        <div class="col-md-4 mb-3">
                                            <label for="text1">{{ __('Text 1') }}</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="text1"
                                                    value="{{ old('text1', $info_block->text1) }}"
                                                    placeholder="Enter Text 1">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="text2">{{ __('Text 2') }}</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="text2"
                                                    value="{{ old('text2', $info_block->text2) }}"
                                                    placeholder="Enter Text 2">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="text3">{{ __('Text 3') }}</label>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="text3"
                                                    value="{{ old('text3', $info_block->text3) }}"
                                                    placeholder="Enter Text 3">
                                            </div>
                                        </div>

                                        <!-- Features -->

                                    </div>
                                    
                                </div>
<div class="col-md-12 mb-3">
                                        <label>{{ __('Features') }}</label>
                                        <div id="features-container">
                                            @foreach ($info_block->features as $index => $feature)
                                                <div class="row mb-3 feature-group border rounded p-2">
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
                                                                value="{{ $feature->description }}" class="form-control"
                                                                placeholder="Enter Description">
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
                                            Feature</button>
                                    </div>
     
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
        $('.checkBtn').click(function() {
            $(this).toggleClass('btn-info').toggleClass('btn-warning');
            $('.checkBtnIcon').toggleClass('bi-check').toggleClass('bi-x');
            $('.otherInfo').toggleClass('d-none');
        });
    </script>
    <script>
        let featureIndex = {{ count($info_block->features) }};;

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
