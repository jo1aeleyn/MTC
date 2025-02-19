<footer class="footer">
  <div class="container-fluid d-flex justify-content-center">
    <div class="copyright">
      &copy; {{ date('Y') }}, Mendoza Tugano & Co,. CPAs
    </div>
  </div>
</footer>



<!-- Core JS Files -->
<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/employeeindex.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
<script src="{{ asset('js/createemployee.js') }}"></script>
<script src="{{ asset('js/editemployee.js') }}"></script>
<script src="{{ asset('js/usersindex.js') }}"></script>
<script src="{{ asset('js/usersedit.js') }}"></script>
<script src="{{ asset('js/profilepage.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
<!-- FullCalendar JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('assets/js/mtcadmin.min.js') }}"></script>
<script>
  // Function to format the date and time in Philippines time (UTC+8)
  function getFormattedDateTime() {
    const options = {
      weekday: 'long', // "Monday"
      year: 'numeric', // "2025"
      month: 'long', // "February"
      day: 'numeric', // "6"
      hour: '2-digit', // "02"
      minute: '2-digit', // "30"
      second: '2-digit', // "45"
      timeZone: 'Asia/Manila', // Set to Philippine timezone
      hour12: true
    };
    const date = new Date().toLocaleString('en-PH', options);
    return date;
  }

  // Function to update the date and time
  function updateDateTime() {
    document.getElementById('current-date-time').textContent = getFormattedDateTime();
  }

  // Update the date and time initially
  updateDateTime();

  // Update the date and time every second (1000 milliseconds)
  setInterval(updateDateTime, 1000);
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.role-dropdown').forEach(select => {
    select.addEventListener('change', function() {
        const userId = this.dataset.userId; // Get user ID from dataset
        const newRole = this.value; // Get selected role

        fetch(`/users/${userId}/update-role`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ role: newRole })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Success!",
                    text: "User role updated successfully.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Failed to update role: " + data.message,
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Please try again.",
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK"
            });
        });
    });
});
</script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Show month view
                selectable: true,
                editable: true,
                eventClick: function(info) {
                    window.location.href = "/events/edit/" + info.event.id;
                },
                events: '/events/get', // Fetch events from Laravel controller
            });

            calendar.render();
        });
    </script>


</body>
</html>
