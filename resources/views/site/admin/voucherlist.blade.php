@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-white" style="background-color: #cd9f8e">
                List of all voucher for item {{ $voucher_type->item_name }} of {{ $voucher_type->partners->name }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Vouchers</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Voucher ID</th>
                                <th>Infant Name</th>
                                <th>Code</th>
                                <th>Claimable</th>
                                <th>Claimed</th>
                                <th>Claim Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                                <tr>
                                    <td>{{$voucher->id}}</td>
                                    <td>{{ $voucher->infant->infant_firstname }} {{ $voucher->infant->infant_middlename }}
                                        {{ $voucher->infant->infant_lastname }}</td>
                                    <td>{{ $voucher->voucher_code }}</td>
                                    <td>
                                        @if ($voucher->is_reedeemable == 1)
                                            Yes
                                        @elseif($voucher->is_reedeemable == 0)
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        @if ($voucher->is_redeemed == 1)
                                            Yes
                                        @elseif($voucher->is_redeemed == 0)
                                            No
                                        @endif
                                    </td>
                                    <td>{{$voucher->redeemed_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
