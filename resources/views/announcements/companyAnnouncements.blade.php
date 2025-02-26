@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Announcements</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Company Announcements</li>
                </ol>
            </nav>
            <div class="card p-4">
            <div class="row">
                @if ($announcements->isEmpty())
                    <div class="col-12 text-center text-muted fs-5">
                        No announcement records found.
                    </div>
                @else
                    @foreach ($announcements as $announcement)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ asset('storage/announcements/' . $announcement->image) }}" class="card-img-top" alt="Announcement Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                <h6 class="card-title fw-bold text-center">{{ $announcement->title }}</h6>
                                    <p class="card-text m-0"><strong>Category:</strong> {{ $announcement->category }}</p>
                                    <p class="card-text m-0"><strong>Created By:</strong> {{ $announcement->createdBy }}</p>
                                    <p class="card-text text-muted m-0"><i class="fas fa-clock"></i> {{ $announcement->created_at->format('M d, Y') }}</p>
                                    <a href="#" class="btn btn-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $announcements->links('pagination::bootstrap-5') }}
</div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
