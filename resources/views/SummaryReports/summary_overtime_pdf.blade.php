<!DOCTYPE html>
<html>
<head>
    <title>Overtime Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #326C79;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Report Header -->
    <div class="header">Mendoza Tugano & CO, CPAs <br> Overtime Report</div>

    <!-- Date Range -->
    <p style="text-align: center;">
        Date Range: {{ $startDate ? $startDate . ' to ' . $endDate : 'All Time' }}
    </p>

    <!-- Overtime Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Number</th>
                <th>Name</th>
                <th>Position</th>
                <th>Number of Overtimes</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->emp_num }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->surname }}</td>
                    <td>{{ $employee->application->position ?? 'N/A' }}</td>
                    <td>{{ $employee->overtime_count }}</td>
                    <td>{{ $employee->total_hours }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">Generated on {{ now()->format('F d, Y h:i A') }}</div>

</body>
</html>
