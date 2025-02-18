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
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $announcement->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="a" {{ $announcement->category == 'a' ? 'selected' : '' }}>a</option>
                                <option value="b" {{ $announcement->category == 'b' ? 'selected' : '' }}>b</option>
                                <option value="c" {{ $announcement->category == 'c' ? 'selected' : '' }}>c</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" required>{{ old('content', $announcement->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image (Optional)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if($announcement->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/announcements/' . $announcement->image) }}" alt="Current Image" width="150">
                                </div>
                            @endif
                        </div>

                  
                    </form>

                </div>
            </div>
        </div>
        <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Announcements List
    </a>
            <button type="submit" class="btn mb-3" style="float:right; background-color: #326C79; color:white;">Update Announcement</button>
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
        ]
    });
</script>
</body>
</html>
