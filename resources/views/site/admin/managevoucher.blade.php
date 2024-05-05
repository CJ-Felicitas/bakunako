@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                Distribute Voucher
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="form-group">

                    <form action="/admin/addVoucher" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Select Partner</label>
                                <select name="partner_id" class="form-control" id="">
                                    <option value="" selected disabled hidden>Select Partner</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endforeach
                                </select>
                                <label for="" class="mt-3">Name of the Item</label>
                                <input name="item_name" type="text" class="form-control" placeholder="Item's Name">
                                <label for="" class="mt-3">Quantity of Vouchers</label>
                                <input name="total_quantity" type="number" class="form-control" placeholder="Quantity">
                                <label class="mt-3" for="">Vaccine Allocation</label>
                                <select name="vaccine_id" id="" class="form-control">
                                    <option value="" selected disabled hidden>Allocate Voucher to Vaccine</option>
                                    @foreach ($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
                                    @endforeach
                                </select>
                                <label for="" class="mt-3">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter Password for Confirmation">
                            </div>
                        </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success">Distribute Vouchers</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List of all Vouchers</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Partner</th>
                                <th>Item Name</th>
                                <th>Remaining</th>
                                <th>Redeemed</th>
                                <th>Vaccine</th>
                                <th>Total Number of Voucher</th>
                                <th>View Vouchers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voucher_types as $voucher)
                            <tr>
                                <td>{{$voucher->partners->name}}</td>
                                <td>{{$voucher->item_name}}</td>
                                <td>{{$voucher->remaining_quantity}}</td>
                                <td>{{$voucher->redeemed_quantity}}</td>
                                <td>{{$voucher->vaccines->name}}</td>
                                <td>{{$voucher->total_quantity}}</td>
                                <td><a href="/admin/viewvouchers/{{$voucher->id}}" class="btn btn-primary">View Vouchers</a></td>
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($voucher_types->isEmpty())
                <div class="alert alert-warning">
                    There are no vouchers available as of this moment.
                </div>
                
            @endif
        </div>
        @if (session('voucher_distribute_success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Success',
                    message: 'The voucher has been distributed successfully!',
                });
            };
        </script>
    @endif
    </div>
@endsection
@section('custom-script-header')
<script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection

