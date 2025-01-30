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
</head>

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

        <!-- Add New Employee Button -->
        <div class="mb-3">
            <a href="{{ route('employee.create') }}" class="btn btn-success">Add New Employee</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="yearFilter" class="form-label">Filter by Year of Hire</label>
                    <select id="yearFilter" class="form-control">
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Employee Table -->
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
    </script>

    <!-- jQuery and Bootstrap Bundle (for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>

@endsection
