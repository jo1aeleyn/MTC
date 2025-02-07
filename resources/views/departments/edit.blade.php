@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Departments</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Department</li>
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
                    <h3>Edit Department</h3>
                    <form action="{{ route('departments.update', $department->uuid) }}" method="POST" id="departmentForm">
                        @csrf
                        @method('PUT') <!-- Indicates this is an update form -->
                        
                        <div class="mb-3">
                            <label for="DepartmentName" class="form-label">Department Name</label>
                            <input type="text" name="DepartmentName" id="DepartmentName" class="form-control" value="{{ old('name', $department->DepartmentName) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Department</button>
                    </form>

                    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back to Departments</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
</body>
</html>
