@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                Infant Information
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="form-group">

                    <form action="/addVoucher" method="post">
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
@endsection
