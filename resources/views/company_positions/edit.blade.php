@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Company Positions</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Position</li>
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
                    <h5>Edit Position</h5>
                    <form action="{{ route('company_positions.update', ['uuid' => $companyPosition->uuid]) }}" method="POST">

                    @csrf
                        @method('PUT') <!-- Indicates this is an update form -->

                        <div class="mb-3">
                            <label for="PositionName" class="form-label">Position Name</label>
                            <input type="text" name="PositionName" id="PositionName" class="form-control" value="{{ old('PositionName', $companyPosition->Position_name) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Position</button>
                    </form>

                    <a href="{{ route('company_positions.index') }}" class="btn btn-secondary mt-3">Back to Positions</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')


