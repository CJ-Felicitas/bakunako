@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                Infant Immunization Record
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Vaccination Details of {{ $infant->infant_firstname }}
                        {{ $infant->infant_middlename }} {{ $infant->infant_lastname }}</h6>
                </div>
                <div class="table-responsive p-2">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>Vaccine</th>
                                <th>Dose No.</th>
                                <th>Date Of Vaccination</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    {{-- \Carbon\Carbon::parse($schedule->infant->date_of_birth)->format('F j, Y') } --}}
                                    <td>{{ $schedule->vaccine->name }}</td>
                                    <td>{{ $schedule->dose_number }}</td>
                                    <td>
                                        @if ($schedule->date == '2024-05-01')
                                            <span
                                                style="color: green">{{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}</span>
                                            (Today)
                                        @else
                                            {{ \Carbon\Carbon::parse($schedule->date)->format('F j, Y') }}
                                        @endif
                                    <td>
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_start)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_end)->format('h:i A') }}
                                    </td>
                                    <td>
                                        @if ($schedule->status == 'pending')
                                            <span class="badge badge-secondary">Pending</span>
                                        @elseif($schedule->status == 'done')
                                            <span class="badge badge-success">Done</span>
                                        @endif
                                    </td>
                                    <td>{{ $schedule->remarks }}</td>
                                    <td>
                                        @if ($schedule->date == '2024-05-01')
                                            <button type="button" class="btn btn-primary manage-btn" data-toggle="modal"
                                                data-target="#exampleModal" data-schedule-id="{{ $schedule->id }}">
                                                Manage
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary manage-btn" data-toggle="modal"
                                                data-target="#exampleModal" data-schedule-id="{{ $schedule->id }}" disabled>
                                                Manage
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if (session('success'))
                <script>
                    window.onload = function() {
                        iziToast.success({
                            title: 'Success',
                            message: 'The status of the infant has been updated successfully!',
                        });
                    };
                </script>
            @endif
            @if (session('password'))
                <script>
                    window.onload = function() {
                        iziToast.error({
                            title: 'Password Error',
                            message: 'The password is incorrect! Please try again.',
                        });
                    };
                </script>
            @endif
        </div>
        @include('site.healthcare_provider.updateinfantstatusmodal')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.manage-btn').on('click', function() {
                var scheduleId = $(this).data('schedule-id');

                // Update the value of the hidden input field in the modal
                $('#schedule_id').val(scheduleId);

                // Show the modal
                $('#exampleModal').modal('show');
            });
        });
    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
