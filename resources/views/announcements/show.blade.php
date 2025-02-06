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
                    <h3>Announcement Details</h3>

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

                    @if ($announcement->image)
                        <div class="mb-3">
                            <label class="form-label">Image:</label>
                            <div>
                                <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement Image" class="img-fluid" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Back to Announcements</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
