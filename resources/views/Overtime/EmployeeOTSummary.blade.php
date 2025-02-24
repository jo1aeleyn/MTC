<!DOCTYPE html>
<html>
<head>
    <title>Overtime Summary</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            font-size: 12px; /* Reduced font size */
        }
        th, td { 
            border: 1px solid black; 
            padding: 5px; /* Reduced padding */
            text-align: center; 
        }
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
                <th colspan="2">Sunday</th>
                <th rowspan="2">Night Premium</th>
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
    <td>{{ $summary->TotalDuration != 'none' ? $summary->TotalDuration : '' }}</td>
    <td>{{ $summary->DeductedDuration != 'none' ? $summary->DeductedDuration : '' }}</td>

   <!-- Regular Day -->
<td>
    @if($summary->Type_of_Day == "Regular Day")
        {{ $summary->TotalDuration > 8 ? 8 : ($summary->TotalDuration != 'none' ? $summary->TotalDuration : '') }}
    @endif
</td>
<td>
    @if($summary->Type_of_Day == "Regular Day" && $summary->TotalDuration > 8)
        {{ $summary->TotalDuration - 8 }}
    @endif
</td>


    <!-- Rest Day or Special Holiday -->
    <td>
        @if($summary->Type_of_Day == "Special Holiday" && $summary->TotalDuration <= 8)
        {{ $summary->TotalDuration > 8 ? 8 : ($summary->TotalDuration != 'none' ? $summary->TotalDuration : '') }}
        @endif
    </td>
    <td>
        @if($summary->Type_of_Day == "Special Holiday" && $summary->TotalDuration > 8)
            {{ $summary->TotalDuration != 'none' ? $summary->TotalDuration - 8 : '' }}
        @endif
    </td>

    <!-- Legal Holiday -->
    <td>
        @if($summary->Type_of_Day == "Legal Holiday" && $summary->TotalDuration <= 8)
        {{ $summary->TotalDuration > 8 ? 8 : ($summary->TotalDuration != 'none' ? $summary->TotalDuration : '') }}
        @endif
    </td>
    <td>
        @if($summary->Type_of_Day == "Legal Holiday" && $summary->TotalDuration > 8)
            {{ $summary->TotalDuration != 'none' ? $summary->TotalDuration - 8 : '' }}
        @endif
    </td>

    <!-- Legal Holiday on a Rest Day -->
    <td></td>
    <td></td>

    <!-- Special Holiday on a Rest Day -->
    <td></td>
    <td></td>

    <!-- Sunday -->
    <td>
        @if($summary->Type_of_Day == "Sunday" && $summary->TotalDuration <= 8)
        {{ $summary->TotalDuration > 8 ? 8 : ($summary->TotalDuration != 'none' ? $summary->TotalDuration : '') }}
        @endif
    </td>
    <td>
        @if($summary->Type_of_Day == "Sunday" && $summary->TotalDuration > 8)
            {{ $summary->TotalDuration != 'none' ? $summary->TotalDuration - 8 : '' }}
        @endif
    </td>

    <!-- Night Premium (Single Column) -->
    <td>
        {{ $summary->TotalDuration > 5 ? '1' : '' }}
    </td>

    <td>{{ $summary->approved_by }}</td>
