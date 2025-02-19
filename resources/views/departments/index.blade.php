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
                        <button class="btn text-white" style="background-color:#326C79" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Add New Department</button>
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
                                                        <button class="dropdown-item edit-btn"
                                                            data-id="{{ $department->uuid }}"
                                                            data-name="{{ $department->DepartmentName }}"
                                                            data-url="{{ route('departments.update', $department->uuid) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editDepartmentModal">
                                                            Edit
                                                        </button>
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

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Centering Modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Create New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('departments.store') }}" method="POST" id="departmentForm">
                    @csrf
                    <div class="mb-3">
                        <label for="DepartmentName" class="form-label">Department Name</label>
                        <input type="text" name="DepartmentName" id="DepartmentName" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #326C79; color:white;">Create Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Centering Modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDepartmentForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Needed for updating -->

                    <div class="mb-3">
                        <label for="editDepartmentName" class="form-label">Department Name</label>
                        <input type="text" name="DepartmentName" id="editDepartmentName" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #326C79; color:white;">Update Department</button>
                    </div>
                </form>
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

    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                let departmentId = this.getAttribute("data-id");
                let departmentName = this.getAttribute("data-name");
                let updateUrl = this.getAttribute("data-url");

                // Set modal input values
                document.getElementById("editDepartmentName").value = departmentName;
                
                // Update form action URL dynamically
                document.getElementById("editDepartmentForm").setAttribute("action", updateUrl);
            });
        });
    });
</script>
