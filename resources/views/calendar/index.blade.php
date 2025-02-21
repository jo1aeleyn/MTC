@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">
<style>

#calendar {
    max-width: 100%;
    width: 75vw; /* Adjust width (90% of the viewport width) */
    height: 90vh; /* Adjust height (80% of the viewport height) */
    margin: auto; /* Center the calendar */
}

/* Change the color of the month name (title) */
.fc-toolbar-title {
    color: #326C79
    !important; /* Change to your preferred color */
}

/* Change the color of the day names (Sunday, Monday, etc.) */
.fc-col-header-cell-cushion {
    color: #326C79
    !important; /* Change to your preferred color */
    font-weight: bold;
}

/* Change the color of the date numbers */
.fc-daygrid-day-number {
    color: #326C79    !important; /* Change to your preferred color */
    font-weight: bold;
}

    </style>
<div class="container">
    <div class="page-inner">
    <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Calendar</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Events</li>
                </ol>
            </nav>
    <div class="container">
    <div class="card shadow-lg ">
        <div class="card-body">
            

            <!-- Add Event Button -->
            <button class="btn mb-3" style="background-color:#326C79; color:white;" data-bs-toggle="modal" data-bs-target="#createEventModal">
                + Add Event
            </button>

            <!-- Success Message -->
            <div id="success-message" class="alert alert-success" style="display: none;"></div>

            <!-- Calendar -->
            <div id="calendar"></div>
        </div>
    </div>
</div>

    </div>
</div>

<!-- Include Create Event Modal -->
@include('calendar.create')

<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEventForm">
                    @csrf
                    <input type="hidden" id="editEventId" name="event_id">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="editStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="end_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="editType" class="form-label">Type</label>
                        <select class="form-control" id="editType" name="type" required>
                            <option value="event">Event</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>

                    <div id="editHolidayTypeDiv" class="mb-3" style="display: none;">
                        <label for="editHolidayType" class="form-label">Holiday Type</label>
                        <select class="form-control" id="editHolidayType" name="holiday_type">
                            <option value="Regular Holiday">Regular Holiday</option>
                            <option value="Special Holiday">Special Holiday</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const successMessageDiv = document.getElementById("success-message");

    // FULLCALENDAR INITIALIZATION
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        events: {!! json_encode($events) !!},
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        eventDidMount: function(info) {
            // Change text color of events dynamically
            if (info.event.extendedProps.type === "holiday") {
                info.el.style.color = "green";  // Holiday events will be green
            } else {
                info.el.style.color = "red";  // Regular events will be red
            }
        },
        eventClick: function(info) {
            let eventId = info.event.id;

            fetch(`{{ url('events/edit') }}/${eventId}`)
                .then(response => response.json())
                .then(event => {
                    document.getElementById("editEventId").value = event.id;
                    document.getElementById("editTitle").value = event.title;
                    document.getElementById("editStartDate").value = event.start_date;
                    document.getElementById("editEndDate").value = event.end_date;
                    document.getElementById("editType").value = event.type;

                    let holidayTypeDiv = document.getElementById("editHolidayTypeDiv");
                    if (event.type === "holiday") {
                        holidayTypeDiv.style.display = "block";
                        document.getElementById("editHolidayType").value = event.holiday_type;
                    } else {
                        holidayTypeDiv.style.display = "none";
                    }

                    var editModal = new bootstrap.Modal(document.getElementById("editEventModal"));
                    editModal.show();
                })
                .catch(error => console.error("Error fetching event:", error));
        }
    });

    calendar.render();

    // HANDLE DELETE EVENT FUNCTIONALITY
    window.deleteEvent = function() {
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
    };
});
</script>

<!-- Include Footer -->
@include('partials.footer')
