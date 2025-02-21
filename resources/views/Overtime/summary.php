<!DOCTYPE html>
<html>
<head>
    <title>Overtime Summary</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Overtime Summary Report</h2>
    <table>
        <thead>
            <tr>
                <th>Employee No.</th>
                <th>Employee Name</th>
                <th>Type of Day</th>
                <th>Total Hours</th>
                <th>With Pay</th>
                <th>Without Pay</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overtimes as $summary)
            <tr>
                <td>{{ $summary->emp_num }}</td>
                <td>{{ $summary->emp_name }}</td>
                <td>{{ $summary->Type_Of_Day }}</td>
                <td>{{ $summary->total_hours }}</td>
                <td>{{ $summary->with_pay_hours }}</td>
                <td>{{ $summary->without_pay_hours }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
