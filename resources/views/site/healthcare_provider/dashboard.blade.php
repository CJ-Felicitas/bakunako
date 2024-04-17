@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                List of Infants that Needs Vaccination
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Infants Details</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Vaccine Type</th>
                        <th>Date</th>
                        <th>Sex</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->infant->infant_firstname }} {{ $schedule->infant->infant_middlename }}
                                {{ $schedule->infant->infant_lastname }}</td>
                            <td>{{ $schedule->vaccine->name}}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->infant->sex}} </td>
                            <td>{{ $schedule->infant->user->address }}</td>
                            <td><a href="" class="btn btn-primary">Manage</a></td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
