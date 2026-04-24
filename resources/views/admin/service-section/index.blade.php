@extends('admin.layouts.master')
@section('title', 'Service Section')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Service Section') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Service Section') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Service Section') }}</h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.service.section.add', $service->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add Service Section') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Order No') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($serviceSections as $id => $section)
                                        <tr>
                                            <td>
                                                {{ ++$id }}
                                            </td>
                                            <td>
                                                {{ $section->title }}
                                            </td>
                                            <td>
                                                @if ($section->type == 'rtl')
                                                    <span class="badge bg-success">Right To Left</span>
                                                @elseif($section->type == 'ltr')
                                                    <span class="badge bg-success">Left To Right</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $section->order_no }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.service.section.edit', $section->id) }}"
                                                    class="btn btn-info btn-sm"><i
                                                        class="fas fa-pencil-alt"></i></a>


                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.service.section.delete', $section->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i>
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
