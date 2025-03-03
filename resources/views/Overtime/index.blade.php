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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="card">
                <div class="card-body">
               
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
                                        <td>
                                            @php
                                                $badgeClass = match($overtime->status) {
                                                    'Approved' => 'success',  // Green
                                                    'Pending' => 'warning',   // Yellow
                                                    'Recommended'=> 'warning',   // Yellow
                                                    'Rejected' => 'danger',   // Red
                                                    default => 'secondary',   // Default (gray) if status is unknown
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst($overtime->status) }}
                                            </span>
                                        </td>

                                        <td>{{ $overtime->requested_by }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $overtime->uuid  }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $overtime->uuid  }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('overtime.show', $overtime->uuid ) }}">View</a>
                                                    </li>
                                                    <li>
                                                    <form id="archiveForm{{ $overtime->uuid  }}" action="{{ route('overtime.archive', $overtime->uuid ) }}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="button" class="dropdown-item" onclick="confirmAction('archive', '{{ $overtime->uuid }}')">Archive</button>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(action, overtimeUuid) {
        let actionText = action === 'archive' ? 'archive this overtime request' : 'cancel this overtime request';
        let confirmButtonText = action === 'archive' ? 'Yes, archive it!' : 'Yes, cancel it!';
        let formId = action === 'archive' ? 'archiveForm' : 'cancelForm';

        Swal.fire({
            title: "Are you sure?",
            text: `You are about to ${actionText}.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: confirmButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId + overtimeUuid).submit();
            }
        });
    }
</script>
@include('partials.footer')


