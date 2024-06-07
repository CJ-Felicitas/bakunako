@extends('site.layouts.app')
@section('custom-css')
<link rel="stylesheet" href="/izitoast/iziToast.min.css">
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
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert text-dark font-weight-bold text-center" style="background-color: #FDEDD4;">
                <p class="mt-3" style="font-size: 23px">Infant Immunization Record</p>
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
                    <h6 class="m-0 font-weight-bold text-dark">Schedule Info</h6>
                    <a href="/pdf/{{ $infant->id }}" class="btn btn-sm text-white" style="background-color: #cd9f8e">Download PDF</a>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered align-items-center table-flush" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Vaccine</th>
                                <th class="text-center">Dose No.</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Managed At</th>

                                <th class="text-center">Remarks</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ str_replace(range(0, 9), '', $schedule->vaccine->name) }}</td>
                                    <td class="text-center">@ordinal($schedule->dose_number) dose</td>
                                    <td class="text-center font-weight-bold text-dark">
                                        @if ($schedule->date)
                                            {{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}
                                        @else
                                            &nbsp; <!-- This will render as a blank space -->
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_start)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_end)->format('h:i A') }}</td>
                                    <td class="text-center">
                                        @if ($schedule->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($schedule->status == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @elseif($schedule->status == 'missed')
                                            <span class="badge badge-danger">Missed</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$schedule->updated_at}}</td>
                                    <td>{{ $schedule->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @if (session('edit_success'))
    <script>
        window.onload = function() {
            iziToast.success({
                title: 'Edit Success',
                message: "The Infant's Information has been updated successfully",
            });
        };
    </script>
@endif
@endsection
@section('custom-script-header')
<script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
