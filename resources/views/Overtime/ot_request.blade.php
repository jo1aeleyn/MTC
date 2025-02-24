<style>
    .page-break {
        page-break-after: always;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    .label {
        font-weight: bold;
        background-color: #f2f2f2;
        width: 30%;
    }
</style>

@foreach($overtimes as $overtime)
    <table>
        <tr>
            <td class="label">Employee Name:</td>
            <td>{{ $overtime->emp_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Date Filed:</td>
            <td>{{ $overtime->date_filed ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Client Name:</td>
            <td>{{ $overtime->client_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Deducted Duration:</td>
            <td>{{ $overtime->DeductedDuration ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Purpose:</td>
            <td>{{ $overtime->purpose ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Status:</td>
            <td>{{ $overtime->status ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Requested By:</td>
            <td>{{ $overtime->requested_by ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Approved By:</td>
            <td>{{ $overtime->approved_by ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Approved Date:</td>
            <td>{{ $overtime->approved_date ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Page break for PDF -->
    <div class="page-break"></div>
@endforeach
