@extends('admin.layouts.master')
@section('title', 'Edit Faq Section')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Edit Faq Section') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.faq-section.update', $faqSection->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="title">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" id="title" class="form-control" name="title"
                                            value="{{ old('title', $faqSection->title) }}" required>
                                    </div>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subtitle -->
                                <div class="col-md-6 mb-3">
                                    <label for="subtitle">{{ __('Subtitle') }}</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-subscript"></i></span>
                                        </div>
                                        <input type="text" id="subtitle" class="form-control" name="subtitle"
                                            value="{{ old('subtitle', $faqSection->subtitle) }}">
                                    </div>
                                    @error('subtitle')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description">{{ __('Description') }}</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text p-1 px-2"><i
                                                class="fas fa-question-circle"></i></span>

                                        <textarea id="description" class="form-control" name="description" rows="3">{{ old('description', $faqSection->description) }}</textarea>
                                    </div>

                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Details Section -->
                                <div class="col-12">
                                    <label>{{ __('Details') }}</label>
                                    <div id="details-container">
                                        @foreach ($faqSection->details as $index => $detail)
                                            <div class="row mb-3 detail-group border rounded p-2">
                                                <!-- Hidden ID -->
                                                <input type="hidden" name="details[{{ $index }}][id]"
                                                    value="{{ $detail->id }}">
                                                <!-- Question -->
                                                <div class="col-md-5 mb-3">
                                                    <label class="col-form-label-sm">Question <span class="text-danger">*</span></label>

                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text p-1 px-2"><i
                                                                class="fas fa-question-circle"></i></span>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="details[{{ $index }}][question]"
                                                            value="{{ old("details.$index.question", $detail->question) }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <!-- Answer -->
                                                <div class="col-md-5 mb-3">
                                                    <label class="col-form-label-sm">Answer <span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text p-1 px-2"><i
                                                                class="fas fa-reply"></i></span>
                                                        <textarea class="form-control form-control-sm" rows="1" name="details[{{ $index }}][answer]" required>{{ old("details.$index.answer", $detail->answer) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mt-4">
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
        let detailIndex = {{ $faqSection->details->count() }};

        $('#add-detail').click(function() {
            $('#details-container').append(`
            <div class="row mb-3 detail-group border rounded p-2">
                
                <!-- Question -->
                <div class="col-md-5 mb-3">
                    <label class="col-form-label-sm">Question <span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text p-1 px-2">
                            <i class="fas fa-question-circle"></i>
                        </span>
                        <textarea class="form-control form-control-sm" rows="2"
                                  name="details[${detailIndex}][question]"
                                  placeholder="Enter Question" required></textarea>
                    </div>
                </div>

                <!-- Answer -->
                <div class="col-md-5 mb-3">
                    <label class="col-form-label-sm">Answer <span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text p-1 px-2">
                            <i class="fas fa-reply"></i>
                        </span>
                        <textarea class="form-control form-control-sm" rows="2"
                                  name="details[${detailIndex}][answer]"
                                  placeholder="Enter Answer" required></textarea>
                    </div>
                </div>

                <!-- Remove Button -->
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                </div>
            </div>
        `);
            detailIndex++;
        });

        // remove row
        $(document).on('click', '.remove-detail', function() {
            $(this).closest('.detail-group').remove();
        });
    </script>
@endsection
