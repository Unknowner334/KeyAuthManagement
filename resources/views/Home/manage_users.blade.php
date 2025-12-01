@extends('Layout.app')

@section('title', 'Users')

@php
    use App\Http\Controllers\Controller;
@endphp

@section('content')
    <div class="col-lg-12">
        @include('Layout.msgStatus')
        <div class="card mb-5">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                Users Registration
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-outline-light btn-sm" href={{ route('admin.users.history') }}><i class="bi bi-person"></i> HISTORY</a>
                    <a class="btn btn-outline-light btn-sm" href={{ route('admin.users.generate') }}><i class="bi bi-person"></i> USER</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($users->isNotEmpty())
                        <table id="datatable" class="table table-sm table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">#</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Name</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Username</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Saldo</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Role</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Reff</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Created</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Registrar</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Action</span></th>
                                </tr>
                            </thead>
                            @foreach ($users as $item)
                                <tr>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $loop->iteration }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->name }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->username }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">0</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->permissions }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->reff }}</span></td>
                                    <td><i class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::timeElapsed($item->created_at) }}</i></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::userUsername($item->registrar) }}</span></td>
                                    <td>ACTION</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-sm table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th colspan="9"><span class="align-middle badge text-dark fs-6 fw-normal">There are no <strong>keys</strong> to show</span></th>
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
                    { orderable: false, targets: -1 }
                ]
            });
        });
    </script>
@endsection