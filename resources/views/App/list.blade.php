@extends('Layout.app')

@section('title', 'Apps')

@php
    use App\Http\Controllers\Controller;
@endphp

@section('content')
    <div class="col-lg-10">
        @include('Layout.msgStatus')
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                Apps Registered
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('apps.generate') }}" class="btn btn-outline-light btn-sm"><i class="bi bi-terminal"></i> APP</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($apps->isNotEmpty())
                        <table id="datatable" class="table table-sm table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">#</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Name</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Price</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Key Count</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Created</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Registrar</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Action</span></th>
                                </tr>
                            </thead>
                            @foreach ($apps as $item)
                                @php
                                    $price = number_format($item->price);
                                    $raw_price = $item->price;

                                    if ($raw_price < 10000) {
                                        $price = $price;
                                    } else if ($raw_price >= 10000 && $raw_price < 1000000) {
                                        $price = number_format($raw_price / 1000) . 'K';
                                    } else if ($raw_price >= 1000000 && $raw_price < 1000000000) {
                                        $price = number_format($raw_price / 1000000) . 'M';
                                    } else if ($raw_price >= 1000000000 && $raw_price < 1000000000000) {
                                        $price = number_format($raw_price / 1000000000) . 'B';
                                    } else if ($raw_price >= 1000000000000) {
                                        $price = number_format($raw_price / 1000000000000) . 'T';
                                    } else {
                                        $price = "N/A";
                                    }

                                    $keysCount = 0;

                                    foreach($item->keys as $key) {
                                        $keysCount += 1;
                                    }
                                @endphp
                                <tr>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->id }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ Controller::statusColor($item->status) }} fs-6">{{ $item->name }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $price . $currency }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ number_format($keysCount) }} Key</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::timeElapsed($item->created_at) }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::userUsername($item->registrar) }}</span></td>
                                    <td>
                                        <a href={{ route('apps.edit', ['id' => $item->edit_id]) }} class="btn btn-outline-dark btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-sm table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th colspan="6"><span class="align-middle badge text-dark fs-6 fw-normal">There are no <strong>apps</strong> to show</span></th>
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
                    { targets: -1, searchable: false },
                    { targets: [0, 1, 2, 4], searchable: true },
                    { orderable: false, targets: -1 }
                ]
            });
        });
    </script>
@endsection