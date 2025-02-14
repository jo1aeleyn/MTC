@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('css/profilepage.css') }}">

<div class="container">
<div class="page-inner">

<div class="card">
  <!-- Background image -->
  <div class="rounded-top-3" style="background-image: url(../assets/img/bgprofile.png); background-position: center; background-size: cover; background-repeat: no-repeat; height: 300px; "></div>
  
  <div class="card-body p-md-5">
    <div class="d-flex flex-column gap-5">
      <!-- Profile picture with adjusted position -->
      <div class="mt-n5" id="profilepic">
        <img src="{{ asset('Profile_pictures/' . $user->profile_picture) }}" 
             style="margin-top: -120px; width:15%;" 
             alt="mentor 1" 
             class="img-fluid rounded-4">
      </div>
      
      <div class="d-flex flex-column gap-5" style="margin-top: -40px;"  id="profdetails">
        <div class="d-flex flex-column gap-3">
          <div class="d-flex flex-md-row flex-column justify-content-between gap-2">
            <!-- Heading -->
            <div>
              <h1 class="mb-0">{{ $employee->first_name }} {{ $employee->surname }}</h1>
              <!-- Content -->
              <div class="d-flex flex-lg-row flex-column gap-2">
                <small class="fw-medium text-gray-800">
                  {{ $employee->application ? $employee->application->position : 'N/A' }}
                </small>
                <small class="fw-medium text-success">
                  {{ $employee->email }}
                </small>
              </div>
            </div>
          </div>
          <div class="d-flex flex-md-row flex-column gap-md-4 gap-2">
            <div class="d-flex flex-row gap-2 align-items-center lh-1">
              <!-- Icon -->
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-geo-alt-fill text-danger" viewBox="0 0 16 16">
                  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"></path>
                </svg>
              </span>
              <!-- Address -->
              <span>{{ $employee->address }}</span>
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
