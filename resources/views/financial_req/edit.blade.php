@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Financial Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Financial Request</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('financial_req.update', $financialRequest->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="Chargeto" class="form-label">Charge To</label>
                            <select name="Chargeto" id="Chargeto" class="form-control">
                                <option value="Office" {{ $financialRequest->Chargeto == 'Office' ? 'selected' : '' }}>Office</option>
                                <option value="Client/Project" {{ $financialRequest->Chargeto == 'Client/Project' ? 'selected' : '' }}>Client/Project</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="PaymentForm" class="form-label">Payment Form</label>
                            <select name="PaymentForm" id="PaymentForm" class="form-control">
                                <option value="Petty Cash" {{ $financialRequest->PaymentForm == 'Petty Cash' ? 'selected' : '' }}>Petty Cash</option>
                                <option value="Check" {{ $financialRequest->PaymentForm == 'Check' ? 'selected' : '' }}>Check</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="RequestType" class="form-label">Request Type</label>
                            <select name="RequestType" id="RequestType" class="form-control">
                                <option value="Reimbursement" {{ $financialRequest->RequestType == 'Reimbursement' ? 'selected' : '' }}>Reimbursement</option>
                                <option value="Liquidation" {{ $financialRequest->RequestType == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                <option value="Cash Advance" {{ $financialRequest->RequestType == 'Cash Advance' ? 'selected' : '' }}>Cash Advance</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Ammount" class="form-label">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" step="0.01" name="Ammount" id="Ammount" class="form-control" value="{{ $financialRequest->Ammount }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3">{{ $financialRequest->purpose }}</textarea>
                        </div>



                        @if( auth()->user()->user_role == 'Partner')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $financialRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $financialRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $financialRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        @endif



                        <button type="submit" class="btn btn-success">Update Request</button>

                        <a href="{{ route('financial_req.personalindex') }}" class="btn btn-secondary">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
