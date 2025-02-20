<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEventForm" method="POST">
                    @csrf
                    <input type="hidden" id="editEventId" name="event_id">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="end_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-control" id="editType" name="type" required>
                            <option value="holiday">Holiday</option>
                            <option value="meeting">Meeting</option>
                            <option value="general">General</option>
                        </select>
                    </div>

                    <div id="editHolidayTypeDiv" class="mb-3" style="display: none;">
                        <label class="form-label">Holiday Type</label>
                        <select class="form-control" id="editHolidayType" name="holiday_type">
                            <option value="Regular Holiday">Regular Holiday</option>
                            <option value="Special Non-Working Holiday">Special Non-Working Holiday</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update Event</button>
                        <button type="button" class="btn btn-danger" onclick="deleteEvent()">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function deleteEvent() {
    let eventId = document.getElementById("editEventId").value;
    
    if (confirm("Are you sure you want to delete this event?")) {
        fetch(`{{ url('events/delete') }}/${eventId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event deleted successfully!");
                location.reload();
            }
        })
        .catch(error => console.error("Error deleting event:", error));
    }
}

</script>
