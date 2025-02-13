@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Leave Applications</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Apply for Leave</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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

                    <!-- Leave Application Form -->
                    <form action="{{ route('leaves.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Date of Leave -->
                            <div class="mb-3 col-6">
                                <label for="DateOfLeave" class="form-label">Date of Leave</label>
                                <input type="date" name="DateOfLeave" id="DateOfLeave" class="form-control" required>
                            </div>

                            <!-- Total Days -->
                            <div class="mb-3 col-6">
                                <label for="TotalDays" class="form-label">Total Days</label>
                                <input type="number" name="TotalDays" id="TotalDays" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Type of Leave -->
                            <div class="mb-3 col-6">
                                <label for="TypeOfLeave" class="form-label">Type of Leave</label>
                                <select name="TypeOfLeave" id="TypeOfLeave" class="form-select" required onchange="toggleOtherLeave()">
                                    <option value="" disabled selected>Select Type of Leave</option>
                                    <option value="Vacation">Vacation</option>
                                    <option value="Sick">Sick</option>
                                    <option value="Emergency">Emergency</option>
                                    <option value="Other Leave">Other Leave</option>
                                </select>
                            </div>

                            <!-- Other Leave (Hidden by Default) -->
                            <div class="mb-3 col-6 d-none" id="otherLeaveContainer">
                                <label for="OtherLeave" class="form-label">Specify Leave Type</label>
                                <input type="text" name="OtherLeave" id="OtherLeave" class="form-control">
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="mb-3">
                            <label for="Remarks" class="form-label">Remarks</label>
                            <textarea name="Remarks" id="Remarks" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-white w-auto px-4" style="background-color:#326C79">Submit</button>
                            <a href="{{ route('leaves.index') }}" class="btn btn-secondary w-auto px-4 ms-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleOtherLeave() {
        var typeOfLeave = document.getElementById('TypeOfLeave').value;
        var otherLeaveContainer = document.getElementById('otherLeaveContainer');
        if (typeOfLeave === 'Other Leave') {
            otherLeaveContainer.classList.remove('d-none');
        } else {
            otherLeaveContainer.classList.add('d-none');
        }
    }
</script>

@include('partials.footer')
