@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
    <div class="page-inner">
        
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Announcements</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Announcement List</li>
                </ol>
            </nav>
            <div class="card p-4">
            <!-- Add New Announcement Button -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('announcements.create') }}" class="btn text-white" style="background-color:#326C79">Add New Announcement</a>
            </div>

            <div class="row">
                @if ($announcements->isEmpty())
                    <div class="col-12 text-center text-muted fs-5">
                        No announcement records found.
                    </div>
                @else
                    @foreach ($announcements as $announcement)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm position-relative">

                                <!-- Dropdown Positioned Over Image -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <div class="dropdown">
                                        <button class="border-0 bg-transparent p-0" type="button" id="dropdownMenu{{ $announcement->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v text-white p-2 rounded-circle" style="background-color: #326C79;"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu{{ $announcement->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('announcements.show', $announcement->id) }}">View</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('announcements.edit', $announcement->uuid) }}">Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('announcements.archive', $announcement->id) }}" method="POST" id="archiveForm{{ $announcement->id }}">
                                                    @csrf
                                                    <button class="dropdown-item" type="button" onclick="confirmArchive({{ $announcement->id }})">Archive</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <img src="{{ asset('storage/announcements/' . $announcement->image) }}" class="card-img-top" alt="Announcement Image" style="height: 200px; object-fit: cover;">

                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $announcement->title }}</h6>
                                    <p class="card-text m-0 "><strong>Category:</strong> {{ $announcement->category }}</p>
                                    <p class="card-text m-0"><strong>Created By:</strong> {{ $announcement->createdBy }}</p>
                                    <p class="card-text text-muted m-0">
                                        <i class="fas fa-clock"></i> {{ $announcement->created_at->format('F jS, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
</div>
        </div>
    </div>
</div>

@include('partials.footer')

<!-- SweetAlert for Archive Confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmArchive(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to archive this announcement?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('archiveForm' + id).submit();
            }
        });
    }
</script>
