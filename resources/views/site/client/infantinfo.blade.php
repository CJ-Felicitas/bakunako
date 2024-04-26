@extends('site.layouts.app')
@section('custom-css')
    <style>
        #dataTableHover {
            border-collapse: collapse;
            width: 100%;
        }

        #dataTableHover th,
        #dataTableHover td {
            border: 1px solid #999;
            /* Adjusted border color */
            padding: 8px;
            text-align: left;
        }

        #dataTableHover th {
            background-color: #f2f2f2;
        }

        /* Darker border for input fields */
        input.form-control {
            border: 1px solid #999;
            /* Adjusted border color */
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary text-center">
                Infant Information
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" readonly
                value="{{ $infant->infant_firstname }} {{ $infant->infant_middlename }} {{ $infant->infant_lastname }}">

            <label class="mt-3" for="date_of_birth">Date of Birth</label>
            <input type="text" class="form-control" value="{{ $infant->date_of_birth }}" readonly>

            <label class="mt-3" for="place_of_birth">Place of Birth</label>
            <input type="text" class="form-control" value="{{ $infant->place_of_birth }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="mothers_name">Mother's Name</label>
            <input type="text" id="mothers_name" class="form-control" readonly
                value="{{ $infant->mother_firstname }} {{ $infant->mother_middlename }} {{ $infant->mother_lastname }}">

            <label class="mt-3" for="fathers_name">Father's Name</label>
            <input type="text" id="mothers_name" class="form-control" readonly
                value="{{ $infant->father_firstname }} {{ $infant->father_middlename }} {{ $infant->father_lastname }}">

            <label class="mt-3" for="Sex">Sex</label>
            <input type="text" class="form-control" value="{{ $infant->sex }}" readonly>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <label for="address">Address</label>
            <input type="text" id="address" class="form-control" value="{{ $infant->address }}" readonly>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Schedule Info</h6>
                    <a href="" class="btn btn-primary btn-sm">Download PDF</a>
                </div>
                <div class="table-responsive p-2">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Vaccine</th>
                                <th>Dose No.</th>
                                <th>Schedule</th>
                                <th>Time</th>
                                <th>Indicator</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->vaccine->name }}</td>
                                    <td>{{ $schedule->dose_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->time_schedule_start)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_end)->format('h:i A') }}</td>
                                    <td>
                                        @if ($schedule->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($schedule->status == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                    </td>
                                    <td>{{ $schedule->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
