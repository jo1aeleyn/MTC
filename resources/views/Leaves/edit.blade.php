@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Leave Applications</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Leave</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Leave Application</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('leaves.update', $leave->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Employee Number:</strong></label>
                                <input type="text" class="form-control" name="emp_num" value="{{ $leave->emp_num }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>Employee Name:</strong></label>
                                <input type="text" class="form-control" name="name" value="{{ $leave->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Date of Leave:</strong></label>
                                <input type="date" class="form-control" name="DateOfLeave" value="{{ $leave->DateOfLeave->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>Total Days:</strong></label>
                                <input type="number" class="form-control" name="TotalDays" value="{{ $leave->TotalDays }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Type of Leave:</strong></label>
                                <select class="form-control" name="TypeOfLeave" required>
                                    <option value="Vacation Leave" {{ $leave->TypeOfLeave == 'Vacation Leave' ? 'selected' : '' }}>Vacation Leave</option>
                                    <option value="Sick Leave" {{ $leave->TypeOfLeave == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                    <option value="Maternity Leave" {{ $leave->TypeOfLeave == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                                    <option value="Other Leave" {{ $leave->TypeOfLeave == 'Other Leave' ? 'selected' : '' }}>Other Leave</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="otherLeaveTypeField" style="display: {{ $leave->TypeOfLeave == 'Other Leave' ? 'block' : 'none' }}">
                                <label class="form-label"><strong>Other Leave Type:</strong></label>
                                <input type="text" class="form-control" name="OtherLeaveType" value="{{ $leave->OtherLeaveType }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Remarks:</strong></label>
                                <textarea class="form-control" name="Remarks">{{ $leave->Remarks }}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="Status" value="{{ $leave->Status }}">
                        <div class="row mt-4">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Update Leave</button>
                                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const leaveTypeSelect = document.querySelector("select[name='TypeOfLeave']");
        const otherLeaveTypeField = document.getElementById("otherLeaveTypeField");

        leaveTypeSelect.addEventListener("change", function () {
            if (this.value === "Other Leave") {
                otherLeaveTypeField.style.display = "block";
            } else {
                otherLeaveTypeField.style.display = "none";
                otherLeaveTypeField.querySelector("input").value = "";
            }
        });
    });
</script>
