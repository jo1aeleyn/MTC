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
    <div class="container mt-5">
       
        <a href="{{ route('overtime.index') }}" class="btn btn-primary mb-3">Back to Overtime List</a>

        <form action="{{ route('overtime.update', $overtime->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="emp_name" class="form-label">Employee Name</label>
                <input type="text" class="form-control" id="emp_name" name="emp_name" value="{{ old('emp_name', $overtime->emp_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name', $overtime->client_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="date_filed" class="form-label">Date Filed</label>
                <input type="date" class="form-control" id="date_filed" name="date_filed" value="{{ old('date_filed', $overtime->date_filed) }}" required>
            </div>

            <div class="mb-3">
                <label for="number_of_hours" class="form-label">Number of Hours</label>
                <input type="number" class="form-control" id="number_of_hours" name="number_of_hours" value="{{ old('number_of_hours', $overtime->number_of_hours) }}" required>
            </div>

            <div class="mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <textarea class="form-control" id="purpose" name="purpose">{{ old('purpose', $overtime->purpose) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Overtime Request</button>
        </form>
    </div>

    </div>
</div>
</div>


@include('partials.footer')
