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
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Overtime</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Overtime Request Details</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h5>Overtime Request Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="detail-label">Employee Name:</span> <span class="detail-value">{{ $overtime->emp_name }}</span></p>
                            <p><span class="detail-label">Employee Number:</span> <span class="detail-value">{{ $overtime->emp_num }}</span></p>
                            <p><span class="detail-label">Requested By:</span> <span class="detail-value">{{ $overtime->requested_by }}</span></p>
                            <p><span class="detail-label">Created By:</span> <span class="detail-value">{{ $overtime->created_by }}</span></p>
                            <p><span class="detail-label">Approved By:</span> <span class="detail-value">{{ $overtime->approved_by }}</span></p>
                            <p><span class="detail-label">Approved Date:</span> <span class="detail-value">{{ \Carbon\Carbon::parse($overtime->approved_date)->format('Y-m-d') }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="detail-label">Client Name:</span> <span class="detail-value">{{ $overtime->client_name }}</span></p>
                            <p><span class="detail-label">Date Filed:</span> <span class="detail-value">{{ $overtime->date_filed }}</span></p>
                            <p><span class="detail-label">Request Date:</span> <span class="detail-value">{{ $overtime->request_date }}</span></p>
                            <p><span class="detail-label">Purpose:</span> <span class="detail-value">{{ $overtime->purpose ?? 'No Purpose Provided' }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <span class="detail-label">Status:</span> 
                                <span class="badge bg-{{ 
                                    $overtime->status == 'pending' ? 'warning' : 
                                    ($overtime->status == 'approved' ? 'success' : 
                                    ($overtime->status == 'recommended' ? 'warning' : 'danger')) 
                                }}">
                                    {{ ucfirst($overtime->status) }}
                                </span>
                            </p>
                            <!-- <p>
                                <span class="detail-label">With Pay:</span> 
                                <span class="badge bg-{{ $overtime->WithPay ? 'success' : 'danger' }}">
                                    {{ $overtime->WithPay ? 'Yes' : 'No' }}
                                </span>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->user_role == 'Partners' && $empnum !== $overtime->emp_num)
                <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'approved']) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success mt-3">Approve</button>
                </form>
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
            @endif

            <a href="javascript:history.back()" class="btn mt-3" style="background-color:#326C79;color:white;float:right;">Back to Overtime List</a>
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
            <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'rejected']) }}" method="POST">
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

@include('partials.footer')
