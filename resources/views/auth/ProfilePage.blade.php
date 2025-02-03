@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">
<div class="container mt-5 mb-5">

    <h2 class="mb-4 text-center">Edit Profile</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row d-flex align-items-start mb-4">
        <!-- Profile Picture Section -->
        <div class="col-lg-4">
            <div class="card h-100 shadow-lg border-0">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body text-center">
                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <img src="{{ asset('/Profile_pictures/' . $user->profile_picture) }}"
                             alt="{{$user->profile_picture}}"
                             width="150"
                             height="150"
                             class="img-thumbnail rounded-circle mb-3">
                    </div>

                    <!-- File Input for Profile Picture -->
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Change Profile Picture</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="col-lg-8 mt-3">
            <div class="card h-100 shadow-lg border-0">
                <div class="card-body">
                
                        @csrf
                        @method('PUT')

                        <!-- Username Field -->
                        <div class="row mb-4">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-4">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        </div>  

                    <!-- Confirm Password Field -->
                        <div class="row mb-4">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9 position-relative">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                                <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary" style='background-color:#326C79'>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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

</div>
</div>
</div>





@include('partials.footer')
