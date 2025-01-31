<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJb3Qhq0Xj+KryhC0eCua9xC9LMuD5AzF7M5p6vKhf6Qk1Xz1EX+5yI3Jgl9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Your Account Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Username:</strong> {{ $username }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
                <div class="alert alert-warning mt-3" role="alert">
                    Please remember to change your password as soon as possible to ensure your account's security.
                </div>
            </div>
            <div class="card-footer text-center">
                <small>If you have any questions, feel free to contact support.</small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for any interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-4fZ8D4Vwp0yTkGx5H2Lfj9p7Yje0O7X9bvwV9EuqU0kzcmFjv/jAcmGBxzznOvQ9" crossorigin="anonymous"></script>
</body>
</html>
