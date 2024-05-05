@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                List of Vouchers
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">My Vouchers</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Sponsor</th>
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
    </div>

    <div class="row">
        
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">My Vouchers</h6>
        </div>
        <div class="col-md-12">
            @if ($vouchers->isEmpty())
                <div class="alert alert-warning">
                    No vouchers available as of this moment
                </div>
            @elseif(!$vouchers->isEmpty())
            <div class="card p-3">
                <div class="row">
                        @foreach ($vouchers as $voucher)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">{{$voucher->voucherType->partners->name}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$voucher->voucherType->item_name}}</div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                @if ($voucher->is_redeemed == 1)
                                                <span class="text-secondary mr-2">CLAIMED AT</span>
                                                <span>{{$voucher->redeemed_at}}</span>
                                                @elseif($voucher->is_redeemed == 0)
                                                <span class="text-success mr-2">NOT YET CLAIMED</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            @if ($voucher->is_redeemed == 0)
                                            <a href="/parent/claimvoucher/{{$voucher->id}}" class="btn btn-success btn-sm">CLAIM</a>
                                            @elseif($voucher->is_redeemed == 1)
                                            <button disabled class="btn btn-secondary btn-sm">CLAIMED</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    {{-- end of voucher line --}}
                </div>
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