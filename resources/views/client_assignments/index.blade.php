@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Assignments</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Client Assignments</li>
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

                    <!-- Container for the button section -->
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Add New Assignment Button -->
                        <a href="{{ route('client.assignment.create') }}" class="btn text-white" style="background-color:#326C79">Assign Client</a>
                    </div>

                    <!-- Client Assignments Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="assignmentTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Client Name</th>
                                        <th>Assigned By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignments as $assignment)
                                  
                                    <tr>
                                        <td>{{ $assignment->employee_name ?? 'N/A' }}</td> 
                                        <td>{{ $assignment->client_name ?? 'N/A' }}</td> 
                                        <td>{{ $assignment->assigned_by_name ?? 'N/A' }}</td>

                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $assignment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $assignment->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('client.assignment.edit', $assignment->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form id="archiveForm{{ $assignment->id }}" action="{{ route('client.assignment.archive', $assignment->uuid) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="dropdown-item" type="button" onclick="confirmArchive('{{ $assignment->uuid }}')">Archive</button>
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
                        No client assignment records found.
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
        title: "Are you sure?",
        text: "Do you really want to archive this assignment?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector(`form[action*="${uuid}"]`).submit();
        }
    });
}

</script>

@include('partials.footer')
