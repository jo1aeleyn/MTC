@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/tables.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Financial Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">My Financial Application Requests</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <!-- Success and Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Container for the button and filter section -->

                    @if(auth()->user()->user_role == 'Employee User')
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Add New Financial Request Button -->
                        <a href="{{ route('financial_req.create') }}" class="btn text-white" style="background-color:#326C79">Add New Financial Request</a>
                    </div>
                    @endif
                    <!-- Financial Requests Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="personalfinancialReqTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Number</th>
                                        <th>Payee</th>
                                        <th>Charge To</th>
                                        <th>Payment Form</th>
                                        <th>Request Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($financialRequests as $index => $request)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $request->emp_num }}</td>
                                            <td>{{ $request->payee }}</td>
                                            <td>{{ $request->Chargeto }}</td>
                                            <td>{{ $request->PaymentForm }}</td>
                                            <td>{{ $request->RequestType }}</td>
                                            <td>₱{{ number_format($request->Ammount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $request->Date->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="dropdown" style="text-align:center;">
                                                    <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $request->uuid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $request->uuid }}">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('financial_req.show', $request->uuid) }}">View</a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('financial_req.edit', $request->uuid) }}">Edit</a>
                                                        </li>
                                                      
                                                      
                                                        <li>
                                                        <form id="cancelFinancialForm{{ $request->uuid }}" action="{{ route('financial_req.cancel', $request->uuid) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" class="dropdown-item" onclick="confirmAction('cancel', '{{ $request->uuid }}')">Cancel</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>s
                        </div>
                    </div>

                    <!-- No Records Found Message -->
                    @if ($financialRequests->isEmpty())
                        <div id="noRecordsMessage" class="text-center text-muted mt-3" style="font-size: 18px;">
                            No financial requests found.
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $financialRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmAction(action, overtimeUuid) {
        let actionText = action === 'archive' ? 'archive this overtime request' : 'cancel this overtime request';
        let confirmButtonText = action === 'archive' ? 'Yes, archive it!' : 'Yes, cancel it!';
        let formId = action === 'archive' ? 'archiveForm' : 'cancelForm';

        Swal.fire({
            title: "Are you sure?",
            text: `You are about to ${actionText}.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: confirmButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId + overtimeUuid).submit();
            }
        });
    }
</script>
@include('partials.footer')
