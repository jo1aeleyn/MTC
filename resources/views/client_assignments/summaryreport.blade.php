<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Client Assignments</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #326C79; color: white; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Client Assignments Report</h2>
        <p>Generated on: {{ now()->format('F j, Y, g:i a') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Client Name</th>
                <th>Assigned By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->employee_name }}</td>
                    <td>{{ $assignment->client_name }}</td>
                    <td>{{ $assignment->assigned_by_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
