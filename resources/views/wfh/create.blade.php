@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Work From Home</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Apply for WFH</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('wfh.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="Date_filed" class="form-label">Date Filed</label>
                                <input type="date" name="Date_filed" id="Date_filed" class="form-control" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="Date_WFH" class="form-label">Date of WFH</label>
                                <input type="date" name="Date_WFH" id="Date_WFH" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
    <!-- Engagement -->
    <div class="mb-3 col-md-6">
        <label for="Engagement" class="form-label">Engagement</label>
        <input type="text" name="Engagement" id="Engagement" class="form-control" required>
    </div>
    <!-- Client Name -->
    <div class="mb-3 col-md-6">
        <label for="client_name" class="form-label">Client Name</label>
        <select name="client_name" id="client_name" class="form-control" required>
            <option value="">Select Client</option>
            @foreach($clients as $client)
    <option value="{{ $client['name'] }}">
        {{ $client['name'] }} ({{ $client['type'] }})
    </option>
@endforeach

        </select>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="taskTable">
        <thead class="text-center">
            <tr>
                <th colspan="2">Assigned Task/Deliverables</th>
                <th colspan="2">Task Completed/Output</th>
                <th></th>
            </tr>
            <tr>
                <th style="width: 15%;">Budgeted Time</th>
                <th style="width: 35%;">Details</th>
                <th style="width: 35%;">Summary of Work Done</th>
                <th style="width: 15%;">Time Submitted</th>
                <th style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="number" name="Budgetted_time[]" class="form-control form-control-sm" min="1" required>
                </td>
                <td>
                    <textarea name="Details[]" class="form-control form-control-sm" rows="2" required></textarea>
                </td>
                <td>
                    <textarea name="SummaryOfWorkDone[]" class="form-control form-control-sm" rows="2"></textarea>
                </td>
                <td>
                    <input type="time" name="TimeSubmitted[]" class="form-control form-control-sm">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm removeRow" disabled>Remove</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Buttons -->
<div class="d-flex justify-content-center my-3">
    <button type="button" class="btn btn-success me-2" id="addRow">Add Row</button>
</div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-white w-auto px-4" style="background-color:#326C79">Submit</button>
                            <a href="{{ route('wfh.index') }}" class="btn btn-secondary w-auto px-4 ms-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("addRow").addEventListener("click", function() {
    let table = document.getElementById("taskTable").getElementsByTagName("tbody")[0];
    let newRow = table.rows[0].cloneNode(true);

    // Clear the input values in the cloned row
    newRow.querySelectorAll("input, textarea").forEach(input => input.value = "");

    // Enable remove button for new rows
    newRow.querySelector(".removeRow").disabled = false;

    table.appendChild(newRow);
    updateRemoveButtons();
});

// Remove row function
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("removeRow")) {
        let table = document.getElementById("taskTable").getElementsByTagName("tbody")[0];
        if (table.rows.length > 1) {
            event.target.closest("tr").remove();
            updateRemoveButtons();
        }
    }
});

// Function to update remove button state
function updateRemoveButtons() {
    let table = document.getElementById("taskTable").getElementsByTagName("tbody")[0];
    let rows = table.getElementsByTagName("tr");

    if (rows.length === 1) {
        rows[0].querySelector(".removeRow").disabled = true;
    } else {
        Array.from(rows).forEach(row => {
            row.querySelector(".removeRow").disabled = false;
        });
    }
}
</script>
@include('partials.footer')
