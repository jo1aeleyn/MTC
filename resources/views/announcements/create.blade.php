@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    .cke_dialog_ui_hbox_child span.cke_reset {
    display: none !important;
}

</style>

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Announcements</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Announcement</li>
                </ol>
            </nav>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5>Create Announcement</h5>
                    <form action="{{ route('announcements.store') }}" method="POST" id="announcementForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload with Preview -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image (Optional)</label>
                            <!-- Placeholder Image Preview -->
                            <div class="d-flex justify-content-center mb-2">
                                <img id="image_preview" src="https://via.placeholder.com/150" alt="Image Preview" class="img-thumbnail" style="max-width: 300px; display: none;">
                            </div>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="General Updates">General Updates</option>
                                <option value="Events">Events</option>
                                <option value="Policy Changes">Policy Changes</option>
                                <option value="Employee Recognition">Employee Recognition</option>
                                <option value="Internal Communications">Internal Communications</option>
                                <option value="Legal Updates">Legal Updates</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn mb-2" style="float:right; color:white; background-color: #326C79;">Create Announcement</button>

                </div>
            </div>
            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Announcements List
    </a>
        </div>
    
        
            </form>
           
    </div>
</div>

@include('partials.footer')

<script>
    CKEDITOR.replace('content', {
        height: 300,
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
            { name: 'insert', items: ['Link', 'Image', 'Table'] },
            { name: 'styles', items: ['Format', 'FontSize'] }
        ],
        removePlugins: 'securityNotification' // Hide security warning
    });

    // Function to hide the CKEditor security warning instantly
    function removeSecurityWarning() {
        let securityWarning = document.querySelector('.cke_notification');
        if (securityWarning) {
            securityWarning.remove(); // Remove warning from DOM instantly
        }
    }

    // Observe DOM changes and remove the warning as soon as it appears
    const observer = new MutationObserver(() => {
        removeSecurityWarning();
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Run once immediately in case the warning is already present
    removeSecurityWarning();
</script>


</body>

<script>
    // Function to preview the image when a user selects a file
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('image_preview');
            preview.style.display = 'block'; // Show the preview
            preview.src = reader.result; // Set the preview image source
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</html>
