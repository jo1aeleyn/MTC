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
                                    @foreach($clients as $client)
                                        <option value="{{ $client['name'] }}">
                                            {{ $client['name'] }} ({{ $client['type'] }})
                                        </option>
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

                            <!-- Activity Code -->
                            <div class="mb-3">
                                <label for="activitycode" class="form-label">Activity Code</label>
                                <input type="text" name="activitycode" id="activitycode" class="form-control" required>
                            </div>

                            <!-- Activity Name -->
                            <div class="mb-3">
                                <label for="activityname" class="form-label">Activity Name</label>
                                <input type="text" name="activityname" id="activityname" class="form-control" required>
                            </div>

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

    function roundToNearest30Minutes(hours) {
        const fullHours = Math.floor(hours); // Get full hours
        const minutes = Math.round((hours - fullHours) * 60); // Convert decimal to minutes

        let roundedMinutes;
        if (minutes <= 14) {
            roundedMinutes = 0; // Round down to nearest hour
        } else if (minutes <= 44) {
            roundedMinutes = 30; // Round to 30 minutes
        } else {
            roundedMinutes = 0; // Round up to next full hour
            fullHours += 1;
        }

        return fullHours + roundedMinutes / 60; // Convert back to decimal hours
    }

    function getStandardDeduction(overtime) {
        const deductionTable = {
            1.00: 0.25, 1.50: 0.25, 2.00: 0.50, 2.50: 0.50, 3.00: 0.75, 
            3.50: 0.75, 4.00: 1.00, 4.50: 1.00, 5.00: 1.25, 5.50: 1.25, 
            6.00: 1.50, 6.50: 1.50, 7.00: 1.75, 7.50: 1.75, 8.00: 2.00, 
            8.50: 2.00, 9.00: 2.25, 9.50: 2.25, 9.75: 2.50, 10.00: 2.50, 
            10.50: 2.50, 11.00: 2.75, 11.50: 2.75, 12.00: 3.00, 12.50: 3.00, 
            13.00: 3.25, 13.50: 3.25
        };
        return deductionTable[overtime] || 0; // Default to 0 if not found
    }

    function calculateDuration() {
        const startTime = startTimeInput.value;
        const endTime = endTimeInput.value;

        if (startTime && endTime) {
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);

            let diff = (end - start) / (1000 * 60 * 60); // Convert milliseconds to hours
            if (diff < 0) diff += 24; // Handle overnight shifts

            const roundedDuration = roundToNearest30Minutes(diff);
            const deduction = getStandardDeduction(roundedDuration);
            const netOvertime = roundedDuration - deduction;

            // Update displayed values
            totalDurationOutput.textContent = `${Math.floor(roundedDuration)}h ${((roundedDuration % 1) * 60).toFixed(0)}m`;
            deductedDurationOutput.textContent = `${Math.floor(netOvertime)}h ${((netOvertime % 1) * 60).toFixed(0)}m`;

            // Update hidden inputs
            totalDurationInput.value = roundedDuration.toFixed(2);
            deductedDurationInput.value = netOvertime.toFixed(2);
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
