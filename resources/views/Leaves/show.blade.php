@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
    <div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Leaves</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">View </li>
                </ol>
            </nav>
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Leave Request Overview</h4>

                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


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
                    <form method="POST" action="{{ route('leave.credits.store', $leave->uuid) }}">
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
                                <label for="LessApprovedDays" class="form-label">Less Approved Leave Days:</label>
                                <input type="text" class="form-control" id="LessApprovedDays" name="LessApprovedDays">
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
                            <form action="{{ route('leave_requests.update_status', ['uuid' => $leave->uuid, 'status' => 'Approved']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('leave_requests.update_status', ['uuid' => $leave->uuid, 'status' => 'Rejected']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Disapprove</button>
                            </form>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Announcements List
    </a>
    </div>
</div>

@include('partials.footer')
