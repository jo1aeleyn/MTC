@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container my-4">
    <div class="page-inner">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent p-0 m-0 fs-6">
                <li class="breadcrumb-item text-muted">Leave Requests</li>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Request Details</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Leave Request Overview</h4>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Employee Name:</strong>
                        <p class="fs-5">{{ $leave->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Employee Number:</strong>
                        <p class="fs-5">{{ $leave->emp_num }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Leave Type:</strong>
                        <p class="fs-5">{{ $leave->TypeOfLeave }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Date of Leave:</strong>
                        <p class="fs-5">{{ $leave->DateOfLeave->format('Y-m-d') }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Remarks:</strong>
                        <p class="fs-5">{{ $leave->Remarks }}</p>
                    </div>
                    <div class="col-md-6">
                    <strong>Status:</strong>
                    <span class="badge bg-{{ 
                        $leave->Status == 'pending' ? 'warning' : 
                        ($leave->Status == 'approved' ? 'success' : 
                        ($leave->Status == 'recommended' ? 'warning' : 'danger'))
                    }} rounded-pill">
                        {{ ucfirst($leave->Status) }}
                    </span>
                </div>  
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Date Requested:</strong>
                        <p class="fs-5">{{ $leave->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-4">Personnel Leave Details</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <h6 class="text-muted">VL/SL Credits Remaining</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->LeavesCredits ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">With Pay</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->WithPay ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Without Pay</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->WithoutPay ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Less Approved Leave Days</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->LessApproedDays ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Remaining Leave Credits</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->RemainingLeaves ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Filled Up By</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->FilledUpBy ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Filled Up Date</h6>
                        <p class="fs-5 fw-semibold">{{ $leave->FilledUpDate ? $leave->FilledUpDate->format('Y-m-d') : 'N/A' }}</p>
                    </div>
                </div>

                @if(auth()->user()->user_role == 'HR Admin')
                    <hr class="my-4">
                    <h5 class="mb-4">Leave Credits Form (To be filled up by Personnel)</h5>
                    <form method="POST" action="{{ route('leave.credits.store', $leave->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="LeavesCredits" class="form-label">VL/SL Credits Remaining:</label>
                                <input type="text" class="form-control" id="LeavesCredits" name="LeavesCredits">
                            </div>
                            <div class="col-md-3">
                                <label for="WithPay" class="form-label">With Pay:</label>
                                <input type="text" class="form-control" id="WithPay" name="WithPay">
                            </div>
                            <div class="col-md-3">
                                <label for="WithoutPay" class="form-label">Without Pay:</label>
                                <input type="text" class="form-control" id="WithoutPay" name="WithoutPay">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="LessApproedDays" class="form-label">Less Approved Leave Days:</label>
                                <input type="text" class="form-control" id="LessApproedDays" name="LessApproedDays">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="RemainingLeaves" class="form-label">Remaining Leave Credits:</label>
                                <input type="text" class="form-control" id="RemainingLeaves" name="RemainingLeaves">
                            </div>
                            <div class="col-md-3">
                                <label for="FilledUpBy" class="form-label">By:</label>
                                <input type="text" class="form-control" id="FilledUpBy" name="FilledUpBy">
                            </div>
                            <div class="col-md-3">
                                <label for="FilledUpDate" class="form-label">Date:</label>
                                <input type="date" class="form-control" id="FilledUpDate" name="FilledUpDate">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Recommend</button>
                    </form>
                @endif

                <div class="row mt-4">
                    <div class="col-md-12 text-end">
                        @if(auth()->user()->user_role == 'Partners' && $empnum !== $leave->emp_num)
                            <form action="{{ route('leave_requests.update_status', ['id' => $leave->id, 'status' => 'approved']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('leave_requests.update_status', ['id' => $leave->id, 'status' => 'rejected']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Disapprove</button>
                            </form>
                        @endif
                        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
