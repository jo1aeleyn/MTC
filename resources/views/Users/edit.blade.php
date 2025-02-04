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
                                <div class="mt-2 d-flex justify-content-center">
                                    <!-- Placeholder Image -->
                                    <img id="profile_preview" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwbYMnoBKydOk2tezl6c1A1g1nQgC_8JXckA&s" alt="Profile Preview" class="img-thumbnail mt-4" style="max-width: 150px;">
                                </div>
                                    <div class="mt-3">
                                        <label for="profile_picture" class="form-label">Change Profile Picture</label>
                                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                </div>

                                <!-- Username Field -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
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
    // Function to preview the image when a user selects a file
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('profile_preview');
            preview.style.display = 'block';  // Show the preview
            preview.src = reader.result;  // Set the preview image source
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>