</tr>

            @endforeach
        </tbody>
    </table>
   <!-- Side-by-Side Tables -->
   <div class="table-container">
        <!-- Second Table -->
        <table>
            <thead>
                <tr>
                    <th>Total OT</th>
                    <th>Total Deduction</th>
                    <th>Total After Deduction</th>
                </tr>
            </thead>
            <tbody>
                @foreach($overtimes as $summary)
                <tr>
                    <td>{{ $summary->TotalDuration != 'none' ? $summary->TotalDuration : '' }}</td>
                    <td>
                        @if($summary->DeductedDuration != 'none')
                            {{ $summary->TotalDuration - $summary->DeductedDuration }}
                        @endif
                    </td>
                    <td>{{ $summary->DeductedDuration != 'none' ? $summary->DeductedDuration : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Third Table (Overtime Aggregation for Regular Day) -->
        @php
            $first8h_total = 0;
            $more8h_total = 0;
            foreach($overtimes as $summary) {
                if($summary->Type_of_Day == "Regular Day" && $summary->TotalDuration != 'none'){
                    if($summary->TotalDuration <= 8){
                        $first8h_total += $summary->TotalDuration;
                    } else {
                        $first8h_total += 8;
                        $more8h_total += ($summary->TotalDuration - 8);
                    }
                }
            }
        @endphp
        <table border="1">
            <thead>
                <tr>
                    <th></th> <!-- Blank header cell -->
                    <th>1st 8h</th>
                    <th>1st 8h NP</th>
                    <th>>8h</th>
                    <th>>8h NP</th>
                    <th></th> <!-- Blank Column -->
                    <th colspan="2">Leave & Absences</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Regular</td>
                    <td>{{ $first8h_total }}</td>
                    <td>-</td>
                    <td>{{ $more8h_total }}</td>
                    <td>0.0</td>
                    <td></td>
                    <td>Tardiness/Undertime</td>
                    <td></td>
                </tr>
                <!-- You can add additional rows here for Sunday, Legal Holiday, etc. -->
                <tr>
    <td>Sunday</td>
    <td>
        @php
            $sunday_first8h = 0;
            $sunday_more8h = 0;
            foreach($overtimes as $summary) {
                if($summary->Type_of_Day == "Sunday" && $summary->TotalDuration != 'none') {
                    if($summary->TotalDuration <= 8) {
                        $sunday_first8h += $summary->TotalDuration;
                    } else {
                        $sunday_first8h += 8;
                        $sunday_more8h += ($summary->TotalDuration - 8);
                    }
                }
            }
        @endphp
        {{ $sunday_first8h }}
    </td>
    <td>-</td>
    <td>{{ $sunday_more8h }}</td>
    <td>0.0</td>
    <td></td>
    <td>Absence w/o Leave</td>
    <td></td>
</tr>
<tr>
    <td>Legal Holiday</td>
    <td>
        @php
            $legal_first8h = 0;
            $legal_more8h = 0;
            foreach($overtimes as $summary) {
                if($summary->Type_of_Day == "Legal Holiday" && $summary->TotalDuration != 'none') {
                    if($summary->TotalDuration <= 8) {
                        $legal_first8h += $summary->TotalDuration;
                    } else {
                        $legal_first8h += 8;
                        $legal_more8h += ($summary->TotalDuration - 8);
                    }
                }
            }
        @endphp
        {{ $legal_first8h }}
    </td>
    <td>-</td>
    <td>{{ $legal_more8h }}</td>
    <td>0.0</td>
    <td></td>
    <td>Vacation Leave</td>
    <td></td>
</tr>
<tr>
    <td>Special Holiday</td>
    <td>
        @php
            $special_first8h = 0;
            $special_more8h = 0;
            foreach($overtimes as $summary) {
                if($summary->Type_of_Day == "Special Holiday" && $summary->TotalDuration != 'none') {
                    if($summary->TotalDuration <= 8) {
                        $special_first8h += $summary->TotalDuration;
                    } else {
                        $special_first8h += 8;
                        $special_more8h += ($summary->TotalDuration - 8);
                    }
                }
            }
        @endphp
        {{ $special_first8h }}
    </td>
    <td>-</td>
    <td>{{ $special_more8h }}</td>
    <td>0.0</td>
    <td></td>
    <td>Sick Leave</td>
    <td></td>
</tr>
                <tr>
                    <td>Legal Hol Sun</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td></td>
                    <td>Other Leave</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Spcl Hol Sun</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                @if($overtimes->isNotEmpty())
                <td colspan="2">Prepared by: {{ $overtimes->first()->emp_name }}</td>
                 @endif

                    <td colspan="3">Checked by:</td>
                    <td colspan="3">Approved by:</td>
                </tr>
            </tfoot>
        </table>
    </div>

</body>
</html>
