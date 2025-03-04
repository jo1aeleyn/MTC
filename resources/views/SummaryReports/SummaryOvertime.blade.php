@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.min.css" />



<div class="container">
<div class="page-inner">
<div class="container">
<nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
            <li class="breadcrumb-item text-muted">Summary Reports</li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Overtime Reports</li>
        </ol>
    </nav>
<div class="card">
    <div class="card-body">
    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
<!-- Form and Export Button Aligned Properly -->
<div class="card-body">
    <div class="d-flex justify-content-between align-items-end">
        <!-- Centered, Modern Date Selection Form -->
        <form method="GET" action="{{ route('overtime.summary') }}" class="p-3">
            <div class="d-flex align-items-end">
                <div class="me-2">
                    <label for="date_range" class="form-label mb-1 fw-bold d-flex justify-content-center">Date Range</label>
                    <input type="text" class="form-control form-control-sm rounded-pill border-secondary text-center"
                           id="date_range" 
                           style="width: 220px; padding: 8px 12px; font-size: 14px;" 
                           placeholder="Select date range" 
                           required>
                    <input type="hidden" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>

                <!-- Clear Button -->
                <div>
                    <a href="{{ route('overtime.summary') }}" class="btn btn-sm btn-secondary rounded-pill px-3">Clear</a>
                </div>
            </div>
        </form>

        <!-- Export PDF Button Pushed to the Right -->
        <div class="ms-auto">
            <a id="exportPdfBtn" href="{{ route('overtime.export-pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
               class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>
</div>





        <!-- Employee Table -->
        <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="employeeTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Number</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Number of Overtimes</th>
                                    <th>Total Hours</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->emp_num }}</td>
                                        <td>{{ $employee->first_name }} {{ $employee->surname }}</td>
                                        <td>{{ $employee->application->position ?? 'N/A' }}</td>
                                        <td style="text-align: center;">{{ $employee->overtime_count }}</td>
                                        <td style="text-align: center;">{{ $employee->total_hours }}</td>

                                        <td>
                                            <!-- Dropdown for Actions -->
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $employee->uuid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $employee->uuid }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('employee.edit', $employee->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('employee.show', $employee->uuid) }}">View</a>
                                                    </li>
                                                    <li>
                                                    <form id="archiveForm{{ $employee->uuid }}" action="{{ route('employee.archive', $employee->uuid) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="dropdown-item" onclick="confirmArchive('{{ $employee->uuid }}')">Archive</button>
                                                    </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
        </div>
        <!-- No Records Found Message -->
        <div id="noRecordsMessage" class="text-center text-muted" style="display: none; font-size: 18px;">
            No employee records found.
        </div>
    </div>
</div>
</div>
</div>

</div>
</div>
@include('partials.footer')

<script>
$(document).ready(function() {
    function updateExportPDFLink() {
        let startDate = $('#start_date').val();
        let endDate = $('#end_date').val();
        let exportLink = "{{ route('overtime.export-pdf') }}?start_date=" + startDate + "&end_date=" + endDate;
        $('#exportPdfBtn').attr('href', exportLink);
    }

    $('#date_range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' }
    });

    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        let startDate = picker.startDate.format('YYYY-MM-DD');
        let endDate = picker.endDate.format('YYYY-MM-DD');

        // Update hidden fields
        $('#start_date').val(startDate);
        $('#end_date').val(endDate);

        // Show selected date range inside input field
        $(this).val(startDate + ' to ' + endDate);

        // Update Export PDF Link
        updateExportPDFLink();

        // Automatically submit the form
        $(this).closest('form').submit();
    });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val(''); // Clear input field
        $('#start_date').val('');
        $('#end_date').val('');

        // Update Export PDF Link
        updateExportPDFLink();
    });

    // ✅ Ensure the date range is displayed when the page loads
    let existingStartDate = $('#start_date').val();
    let existingEndDate = $('#end_date').val();
    if (existingStartDate && existingEndDate) {
        $('#date_range').val(existingStartDate + ' to ' + existingEndDate);
    }

    // Ensure the export PDF link is updated on page load
    updateExportPDFLink();
});
</script>



<!-- Include jQuery & Date Range Picker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.min.js"></script>
