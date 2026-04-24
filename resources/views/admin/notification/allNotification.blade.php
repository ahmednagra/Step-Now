@extends('admin.layouts.master')
@section('title', 'All Notifications')
@section('content')
    <div class="card mt-5">
        @forelse($notifications as $notification)
            <div class="alert alert-primary" role="alert">
                {{ $notification->data['message'] }}

                <button type="button" class="btn-sm btn btn-secondary float-right mark-as-read" data-id="{{ $notification->id }}">Mark as Read</button>
            </div>
        @empty
            No Notification
        @endforelse
    </div>
@endsection
@section('js')
    <script>
        function sendMarkRequest(id) {
            let _token = '{{ csrf_token() }}';
            return $.ajax("{{ route('admin.mark.read') }}", {
                method: 'post',
                data: {
                    _token: _token,
                    id: id
                }
            });
        }

        $(function () {
            $(".mark-as-read").click(function () {
                let $this = $(this); // Store $(this) reference
                let request = sendMarkRequest($this.data("id"));
                request.done(() => {
                    $this.parents("div.alert").remove(); // Use $this here
                });
            });
        });
    </script>
@endsection
