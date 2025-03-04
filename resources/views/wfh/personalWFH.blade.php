@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage WFH</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">My WFH Requests</li>
                </ol>
            </nav>

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('wfh.create') }}" class="btn" style="background-color: #326C79; color:white;">Create New WFH Request</a>
                        <div class="d-flex justify-content-end">
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table id="personalwfhTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Client Name</th>
                                    <th>Date Filed</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wfh_requests as $wfh)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->surname }}, {{ $employee->first_name }}</td>
                                        <td>{{ $wfh->client_name }}</td>
                                        <td>{{ $wfh->Date_filed }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($wfh->Status) {
                                                    'Approved' => 'success',
                                                    'Pending' => 'warning',
                                                    'Recommended' => 'warning',
                                                    'Rejected' => 'danger',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst($wfh->Status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $wfh->uuid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $wfh->uuid }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('wfh.show', $wfh->uuid) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('wfh.edit', $wfh->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                    <form id="cancelForm{{ $wfh->uuid }}" action="{{ route('wfh.cancel', $wfh->uuid) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button" class="dropdown-item" onclick="confirmAction('cancel', '{{ $wfh->uuid }}')">Cancel</button>
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
            {{ $wfh_requests->links() }}
        </div>
    </div>
</div>
<script>
    function confirmAction(action, wfhUuid) {
        let actionText = action === 'archive' ? 'archive this WFH request' : 'cancel this WFH request';
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
                document.getElementById(formId + wfhUuid).submit();
            }
        });
    }
</script>
@include('partials.footer')
