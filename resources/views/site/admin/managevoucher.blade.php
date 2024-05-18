@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark" style="background-color: #FDEDD4">
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
                                    @if ($partners->isEmpty())
                                        <option value="" disabled>No Partners Available</option>
                                    @endif
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endforeach
                                </select>
                                <label for="" class="mt-3">Name of the Item</label>
                                <input name="item_name" type="text" class="form-control" placeholder="Item's Name">
                                <label for="" class="mt-3">Quantity of Vouchers</label>
                                <input name="total_quantity" type="number" min="0" class="form-control"
                                    placeholder="Quantity">
                                <label class="mt-3" for="">Vaccine Allocation</label>
                                <select name="vaccine_id" id="" class="form-control">
                                    <option value="" selected disabled hidden>Allocate Voucher to Vaccine</option>
                                    @foreach ($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}">
                                            {{ str_replace(range(0, 9), '', $vaccine->name) }}</option>
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
                        <button type="submit" class="btn text-white" style="background-color: #cd9f8e">Distribute Vouchers</button>
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
                    <h6 class="m-0 font-weight-bold text-dark">List of all Vouchers</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Partner</th>
                                <th>Item Name</th>
                                <th>Remaining</th>
                                <th>Claimed</th>
                                <th>Vaccine</th>
                                <th>Total Number of Voucher</th>
                                <th>View Vouchers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voucher_types as $voucher)
                                <tr>
                                    <td>{{ $voucher->partners->name }}</td>
                                    <td>{{ $voucher->item_name }}</td>
                                    <td>{{ $voucher->remaining_quantity }}</td>
                                    <td>{{ $voucher->redeemed_quantity }}</td>
                                    <td>{{ str_replace(range(0, 9), '', $voucher->vaccines->name) }}</td>
                                    <td>{{ $voucher->total_quantity }}</td>
                                    <td><a href="/admin/viewvouchers/{{ $voucher->id }}" class="btn btn-sm text-white" style="background-color: #cd9f8e">View
                                            Vouchers</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- voucher distributtion --}}
    {{-- <div class="row mb-5 mt-2">
        <div class="col-md-12">
            <div class="card p-3">
                <p class="text-dark font-weight-bold">Configure Voucher Distribution</p>
                <div class="form-group">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Vaccine Name</th>
                                            <th>Voucher Item Name</th>
                                            <th>Remaining</th>
                                            <th>Active Since</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($active_vouchers as $active_voucher)
                                        <tr>
                                            <td>{{ str_replace(range(0, 9), '', $active_voucher->vaccine->name) }}</td>
                                            <td>
                                                @if (is_null($active_voucher->voucherType))
                                                    No Voucher Exists for this Vaccine
                                                @else
                                                    {{ $active_voucher->voucherType->item_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_null($active_voucher->voucherType))
                                                    No Voucher Exists for this Vaccine
                                                @else
                                                    {{ $active_voucher->voucherType->remaining_quantity }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_null($active_voucher->updated_at))
                                                    No Voucher Exists for this Vaccine
                                                @else
                                                    {{ $active_voucher->updated_at }}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <label for="" class="font-weight-bold text-dark">Update Voucher Distribution
                                Panel</label>
                            <br>
                            <form id="updateDistributionForm" action="/admin/update_active_distribution" method="POST">
                                @csrf
                                <label for="" class="mt-3">Select Vaccine</label>
                                <select name="vaccine_id" id="vaccineSelect" class="form-control">
                                    <option value="" selected disabled hidden>Select Vaccine
                                    </option>
                                    @foreach ($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}">{{ str_replace(range(0, 9), '', $vaccine->name) }}</option>
                                    @endforeach
                                </select>

                                <label for="" class="mt-2">Select Voucher</label>
                                <select name="voucher_type_id" id="voucherSelect" class="form-control">

                                </select>

                                <label for="" class="mt-2">Password</label>
                                <input type="text" name="password" class="form-control"
                                    placeholder="Enter Password to Confirm Changes">
                                <br>
                                <input type="submit" class="btn btn-block text-white" style="background-color: #cd9f8e" value="Update">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#vaccineSelect').change(function() {
                    var vaccineId = $(this).val();
                    $.ajax({
                        url: '/admin/vaccines_to_vouchers',
                        method: 'GET',
                        data: {
                            vaccine_id: vaccineId
                        },
                        success: function(response) {
                            $('#voucherSelect').empty();
                            response.forEach(function(voucher) {
                                $('#voucherSelect').append('<option value="' + voucher.id +
                                    '">' + voucher.item_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            // Handle error here
                        }
                    });
                });
            });
        </script>
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
    @endsection
    @section('custom-script-header')
        <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
    @endsection

    @section('custom-script')
        <script>
            $(document).ready(function() {
                $('#dataTableHover').DataTable(); // ID From dataTable with Hover
            });
        </script>
    @endsection
