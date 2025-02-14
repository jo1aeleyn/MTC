@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/tables.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Leave Applications</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">My Leave Applications</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <!-- Success and Error Messages -->
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

                    <!-- Add New Leave Application Button -->
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('leaves.create') }}" class="btn text-white" style="background-color:#326C79">Apply for Leave</a>
                    </div>

                    <!-- Leave Applications Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="personalleaveTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Number</th>
                                        <th>Date of Leave</th>
                                        <th>Total Days</th>
                                        <th>Type of Leave</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $leave->emp_num }}</td>
                                            <td>{{ $leave->DateOfLeave->format('Y-m-d') }}</td>
                                            <td>{{ $leave->TotalDays }}</td>
                                            <td>{{ $leave->TypeOfLeave }}</td>
                                            <td>
                                            <span class="badge bg-{{ 
                                                $leave->Status == 'pending' ? 'warning' : 
                                                ($leave->Status == 'approved' ? 'success' : 
                                                ($leave->Status == 'recommended' ? 'warning' : 
                                                ($leave->Status == 'cancelled' ? 'secondary' : 'danger'))) 
                                            }}">
                                                {{ ucfirst($leave->Status) }}
                                            </span>

                                            </td>
                                            <td>
                                                <div class="dropdown text-center">
                                                    <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $leave->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $leave->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('leaves.show', $leave->id) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('leaves.edit', $leave->id) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('leaves.cancel', $leave->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure you want to cancel this request?')">Cancel</button>
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
                    @if ($leaves->isEmpty())
                        <div id="noRecordsMessage" class="text-center text-muted mt-3" style="font-size: 18px;">
                            No leave applications found.
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $leaves->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('partials.footer')
