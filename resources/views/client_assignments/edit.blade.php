@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<style>
    .client-type-label {
        display: inline-block;
        padding: 10px 20px;
        border: 2px solid #ccc;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .client-type-label:hover {
        background-color: #f1f3f5;
    }
    .form-check-input:checked + .client-type-label {
        background-color: #ffde59;
        color: white;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }
</style>

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Client Assignment</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Client Assignment</li>
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
                    <h5>Edit Client Assignment</h5>
                    <form action="{{ route('client.assignment.update', $assignment->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')  <!-- This is needed for update -->
                        <div class="row">
                            <!-- Employee Dropdown -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Name</label>
                                    <select name="emp_num" id="emp_num" class="form-control" required>
                                        <option value="">Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->emp_num }}" 
                                                {{ $employee->emp_num == $assignment->emp_num ? 'selected' : '' }}>
                                                {{ $employee->surname }}, {{ $employee->first_name }}
                                            </option>
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
                                            <option value="{{ $client->client_id }}" 
                                                {{ $client->client_id == $assignment->client_id ? 'selected' : '' }}>
                                                {{ $client->registered_company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Client Type Dropdown -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Type</label>
                                    <select name="client_type" id="client_type" class="form-control" required>
                                        <option value="Main Client" {{ $assignment->client_type == 'Main Client' ? 'selected' : '' }}>Main Client</option>
                                        <option value="Temporary Client" {{ $assignment->client_type == 'Temporary Client' ? 'selected' : '' }}>Temporary Client</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn mb-3" style="background-color:#326C79; color:white; float:right;">Update Assignment</button>
                    </form>
                </div>
            </div>

            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
                Back to Assignment List
            </a>
        </div>
    </div>
</div>


@include('partials.footer')
