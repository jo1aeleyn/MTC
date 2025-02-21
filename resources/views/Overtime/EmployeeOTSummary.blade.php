<!DOCTYPE html>
<html>
<head>
    <title>Overtime Summary</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Overtime Authorization</h2>
    @if($overtimes->isNotEmpty())
    <h2 style="text-align: left;">Employee Name: {{ $overtimes->first()->emp_name }}</h2>
    @endif

    <table>
        <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th rowspan="2">Activity Code</th>
                <th rowspan="2">Activity Name</th>
                <th rowspan="2">Start Time</th>
                <th rowspan="2">End Time</th>
                <th rowspan="2">Number of Hours</th>
                <th rowspan="2">Total hours after deduction</th>
                <th colspan="2">Regular Day</th>
                <th colspan="2">Rest Day or Spcl Holiday</th>
                <th colspan="2">Legal Holiday</th>
                <th colspan="2">Legal Holiday on a Rest Day</th>
                <th colspan="2">Spcl Holiday on a Rest Day</th>
                <th colspan="2">Night Premium</th>
                <th rowspan="2">In-Charge Approval</th>
            </tr>
            <tr>
                <th>1st 8h</th>
                <th>>8h</th>
                <th>1st 8h</th>
                <th>>8h</th>
                <th>1st 8h</th>
                <th>>8h</th>
                <th>1st 8h</th>
                <th>>8h</th>
                <th>1st 8h</th>
                <th>>8h</th>
                <th>1st 8h</th>
                <th>>8h</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overtimes as $summary)
            <tr>
                <td>{{ $summary->date_filed }}</td>
                <td>{{ $summary->ActivityCode }}</td>
                <td>{{ $summary->ActivityName }}</td>
                <td>{{ $summary->start_time }}</td>
                <td>{{ $summary->end_time }}</td>
                <td>{{ $summary->TotalDuration }}</td>
                <td>{{ $summary->DeductedDuration }}</td>

                <!-- Regular Day -->
                <td>
                    @if($summary->Type_of_Day == "Regular Day" && $summary->TotalDuration <= 8)
                        {{ $summary->TotalDuration }}
                    @else
                        0.0
                    @endif
                </td>
                <td>
                    @if($summary->Type_of_Day == "Regular Day" && $summary->TotalDuration > 8)
                        {{ $summary->TotalDuration - 8 }}
                    @else
                        0.0
                    @endif
                </td>

                <!-- Rest Day or Special Holiday -->
                <td>
                    @if($summary->Type_of_Day == "Special Holiday" && $summary->TotalDuration <= 8)
                        {{ $summary->TotalDuration }}
                    @else
                        0.0
                    @endif
                </td>
                <td>
                    @if($summary->Type_of_Day == "Special Holiday" && $summary->TotalDuration > 8)
                        {{ $summary->TotalDuration - 8 }}
                    @else
                        0.0
                    @endif
                </td>

                <!-- Legal Holiday -->
                <td>
                    @if($summary->Type_of_Day == "Legal Holiday" && $summary->TotalDuration <= 8)
                        {{ $summary->TotalDuration }}
                    @else
                        0.0
                    @endif
                </td>
                <td>
                    @if($summary->Type_of_Day == "Legal Holiday" && $summary->TotalDuration > 8)
                        {{ $summary->TotalDuration - 8 }}
                    @else
                        0.0
                    @endif
                </td>

                <!-- Legal Holiday on a Rest Day -->
                <td>0.0</td>
                <td>0.0</td>

                <!-- Special Holiday on a Rest Day -->
                <td>0.0</td>
                <td>0.0</td>

                <!-- Night Premium -->
                <td>0.0</td>
                <td>0.0</td>

                <td>{{ $summary->approved_by }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
