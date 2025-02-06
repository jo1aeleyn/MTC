@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Clients</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Client List</li>
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

                    <!-- Container for the button and filter section -->
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Add New Client Button -->
                        <a href="{{ route('clients.create') }}" class="btn text-white" style="background-color:#326C79">Add New Client</a>

                     
                    </div>

                    <!-- Clients Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="clientTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Registered Address</th>
                                        <th>Authorized Personnel</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->client_id }}</td>
                                        <td>{{ $client->registered_company_name }}</td>
                                        <td>{{ $client->registered_address }}</td>
                                        <td>{{ $client->authorized_personnel }}</td>
                                        <td>
                                            <div class="dropdown" style="text-align:center;">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $client->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $client->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('clients.show', $client->uuid) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('clients.edit', $client->uuid) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('clients.archive', $client->uuid) }}" method="POST" onsubmit="return confirm('Are you sure you want to archive this client?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">Archive</button>
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
                        No client records found.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
