@extends('admin.layouts.master')
@section('title', '  Testimonial Section')
@section('content')


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card mt-2 card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Testimonial Section List</h3>
                        <div class="card-tools d-flex">
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('admin.testimonial-section.add') }}">
                                <i class="fas fa-plus"></i> Add Testimonial Section
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $index => $testimonial)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $testimonial->title }}</td>
                                        <td>{{ $testimonial->subtitle ?? '—' }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.testimonial-section.edit', $testimonial->id) }}"
                                               class="btn btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="deleteform-{{ $testimonial->id }}" class="d-inline-block mx-1"
                                                  action="{{ route('admin.testimonial-section.delete', $testimonial->id) }}"
                                                  method="post">
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
