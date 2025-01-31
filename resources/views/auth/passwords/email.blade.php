<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('import/img/brgylogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link href="{{ asset('import/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <title>Forgot Password</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .full-height {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
<section class="bg-light p-3 p-md-4 p-xl-5 full-height">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="text-center mb-2">
                            <a href="#!">
                                <!-- <img src="{{ asset('import/img/brgylogo.png') }}" alt="Barangay Olympia Logo" width="125"> -->
                            </a>
                        </div>
                        <h2 class="h4 text-center mb-2">Password Reset</h2>
                        <h3 class="fs-6 fw-normal text-secondary text-center mb-4">To retrieve your password, enter the email address linked to your account.</h3>
                        
                        @if (session('status'))
                        <div class="alert alert-success mt-4" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-4 mb-4 border-secondary-subtle">
                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                    <a href="{{ route('login') }}" class="link-secondary text-decoration-none">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
