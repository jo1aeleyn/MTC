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

<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
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
      timeZone: 'Asia/Manila', // Set to Philippine timezone
      hour12: true
    };
    const date = new Date().toLocaleString('en-PH', options);
    return date;
  }

  // Set the date and time to the placeholder
  document.getElementById('current-date-time').textContent = getFormattedDateTime();
</script>
</body>
</html>
