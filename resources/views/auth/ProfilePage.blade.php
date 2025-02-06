@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('assets/css/profilepage.css') }}">

<div class="container">
<div class="page-inner">

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo"></div>
                        <div class="profile-photo text-center">
                            <img src="{{ asset('Profile_pictures/' . $user->profile_picture) }}" class="img-fluid rounded-circle" alt="">
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <div class="row">
                                    <!-- Name Section -->
                                    <div class="col-12 col-sm-6 col-md-4 border-right-1 prf-col">
                                        <div class="profile-name">
                                        <h4 class="text-primary" style="margin-bottom: 5px;">{{ $employee->first_name }} {{ $employee->surname }}</h4>
                                        <h4 class="text-muted" style="margin-bottom: 5px; ">{{ $employee->email }}</h4>
                                        <p style="margin-bottom: 0; ">{{ $employee->application ? $employee->application->position : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Profile Tab Section -->
    <div class="card">
        <div class="card-body">
            <div class="profile-tab">
                <div class="custom-tab-1">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs justify-content-center flex-column flex-sm-row">
                        <li class="nav-item">
                            <a href="#edit-profile" data-bs-toggle="tab" class="nav-link active show">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#my-posts" data-bs-toggle="tab" class="nav-link ">About Me</a>
                        </li>

                        <li class="nav-item">
                            <a href="#about-me" data-bs-toggle="tab" class="nav-link">Educational Background</a>
                        </li>

                        <li class="nav-item">
                            <a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Training History</a>
                        </li>
                        <li class="nav-item">
                            <a href="#employment-history" data-bs-toggle="tab" class="nav-link">Employment History</a>
                        </li>
                        <li class="nav-item">
                            <a href="#family-background" data-bs-toggle="tab" class="nav-link">Family Background</a>
                        </li>
                        <li class="nav-item">
                            <a href="#emergency-contacts" data-bs-toggle="tab" class="nav-link">Emergency Contacts</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- About Me Tab Content -->
                        <div id="my-posts" class="tab-pane fade">
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
                            </div>
                        </div>

                        <!-- Educational Background Tab Content -->
                        <div id="about-me" class="tab-pane fade">
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

                        <!-- Training History Tab Content -->
                        <div id="profile-settings" class="tab-pane fade">
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

                        <!-- Edit Profile Tab Content -->
                        <div id="edit-profile" class="tab-pane fade  active show">
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">     
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

                        <!-- Employment History Tab Content -->
                        <div id="employment-history" class="tab-pane fade">
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

                        <!-- Family Background Tab Content -->
                        <div id="family-background" class="tab-pane fade">
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

                        <!-- Emergency Contacts Tab Content -->
                        <div id="emergency-contacts" class="tab-pane fade">
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
 </div>
</div>



@include('partials.footer')
