@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Announcements</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Announcement</li>
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
                    <h5>Edit Announcement</h5>
                    <form action="{{ route('announcements.update', $announcement->uuid) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                        @if($announcement->image)
                            <div class="mt-2 d-flex justify-content-center">
                                <img src="{{ asset('storage/announcements/' . $announcement->image) }}" alt="Current Image" width="300">
                            </div>
                        @endif
                            <label for="image" class="form-label">Image (Optional)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                     
                        </div>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $announcement->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="a" {{ $announcement->category == 'General Updates' ? 'selected' : '' }}>General Updates</option>
                                <option value="b" {{ $announcement->category == 'Events' ? 'selected' : '' }}>Events</option>
                                <option value="c" {{ $announcement->category == 'Policy Changes' ? 'selected' : '' }}>Policy Changes</option>
                                <option value="a" {{ $announcement->category == 'Employee Recognition' ? 'selected' : '' }}>Employee Recognition</option>
                                <option value="b" {{ $announcement->category == 'Internal Communications' ? 'selected' : '' }}>Internal Communications</option>
                                <option value="c" {{ $announcement->category == 'Legal Updates' ? 'selected' : '' }}>Legal Updates</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" required>{{ old('content', $announcement->content) }}</textarea>
                        </div>

                  
                        <button type="submit" class="btn mb-3" style="float:right; background-color: #326C79; color:white;">Update Announcement</button>
                
                    </form>

                </div>
            </div>
            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Announcements List
    </a>
        </div>
        
            
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
</script>
</body>
</html>
