<!DOCTYPE html>
<html>

<head>
    <title>Infant Information</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', 'Geneva', Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;

        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .row>.col {
            flex: 1;
            padding: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .centered-image {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            /* Adjust the max-width as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="images/pdf-logo.jpg" class="centered-image" alt="Logo"> <!-- Image centered here -->
        </div>
        <hr>
        <div class="content">
            <div class="row">
                <div class="col">
                    <h3 style="text-align: center">Personal Information</h3>
                    <p><strong>Name:</strong> {{ $infant->infant_firstname }} {{ $infant->infant_middlename }}
                        {{ $infant->infant_lastname }}</p>
                    <p><strong>Date of Birth:</strong> {{ $infant->date_of_birth }}</p>
                    <p><strong>Place of Birth:</strong> {{ $infant->place_of_birth }}</p>
                    <p><strong>Sex:</strong> {{ $infant->sex }}</p>
                    <p><strong>Address:</strong> {{ $infant->address }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <h3 style="text-align: center">Infant Immunization Record</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vaccine</th>
                                <th>Dose No.</th>
                                <th>Schedule</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ str_replace(range(0, 9), '', $schedule->vaccine->name) }}</td>
                                    <td> @ordinal($schedule->dose_number) dose</td>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->time_schedule_start)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($schedule->time_schedule_end)->format('h:i A') }}</td>
                                    <td>
                                        @if ($schedule->status == 'pending')
                                            Pending
                                        @elseif($schedule->status == 'done')
                                            Done
                                        @elseif($schedule->status == 'missed')
                                            Missed
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
        <footer>
            <p style="font-size: 10px; text-align: right;">System Generated - {{ date('Y-m-d') }}</p>
        </footer>
    </div>
</body>

</html>
