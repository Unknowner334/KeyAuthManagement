@extends('Layout.app')

@section('title', 'Referrables Code')

@php
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\DashController;
@endphp

@section('content')
    <div class="col-lg-12">
        @include('Layout.msgStatus')
        <div class="card mb-5">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                Referrables Registered
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-outline-light btn-sm" href={{ route('admin.referrable.generate') }}><i class="bi bi-person-add"></i> REFF</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($reffs->isNotEmpty())
                        <table id="datatable" class="table table-sm table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">#</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Name</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Username</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Saldo</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Role</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Reff</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Registrar</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Created</span></th>
                                    <th><span class="align-middle badge fw-semibold text-dark fs-6">Action</span></th>
                                </tr>
                            </thead>
                            @foreach ($reffs as $item)
                                <tr>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ $item->id }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ Controller::statusColor($item->status) }} fs-6">{{ $item->name }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ Controller::statusColor($item->status) }} fs-6 blur Blur">{{ $item->username }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ $saldo[1] }} fs-6">{{ $saldo[0] }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ Controller::permissionColor($item->permissions) }} fs-6">{{ $item->permissions }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-{{ $reff_status }} fs-6">{{ $reff_code }}</span></td>
                                    <td><span class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::userUsername($item->registrar) }}</span></td>
                                    <td><i class="align-middle badge fw-semibold text-dark fs-6">{{ Controller::timeElapsed($item->created_at) }}</i></td>
                                    <td>
                                        Action
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <table class="table table-sm table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th colspan="9"><span class="align-middle badge text-dark fs-6 fw-normal">There are no <strong>referrables</strong> to show</span></th>
                                </tr>
                            </thead>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function fallbackCopy(text) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    console.log(`Copied (fallback): ${text}`);
                } catch (err) {
                    console.error('Fallback copy failed:', err);
                }
                document.body.removeChild(textarea);
            }

            document.querySelectorAll('.copy-trigger').forEach(el => {
                el.addEventListener('click', () => {
                    const text = el.getAttribute('data-copy');
                    if (!text) return;

                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(text)
                            .then(() => console.log(`Copied: ${text}`))
                            .catch(() => fallbackCopy(text));
                    } else {
                        fallbackCopy(text);
                    }
                });
            });
        });
    </script>
@endsection