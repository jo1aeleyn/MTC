@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Overtime</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Overtime Request Details</li>
                </ol>
            </nav>

            <div class="card mb-4 shadow-lg rounded-3 h-100">
                <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79;">
                    <h6 class="m-1">Overtime Request Information</h6>
                </div>
                <div class="card-body">
                    <div class="row d-flex align-items-stretch mb-3">
                        <div class="col-lg-6">
                            <h5><strong>Employee Name:</strong> {{ $overtime->emp_name }}</h5>
                            <p><strong>Employee Number:</strong> {{ $overtime->emp_num }}</p>
                            <p><strong>Requested By:</strong> {{ $overtime->requested_by }}</p>
                            <p><strong>Created By:</strong> {{ $overtime->created_by }}</p>
                            
                            @if($overtime->approved_by)
                            <div class="row d-flex align-items-stretch mb-3">
                                <div class="col-lg-6">
                                    <h6><strong>Approved By:</strong> {{ $overtime->approved_by }}</h6>
                                    <p><strong>Approved Date:</strong> {{ $overtime->approved_date }}</p>
                                </div>
                            </div>
                            @else
                            <p><strong>Approval Status:</strong>  <span class="badge bg-{{ 
                                $overtime->status == 'pending' ? 'warning' : 
                                ($overtime->status == 'approved' ? 'success' : 
                                ($overtime->status == 'recommended' ? 'warning' : 'danger')) 
                            }}">
                                {{ ucfirst($overtime->status) }}
                            </span></p>
                            @endif

                            <div class="mb-3">
                                <p><strong>Reason:</strong> {{ $overtime->reason ?? 'No Reason Provided' }}</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h6><strong>Client Name:</strong> {{ $overtime->client_name }}</h6>
                            <p><strong>Date Filed:</strong> {{ $overtime->date_filed }}</p>
                            <p><strong>Request Date:</strong> {{ $overtime->request_date }}</p>
                            <p><strong>Purpose:</strong> {{ $overtime->purpose ?? 'No Purpose Provided' }}</p>
                            <p><strong>Total Duration:</strong> {{ $overtime->TotalDuration }} hours</p>
                            <p><strong>Deducted Duration:</strong> {{ $overtime->DeductedDuration }} hours</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->user_role == 'Partners' && $empnum !== $overtime->emp_num)
                <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'approved']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'rejected']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            @endif


            @if(auth()->user()->user_role == 'HR Admin' && $empnum !== $overtime->emp_num)
                <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'recommended']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Recommend</button>
                </form>
                <form action="{{ route('overtime.update_status', ['overtime' => $overtime, 'status' => 'declined']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')      
                    <button type="submit" class="btn btn-danger">Decline</button>
                </form>
            @endif


            <a href="javascript:history.back();" class="btn" style="background-color:#326C79;color:white;float:right;">Back to Overtime List</a>
        </div>  
    </div>
</div>

@include('partials.footer')