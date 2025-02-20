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
                    
                    <div class="card mt-3">
                        <div class="card-header text-white p-1" style="background-color: #326C79;">
                            <h6 class="m-1">Employee Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="detail-label">Employee Name:</span> <span class="detail-value">{{ $overtime->emp_name }}</span></p>
                                    <p><span class="detail-label">Employee Number:</span> <span class="detail-value">{{ $overtime->emp_num }}</span></p>
                                    <p><span class="detail-label">Client Name:</span> <span class="detail-value">{{ $overtime->client_name }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="detail-label">Date Filed:</span> <span class="detail-value">{{ $overtime->date_filed }}</span></p>
                                    <p><span class="detail-label">Request Date:</span> <span class="detail-value">{{ $overtime->request_date }}</span></p>
                                    <p><span class="detail-label">Purpose:</span> <span class="detail-value">{{ $overtime->purpose ?? 'No Purpose Provided' }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header text-white p-1" style="background-color: #326C79;">
                            <h6 class="m-1">Approval Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="detail-label">Approved By:</span> <span class="detail-value">{{ $overtime->approved_by }}</span></p>
                                    <p><span class="detail-label">Approved Date:</span> <span class="detail-value">{{ \Carbon\Carbon::parse($overtime->approved_date)->format('Y-m-d') }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="detail-label">Approval Status:</span>
                                        <span class="badge bg-{{ 
                                            $overtime->status == 'pending' ? 'warning' : 
                                            ($overtime->status == 'approved' ? 'success' : 'danger') }}">
                                            {{ ucfirst($overtime->status) }}
                                        </span>
                                    </p>
                                    <p><span class="detail-label">With Pay:</span>
                                        <span class="badge bg-{{ $overtime->WithPay === 1 ? 'success' : ($overtime->WithPay === 0 ? 'danger' : 'secondary') }}">
                                            {{ $overtime->WithPay === 1 ? 'Yes' : ($overtime->WithPay === 0 ? 'No' : 'Not Set') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->user_role == 'Partners' && $empnum !== $overtime->emp_num)
                        <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#approveModal">Approve</button>
                        <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
                    @endif

                    <a href="javascript:history.back();" class="btn mt-3" style="background-color:#326C79;color:white;float:right;">Back to Overtime List</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
