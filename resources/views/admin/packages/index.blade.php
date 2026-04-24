@extends('admin.layouts.master')
@section('title', 'Packages')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline mt-2">
                <div class="card-header">
                    <h3 class="card-title text-primary"><i class="fas fa-list"></i> Packages List</h3>
                    <a href="{{ route('admin.package.add') }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-plus-circle"></i> Add New
                    </a>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td><img src="{{ asset('assets/admin/uploads/package/' . $package->icon) }}"
                                            width="50"></td>
                                    <td>{{ $package->title }}</td>
                                    <td>AED {{ $package->amount }}</td>
                                    <td>
                                        AED {{ $package->discounted_amount }}
                                        <br>
                                        <small>({{ number_format((($package->amount - $package->discounted_amount) / $package->amount) * 100, 2) }}%
                                            off)</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.package.edit', $package->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('admin.package.delete', $package->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
