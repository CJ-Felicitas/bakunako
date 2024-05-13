@extends('site.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 p-3">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 text-center">
                            <h2>Number of Male Infants</h2>
                        </div>
                        <div class="col-md-5 text-center">
                            <div class="font-weight-bold" style="font-size: 70px;">
                                {{ $male_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-3">
            <div class="card bg-gradient-danger text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 text-center">
                            <h2>Number of Female Infants</h2>
                        </div>
                        <div class="col-md-5 text-center">
                            <div class="font-weight-bold" style="font-size: 70px;">
                                {{ $female_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 p-3">
            <div class="card bg-gradient-success text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Total Number of Infants: <span class="font-weight-bold">{{ $total }}</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">List of all Infants</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Place of Birth</th>
                                <th>Sex</th>
                                <th>Date Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infants as $infant)
                                <tr>
                                    <td>{{ $infant->infant_firstname }} {{ $infant->infant_middlename }}
                                        {{ $infant->infant_lastname }}</td>
                                    <td>{{ $infant->date_of_birth }}</td>
                                    <td>{{ $infant->place_of_birth }}</td>
                                    <td>{{ $infant->sex }}</td>
                                    <td>{{ $infant->created_at }}</td>
                                    <td><a href="/admin/infant/{{$infant->id}}" class="btn btn-sm text-white" style="background-color: #CD9F8E;">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
