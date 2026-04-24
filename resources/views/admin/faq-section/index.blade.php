@extends('admin.layouts.master')
@section('title', ' Faq Section')
@section('content')


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- content --}}
                <div class="card mt-2 card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Faq Section List</h3>
                        <div class="card-tools d-flex">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.faq-section.add') }}">
                                <i class="fas fa-plus"></i> Add Faq Section
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
                                @foreach ($faq_section as $index => $section)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $section->title }}</td>
                                        <td>{{ $section->subtitle ?? '—' }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.faq-section.edit', $section->id) }}" class="btn btn-primary"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Delete Button -->
                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.faq-section.delete', $section->id) }}"
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
