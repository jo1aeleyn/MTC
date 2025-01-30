
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Footer</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Make sure the body takes up at least the full height of the viewport */
        }

        main {
            flex: 1; /* This will make sure the content area can expand and push the footer down */
        }

        /* Footer Styles */
        footer {
            background-color: #326c79;
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
        }

        footer p {
            font-size: 14px;
        }

        footer a {
            color: #f39c12;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #e67e22; /* Hover effect for links */
        }
    </style>
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
