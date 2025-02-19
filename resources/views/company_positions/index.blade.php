@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Positions</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Position List</li>
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

                    <!-- Add New Position Button (Triggers Modal) -->
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn text-white" style="background-color:#326C79" data-bs-toggle="modal" data-bs-target="#addPositionModal">
                            Add New Position
                        </button>
                    </div>

                    <!-- Positions Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="positionTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Position Name</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $key => $position)
                                    <tr>
                                        <td>{{ $position->Position_name }}</td>
                                        <td>{{ $position->createdBy->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $position->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $position->uuid }}">
                                                    <li>
                                                    <a class="dropdown-item" href="{{ route('company_positions.edit', ['uuid' => $position->uuid]) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('company_positions.archive', $position->uuid) }}" method="POST" id="archiveForm{{ $position->uuid }}">
                                                            @csrf
                                                            <button class="dropdown-item" type="button" onclick="confirmArchive('{{ $position->uuid }}')">Archive</button>
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
                        No position records found.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
<!-- Add Position Modal (Centered) -->
<div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Centering Modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Create New Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company_positions.store') }}" method="POST" id="positionForm">
                    @csrf
                    <div class="mb-3">
                        <label for="PositionName" class="form-label">Position Name</label>
                        <input type="text" name="PositionName" id="PositionName" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #326C79; color:white;">Create Position</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- DataTables and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmArchive(uuid) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to archive this position?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('archiveForm' + uuid).submit();
        }
    });
}
</script>
