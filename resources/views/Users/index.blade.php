@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container mb-5">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Users</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Users List</li>
                </ol>
                </nav>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                    </div>
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
                                        <div class="dropdown" style="text-align:center;">
                                            <button  class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $user->id }}">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user->uuid) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to archive this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                       <button class="dropdown-item" onclick="confirmDelete(event, this)">
                                                            Archive
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
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
