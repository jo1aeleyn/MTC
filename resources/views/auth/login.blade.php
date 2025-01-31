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
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Side (Form) -->
                <div class="col-sm-12 col-md-6 text-black  align-items-center">
                    <div class="px-5 ms-xl-4">
                        <span class="h1 fw-bold mb-0">
                            <img style="width: 180px; padding-top: 30px;" src="https://mtco.com.ph/img/logotype_opaque.svg" alt="Logo">
                        </span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5 w-100">
                        <form action="{{ route('login') }}" method="POST" style="width: 100%; max-width: 370px;">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; font-family: 'Merriweather'">HR Information System</h3>

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


                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg" required placeholder="Username or Email" style="color: #555;" />
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 position-relative">
                            <input type="password" id="password" name="password" class="form-control form-control-lg" required placeholder="Password" style="color: #555;" />
                            <a href="{{ route('password.request') }}"> Forgot password? </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="z-index: 10;">
                            <i class="fas fa-eye"></i>
                            </button>
                            </div>

                            <div class="pt-1 mb-4">
                                <button style="width: 100%; background-color: #326C79; border-color:#326C79; color:white;" type="submit" class="btn btn-info btn-lg btn-block">Login</button>
                            </div>
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
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const toggleIcon = togglePasswordButton.querySelector('i');

    togglePasswordButton.addEventListener('click', () => {
        const isPasswordVisible = passwordInput.getAttribute('type') === 'text';
        passwordInput.setAttribute('type', isPasswordVisible ? 'password' : 'text');
        toggleIcon.classList.toggle('fa-eye', isPasswordVisible);
        toggleIcon.classList.toggle('fa-eye-slash', !isPasswordVisible);
    });
</script>

</body>

</html>