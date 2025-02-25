@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Temporary Clients</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Add Temporary Client for Employee</li>
                </ol>
            </nav>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5>Add Temporary Client</h5>
                    <form action="{{ route('temp.clients.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <!-- Requested By Dropdown -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Requested By</label>
                                    <select name="requested_by" id="requested_by" class="form-control" required>
                                        <option value="">Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->emp_num }}">{{ $employee->surname }}, {{ $employee->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Department Dropdown -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <select name="DepartmentID" id="DepartmentID" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->DepartmentName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Client Dropdown -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name</label>
                                    <select name="client_id" id="client_id" class="form-control" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->client_id }}">{{ $client->registered_company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                    
                            <!-- Purpose -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Purpose</label>
                                    <textarea name="purpose" id="purpose" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
                            Back to List
                        </a>    
                        <button type="submit" class="btn mb-3" style="background-color:#326C79; color:white; float:right;">Add Temporary Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
