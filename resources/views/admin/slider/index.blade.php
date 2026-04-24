@extends('admin.layouts.master')
@section('title', 'Slider List')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Slider List') }}</h3>
                            <div class="card-tools d-flex">
                                <div class="d-inline-block mr-4">

                                </div>
                                <a href="{{ route('admin.slider.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add Slider') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('#') }}</th>
                                        <th style="width: 15%;">{{ __('Image') }}</th>
                                        <th style="width: 25%;">{{ __('Title') }}</th>
                                        <th style="width: 10%;">{{ __('Order') }}</th>
                                        <th style="width: 15%;">{{ __('Status') }}</th>
                                        <th style="width: 25%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $id => $slider)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <img class="w-80"
                                                    src="{{ asset($slider->image) }}"
                                                    alt="{{ $slider->title }}" style="width: 50px;">
                                            </td>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->serial_no }}</td>
                                            <td>
                                                @if ($slider->status == 1)
                                                    <span class="badge badge-success">{{ __('Publish') }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                                </a>
                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.slider.delete', $slider->id) }}" method="post">
                                                    @csrf
                                                        @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
