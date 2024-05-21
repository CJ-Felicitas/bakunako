@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4; font-size: 25px" class="alert text-center text-dark font-weight-bold">
                Vaccine Infants
            </div>
        </div>
    </div>
    <div class="card mb-4 p-2">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">List of Infants that needed to be vaccinated today</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Birth Date</th>
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
                            <td>{{ \Carbon\Carbon::parse($schedule->infant->date_of_birth)->format('F j, Y') }}</td>
                            <td>{{ $schedule->infant->sex }} </td>
                            <td>{{ $schedule->infant->user->address }}</td>
                            <td><a href="/healthcare_provider/vaccination_details/{{ $schedule->infant->id }}"
                                    class="btn text-white" style="background-color: #CD9F8E">Manage</a></td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($schedules->isEmpty())
        <div class="alert alert-warning text-center">
            There are no vaccination schedules for today.
        </div>
    @endif
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
