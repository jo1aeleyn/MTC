document.addEventListener('DOMContentLoaded', function () {
    // Add click event listeners to archive buttons
    const archiveButtons = document.querySelectorAll('.archive-btn');
    archiveButtons.forEach(button => {
        button.addEventListener('click', function () {
            const employeeId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archive it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the corresponding form
                    document.getElementById(`archive-form-${employeeId}`).submit();
                }
            });
        });
    });
});

// Toggle filter dropdown visibility when filter icon is clicked
document.getElementById('filterIcon').addEventListener('click', function() {
const filterDropdown = document.getElementById('yearFilterDropdown');
// Toggle the visibility of the dropdown
if (filterDropdown.style.display === "none" || filterDropdown.style.display === "") {
    filterDropdown.style.display = "block";
} else {
    filterDropdown.style.display = "none";
}
});

// Clear the filter when "Clear Filter" button is clicked
document.getElementById('removeFilterBtn').addEventListener('click', function() {
document.getElementById('yearFilter').value = ""; // Reset the dropdown
document.getElementById('yearFilterDropdown').style.display = "none"; // Hide the dropdown
// Optionally reset the table display or filtering logic
filterEmployeesByYear("");
});

// Function to filter employees based on the selected year
function filterEmployeesByYear(year) {
let rows = document.querySelectorAll('#employeeTable tbody tr');
rows.forEach(function(row) {
    let dateHiredCell = row.cells[5];
    let dateHired = dateHiredCell.textContent.trim();
    let yearHired = dateHired.split('-')[0];

    if (year === "" || yearHired === year) {
        row.style.display = '';
    } else {
        row.style.display = 'none';
    }
});

// Display 'No records found' message if no rows are visible
const noRecordsMessage = document.getElementById('noRecordsMessage');
const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
noRecordsMessage.style.display = visibleRows.length === 0 ? 'block' : 'none';
}

// Filter the employees whenever a new year is selected from the dropdown
document.getElementById('yearFilter').addEventListener('change', function() {
const selectedYear = this.value;
filterEmployeesByYear(selectedYear);
});