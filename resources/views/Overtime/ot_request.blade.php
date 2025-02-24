<style>
    /* Page break style for PDF generation */
    .page-break {
        page-break-after: always;
    }

    /* Center the text in the single-column rows */
    .center-cell {
        text-align: center;
        vertical-align: middle;
    }

    /* Other styles for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
        border: 1px solid black; /* Add black border for the table itself */
    }

    td {
        padding: 8px;
        border: 1px solid black; /* Border for individual cells */
    }

    .label {
        font-weight: bold;
        background-color: #DCDCDC;
        width: 30%;
        border: 1px solid black; /* Ensure label cells have black border */
    }

    /* Flexbox layout for side by side content */
    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .col-6 {
        flex: 1; /* Ensures 50% width for each column */
        padding: 5px; /* Adds some padding between columns */
    }

    /* Ensure the content looks good when printed or in PDF */
    @media print {
        .row {
            display: flex;
            justify-content: space-between;
        }

        .col-6 {
            width: 48%; /* This ensures they are side by side and not stacked */
            padding: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    }

    h3 {
        text-align: center;
        margin: 0; /* Removes default margin */
        padding: 0; /* Removes any padding if applied */
        color:#326C79;
    }
    
    h4 {
    text-align: center;
    margin: 0; /* Removes default margin */
    padding: 0; /* Removes any padding if applied */
    color: #FFDE59;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); /* Adds a subtle shadow */
}


    /* Optional: Add some spacing between them */
    h4 {
        margin-top: 3px; /* Adjust this value as needed */
        margin-bottom: 10px; 
    }
</style>
@foreach($overtimes as $index => $overtime)
<br>
    <hr>
    <br>
    <h3>MENDOZA TUGANO & Co,. CPAs</h3>
    <h4>Overtime Request Form</h4>

    <table>
        <tr>
            <td class="label">Employee Name:</td>
            <td>{{ $overtime->emp_name ?? 'N/A' }}</td>
        
            <td class="label">Date Filed:</td>
            <td>{{ $overtime->date_filed ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Client Name:</td>
            <td>{{ $overtime->client_name ?? 'N/A' }}</td>

            <td class="label">Deducted Duration:</td>
            <td>{{ $overtime->DeductedDuration ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Center the Purpose field -->
    <table>
        <tr>
            <td colspan="4" class="center-cell label">Purpose:</td>
        </tr>
        <tr>
            <td colspan="4" class="center-cell">{{ $overtime->purpose ?? 'N/A' }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="label">Requested By:</td>
            <td>{{ $overtime->requested_by ?? 'N/A' }}</td>
        
            <td class="label">Approved By:</td>
            <td>{{ $overtime->approved_by ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td class="label">Date:</td>
            <td>{{ $overtime->date_filed ?? 'N/A' }}</td>
            <td class="label">Approved Date:</td>
            <td>{{ $overtime->approved_date ?? 'N/A' }}</td>
        </tr>
    </table>

    <!-- Center the Status field -->
    <table>
        <tr>
            <td colspan="4" class="center-cell label">Status:</td>
        </tr>
        <tr>
            <td colspan="4" class="center-cell">{{ $overtime->status ?? 'N/A' }}</td>
        </tr>
    </table>
    <br>
    <hr>
    <br>

    <!-- Page break after every second loop -->
    @if (($index + 1) % 2 == 0)
        <div class="page-break"></div>
    @endif
@endforeach
