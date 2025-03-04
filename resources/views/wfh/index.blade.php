@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage WFH</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">WFH Requests</li>
                </ol>
            </nav>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="wfhTable" class="display table table-striped table-hover">
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
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $wfh->uuid  }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $wfh->uuid  }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('wfh.show', $wfh->uuid ) }}">View</a>
                                                    </li>
                                                    <li>
                                                    <form id="archiveForm{{ $wfh->uuid }}" action="{{ route('wfh.archive', $wfh->uuid) }}" method="POST">
                                                                    @csrf
                                                                    <button type="button" class="dropdown-item" onclick="confirmAction('archive', '{{ $wfh->uuid }}')">Archive</button>
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
            
            {{ $wfh_requests->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(action, uuid) {
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
                document.getElementById(formId + uuid).submit();
            }
        });
    }
</script>

@include('partials.footer')
