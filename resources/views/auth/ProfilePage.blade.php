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

</div>
</div>
</div>

s



@include('partials.footer')
