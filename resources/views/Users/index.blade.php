@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">
<div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">User Accounts</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Profile Picture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->user_role }}</td>
                                <td>
                                    @if ($user->profile_picture)
                                        <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" width="50" height="50" class="rounded-circle">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->uuid) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(event, this)">
                                            Archive
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

    </div>
</div>

@include('partials.footer')
