@extends('Layout.app')

@section('title', 'Users')

@php
    use App\Http\Controllers\Controller;
@endphp

@section('content')
    <div class="col-lg-12">
        @include('Layout.msgStatus')
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                Users Registration
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-outline-light btn-sm" href={{ route('admin.users') }}><i class="bi bi-person"></i> BACK</a>
                    <button class="btn btn-secondary btn-sm ms-1" id="blur-out" data-bs-toggle="tooltip" data-bs-placement="top" title="Eye Protect"><i class="bi bi-eye-slash"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($histories->isNotEmpty())
                        <table id="datatable" class="table table-sm table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th><span class="align-middle badge text-dark fs-6">#</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">User ID</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">Username</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">Status</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">Type</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">IP Address</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">User Agent</span></th>
                                    <th><span class="align-middle badge text-dark fs-6">Created At</span></th>
                                </tr>
                            </thead>
                                @foreach ($histories as $item)
                                    @php
                                        if ($item->user_id == NULL) {
                                            $user_id = "N/A";
                                        } else {
                                            $user_id = Controller::censorText($item->user_id, 3);
                                        }
                                    @endphp
                                    <tr>
                                        <td><span class="align-middle badge text-dark fs-6">{{ $item->id }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ $user_id }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6 blur Blur">{{ $item->username }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ $item->status }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ $item->type }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ $item->ip_address }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ Controller::censorText($item->user_agent, 10) }}</span></td>
                                        <td><span class="align-middle badge text-dark fs-6">{{ Controller::timeElapsed($item->created_at) }}</span></td>
                                    </tr>
                                @endforeach
                        </table>
                    @else
                        <table class="table table-sm table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th colspan="8"><span class="align-middle badge text-dark fs-6 fw-normal">There are no <strong>histories</strong> to show</span></th>
                                </tr>
                            </thead>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                pageLength: 10,
                lengthChange: true,
                ordering: true,
                order: [[0,'desc']],
                columnDefs: [
                    { targets: [1, 6, 7], searchable: false },
                    { targets: [0, 2, 3, 4, 5], searchable: true },
                ]
            });

            $("#blur-out").click(function() {
                if ($(".Blur").hasClass("blur")) {
                    $(".Blur").removeClass("blur");
                    $("#blur-out").html(`<i class="bi bi-eye"></i>`);
                } else {
                    $(".Blur").addClass("blur");
                    $("#blur-out").html(`<i class="bi bi-eye-slash"></i>`);
                }
            });
        });
    </script>
@endsection