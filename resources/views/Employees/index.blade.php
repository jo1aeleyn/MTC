@extends('Layouts.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom White Theme Style -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<!-- /* push test hehe*/ -->

<style>
    /* Flexbox container */
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    /* Add New Employee Button */
    .add-employee-btn {
        margin-right: 20px;
    }

    /* Filter Container */
    .filter-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    /* Custom Dropdown */
    .custom-dropdown {
        margin-right: 10px;
    }

    /* Filter Icon */
    #filterIcon {
        font-size: 16px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    #filterIcon i {
        margin-right: 5px;
    }

    /* Clear Filter Button */
    #removeFilterBtn {
        font-size: 14px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 10px;
        transition: background-color 0.3s;
    }

    #removeFilterBtn:hover {
        background-color: #e2e6ea;
    }

    /* Hide the dropdown initially */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 30px;
        right: 0;
        z-index: 1000;
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .header-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .add-employee-btn {
            margin-bottom: 10px;
        }

        .filter-container {
            width: 100%;
            margin-top: 10px;
        }

        .custom-dropdown {
            width: 100%;
            margin-right: 0;
        }

        #removeFilterBtn {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>
@section('content')
<body>

    <div class="container mt-5">
        <h2 class="text-center">Employee List</h2>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
<!-- Container for the button and filter section -->
<div class="header-container">
    <!-- Add New Employee Button (on the left) -->
    <div class="add-employee-btn">
        <a href="{{ route('employee.create') }}" class="btn btn-success">Add New Employee</a>
    </div>

    <!-- Filter Section (on the right) -->
    <div class="filter-container">
        <!-- Filter Icon (clickable) -->
        <button id="filterIcon" class="btn btn-light btn-sm">
            <i class="fas fa-filter"></i> Filter
        </button>

        <!-- Year Filter Dropdown (Initially Hidden) -->
        <div id="yearFilterDropdown" class="dropdown-menu" style="display: none;">
            <select id="yearFilter" class="form-control custom-dropdown">
                <option value="">Select Year</option>
                <option value="">Clear Filter</option>
                @foreach(range(2000, date('Y')) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <button id="removeFilterBtn" class="btn btn-secondary btn-sm">Clear Filter</button>
        </div>
    </div>
</div>

<!-- The table and other content go below -->
<table id="employeeTable" class="table table-striped">
    <thead>
        <tr>
            <th>Employee Number</th>
            <th>Name</th>
            <th>Position</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Date Hired</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->emp_num }}</td>
                <td>{{ $employee->first_name }} {{ $employee->surname }}</td>
                <td>{{ $employee->application->position ?? 'N/A' }}</td>
                <td>{{ $employee->contact_num }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->formatted_date_hired }}</td>

                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('employee.edit', $employee->uuid) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('employee.show', $employee->uuid) }}" class="btn btn-info btn-sm">View</a>

                    <!-- Archive Button -->
                    <button type="button" class="btn btn-warning btn-sm archive-btn" data-id="{{ $employee->uuid }}">
                        Archive
                    </button>

                    <!-- Hidden Form -->
                    <form id="archive-form-{{ $employee->uuid }}" action="{{ route('employee.archive', $employee->uuid) }}" method="POST" style="display:none;">
                        @csrf
                        @method('PATCH')
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- No Records Found Message -->
<div id="noRecordsMessage" style="display: none; text-align: center; font-size: 18px; color: #999;">
    No employee records found.
</div>
            </div>
        </div>
    </div>

    <script>
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
    </script>

    <!-- jQuery and Bootstrap Bundle (for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>

@endsection