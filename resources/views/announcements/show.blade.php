@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Announcements</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">View Announcement</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h5>Announcement Details</h5>

                    <div class="mb-3">
                        <label class="form-label">Title:</label>
                        <p class="form-control-plaintext">{{ $announcement->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category:</label>
                        <p class="form-control-plaintext">{{ $announcement->category }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content:</label>
                        <div class="form-control-plaintext border p-3" style="background-color: #f8f9fa;">
                            {!! $announcement->content !!}
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Posted By:</label>
                        <div class="d-flex align-items-center p-3 border" style="background-color: #f8f9fa;">
                            <!-- Display Profile Picture -->
                            <img src="{{ $announcement->createdByUser->profile_picture ? asset('profile_pictures/' . $announcement->createdByUser->profile_picture) : asset('profile_pictures/default-profile.png') }}" 
                                alt="Profile Picture" 
                                class="rounded-circle me-2" 
                                style="width: 50px; height: 50px; object-fit: cover;">

                            <!-- Display Username -->
                            <span>{{ $announcement->createdByUser->username ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    @if ($announcement->image)
                        <div class="mb-3">
                            <label class="form-label">Image:</label>
                            <div>
                                <img src="{{ asset('storage/announcements/' . $announcement->image) }}" alt="Announcement Image" class="img-fluid" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    
                </div>
                
            </div>
            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Announcements List
    </a>
        </div>
    </div>
</div>

@include('partials.footer')
