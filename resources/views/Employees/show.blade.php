@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Employee</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Employee Details</li>
                </ol>
            </nav>
            <div class="row d-flex align-items-stretch mb-3">
                <div class="col-lg-12">
                    <div class="card mb-4 h-100">
                    <div class="row d-flex align-items-center mb-3">
                            <!-- Left Column (Profile Image and Basic Info) -->
                            <div class="col-lg-6">
                                <div class="card-body text-center">
                                    <img src="{{ asset('Profile_pictures/' . $user->profile_picture) }}" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 125px;">
                                    <h6>{{ $employee->first_name }} {{ $employee->surname }}</h6>
                                    <p class="text-muted mb-1">
                                        {{ $employee->application ? $employee->application->position : 'N/A' }}
                                    </p>
                                    <p class="text-muted mb-1">
                                        {{ $employee->application ? $employee->application->DepartmentName : 'N/A' }}
                                    </p>
                                    <p class="text-muted mb-1">{{ $employee->emp_num }}</p>
                                    <p class="text-muted mb-1">{{ $employee->email }}</p>
                                </div>
                            </div>
                            <!-- Right Column (Employee Details) -->
                            <div class="col-lg-6 mx-auto">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <p><strong>Contact Number:</strong> 
                                            {{ $employee->contact_num }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Birthdate:</strong> 
                                            {{ $employee->birthdate }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong> Address:</strong> 
                                            {{ $employee->address }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong> Civil Status:</strong> 
                                            {{ $employee->civil_status }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End of row -->
                    </div> <!-- End of card -->
                </div> <!-- End of col-lg-12 -->
            </div> <!-- End of row -->
        </div> <!-- End of container -->




<div class="row d-flex align-items-stretch mb-3">
    <div class="col-lg-4">
        <div class="card mb-4 shadow-lg rounded-3 h-100 ">
            <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
                <h6 class ="m-1">Educational Background</h6>
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

    <div class="col-lg-4">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
                <h6 class ="m-1">Training History</h6>
            </div>
            <div class="card-body">
                @foreach ($employee->training as $train)
                    <div class="mb-3">
                        <p><strong>Title:</strong> {{ $train->title }}</p>
                        <p><strong>Inclusive Dates:</strong> {{ $train->inclusive_dates }}</p>
                        <p><strong>Conducted By:</strong> {{ $train->conducted_by }}</p>
                        <p><strong>Venue:</strong> {{ $train->venue }}</p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4">
    <div class="card mb-4 shadow-lg rounded-3 h-100 ">
    <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
    <h6 class ="m-1">Employment History</h6>
    </div>
    <div class="card-body">
        @foreach ($employee->employment as $job)
            <div class="mb-3">
                <p><strong>Company:</strong> {{ $job->company }}</p>
                <p><strong>Position:</strong> {{ $job->position }}</p>
                <p><strong>Salary:</strong> ₱{{ number_format($job->salary, 2) }}</p>
                <p><strong>Supervisor:</strong> {{ $job->superior }}</p>
                <p><strong>Department:</strong> {{ $job->department }}</p>
                <p><strong>Reason for Leaving:</strong> {{ $job->reason_for_leaving }}</p>
            </div>
            <hr class="my-3">
        @endforeach
    </div>
    </div>
</div>
</div>


<div class="row d-flex align-items-stretch mb-3">
    <div class="col-lg-6">
        <div class="card mb-4 shadow-lg rounded-3 h-100">
            <div class="card-header text-white rounded-top p-1 d-flex align-items-center"" style="background-color: #326C79">
                <h6 class ="m-1">Family Background</h6>
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
            <div class="card-header text-white rounded-top p-1 d-flex align-items-center"" style="background-color: #326C79">
                <h6 class ="m-1">Emergency Contacts</h6>
            </div>
            <div class="card-body">
                @foreach ($employee->emergencyContacts as $contact)
                    <div class="mb-3">
                        <p><strong>Name:</strong> {{ $contact->name }}</p>
                        <p><strong>Relationship:</strong> {{ $contact->relationship }}</p>
                        <p><strong>Address:</strong> {{ $contact->address }}</p>
                        <p><strong>Contact Number:</strong> {{ $contact->contact_num }}</p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- 
<button id="exportPdf" style="width: 100%; background-color: #326C79; border-color:#326C79; color:white;">Export as PDF</button> -->

    <!-- Back Button -->
    <a href="{{ route('employees.index') }}" class="btn btn-danger" style="float:right;">Back to Employee List</a>
</div>


</div>


@include('partials.footer')
