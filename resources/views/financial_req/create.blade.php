@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Financial Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Financial Request</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Financial Request Form -->
                    <form action="{{ route('financial_req.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Charge To -->
                            <div class="mb-3 col-6">
                                <label for="Chargeto" class="form-label">Charge To</label>
                                <select name="Chargeto" id="Chargeto" class="form-select">
                                    <option value="" disabled selected>Select Charge To</option>
                                    <option value="Office">Office</option>
                                    <option value="Client/Project">Client/Project</option>
                                </select>
                            </div>

                            <!-- Request Type -->
                            <div class="mb-3 col-6">
                                <label for="RequestType" class="form-label">Request Type</label>
                                <select name="RequestType" id="RequestType" class="form-select">
                                    <option value="" disabled selected>Select Request Type</option>
                                    <option value="reimbursement">Reimbursement</option>
                                    <option value="liquidation">Liquidation</option>
                                    <option value="cash advance">Cash Advance</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Payment Form -->
                            <div class="mb-3 col-6">
                                <label for="PaymentForm" class="form-label">Payment Form</label>
                                <select name="PaymentForm" id="PaymentForm" class="form-select">
                                    <option value="" disabled selected>Select Payment Form</option>
                                    <option value="Petty Cash">Petty Cash</option>
                                    <option value="Check">Check</option>
                                </select>
                            </div>

                            <!-- Amount -->
                            <div class="mb-3 col-6">
                                <label for="Amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="number" step="0.01" name="Amount" id="Amount" class="form-control" placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <!-- Purpose -->
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="Date" class="form-label">Date</label>
                            <input type="date" name="Date" id="Date" class="form-control">
                        </div>

                                            <!-- Upload Images Section (Hidden by Default) -->
                        <div id="imageUploadSection" class="mb-3" style="display: none;">
                            <label for="images" class="form-label">Upload Images</label>
                            <input type="file" name="images[]" id="images" name="images" class="form-control" multiple>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-white w-auto px-4" style="background-color:#326C79">Submit</button>
                            <a href="javascript:history.back();" class="btn btn-secondary w-auto px-4 ms-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("RequestType").addEventListener("change", function () {
        let requestType = this.value;
        let paymentForm = document.getElementById("PaymentForm");

        // Clear existing options
        paymentForm.innerHTML = '<option value="" disabled selected>Select Payment Form</option>';

        // Add default options
        paymentForm.innerHTML += '<option value="Petty Cash">Petty Cash</option>';
        paymentForm.innerHTML += '<option value="Check">Check</option>';

        // Add conditional option if Request Type is "Reimbursement"
        if (requestType === "reimbursement") {
            paymentForm.innerHTML += '<option value="Credit to Payroll">Credit to Payroll</option>';
        }
    });

    document.getElementById("RequestType").addEventListener("change", function () {
        let requestType = this.value;
        let imageUploadSection = document.getElementById("imageUploadSection");

        if (requestType === "reimbursement" || requestType === "liquidation") {
            imageUploadSection.style.display = "block";
        } else {
            imageUploadSection.style.display = "none";
        }
    });
</script>

@include('partials.footer')
