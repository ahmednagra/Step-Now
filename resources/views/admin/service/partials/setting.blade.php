@extends('admin.layouts.master')
@section('title', ucwords(str_replace('-', ' ', $slug)) . ' | Setting')
@section('content')

    @include('admin.service.top-nav')

    <section class="content">
        @include('admin.service.side-nav')
        <div class="row">

            <div class="col-md-12">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Setting
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="sortForm" method="POST" action="{{ route('admin.service.setting.update', $slug) }}">
                            @csrf
                            <ul class="todo-list ui-sortable" id="sortable" data-widget="todo-list">
                                @php
                                    $colors = [
                                        'App\\Models\\ServiceSection' => 'badge-primary',
                                        'App\\Models\\ServiceBlock' => 'badge-success',
                                        'App\\Models\\ServiceElement' => 'badge-info',
                                        'App\\Models\\ServiceFeature' => 'bg-orange text-white',
                                    ];
                                @endphp

                                @forelse ($service_sections as $setting)
                                    @php
                                        $model = class_basename($setting->reference_type);
                                        $color = $colors[$setting->reference_type] ?? 'badge-secondary';
                                    @endphp

                                    <li class="ui-state-default" data-id="{{ $setting->id }}" style="cursor: pointer;">
                                        <span class="">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>

                                        <span class="text">
                                            {{ $setting->reference->title ?? 'Untitled Section' }}
                                            <span class="badge {{ $color }}">{{ $model }}</span>
                                        </span>

                                        <input type="hidden" name="order[]" value="{{ $setting->id }}">
                                    </li>

                                @empty
                                    <li>No Sections added yet!</li>
                                @endforelse

                            </ul>

                            <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                // remove: handle: ".handle",
                update: function(event, ui) {
                    $("#sortable li").each(function(index) {
                        $(this).find("input[name='order[]']").val($(this).data("id"));
                    });
                }
            });
            $("#sortable").disableSelection();
        });
    </script>
@endsection
