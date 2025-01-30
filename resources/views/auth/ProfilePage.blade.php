@extends('Layouts.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>
<body>

    @section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Edit Profile</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container mt-5">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10 position-relative">
                        <input type="password" class="form-control" id="password" name="password">
                        <!-- Eye icon to toggle password visibility -->
                        <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="top: 50%; right: 10px; cursor: pointer;"></i>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10 position-relative">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <!-- Eye icon to toggle confirm password visibility -->
                        <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="top: 50%; right: 10px; cursor: pointer;"></i>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="profile_picture" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <img src="{{ asset('storage/./Profile_pictures/' . $user->profile_picture) }}"
                                 alt="{{$user->profile_picture}}"
                                 width="150"
                                 height="150"
                                 class="img-thumbnail">
                        </div>

                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('password_confirmation');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type of the password field
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;

            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function (e) {
            // Toggle the type of the confirm password field
            const type = confirmPassword.type === 'password' ? 'text' : 'password';
            confirmPassword.type = type;

            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
