@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Overtime</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Overtime Requests</li>
                </ol>
            </nav>

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('overtime.create') }}" class="btn btn-primary">Create New Overtime Request</a>
                    </div>
                    <div class="table-responsive">
                        <table id="overtimeTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Client Name</th>
                                    <th>Date Filed</th>
                                    <th>Status</th>
                                    <th>Requested By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($overtimes as $overtime)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $overtime->emp_name }}</td>
                                        <td>{{ $overtime->client_name }}</td>
                                        <td>{{ $overtime->date_filed }}</td>
                                        <td>{{ $overtime->status }}</td>
                                        <td>{{ $overtime->requested_by }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $overtime->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $overtime->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('overtime.show', $overtime->id) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('overtime.edit', $overtime->id) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('overtime.cancel', $overtime->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this overtime request?');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="dropdown-item" type="submit">Cancel</button>
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
            </div>

            <!-- Pagination -->
            {{ $overtimes->links() }}
        </div>
    </div>
</div>

@include('partials.footer')

<!-- DataTable JS & CSS -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#overtimeTable').DataTable({
            // You can customize DataTable options here
            paging: true,
            searching: true,
            ordering: true,
            info: true,
        });
    });
</script>
