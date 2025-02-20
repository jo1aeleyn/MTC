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
<!-- Edit Event Modal -->
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
                            <option value="meeting">Meeting</option>
                            <option value="holiday">Holiday</option>
                        </select>
                    </div>

                    <div id="editHolidayTypeDiv" class="mb-3" style="display: none;">
                        <label for="editHolidayType" class="form-label">Holiday Type</label>
                        <input type="text" class="form-control" id="editHolidayType" name="holiday_type">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Event</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const typeSelect = document.getElementById("type");
    const holidayTypeDiv = document.getElementById("holidayTypeDiv");
    const form = document.getElementById("createEventForm");
    const successMessageDiv = document.getElementById("success-message");
    const modal = new bootstrap.Modal(document.getElementById("createEventModal")); // Bootstrap modal

    // Hide success message initially
    successMessageDiv.style.display = "none";

    // Show/Hide Holiday Type
    typeSelect.addEventListener("change", function () {
        holidayTypeDiv.style.display = this.value === "holiday" ? "block" : "none";
    });

    // Form Submission
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch("{{ route('events.store') }}", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json()) // Expecting JSON response
        .then(data => {
            if (data.success) {
                successMessageDiv.textContent = data.message; // Set success message
                successMessageDiv.style.display = "block"; // Show success message
                successMessageDiv.classList.remove("alert-danger"); // Remove error styling if any
                successMessageDiv.classList.add("alert-success"); // Ensure success styling

                form.reset(); // Clear form fields

                // Hide success message after 3 seconds
                setTimeout(() => {
                    successMessageDiv.style.display = "none";
                    modal.hide(); // Close the modal
                }, 3000);
            } else {
                successMessageDiv.textContent = "Error: " + (data.message || "Something went wrong.");
                successMessageDiv.style.display = "block";
                successMessageDiv.classList.remove("alert-success");
                successMessageDiv.classList.add("alert-danger"); // Show error styling
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            successMessageDiv.textContent = "Something went wrong. Please try again.";
            successMessageDiv.style.display = "block";
            successMessageDiv.classList.remove("alert-success");
            successMessageDiv.classList.add("alert-danger");
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        events: {!! json_encode($events) !!}, // Pass events from PHP
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
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
});

// Handle Edit Event Form Submission
document.getElementById("editEventForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let eventId = document.getElementById("editEventId").value;

    fetch(`{{ url('events/update') }}/${eventId}`, {
        method: "POST", // Laravel does not accept PUT via FormData, so use POST with _method field
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


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        events: {!! json_encode($events) !!}, // Pass events from PHP
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        eventClick: function(info) {
            alert("Event: " + info.event.title); // Show event details
        }
    });

    calendar.render();
});
</script>

@include('partials.footer')
