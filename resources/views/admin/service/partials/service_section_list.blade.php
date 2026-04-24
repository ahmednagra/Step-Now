@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Sections')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card card-primary card-outline mt-2">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Section List</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.service.section.add', ['slug' => $slug]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add Section') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped data_table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                       <td><img src="{{ asset($section->image) }}" alt="Image" width="50px"></td>
                                        <td>{{ $section->title ?? 'N/A' }}</td>
                                        <td>{{ $section->type }}</td>
                                        <td>
                                            <a href="{{ route('admin.service.section.edit', $section->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                            <form id="deleteform" class="d-inline-block mx-1"
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
    </section>

@endsection
