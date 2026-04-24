@extends('admin.layouts.master')
@section('title', 'Package Categories')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title text-primary"><i class="fas fa-list"></i> Package Categories List</h3>
                    <a href="{{ route('admin.package-category.add') }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus-circle"></i> Add New
                    </a>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover table-striped text-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Icon</th>

                                <th>Name</th>
                                <th>Slug</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('assets/admin/uploads/package-category/icon/' . $category->icon) }}"
                                            width="50px">
                                    </td>

                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->order_no }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $category->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.package-category.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form id="deleteform" class="d-inline-block"
                                            action="{{ route('admin.package-category.delete', $category->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
