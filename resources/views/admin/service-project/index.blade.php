@extends('admin.layouts.master')
@section('title', 'Service Category')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Service Category') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Service Category') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Service Category') }}</h3>
                            <div class="card-tools d-flex">

                                <a href="{{ route('admin.service.category.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Service Category') }}
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
                                          <th>{{ __('Slug') }}</th>
                                        <th>{{ __('Order No') }}</th>

                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($services as $id => $service)
                                        <tr>
                                            <td>
                                                {{ ++$id }}
                                            </td>
                                            <td>
                                                {{ $service->title }}
                                            </td>
                                                                                        <td>
                                                {{ $service->slug }}
                                            </td>
                                            <td>
                                                {{ $service->order_no }}
                                            </td>

                                            <td>
                                                @if ($service->status == 'publish')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($service->status == 'draft')
                                                    <span class="badge bg-info">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.service.category.edit', $service->id) }}"
                                                    class="btn btn-info btn-sm"><i
                                                        class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>


                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.service.category.delete', $service->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
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
