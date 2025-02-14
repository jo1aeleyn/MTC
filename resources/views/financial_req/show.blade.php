@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Financial Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Request Details</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Financial Request Details</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Employee Number:</strong>
                            <p>{{ $financialRequest->emp_num }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Payee:</strong>
                            <p>{{ $financialRequest->payee }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Charge To:</strong>
                            <p>{{ $financialRequest->Chargeto }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Payment Form:</strong>
                            <p>{{ $financialRequest->PaymentForm }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Request Type:</strong>
                            <p>{{ $financialRequest->RequestType }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Amount:</strong>
                            <p>₱{{ number_format($financialRequest->Ammount, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ 
                                $financialRequest->status == 'pending' ? 'warning' : 
                                ($financialRequest->status == 'approved' ? 'success' : 
                                ($financialRequest->status == 'recommended' ? 'warning' : 'danger')) 
                            }}">
                                {{ ucfirst($financialRequest->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong>
                            <p>{{ $financialRequest->Date->format('Y-m-d') }}</p>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Purpose:</strong>
                            <p>{{ $financialRequest->purpose }}</p>
                        </div>
                    </div>

                    
                        
                            <div class="row mt-4">
                                <div class="col-md-12 text-end">
                                @if(auth()->user()->user_role == 'Partner')
                                     @if($empnum !== $financialRequest->emp_num)
                                    <form action="{{ route('financial_req.update_status', ['id' => $financialRequest->id, 'status' => 'approved']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                 
                                    <form action="{{ route('financial_req.update_status', ['id' => $financialRequest->id, 'status' => 'rejected']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Disapprove</button>
                                    </form>
                                    @endif
                                    @endif
                                    @if($empnum !== $financialRequest->emp_num)
                                    @if(auth()->user()->user_role == 'HR Admin')
                                    <form action="{{ route('financial_req.update_status', ['id' => $financialRequest->id, 'status' => 'recommended']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Recommend</button>
                                    </form>
                                    <form action="{{ route('financial_req.update_status', ['id' => $financialRequest->id, 'status' => 'declined']) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')      
                                        <button type="submit" class="btn btn-danger">Decline</button>
                                    </form>
                                    @endif
                                    @endif
                                    <a href="javascript:history.back();" class="btn btn-secondary">Back to List</a>
                                    </div>
                            </div>
                       
                    

                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
