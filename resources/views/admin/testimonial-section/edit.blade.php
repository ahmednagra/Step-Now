@extends('admin.layouts.master')
@section('title', 'Edit Testimonial Section')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2 card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Edit Testimonial Section</h3>
                        <div class="card-tools d-flex">
                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.testimonial-section.index') }}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.testimonial-section.update', $testimonial->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>

                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ old('title', $testimonial->title) }}" required>
                                    </div>

                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subtitle -->
                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">Subtitle <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                        </div>

                                        <input type="text" id="subtitle" name="subtitle" class="form-control"
                                            value="{{ old('subtitle', $testimonial->subtitle) }}">
                                    </div>

                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text p-1 px-2"><i
                                                class="fas fa-question-circle"></i></span>

                                        <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $testimonial->description) }}</textarea>
                                    </div>

                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Testimonial Details -->
                                <div class="col-12 mb-3">
                                    <label>Details</label>
                                    <div id="details-container">
                                        @foreach ($testimonial->details as $index => $detail)
                                            <input type="text" name="details[{{ $index }}][id]"
                                                value="{{ $detail->id }}" hidden>
                                            <div class="row mb-3 detail-group border rounded p-2">

                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label-sm">Image</label>
                                                    <input type="file" name="details[{{ $index }}][image]"
                                                        class="form-control form-control-sm">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label-sm">Name</label>
                                                    <input type="text" name="details[{{ $index }}][name]"
                                                        class="form-control form-control-sm"
                                                        value="{{ old("details.$index.name", $detail->name) }}" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label-sm">Designation</label>
                                                    <input type="text" name="details[{{ $index }}][designation]"
                                                        class="form-control form-control-sm"
                                                        value="{{ old("details.$index.designation", $detail->designation) }}">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label-sm">Feedback</label>
                                                    <input type="text" name="details[{{ $index }}][feedback]"
                                                        class="form-control form-control-sm"
                                                        value="{{ old("details.$index.feedback", $detail->feedback) }}"
                                                        required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="col-form-label-sm">Rating</label>
                                                    <input type="number" name="details[{{ $index }}][rating]"
                                                        class="form-control form-control-sm"
                                                        value="{{ old("details.$index.rating", $detail->rating) }}"
                                                        min="1" max="5" required>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-detail">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-detail">+ Add
                                        Detail</button>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-right mt-3">Update</button>
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
        let detailIndex = {{ $testimonial->details->count() }};

        $('#add-detail').click(function() {
            $('#details-container').append(`
        <div class="row mb-3 detail-group border rounded p-2">
            <!-- Image -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Image</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                    <input type="file" name="details[${detailIndex}][image]" class="form-control form-control-sm">
                </div>
            </div>

            <!-- Name -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Name <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-user"></i></span>
                    <input type="text" name="details[${detailIndex}][name]" class="form-control form-control-sm" required>
                </div>
            </div>

            <!-- Designation -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Designation</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="details[${detailIndex}][designation]" class="form-control form-control-sm">
                </div>
            </div>

            <!-- Feedback -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Feedback <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-comment-dots"></i></span>
                    <input type="text" name="details[${detailIndex}][feedback]" class="form-control form-control-sm" required>
                </div>
            </div>

            <!-- Rating -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Rating <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-star"></i></span>
                    <input type="number" name="details[${detailIndex}][rating]" class="form-control form-control-sm" min="1" max="5" required>
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
            </div>
        </div>
        `);
            detailIndex++;
        });

        $(document).on('click', '.remove-detail', function() {
            $(this).closest('.detail-group').remove();
        });
    </script>
@endsection
