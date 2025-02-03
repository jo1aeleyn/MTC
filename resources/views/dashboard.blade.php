@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">

                    <h1>Welcome to the Dashboard</h1>

                    <!-- Display the logged-in user's username -->
                    @if(Auth::check())
                        <h5 class="mb-4">
                            Logged in as: <span class="text-primary">{{ Auth::user()->username }}</span>
                        </h5>
                    @else
                        <p class="text-danger">No user is logged in.</p>
                    @endif

                    <!-- Display success message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Dashboard Overview</h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">This is your dashboard. You can manage your application and view statistics here.</p>
                            <ul class="list-group mt-3">
                                <li class="list-group-item">Feature 1: User Management</li>
                                <li class="list-group-item">Feature 2: Reports</li>
                                <li class="list-group-item">Feature 3: Notifications</li>
                            </ul>
                        </div>
                    </div>
              
        </div>
    </div>

</div>
</div>

@include('partials.footer')

