@extends('Layouts.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Optional: Custom CSS (if any) -->
    <style>
        .card-header {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }


    </style>
</head>
@section('content')
<body>

<div class="container mt-5 mb-5">
    <h2 class="mb-3">Employee Details</h2>



    <div class="row d-flex align-items-stretch mb-3">
    <div class="col-lg-4">
        <div class="card mb-4 h-100">
            <div class="card-body text-center">
                <img src="{{ asset('Profile_pictures/' . $user->profile_picture) }}" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 125px;">
                <h5>{{ $employee->first_name }} {{ $employee->surname }}</h5>
                <p class="text-muted mb-1">{{ $employee->application ? $employee->application->position : 'N/A' }}</p>
                <p class="text-muted mb-1">{{ $employee->emp_num }}</p>
                <p class="text-muted mb-1">{{ $employee->email }}</p>
                <div class="d-flex justify-content-center mb-2">
                    <!-- Additional content can go here -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
    <div class="card mb-4 shadow-lg rounded-3 h-100">
        <div class="card-header bg-info text-white rounded-top">
            <h5>Employee Information</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p><strong><i class="fas fa-phone-alt"></i> Contact Number:</strong> {{ $employee->contact_num }}</p>
            </div>
            <div class="mb-3">
                <p><strong><i class="fas fa-birthday-cake"></i> Birthdate:</strong> {{ $employee->birthdate }}</p>
            </div>
            <div class="mb-3">
                <p><strong><i class="fas fa-home"></i> Address:</strong> {{ $employee->address }}</p>
            </div>
            <div class="mb-3">
                <p><strong><i class="fas fa-heart"></i> Civil Status:</strong> {{ $employee->civil_status }}</p>
            </div>
            <div class="d-flex justify-content-center mb-2">
                <!-- Additional content can go here -->
            </div>
        </div>
    </div>
</div>

</div>


<div class="row d-flex align-items-stretch mb-3">
    <div class="col-lg-6">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header bg-info text-white rounded-top">
                <h5>Educational Background</h5>
            </div>
            <div class="card-body">
                @foreach ($employee->education as $edu)
                    <div class="mb-3">
                        <p><strong>Level:</strong> {{ $edu->level }}</p>
                        <p><strong>School:</strong> {{ $edu->school }}</p>
                        <p><strong>Degree:</strong> {{ $edu->degree }}</p>
                        <p><strong>Year Attended:</strong> {{ $edu->year_attended_from }} - {{ $edu->year_attended_to }}</p>
                        <p><strong>Honors Received:</strong> {{ $edu->honors_received }}</p>
                    </div>
                    <hr class="my-3">
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header bg-info text-white rounded-top">
                <h5>Training History</h5>
            </div>
            <div class="card-body">
                @foreach ($employee->training as $train)
                    <div class="mb-3">
                        <p><strong>Title:</strong> {{ $train->title }}</p>
                        <p><strong>Inclusive Dates:</strong> {{ $train->inclusive_dates }}</p>
                        <p><strong>Conducted By:</strong> {{ $train->conducted_by }}</p>
                        <p><strong>Venue:</strong> {{ $train->venue }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Employment History Card -->
<div class="card mb-4 shadow-lg rounded-3">
    <div class="card-header bg-info text-white rounded-top">
        <h5>Employment History</h5>
    </div>
    <div class="card-body">
        @foreach ($employee->employment as $job)
            <div class="mb-3">
                <p><strong>Company:</strong> {{ $job->company }}</p>
                <p><strong>Position:</strong> {{ $job->position }}</p>
                <p><strong>Salary:</strong> {{ $job->salary }}</p>
                <p><strong>Supervisor:</strong> {{ $job->superior }}</p>
                <p><strong>Department:</strong> {{ $job->department }}</p>
                <p><strong>Reason for Leaving:</strong> {{ $job->reason_for_leaving }}</p>
            </div>
            <hr class="my-3">
        @endforeach
    </div>
</div>

<div class="row d-flex align-items-stretch mb-3">
    <div class="col-lg-6">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header bg-info text-white rounded-top">
                <h5>Family Background</h5>
            </div>
            <div class="card-body">
                @foreach ($employee->family as $familyMember)
                    <div class="mb-3">
                        <p><strong>Name:</strong> {{ $familyMember->name }}</p>
                        <p><strong>Relationship:</strong> {{ $familyMember->relationship }}</p>
                        <p><strong>Occupation:</strong> {{ $familyMember->occupation }}</p>
                        <p><strong>Birthdate:</strong> {{ $familyMember->birthdate }}</p>
                        <p><strong>Contact Number:</strong> {{ $familyMember->phone }}</p>
                    </div>
                    <hr class="my-3">
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header bg-info text-white rounded-top">
                <h5>Emergency Contacts</h5>
            </div>
            <div class="card-body">
                @foreach ($employee->emergencyContacts as $contact)
                    <div class="mb-3">
                        <p><strong>Name:</strong> {{ $contact->name }}</p>
                        <p><strong>Relationship:</strong> {{ $contact->relationship }}</p>
                        <p><strong>Address:</strong> {{ $contact->address }}</p>
                        <p><strong>Contact Number:</strong> {{ $contact->contact_num }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<button id="exportPdf" class="btn btn-success mb-3">Export as PDF</button>

    <!-- Back Button -->
    <a href="{{ route('employees.index') }}" class="btn btn-danger">Back to Employee List</a>
</div>

<!-- Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<script>

        document.getElementById('exportPdf').addEventListener('click', function () {
    html2canvas(document.querySelector('.container')).then(function (canvas) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const imgData = canvas.toDataURL('image/png');
        doc.addImage(imgData, 'PNG', 10, 10);

        doc.save('employee-details.pdf');
    }).catch(function(error) {
        console.error('Error generating PDF: ', error);
    });
});

</script>

</body>
</html>
@endsection
