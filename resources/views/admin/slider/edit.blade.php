@extends('admin.layouts.master')
@section('title', 'Edit Slider')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Edit Slider') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.slider.update', $slider->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label control-label" for="image">{{ __('Image') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text p-1 px-2">
                                                    <i class="fas fa-image"></i>
                                                </span>
                                            </div>
                                            <input type="file"
                                                class="form-control form-control-sm form-control form-control-sm-sm up-img"
                                                name="image" id="image">
                                        </div>

                                        @if (isset($slider) && $slider->image)
                                            <img class="mw-400 show-img img-demo mt-2" src="{{ asset($slider->image) }}"
                                                alt="Uploaded Image" style="width: 150px;">
                                        @else
                                            <img class="mw-400 show-img img-demo mt-2"
                                                src="{{ asset('assets/uploads/core/img-demo.jpg') }}" alt="Demo Image"
                                                style="width: 150px;">
                                        @endif
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="title">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                            </div>

                                            <input type="text" class="form-control form-control-sm" name="title" id="title"
                                                placeholder="{{ __('Title') }}" value="{{ $slider->title }}">
                                        </div>
                                        @if ($errors->has('title'))
                                            <p class="text-danger"> {{ $errors->first('title') }} </p>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="subtitle">{{ __('Sub Title') }}</label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-quote-right"></i></span>
                                            </div>

                                            <input type="text" class="form-control form-control-sm" name="sub_title" id="subtitle"
                                                placeholder="{{ __('Sub Title') }}" value="{{ $slider->sub_title }}">
                                        </div>
                                        @if ($errors->has('sub_title'))
                                            <p class="text-danger"> {{ $errors->first('sub_title') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="buttonTitle">{{ __('Button Title') }}</label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-mouse-pointer"></i></span>
                                            </div>

                                            <input type="text" class="form-control form-control-sm" name="button_title" id="buttonTitle"
                                                placeholder="{{ __('Button Title') }}"
                                                value="{{ old('button_title') ?? $slider->button_title }}">
                                        </div>
                                        @if ($errors->has('button_title'))
                                            <p class="text-danger"> {{ $errors->first('button_title') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="buttonUrl">{{ __('Button URL') }}</label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>

                                            <input type="url" class="form-control form-control-sm" name="button_url" id="buttonUrl"
                                                placeholder="{{ __('Button URL') }}"
                                                value="{{ old('button_url') ?? $slider->button_url }}">
                                        </div>
                                        @if ($errors->has('button_url'))
                                            <p class="text-danger"> {{ $errors->first('button_url') }} </p>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="serialNo">{{ __('Serial No') }}<span
                                            class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-sort-numeric-up"></i></span>
                                            </div>

                                            <input type="number" class="form-control form-control-sm" name="serial_no" id="serialNo"
                                                placeholder="{{ __('Serial No') }}" value="{{ $slider->serial_no }}">
                                        </div>
                                        @if ($errors->has('serial_no'))
                                            <p class="text-danger"> {{ $errors->first('serial_no') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                            </div>

                                            <select class="form-control form-control-sm" name="status" id="status">
                                                <option value="0" {{ $slider->status == '0' ? 'selected' : '' }}>
                                                    {{ __('Unpublish') }}</option>
                                                <option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>
                                                    {{ __('Publish') }}</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('status'))
                                            <p class="text-danger"> {{ $errors->first('status') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
