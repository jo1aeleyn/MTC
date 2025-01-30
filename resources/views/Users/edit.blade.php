@extends('Layouts.layout')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@section('content')
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password (Leave blank if unchanged)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="user_role" class="form-label">Role</label>
                <select class="form-select" id="user_role" name="user_role" required>
                    <option value="admin" {{ $user->user_role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->user_role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                @if($user->profile_picture)
                    <div class="mt-2">
                        <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" width="50" height="50" class="rounded-circle">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

