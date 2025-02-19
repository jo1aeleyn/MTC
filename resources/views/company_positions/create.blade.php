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
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Position</li>
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
                    <h5>Create Position</h5>
                    <form action="{{ route('company_positions.store') }}" method="POST" id="positionForm">
                        @csrf
                        <div class="mb-3">
                            <label for="PositionName" class="form-label">Position Name</label>
                            <input type="text" name="PositionName" id="PositionName" class="form-control" required>
                        </div>
                        
        <button type="submit" class="btn" style="float:right; background-color: #326C79; color:white;">Create Position</button>
                </div>
                
            </div>
            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Positions List
    </a>
        </div>
        
        </form>
    </div>
</div>

@include('partials.footer')
</body>
</html>

