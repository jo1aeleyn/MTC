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


</script>

@include('partials.footer')
