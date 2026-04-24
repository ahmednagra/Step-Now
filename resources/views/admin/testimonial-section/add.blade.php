@extends('admin.layouts.master')
@section('title', 'Add testimonial Section')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Add testimonial Section') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.testimonial-section.store') }}" method="post"
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
                                        <input type="text" id="title" class="form-control form-control-sm"
                                            name="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subtitle -->
                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">{{ __('Subtitle') }} <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                        </div>
                                        <input type="text" id="subtitle" class="form-control form-control-sm "
                                            name="subtitle" placeholder="Enter Subtitle" value="{{ old('subtitle') }}" required>
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}  <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text p-1 px-2"><i
                                                class="fas fa-question-circle"></i></span>

                                        <textarea id="description" class="form-control form-control-sm" name="description" rows="3"
                                            placeholder="Enter Description" required>{{ old('description') }}</textarea>
                                    </div>

                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Details Section -->
                                <div class="col-12">
                                    <label>{{ __('Details') }}</label>
                                    <div id="details-container"></div>
                                    <button type="button" class="btn btn-secondary btn-sm mt-2" id="add-detail">+ Add
                                        Detail</button>
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
    let detailIndex = 0;

    $('#add-detail').click(function() {
        $('#details-container').append(`
        <div class="row mb-3 detail-group border rounded p-2">
            <!-- Image -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Image</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                    <input type="file" class="form-control form-control-sm" name="details[${detailIndex}][image]">
                </div>
            </div>

            <!-- Name -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Name <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control form-control-sm" name="details[${detailIndex}][name]" placeholder="Enter Name" required>
                </div>
            </div>

            <!-- Designation -->
            <div class="col-md-3 mb-3">
                <label class="col-form-label-sm">Designation</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="text" class="form-control form-control-sm" name="details[${detailIndex}][designation]" placeholder="Enter Designation">
                </div>
            </div>

            <!-- Rating -->
            <div class="col-md-2 mb-3">
                <label class="col-form-label-sm">Rating <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-star"></i></span>
                    <input type="number" class="form-control form-control-sm" name="details[${detailIndex}][rating]" min="1" max="5" value="5" required>
                </div>
            </div>

            <!-- Remove Button -->
            <div class="col-md-1 mt-4">
                <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
            </div>

            <!-- Feedback -->
            <div class="col-md-12 mb-3">
                <label class="col-form-label-sm">Feedback <span class="text-danger">*</span></label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text p-1 px-2"><i class="fas fa-comment-dots"></i></span>
                    <textarea class="form-control form-control-sm" name="details[${detailIndex}][feedback]" rows="2" placeholder="Enter Feedback" required></textarea>
                </div>
            </div>
        </div>
    `);
        detailIndex++;
    });

    // Remove detail
    $(document).on('click', '.remove-detail', function() {
        $(this).closest('.detail-group').remove();
    });
</script>
@endsection
