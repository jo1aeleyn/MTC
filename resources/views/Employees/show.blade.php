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
                                        <p><strong>Contact Number:</strong> {{ $employee->contact_num }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Birthdate:</strong> {{ $employee->birthdate }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Address:</strong> {{ $employee->address }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <p><strong>Civil Status:</strong> {{ $employee->civil_status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End of row -->
                    </div> <!-- End of card -->
                </div> <!-- End of col-lg-12 -->
            </div> <!-- End of row -->
        </div> <!-- End of container -->

        <!-- Educational Background -->
        <div class="row d-flex align-items-stretch mb-3">
            <div class="col-lg-4">
                <div class="card mb-4 shadow-lg rounded-3 h-100">
                    <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
                        <h6 class="m-1">Educational Background</h6>
                    </div>
                    <div class="card-body">
                        <div class="education-content">
                            <!-- Show only the first record initially -->
                            <div class="education-record">
                                @if ($employee->education->isNotEmpty())
                                    <div class="mb-3">
                                        <p><strong>Level:</strong> {{ $employee->education[0]->level }}</p>
                                        <p><strong>School:</strong> {{ $employee->education[0]->school }}</p>
                                        <p><strong>Degree:</strong> {{ $employee->education[0]->degree }}</p>
                                        <p><strong>Year Attended:</strong> {{ $employee->education[0]->year_attended_from}} - {{ $employee->education[0]->year_attended_to}}</p>
                                        <p><strong>Honors Received:</strong> {{ $employee->education[0]->honors_received }}</p>
                                    </div>
                                    <hr class="my-3">
                                @endif
                            </div>
                            
                            <!-- Additional records hidden by default -->
                            <div class="more-education-records" style="display: none;">
                                @foreach ($employee->education->skip(1) as $edu)
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
                            
                            <!-- Display "Read More" button only if there is more than 1 record -->
                            @if ($employee->education->count() > 1)
                            <div class="btn-container">
                                <button class="btn btn-read-more" onclick="toggleContent('education')">Read More</button>
                            </div>                           
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training History -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow-lg rounded-3 h-100">
                    <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
                        <h6 class="m-1">Training History</h6>
                    </div>
                    <div class="card-body">
                        <div class="training-content">
                            <!-- Show only the first record initially -->
                            <div class="training-record">
                                @if ($employee->training->isNotEmpty())
                                    <div class="mb-3">
                                        <p><strong>Title:</strong> {{ $employee->training[0]->title }}</p>
                                        <p><strong>Inclusive Dates:</strong> {{ $employee->training[0]->inclusive_dates }}</p>
                                        <p><strong>Conducted By:</strong> {{ $employee->training[0]->conducted_by }}</p>
                                        <p><strong>Venue:</strong> {{ $employee->training[0]->venue }}</p>

                                    </div>
                                    <hr class="my-3">
                                @endif
                            </div>

                            <!-- Additional records hidden by default -->
                            <div class="more-training-records" style="display: none;">
                                @foreach ($employee->training->skip(1) as $train)
                                    <div class="mb-3">
                                    <p><strong>Title:</strong> {{ $train->title }}</p>
                                    <p><strong>Inclusive Dates:</strong> {{ $train->inclusive_dates }}</p>
                                    <p><strong>Conducted By:</strong> {{ $train->conducted_by }}</p>
                                    <p><strong>Venue:</strong> {{ $train->venue }}</p>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                            <!-- Display "Read More" button only if there is more than 1 record -->
                            @if ($employee->training->count() > 1)
                            <div class="btn-container">
                                <button class="btn btn-read-more" onclick="toggleContent('training')">Read More</button>
                            </div>                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment History -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow-lg rounded-3 h-100">
                    <div class="card-header text-white rounded-top p-1 d-flex align-items-center" style="background-color: #326C79">
                        <h6 class="m-1">Employment History</h6>
                    </div>
                    <div class="card-body">
                        <div class="employment-content">
                            <!-- Show only the first record initially -->
                            <div class="employment-record">
                                @if ($employee->employment->isNotEmpty())
                                    <div class="mb-3">
                                        <p><strong>Company:</strong> {{ $employee->employment[0]->company }}</p>
                                        <p><strong>Position:</strong> {{ $employee->employment[0]->position }}</p>
                                        <p><strong>Salary:</strong> ₱{{ $employee->employment[0]->salary,2 }}</p>
                                        <p><strong>Supervisor:</strong> {{ $employee->employment[0]->superior }}</p>
                                        <p><strong>Department:</strong> {{ $employee->employment[0]->department }}</p>
                                        <p><strong>Reason for Leaving:</strong> {{ $employee->employment[0]->reason_for_leaving }}</p>
                                    </div>
                                    <hr class="my-3">
                                @endif
                            </div>

                            <!-- Additional records hidden by default -->
                            <div class="more-employment-records" style="display: none;">
                                @foreach ($employee->employment->skip(1) as $job)
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

                            <!-- Display "Read More" button only if there is more than 1 record -->
                            @if ($employee->employment->count() > 1)
                            <div class="btn-container">
                                <button class="btn btn-read-more" onclick="toggleContent('employment')">Read More</button>
                            </div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>
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

<script>
    function toggleContent(section) {
        const content = document.querySelector(`.${section}-content`);
        const moreRecords = content.querySelector(`.more-${section}-records`);
        const button = content.querySelector('.btn-read-more');

        // Toggle visibility of additional records
        if (moreRecords.style.display === "none" || moreRecords.style.display === "") {
            moreRecords.style.display = "block";
            button.innerText = "Read Less";
        } else {
            moreRecords.style.display = "none";
            button.innerText = "Read More";
        }
    }
</script>

<style>
    .btn-read-more {
    background-color: #326C79;
    color: #fff;
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 80%;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-transform: uppercase;
    display: inline-block;
    margin: 0 auto; /* This will center the button horizontally */
}
.btn-container {
    display: flex;
    justify-content: center; /* Centers horizontally */
    align-items: center; /* Centers vertically */
}

    .btn-read-more:hover {
        background-color: #264f59;
    }

    .btn-read-more:focus {
        outline: none;
    }

    .btn-read-more:active {
        background-color: #203a42;
    }
</style>
    