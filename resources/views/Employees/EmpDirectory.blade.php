<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
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
        color:white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .header {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .footer {
        margin-top: 20px;
        text-align: right;
        font-size: 10px;
        color: #666;
    }
</style>

<div class="header">Mendoza Tugano & CO,. CPAs <br>Employee Directory</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Employee Number</th>
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Tin</th>
            <th>SSS</th>
            <th>Pag-Ibig</th>
            <th>Philhealth</th>
            <th>Tax Status</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $index => $employee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $employee->emp_num }}</td>
                <td>{{ $employee->first_name }} {{ $employee->surname }}</td>
                <td>{{ $employee->application->position ?? 'N/A' }}</td>
                <td>{{ $employee->application->DepartmentName ?? 'N/A' }}</td>
                <td>{{ $employee->tin_num }}</td>
                <td>{{ $employee->sss_num }}</td>
                <td>{{ $employee->pag_ibig_num }}</td>
                <td>{{ $employee->philhealth_num }}</td>
                <td>{{ $employee->tax_status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">Generated on {{ now()->format('F d, Y h:i A') }}</div>