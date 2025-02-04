@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit User Account </h2>

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

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture Section -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('/Profile_pictures/' . $user->profile_picture) }}" 
                                 alt="{{ $user->profile_picture }}" 
                                 class="img-fluid rounded-circle" 
                                 style="max-width: 120px; height: auto;">
                            <div class="mt-3">
                                <label for="profile_picture" class="form-label">Change Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                        </div>

                        <!-- Password Fields -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye-slash"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="bi bi-eye-slash"></i></button>
                            </div>
                        </div>

                        <!-- User Role Dropdown -->
                        <div class="mb-3">
                            <label for="user_role" class="form-label">User Role</label>
                            <select class="form-select" id="user_role" name="user_role" required>
                                <option value="admin" {{ old('user_role', $user->user_role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('user_role', $user->user_role) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" style='background-color:#326C79'>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
    <form action="{{ route('users.resetPassword', $user->uuid) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">Reset Password</button>
    </form>
</div>
        </div>
    </div>


@include('partials.footer')

<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password_confirmation");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });
</script>
