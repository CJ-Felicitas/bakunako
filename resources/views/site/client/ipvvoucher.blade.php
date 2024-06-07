@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
    <style>
        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            /* Remove underline on hover */
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4;" class="alert alert-primary font-weight-bold text-dark">
                Rewards
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="/parent/voucher/rewards">
                        <div class="alert alert-success font-weight-bold text-dark text-center">
                            <i class="fas fa-gift fa-fw"></i> Claim Rewards
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="/parent/voucher/my_vouchers">
                        <div style="background-color: #C8A796;"
                            class="alert alert-primary font-weight-bold text-dark text-center">
                            <i class="fas fa-receipt fa-fw"></i>My Vouchers
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">My Vouchers</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Partner</th>
                                <th>Item Name</th>
                                <th>Voucher Code</th>
                                <th>Claimed at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($my_vouchers as $my_voucher)
                                <tr>
                                    <td>
                                        {{ $my_voucher->voucherType->partners->name }}
                                    </td>
                                    <td>{{$my_voucher->voucherType->item_name}}</td>
                                    <td>{{$my_voucher->voucher_code}}</td>
                                    <td>{{$my_voucher->redeemed_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md">
            <a href="/parent/voucher/rewards">
                <div style="background-color: #C8A796;" class="alert alert-success font-weight-bold text-dark text-center">
                    BCG
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parent/voucher/rewards/hepb">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                    HEPATITIS B
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parentvoucher/rewards/penta">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                    PENTAVALENT
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parent/voucher/rewards/opv">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                    OPV
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parent/voucher/rewards/ipv">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-white text-center">
                    IPV
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parent/voucher/rewards/pcv">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                    PCV
                </div>
            </a>
        </div>
        <div class="col-md">
            <a href="/parent/voucher/rewards/mmr">
                <div style="background-color: #C8A796;" class="alert font-weight-bold text-dark text-center">
                    MMR
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">Voucher Rewards for IPV</h6>
        </div>
        <div class="col-md-12">
            @if ($IPVs->isEmpty())
                <div class="alert alert-warning">
                    No vouchers available as of this moment
                </div>
            @elseif(!$IPVs->isEmpty())
                <div class="row">
                    @foreach ($IPVs as $voucher)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                {{ $voucher->voucherType->partners->name }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $voucher->voucherType->item_name }}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                @if ($voucher->is_redeemed == 1)
                                                    <span class="text-secondary mr-2">CLAIMED AT</span>
                                                    <span>{{ $voucher->redeemed_at }}</span>
                                                @elseif($voucher->is_redeemed == 0)
                                                    <span class="text-success mr-2">NOT YET CLAIMED</span>
                                                @endif
                                                <br>
                                                <span class="text-uppercase">{{ $voucher->infant->infant_firstname }}
                                                    {{ $voucher->infant->infant_lastname }}</span><br>
                                                <span>FROM {{ $voucher->voucherType->vaccines->name }} vaccine</span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            @if ($voucher->is_redeemed == 0)
                                            <a href="/parent/claimvoucher/{{ $voucher->id }}?infantid={{ $voucher->infant->id }}&vtype={{$voucher->voucherType->id}}&vid={{$voucher->voucherType->vaccine_id}}"
                                                class="btn btn-success btn-sm">CLAIM</a>
                                        @elseif($voucher->is_redeemed == 1)
                                            <button disabled class="btn btn-secondary btn-sm">CLAIMED</button>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Voucher Claimed',
                    message: 'The voucher has been claimed successfully',
                });
            };
        </script>
    @endif

    @if (session('already_claimed'))
        <script>
            window.onload = function() {
                iziToast.errorr({
                    title: 'Voucher Claimed',
                    message: "already claimed",
                });
            };
        </script>
    @endif

    @if (session('limit_error'))
    <script>
        window.onload = function() {
            iziToast.warning({
                title: 'Error',
                message: "{{ session('limit_error') }}",
            });
        };
    </script>
@endif

@if (session('voucher_empty'))
<script>
    window.onload = function() {
        iziToast.warning({
            title: 'Error',
            message: "The voucher is not available anymore",
        });
    };
</script>
@endif

@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
