@extends('admin.layouts.master')
@section('title',  ' Info Block')
@section('content')


    <section class="content">
        <div class="row">



            <div class="col-md-12">
                {{-- content --}}
                <div class="card mt-2 card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Info Block List</h3>
                        <div class="card-tools d-flex ">

                            <a class="btn btn-sm btn-primary" href="{{ route('admin.info-block.add') }}"><i
                                    class="fas fa-plus"></i> Add Info Block</a>

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
                                    <th>Subtitle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blocks as $index => $block)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            @if ($block->image1)
                                                <img src="{{ asset($block->image1) }}" width="50px" alt="Icon">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $block->title }}</td>
                                        <td>{{ $block->subtitle }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.info-block.edit', $block->id) }}"
                                                class="btn btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button with form -->
                                            <form id="deleteform" class="d-inline-block mx-1"
                                                action="{{ route('admin.info-block.delete', $block->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" id="delete">
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