<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="row w-100 justify-content-center">
                <!-- Left Side (Form) -->
<div class="col-sm-12 col-md-6 text-black d-flex flex-column align-items-center justify-content-center">
    <!-- Logo above the form -->
    <span class="d-flex align-items-center px-4 w-100 justify-content-center">
        <img style="width: 400px; padding-top: 30px;" src="{{ asset('/Logo/LoginLogo.png') }}" alt="Logo">
    </span>

    <!-- Login Form Section -->
    <div class="d-flex align-items-center px-4 mt-3 pt-5 w-100 justify-content-center">
    <form action="{{ route('login') }}" method="POST" style="width: 100%; max-width: 370px;">
            @csrf
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; font-family: 'Merriweather'">Login</h3>

            <!-- Display Logout Success Message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="mb-4">
        <label for="username" class="form-label">Username or Email</label>
        <input type="text" id="username" name="username" class="form-control form-control-lg" required placeholder="Username or Email" />
    </div>

    <div class="mb-4 position-relative">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <input type="password" id="password" name="password" class="form-control form-control-lg" required placeholder="Password" />
            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                <i class="bi bi-eye"></i>
            </span>
        </div>
        <a href="{{ route('password.request') }}" class="d-block mt-2">Forgot password?</a>
    </div>

    <!-- You can add a submit button here if needed -->
    <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


                <!-- Right Side (Image) -->
                <div class="col-sm-12 col-md-6 px-0 d-none d-md-block">
                    <img src="https://images.pexels.com/photos/290275/pexels-photo-290275.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("password");
        let icon = this.querySelector("i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    });
</script>

</body>

</html>
