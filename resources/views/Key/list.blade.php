@extends('Layout.app')

@section('title', 'Keys')

@php
    use App\Http\Controllers\KeyController;
    use App\Http\Controllers\Controller;
@endphp

@section('content')
    <div class="col-lg-12">
        @include('Layout.msgStatus')
        <div class="card mb-5">
            <div class="card-header text-bg-dark">
                <div class="row">
                    <div class="col pt-1">
                        Keys Registration
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-outline-light btn-sm" href={{ route('keys.generate') }}><i class="bi bi-key"></i> KEY</a>
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#PayoutsModal"><i class="bi bi-cash-coin"></i> Payouts</button>
                        <a class="btn btn-outline-light btn-sm" href="{{ route('keys', ['page' => request()->get('page', 1)]) }}"><i class="bi bi-arrow-clockwise"></i> REFRESH</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped table-hover text-center">
                        <tr>
                            <th><span class="align-middle badge text-dark fs-6">#</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Owner</span></th>
                            <th><span class="align-middle badge text-dark fs-6">App</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Key</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Duration</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Devices</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Rank</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Created</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Created By</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Price</span></th>
                            <th><span class="align-middle badge text-dark fs-6">Action</span></th>
                        </tr>
                        @if ($keys->isNotEmpty())
                            @foreach ($keys as $key)
                                @php
                                    if ($key->owner == "") {
                                        $owner = "N/A";
                                    } else {
                                        $owner = $key->owner;
                                    }
                                @endphp
                                <tr>
                                    <td><span class="align-middle badge text-dark fs-6">{{ $loop->iteration }}</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">{{ $owner }}</span></td>
                                    <td><span class="align-middle badge text-{{ Controller::statusColor($key->app->status) }} fs-6">{{ $key->app->name ?? 'N/A' }}</span></td>
                                    <td><span class="align-middle badge text-{{ Controller::statusColor($key->status) }} fs-6 copy-trigger" data-copy="{{ $key->key }}">{{ Controller::censorText($key->key) ?? 'N/A'}}</span></td>
                                    <td><span class="align-middle badge text-{{ KeyController::RemainingDaysColor(KeyController::RemainingDays($key->expire_date)) }} fs-6">{{ KeyController::RemainingDays($key->expire_date) }}/{{ $key->duration ?? 'N/A' }} Days</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">0/{{ $key->max_devices ?? 'N/A' }}</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">{{ $key->rank ?? 'N/A' }}</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">{{ Controller::timeElapsed($key->created_at) ?? 'N/A' }}</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">{{ $key->created_by ?? 'N/A' }}</span></td>
                                    <td><span class="align-middle badge text-dark fs-6">{{ number_format(KeyController::keyPriceCalculator($key->rank, $key->app->ppd_basic, $key->app->ppd_premium, $key->max_devices, $key->duration)) }}{{ $currency }}</span></td>
                                    <td>
                                        <a href={{ route('keys.edit', ['id' => $key->edit_id]) }} class="btn btn-outline-dark">
                                            <i class="bi bi-person"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11"><span class="align-middle badge text-danger fs-6">No Keys Where Found</span></td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $keys->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PayoutsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-dark">
                    <h5 class="modal-title">Payouts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @php
                        $monthly = 0;

                        foreach($fullKeys as $key) {
                            $monthly += KeyController::keyPriceCalculator($key->rank, $key->app->ppd_basic, $key->app->ppd_premium, $key->max_devices, $key->duration);
                        }

                        $monthlyFormatted = number_format($monthly);
                        $yearlyFormatted = number_format($monthly * 12);
                    @endphp
                    All the keys gets you<br>
                    Monthly {{ $monthlyFormatted }} IQD<br>
                    Yearly {{ $yearlyFormatted }} IQD
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Okay</button>
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