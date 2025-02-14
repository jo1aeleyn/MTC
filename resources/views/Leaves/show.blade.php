@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Leave Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Request Details</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Leave Request Details</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Employee Name:</strong>
                            <p>{{ $leave->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Employee Number:</strong>
                            <p>{{ $leave->emp_num }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Leave Type:</strong>
                            <p>{{ $leave->TypeOfLeave }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Date of Leave:</strong>
                            <p>{{ $leave->DateOfLeave->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Remarks:</strong>
                            <p>{{ $leave->Remarks }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $leave->Status == 'pending' ? 'warning' : ($leave->Status == 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($leave->Status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Date Requested:</strong>
                            <p>{{ $leave->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>

                  
                        <div class="row mt-4">
                            <div class="col-md-12 text-end">
                            @if(auth()->user()->user_role == 'Partner')
                            @if($empnum !== $leave->emp_num)
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
                                    @endif
                                    @if($empnum !== $leave->emp_num)
                                    @if(auth()->user()->user_role == 'HR Admin')
                                    <form action="{{ route('leave_requests.update_status', ['id' => $leave->id, 'status' => 'recommended']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Recommend</button>
                                    </form>
                                    <form action="{{ route('leave_requests.update_status', ['id' => $leave->id, 'status' => 'declined']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')      
                                        <button type="submit" class="btn btn-danger">Decline</button>
                                    </form>
                                    @endif
                                    @endif
                                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
