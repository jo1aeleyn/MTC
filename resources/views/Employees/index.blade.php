@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">
<div class="container">
<nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
            <li class="breadcrumb-item text-muted">Manage Employee</li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Employee List</li>
        </ol>
    </nav>
<div class="card">
    <div class="card-body">
    
        
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
    <a href="{{ route('employee.create') }}" class="btn text-white" style="background-color:#326C79">Add New Employee</a>

    <!-- Filter and Export Buttons Section -->
    <div class="d-flex">
        <!-- Export Button placed left of Filter Button -->
        <a href="{{ route('employee.export', ['year' => request('year')]) }}" class="btn me-2 text-white" style="background-color: #289DD2">
    Export
</a>


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
</div>


        <!-- Employee Table -->
        <div class="col-md-12">
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
                                            <!-- Dropdown for Actions -->
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $employee->uuid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $employee->uuid }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('employee.edit', $employee->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('employee.show', $employee->uuid) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('employee.archive', $employee->uuid) }}" method="POST" onsubmit="return confirm('Are you sure you want to archive this employee?');">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="dropdown-item" type="submit">Archive</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

</div>
</div>

@include('partials.footer')



