@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Blocks')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">



            <div class="col-md-12">
                {{-- content --}}
                <div class="mt-2 card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Block List</h3>
                        <div class="card-tools d-flex ">

                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.block.add', ['slug' => $slug]) }}"><i
                                    class="fas fa-plus"></i> Add Block </a>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blocks as $index => $block)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>@if ($block->image)
                                            <img src="{{ asset($block->image) }}" width="50px" alt="Image">
                                            @else
                                            N/A
                                        @endif</td>
                                        <td>{{ $block->title }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.service.block.edit', $block->id) }}"
                                                class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button with form -->
                                            <form id="deleteform" class="d-inline-block mx-1"
                                                action="{{ route('admin.service.block.delete', $block->id) }}" method="post">
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
