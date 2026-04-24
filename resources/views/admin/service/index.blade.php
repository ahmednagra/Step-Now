@extends('admin.layouts.master')
@section('title', 'Service')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-2">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Service') }}</h3>
                            <div class="card-tools d-flex">

                                <a href="{{ route('admin.service.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add New Services') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Icon') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Order No') }}</th>
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
                                                <img src="{{ asset($service->icon) }}" width="70px" alt="Icon">
                                            </td>
                                            <td>
                                                {{ $service->name }}
                                            </td>
                                            <td>
                                                @if ($service->status == 'publish')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($service->status == 'draft')
                                                    <span class="badge bg-info">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $service->order_no }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.service.edit', $service->slug) }}"
                                                    class="btn btn-info btn-sm"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.service.delete', $service->id) }}"
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
