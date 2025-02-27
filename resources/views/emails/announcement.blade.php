<!DOCTYPE html>
<html>
<head>
    <title>New Announcement</title>
</head>
<body>
    <h2>{{ $announcement->title }}</h2>
    <p>{!! $announcement->content !!}</p>
    <p>Category: {{ $announcement->category }}</p>

</body>
</html>
