
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Footer</title>
    <link rel="stylesheet" href="/css/footer.css" />
    
</head>
<body>

<main>
    <!-- Content goes here, if needed -->
</main>

<footer>
    <p>&copy; {{ date('Y') }} Mendoza Tugano & Co., CPAs. All rights reserved.</p>
    <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a> | <a href="{{ url('/terms-of-service') }}">Terms of Service</a></p>
</footer>

</body>
</html>
