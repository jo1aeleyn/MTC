@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">

<div class="card">
    <div class="card-body">
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
        <div class="d-flex justify-content-between mb-3">
            <!-- Add New Employee Button -->
            <a href="{{ route('employee.create') }}" class="btn btn-success">Add New Employee</a>
            
            <!-- Export Button -->
            <a href="{{ route('employee.export', ['year' => request('year')]) }}" class="btn btn-primary">Export Employees</a>

            
            <!-- Filter Section -->
            <div class="dropdown">
                <button id="filterIcon" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <div class="dropdown-menu p-2">
                    <select id="yearFilter" class="form-control">
                        <option value="">Select Year</option>
                        <option value="">Clear Filter</option>
                        @foreach(range(2000, date('Y')) as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    <button id="removeFilterBtn" class="btn btn-secondary btn-sm mt-2">Clear Filter</button>
                </div>
            </div>
        </div>
        
       <!-- Employee Table -->
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="employeeTable" class="display table table-striped table-hover">
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
                                    <a href="{{ route('employee.edit', $employee->uuid) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('employee.show', $employee->uuid) }}" class="btn btn-info btn-sm">View</a>
                                    <button type="button" class="btn btn-warning btn-sm archive-btn" data-id="{{ $employee->uuid }}">Archive</button>
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
</div>

<!-- No Records Found Message -->
<div id="noRecordsMessage" class="text-center text-muted" style="display: none; font-size: 18px;">
    No employee records found.
</div>
</div>
</div>
</div>
</div>

@include('partials.footer')
