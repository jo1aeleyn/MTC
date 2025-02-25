@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Temporary Clients</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
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
                    
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('temp.clients.create') }}" class="btn text-white" style="background-color:#326C79">Add Temporary Client</a>
                  
                    </div>
                    
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tempClientsTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Client Name</th>
                                        <th>Requested By</th>
                                        <th>Status</th>
                                        <th>Purpose</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tempClients as $client)
                                    <tr>
                                        <td>{{ $client->employee->first_name ?? 'N/A' }} {{ $client->employee->surname  ?? '' }}</td>
                                        <td>{{ $client->client->registered_company_name ?? 'N/A' }}</td>
                                        <td>{{ $client->requestedByEmployee->first_name ?? 'N/A' }} {{ $client->requestedByEmployee->surname ?? '' }}</td>
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
                                        <td>{{ $client->purpose }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $client->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $client->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('temp.clients.show', $client->id) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <form id="archiveForm{{ $client->id }}" action="{{ route('temp.clients.archive', $client->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="dropdown-item" type="button" onclick="confirmArchive('{{ $client->id }}')">Archive</button>
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
                    
                    <div id="noRecordsMessage" class="text-center text-muted" style="display: none; font-size: 18px;">
                        No temporary client records found.
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
            text: "Do you really want to archive this client?",
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
