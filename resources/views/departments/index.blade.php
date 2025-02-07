@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Departments</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Department List</li>
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

                    <!-- Add New Department Button -->
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('departments.create') }}" class="btn text-white" style="background-color:#326C79">Add New Department</a>
                    </div>

                    <!-- Departments Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="departmentTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department ID</th>
                                        <th>Department Name</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $key => $department)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $department->DepartmentID }}</td>
                                        <td>{{ $department->DepartmentName }}</td>
                                        <td>{{ $department->createdBy->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $department->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $department->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('departments.edit', $department->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('departments.archive', $department->uuid) }}" method="POST" id="archiveForm{{ $department->id }}">
                                                            @csrf
                                                            <button class="dropdown-item" type="button" onclick="confirmArchive({{ $department->id }})">Archive</button>
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
                        No department records found.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<!-- DataTables and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmArchive(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to archive this department?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('archiveForm' + id).submit();
            }
        });
    }
</script>

