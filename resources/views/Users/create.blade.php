@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
<div class="page-inner">
<div class="container">
<nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
            <li class="breadcrumb-item text-muted">Manage Users</li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New User</li>
        </ol>
    </nav>
<div class="card">
<div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

   

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

        <div class="row">


        <div class="mb-1 col-6">
        <div class="mt-2  d-flex justify-content-center">
        <!-- Placeholder Image -->
        <img id="profile_preview" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwbYMnoBKydOk2tezl6c1A1g1nQgC_8JXckA&s" alt="Profile Preview" class="img-thumbnail mt-4" style="max-width: 150px;">
            </div>
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <div class="custom-file mb-3">
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
            </div>
           
        </div>


            <div class="col-6">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            </div>



            <div class="d-flex justify-content-center">
    <button type="submit" class="btn text-white w-auto px-4"  style="background-color:#326C79">Create</button>
</div>


            </div>

        </form>

  


    </div>
    </div>
</div>
</div>
</div>

<script>
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
@include('partials.footer')
