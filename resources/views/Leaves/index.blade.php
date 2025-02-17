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
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">List of Leave Applications</li>
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

                    <!-- Leave Applications Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="leaveTable" class="display table table-striped table-hover">
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
                                                    $leave->Status == 'pending' ? 'secondary' : 
                                                    ($leave->Status == 'approved' ? 'success' : 
                                                    ($leave->Status == 'recommended' ? 'warning' : 'warning')) 
                                                }}">
                                                    {{ ucfirst($leave->Status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown text-center">
                                                    <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $leave->uuid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $leave->uuid }}">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('leaves.show', $leave->uuid) }}">View</a>
                                                        </li>
                                                        @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
                                                        <li>
                                                        <form id="archiveForm{{ $leave->uuid }}" action="{{ route('leaves.archive', $leave->uuid) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" class="dropdown-item" onclick="confirmArchive('{{ $leave->uuid }}')">Archive</button>
                                                        </form>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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
<script>
    function confirmArchive(uuid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to archive this leave request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, archive it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                document.getElementById('archiveForm' + uuid).submit();

                // After submitting, show the success message
                Swal.fire(
                    'Archived!',
                    'The leave request has been archived.',
                    'success'
                );
            }
        });
    }
</script>

@include('partials.footer')
