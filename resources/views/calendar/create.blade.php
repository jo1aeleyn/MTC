<!-- Bootstrap Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Event Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="event">Event</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>

                    <div class="mb-3" id="holidayTypeDiv" style="display: none;">
                        <label for="holiday_type" class="form-label">Holiday Type</label>
                        <select class="form-control" id="holiday_type" name="holiday_type">
                            <option value="">None</option>
                            <option value="Regular Holiday">Regular Holiday</option>
                            <option value="Special Holiday">Special Holiday</option>
                            <option value="Legal Holiday">Legal Holiday</option>
                            <option value="Legal Holiday on a Rest Day">Legal Holiday on a Rest Day</option>
                            <option value="Spcl Holiday on a Rest Day">Spcl Holiday on a Rest Day</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary w-100">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.getElementById("type");
        const holidayTypeDiv = document.getElementById("holidayTypeDiv");

        typeSelect.addEventListener("change", function () {
            if (this.value === "holiday") {
                holidayTypeDiv.style.display = "block";
            } else {
                holidayTypeDiv.style.display = "none";
            }
        });

        // Trigger change event on page load to ensure correct visibility
        typeSelect.dispatchEvent(new Event("change"));
    });
</script>
