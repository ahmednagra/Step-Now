@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Elements')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">



            <div class="col-md-12">
                {{-- content --}}
                <div class="card mt-2 card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Element List</h3>
                        <div class="card-tools d-flex ">

                            <a class="btn btn-sm btn-primary" href="{{ route('admin.service.element.add', ['slug' => $slug]) }}"><i
                                    class="fas fa-plus"></i> Add Element</a>

                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($elements as $index => $element)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            @if ($element->icon)
                                                <img src="{{ asset($element->icon) }}" width="50px" alt="Icon">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($element->image)
                                                <img src="{{ asset($element->image) }}" width="50px" alt="Image">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $element->title }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.service.element.edit', $element->id) }}"
                                                class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button with form -->
                                            <form id="deleteform" class="d-inline-block mx-1"
                                                action="{{ route('admin.service.element.delete', $element->id) }}" method="post">
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
