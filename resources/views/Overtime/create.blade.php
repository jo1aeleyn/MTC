    @include('partials.header')
    @include('partials.sidebar')
    @include('partials.navbar')

    <link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

    <div class="container">
        <div class="page-inner">
            <div class="container">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                        <li class="breadcrumb-item text-muted">Manage Overtime</li>
                        <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Overtime Request</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-body">
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

                        <!-- Create overtime form -->
                        <form action="{{ route('overtime.store') }}" method="POST">
                            @csrf
                            <div class="row">
                            <div class="mb-3 col-6">
                                <label for="client_name" class="form-label">Client Name</label>
                                <select name="client_name" id="client_name" class="form-control" required>
                                    <option value="">Select Client</option>
                                    @foreach($assignedClients as $assignment)
                                        @if($assignment->client) <!-- Check if the client exists -->
                                            <option value="{{ $assignment->client->registered_company_name }}">{{ $assignment->client->registered_company_name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            <!-- Start Time and End Time -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                                </div>
                            </div>

                          <!-- Total Duration and Deducted Duration Preview -->
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label">Total Duration</label>
                                    <p id="total_duration" class="fw-bold">--</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Deducted Duration (After 25% Reduction)</label>
                                    <p id="deducted_duration" class="fw-bold">--</p>
                                </div>
                            </div>

                            <!-- Hidden Inputs to Store Values -->
                            <input type="hidden" name="TotalDuration" id="total_duration_input">
                            <input type="hidden" name="DeductedDuration" id="deducted_duration_input">


                            <!-- Purpose -->
                            <div class="mb-3">
                                <label for="purpose" class="form-label">Purpose</label>
                                <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                            </div>

                            <!-- Request Date -->
                            <div class="mb-3">
                                <label for="request_date" class="form-label">Request Date</label>
                                <input type="datetime-local" name="request_date" id="request_date" class="form-control" required>
                            </div>

                            <!-- Submit and Cancel buttons -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn text-white w-auto px-4" style="background-color:#326C79">Submit</button>
                                <a  href="javascript:history.back();" class="btn btn-secondary w-auto px-4 ms-3">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const startTimeInput = document.getElementById("start_time");
        const endTimeInput = document.getElementById("end_time");
        const totalDurationOutput = document.getElementById("total_duration");
        const totalDurationInput = document.getElementById("total_duration_input");
        const deductedDurationOutput = document.getElementById("deducted_duration");
        const deductedDurationInput = document.getElementById("deducted_duration_input");

        function calculateDuration() {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;

            if (startTime && endTime) {
                const start = new Date(`1970-01-01T${startTime}:00`);
                const end = new Date(`1970-01-01T${endTime}:00`);

                let diff = (end - start) / (1000 * 60 * 60); // Convert milliseconds to hours

                if (diff < 0) {
                    diff += 24; // Handle overnight shifts
                }

                // Calculate deducted duration (25% reduction)
                const deducted = diff * 0.75; // 75% of total duration

                // Update displayed values
                totalDurationOutput.textContent = diff.toFixed(2) + " hours";
                deductedDurationOutput.textContent = deducted.toFixed(2) + " hours";

                // Update hidden inputs
                totalDurationInput.value = diff.toFixed(2);
                deductedDurationInput.value = deducted.toFixed(2);
            } else {
                totalDurationOutput.textContent = "--";
                deductedDurationOutput.textContent = "--";
                totalDurationInput.value = "";
                deductedDurationInput.value = "";
            }
        }

        startTimeInput.addEventListener("input", calculateDuration);
        endTimeInput.addEventListener("input", calculateDuration);
    });
</script>
