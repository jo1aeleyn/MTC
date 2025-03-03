@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Users</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit User</li>
                </ol>
            </nav>

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

                                <div class="mb-3 row">
    <!-- Username Field -->
    <div class="col-md-6">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
    </div>

</div>


                                <!-- Submit Button -->      
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn  w-auto px-4" style='background-color:#326C79; color:white;'>Update Profile</button>
                                </div>
                            
                            </form>
                        </div>
                        
                    </div>
                    <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Users List
    </a>
            <div class="d-flex justify-content-end">
                <form action="{{ route('users.resetPassword', $user->uuid) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Reset Password</button>
                </form>
            </div>
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
            preview.style.display = 'block'; // Show the preview
            preview.src = reader.result; // Set the preview image source
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
