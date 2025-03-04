@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<style>
    .detail-label {
        font-weight: bold;
        font-size: 15px;
        color: #333;
    }
    .detail-value {
        font-size: 14px;
        color: #555;
    }
    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        color: #007bff;
    }
</style>

<div class="container">
    <div class="page-inner">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                <li class="breadcrumb-item text-muted">Manage Overtime</li>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Overtime Request Details</li>
            </ol>
        </nav>
                    <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                <h5 class="section-title text-white mb-4">Overtime Request Information</h5>
                <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover table-striped align-middle shadow-sm rounded">
                                <tbody>
                                    <tr><th class="bg-light text-secondary">Employee Name</th><td>{{ $overtime->emp_name }}</td></tr>
                                    <tr><th class="bg-light text-secondary">Client Name</th><td>{{ $overtime->client_name }}</td></tr>

                                    @if(auth()->user()->user_role != 'Employee User')
                                    <tr><th class="bg-light text-secondary">Employee Number</th><td>{{ $overtime->emp_num }}</td></tr>
                                    @endif
                                    @if(auth()->user()->user_role != 'Employee User')
                                    <tr><th class="bg-light text-secondary">Created By</th><td>{{ $overtime->created_by }}</td></tr>
                                    @endif
                                    <tr><th class="bg-light text-secondary">Recommended By</th><td>{{ $overtime->recommended_by }}</td></tr>

                                    <tr><th class="bg-light text-secondary">Approved Date</th>
                                        <td>{{ \Carbon\Carbon::parse($overtime->Approved_date)->format('Y-m-d') }}</td>
                                    </tr>
                                    
                                    <tr><th class="bg-light text-secondary">Approved By</th><td>{{ $overtime->approved_by }}</td></tr>
                                    @php
                                        $statusClasses = [
                                            'Approved' => 'success',   // Green
                                            'Pending' => 'warning',    // Yellow
                                            'Recommended' => 'warning', // Yellow
                                            'Rejected' => 'danger'     // Red
                                        ];
                                        $badgeClass = $statusClasses[$overtime->status] ?? 'secondary'; // Default to gray if unknown
                                    @endphp
                                    <tr>
                                        <th class="bg-light text-secondary">Status</th>
                                        <td>
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst($overtime->status) ?? 'Unknown' }}
                                            </span>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-hover table-striped align-middle shadow-sm rounded">
                                <tbody>
                                    <tr><th class="bg-light text-secondary">Date Filed</th><td>{{ $overtime->date_filed }}</td></tr>
                                    @if(auth()->user()->user_role != 'Employee User')
                                    <tr><th class="bg-light text-secondary">Request Date</th><td>{{ $overtime->request_date }}</td></tr>
                                    @endif
                                    <tr><th class="bg-light text-secondary">Total Duration</th><td>{{ $overtime->TotalDuration }}</td></tr>
                                    @if(auth()->user()->user_role == 'Employee User' && $overtime->status == 'Approved')
                                    <tr><th class="bg-light text-secondary">Deducted Duration</th><td>{{ $overtime->DeductedDuration }}</td></tr>
                                    @endif
                                     @if(auth()->user()->user_role != 'Employee User')
                                    <tr><th class="bg-light text-secondary">Recommended Duration</th><td>{{ $overtime->sup_deduction }}</td></tr>
                                    @endif
                                    @if(auth()->user()->user_role == 'Employee User' && $overtime->status == 'Approved')
                                    <tr><th class="bg-light text-secondary">Approved Duration</th><td>{{ $overtime->partner_deduction }}</td></tr>
                                    @endif

                                    <tr><th class="bg-light text-secondary">Purpose</th><td>{{ $overtime->purpose ?? 'No Purpose Provided' }}</td></tr>
                                    @if($overtime->status == 'Rejected')
                                        <tr><th class="bg-danger text-white">Rejection Reason</th>
                                            <td class="text-danger">{{ $overtime->reason ?? 'No Reason Provided' }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <div class="mt-3">
            @if(auth()->user()->user_role == 'Auditing Supervisor' || auth()->user()->user_role == 'Accounting Supervisor')
                <button type="button" class="btn btn-success" onclick="openStatusModal('{{ route('overtime.update_status', ['overtime' => $overtime->uuid, 'status' => 'Recommended']) }}', 'Recommended')">Recommend</button>
            @endif
            @if(auth()->user()->user_role == 'Partners')
                <button type="button" class="btn btn-success" onclick="openStatusModal('{{ route('overtime.update_status', ['overtime' => $overtime->uuid, 'status' => 'Approved']) }}', 'Approved')">Approve</button>
            @endif
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
            <a href="javascript:history.back()" class="btn btn-secondary" style="float:right;">Back to Overtime List</a>
        </div>
    </div>
</div>


<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Approved Overtime Duration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="deducted_duration" class="form-label">Deducted Duration (hours):</label>

                    @if(auth()->user()->user_role == 'Auditing Supervisor' || auth()->user()->user_role == 'Accounting Supervisor')
                        <input type="number" step="0.01" class="form-control" 
                            name="sup_deduction" id="sup_deduction" 
                            placeholder="{{ $overtime->sup_deduction ?? '0' }}" required>
                    
                    @elseif(auth()->user()->user_role == 'Partners')
                        <input type="number" step="0.01" class="form-control" 
                            name="partner_deduction" id="partner_deduction" 
                            placeholder="{{ $overtime->partner_deduction ?? '0' }}" required>
                    
                    @else
                        <input type="number" step="0.01" class="form-control" 
                            name="deducted_duration" id="deducted_duration" 
                            placeholder="{{ $overtime->DeductedDuration ?? '0' }}" required>
                    @endif

                    <input type="hidden" name="status" id="status">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Provide Rejection Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('overtime.update_status', ['overtime' => $overtime->uuid, 'status' => 'Rejected']) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <label for="rejection_reason" class="form-label">Reason for Rejection:</label>
        <textarea class="form-control" name="rejection_reason" id="rejection_reason" required></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Reject</button>
    </div>
</form>
        </div>
    </div>
</div>

<script>
   function openStatusModal(actionUrl, status) {
    document.getElementById('updateStatusForm').action = actionUrl;
    document.getElementById('status').value = status;
    new bootstrap.Modal(document.getElementById('updateStatusModal')).show();
}

</script>


@include('partials.footer')
