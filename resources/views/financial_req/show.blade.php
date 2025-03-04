@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')
<style>
.fullscreen-viewer {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.fullscreen-image {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
}
.image-thumbnail {
    width: 150px; /* Set a fixed width */
    height: 150px; /* Set a fixed height */
    object-fit: cover; /* Ensures images maintain aspect ratio and fill the box */
    border-radius: 8px; /* Optional: for rounded corners */
}

.nav-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.5);
    border: none;
    font-size: 24px;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    color: black;
}

.left { left: 10px; }
.right { right: 10px; }

.nav-button:hover {
    background: rgba(255, 255, 255, 0.8);
}
</style>

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Financial Requests</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Request Details</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Financial Request Details</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Employee Number:</strong>
                            <p>{{ $financialRequest->emp_num }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Payee:</strong>
                            <p>{{ $financialRequest->payee }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Charge To:</strong>
                            <p>{{ $financialRequest->Chargeto }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Payment Form:</strong>
                            <p>{{ $financialRequest->PaymentForm }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Request Type:</strong>
                            <p>{{ $financialRequest->RequestType }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Amount:</strong>
                            <p>₱{{ number_format($financialRequest->Ammount, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ 
                                $financialRequest->status == 'pending' ? 'warning' : 
                                ($financialRequest->status == 'approved' ? 'success' : 
                                ($financialRequest->status == 'recommended' ? 'warning' : 'danger')) 
                            }}">{{ ucfirst($financialRequest->status) }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong>
                            <p>{{ $financialRequest->Date->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Purpose:</strong>
                            <p>{{ $financialRequest->purpose }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <h5>Uploaded Images</h5>
                        <div class="d-flex flex-wrap">
                            @foreach($images as $index => $image)
                                <div class="p-2">
                                    <img src="{{ asset('storage/financial_images/' . $image) }}" 
                                        class="img-fluid rounded shadow-sm image-thumbnail"
                                        alt="Uploaded Image" 
                                        style="max-width: 150px; cursor: pointer;"
                                        data-index="{{ $index }}" 
                                        data-src="{{ asset('storage/financial_images/' . $image) }}"
                                        onclick="openFullscreen(this)">
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 text-end">
                            @if(auth()->user()->user_role == 'Partners' && $empnum !== $financialRequest->emp_num)
                                <form action="{{ route('financial_req.update_status', ['uuid' => $financialRequest->uuid, 'status' => 'approved']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <form action="{{ route('financial_req.update_status', ['uuid' => $financialRequest->uuid, 'status' => 'rejected']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Disapprove</button>
                                </form>
                            @endif

                            @if(auth()->user()->user_role == 'HR Admin' && $empnum !== $financialRequest->emp_num)
                                <form action="{{ route('financial_req.update_status', ['uuid' => $financialRequest->uuid, 'status' => 'recommended']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Recommend</button>
                                </form>
                                <form action="{{ route('financial_req.update_status', ['uuid' => $financialRequest->uuid, 'status' => 'declined']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')      
                                    <button type="submit" class="btn btn-danger">Decline</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:history.back();" class="btn mb-3" style="background-color:#326C79; color:white; float:right;">Back to List</a>
        </div>
    </div>
</div>

<div id="fullscreenViewer" class="fullscreen-viewer" onclick="closeFullscreen()">
    <img id="fullscreenImage" class="fullscreen-image" alt="Full View">
    <button id="prevImage" class="nav-button left" onclick="event.stopPropagation(); navigateImage(-1)">&#10094;</button>
    <button id="nextImage" class="nav-button right" onclick="event.stopPropagation(); navigateImage(1)">&#10095;</button>
</div>

@include('partials.footer')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalImage = document.getElementById('modalImage');
        const images = document.querySelectorAll('.image-thumbnail');

        images.forEach(img => {
            img.addEventListener('click', function() {
                modalImage.src = this.getAttribute('data-bs-src');
            });
        });
    });

    function showImage(src) {
        document.getElementById('modalImage').src = src;
    }
</script>
<script>
    let currentIndex = 0;
    let images = [];

    document.addEventListener("DOMContentLoaded", function() {
        images = document.querySelectorAll('.image-thumbnail');
    });

    function openFullscreen(imgElement) {
        currentIndex = parseInt(imgElement.getAttribute('data-index'));
        document.getElementById('fullscreenImage').src = imgElement.getAttribute('data-src');
        document.getElementById('fullscreenViewer').style.display = "flex";
    }

    function closeFullscreen() {
        document.getElementById('fullscreenViewer').style.display = "none";
    }

    function navigateImage(direction) {
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = images.length - 1;
        if (currentIndex >= images.length) currentIndex = 0;
        
        let newImage = images[currentIndex];
        document.getElementById('fullscreenImage').src = newImage.getAttribute('data-src');
    }

    // Close on Esc key
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") closeFullscreen();
        if (event.key === "ArrowLeft") navigateImage(-1);
        if (event.key === "ArrowRight") navigateImage(1);
    });
</script>
