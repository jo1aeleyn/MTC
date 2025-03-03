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
                        <a href="{{ route('users.create') }}" style="background-color: #326C79; color: white;" class="btn ">Create User</a>
                    </div>
                    <div class="table-responsive">
                        <table id="usersTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Profile Picture</th>
                                    <th>Edit Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @if ($user->profile_picture)
                                                <img src="{{ asset('profile_pictures/' . $user->profile_picture) }}" width="50" height="50" class="rounded-circle">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                        <select class="form-select role-dropdown" data-user-id="{{ $user->id }}">
                                            <option value="" disabled {{ is_null($user->user_role) ? 'selected' : '' }}>Select User Role</option>
                                            <option value="Employee User" {{ $user->user_role == 'Employee User' ? 'selected' : '' }}>Employee User</option>
                                            <option value="HR Admin" {{ $user->user_role == 'HR Admin' ? 'selected' : '' }}>HR Admin</option>
                                            <option value="Partners" {{ $user->user_role == 'Partners' ? 'selected' : '' }}>Partners</option>
                                            <option value="Auditing Supervisor" {{ $user->user_role == 'Auditing Supervisor' ? 'selected' : '' }}>Auditing Supervisor</option>
                                            <option value="Accounting Supervisor" {{ $user->user_role == 'Accounting Supervisor' ? 'selected' : '' }}>Accounting Supervisor</option>
                                        </select>
                                        </td>
                                        <td>
                                            <div class="dropdown text-center">
                                                <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                    @if (is_null($user->employee->emp_num ?? null))
                                                    <li>
                                                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this user?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item text-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                    @endif
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
