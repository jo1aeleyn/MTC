@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Overtime</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Overtime Request</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <!-- Display errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Create overtime form -->
                    <form action="{{ route('overtime.store') }}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="mb-3 col-6">
                            <label for="client_name" class="form-label">Client Name</label>
                            <select name="client_name" id="client_name" class="form-control" required>
                                <option value="">Select Client</option>
                                @foreach($assignedClients as $assignment)
                                    @if($assignment->client) <!-- Check if the client exists -->
                                        <option value="{{ $assignment->client->registered_company_name }}">{{ $assignment->client->registered_company_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                            <!-- Number of Hours -->
                            <div class="mb-3 col-6">
                                <label for="number_of_hours" class="form-label">Number of Hours</label>
                                <input type="number" name="number_of_hours" id="number_of_hours" class="form-control" required>
                            </div>
                        </div>

                        <!-- Purpose -->
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <textarea name="purpose" id="purpose" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Request Date -->
                        <div class="mb-3">
                            <label for="request_date" class="form-label">Request Date</label>
                            <input type="datetime-local" name="request_date" id="request_date" class="form-control" required>
                        </div>

                        <!-- Submit and Cancel buttons -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-white w-auto px-4" style="background-color:#326C79">Submit</button>
                            <a  href="javascript:history.back();" class="btn btn-secondary w-auto px-4 ms-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
