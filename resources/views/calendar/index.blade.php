@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <h1>Event Calendar</h1>

            <!-- Add Event Button -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal">
                + Add Event
            </button>
        
            <div id="success-message" class="alert alert-success"></div>

            <!-- Calendar -->
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Include Create Event Modal -->
@include('calendar.create')

<!-- Edit Event Modal (Directly in this file) -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEventForm">
                    @csrf
                    <input type="hidden" id="editEventId">
                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editEventTitle">
                    </div>
                    <div class="mb-3">
                        <label for="editEventStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="editEventStartDate">
                    </div>
                    <div class="mb-3">
                        <label for="editEventEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="editEventEndDate">
                    </div>
                    <div id="editHolidayTypeDiv" class="mb-3" style="display: none;">
                        <label for="editHolidayType" class="form-label">Holiday Type</label>
                        <select class="form-control" id="editHolidayType">
                            <option value="">Select Holiday Type</option>
                            <option value="national">National</option>
                            <option value="special">Special</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" id="deleteEventBtn" class="btn btn-danger mt-2">Delete Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var calendarEl = document.getElementById("calendar");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            events: {!! json_encode($events) !!},
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay"
            },
            eventClick: function(info) {
                let eventId = info.event.id;

                fetch(`{{ url('events/edit') }}/${eventId}`, {
                    method: "GET", // Make sure you're using GET to retrieve event data
                    headers: {
                        "X-Requested-With": "XMLHttpRequest", // Ensures the request is treated as AJAX
                        "Accept": "application/json" // Optional, but good practice to specify JSON response
                    }
                })
                .then(response => response.json())
                .then(event => {
                    // Ensure the modal is populated correctly
                    document.getElementById("editEventId").value = event.id;
                    document.getElementById("editEventTitle").value = event.title;
                    document.getElementById("editEventStartDate").value = event.start_date;
                    document.getElementById("editEventEndDate").value = event.end_date;
                    document.getElementById("editEventType").value = event.type;

                    if (event.type === "holiday") {
                        document.getElementById("editHolidayTypeDiv").style.display = "block";
                        document.getElementById("editHolidayType").value = event.holiday_type;
                    } else {
                        document.getElementById("editHolidayTypeDiv").style.display = "none";
                    }

                    // Show the modal
                    var editModal = new bootstrap.Modal(document.getElementById("editEventModal"));
                    editModal.show();
                })
                .catch(error => {
                    console.error("Error fetching event:", error);
                });
            }
        });

        calendar.render();
    });

    // Handle Edit Event Form Submission
    document.getElementById("editEventForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let eventId = document.getElementById("editEventId").value;

        fetch(`{{ url('events/update') }}/${eventId}`, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event updated successfully!");
                location.reload();
            } else {
                alert("Error updating event: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    // Handle Event Deletion
    document.getElementById("deleteEventBtn").addEventListener("click", function () {
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
                } else {
                    alert("Error deleting event: " + data.message);
                }
            })
            .catch(error => console.error("Error deleting event:", error));
        }
    });
</script>

@include('partials.footer')
