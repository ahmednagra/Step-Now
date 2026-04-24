@extends('admin.layouts.master')
@section('title', ' Edit Why Choose Us')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Edit Why Choose Us') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.why.choose.us.section.update', $section->id) }}" method="post"
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
                                            placeholder="Enter Title" value="{{ old('title', $section->title) }}" required>
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
                                            value="{{ old('subtitle', $section->subtitle) }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" class="form-control summernote" name="description" rows="3"
                                        placeholder="Enter Description">{{ old('description', $section->description) }}</textarea>
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
                                            <option value="home" {{ $section->show_on == 'home' ? 'selected' : '' }}>Home
                                            </option>
                                            <option value="about_us"
                                                {{ $section->show_on == 'about_us' ? 'selected' : '' }}>About Us</option>
                                        </select>
                                    </div>
                                    @error('show_on')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fas fa-image"></i></span></div>
                                        <input type="file" class="form-control form-control-sm up-img" name="image"
                                            id="image">
                                    </div>
                                    <img class="mw-400 mt-2 show-img img-demo"
                                        src="{{ asset('assets/admin/uploads/why_choose_us_section/' . $section->image) }}"
                                        alt="" width="50px">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Features -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('Features') }}</label>
                                            <div id="features-container">
                                                {{-- If validation failed, rebuild old features --}}
                                                @if (old('features'))
                                                    @foreach (old('features') as $index => $feature)
                                                        <div class="row mb-3 feature-group border rounded p-2">
                                                            <div class="col-md-3 mb-3">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text p-1 px-2"><i
                                                                            class="fas fa-image"></i></span>
                                                                    <input type="file"
                                                                        class="form-control form-control-sm"
                                                                        name="features[{{ $index }}][icon]">
                                                                </div>
                                                                @error("features.$index.icon")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-heading"></i></span>
                                                                    </div>
                                                                    <input type="text"
                                                                        name="features[{{ $index }}][title]"
                                                                        class="form-control"
                                                                        value="{{ $feature['title'] ?? '' }}"
                                                                        placeholder="Enter Title">
                                                                </div>
                                                                @error("features.$index.title")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-5">
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-align-left"></i></span>
                                                                    </div>
                                                                    <input type="text"
                                                                        name="features[{{ $index }}][description]"
                                                                        class="form-control"
                                                                        value="{{ $feature['description'] ?? '' }}"
                                                                        placeholder="Enter Description">
                                                                </div>
                                                                @error("features.$index.description")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-12 text-end">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    {{-- Show features from database if no validation error --}}
                                                    @foreach ($section->details as $index => $feature)
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
                                                                @error("features.$index.icon")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-heading"></i></span>
                                                                    </div>
                                                                    <input type="text"
                                                                        name="features[{{ $index }}][title]"
                                                                        value="{{ $feature->title }}"
                                                                        class="form-control" placeholder="Enter Title">
                                                                </div>
                                                                @error("features.$index.title")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
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
                                                                        class="form-control"
                                                                        placeholder="Enter Description">
                                                                </div>
                                                                @error("features.$index.description")
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12 text-end">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-feature">Remove</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
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
        let featureIndex = {{ count($section->details) }};

        $('#add-feature').click(function() {
            $('#features-container').append(`
            <div class="row mb-3 feature-group border rounded p-2">
                <div class="col-md-3 mb-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                        <input type="file" class="form-control form-control-sm up-img" name="features[${featureIndex}][icon]">
                    </div>
                    <p class="text-danger error-icon"></p>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div>
                        <input type="text" name="features[${featureIndex}][title]" class="form-control"
                            placeholder="Enter Title">
                    </div>
                    <p class="text-danger error-title"></p>
                </div>
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        </div>
                        <input type="text" name="features[${featureIndex}][description]" class="form-control"
                            placeholder="Enter Description">
                    </div>
                    <p class="text-danger error-description"></p>
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
