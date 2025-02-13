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

            <div class="card">
                <div class="card-body">
                   

                    <!-- Announcements Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="announcementTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announcements as $key => $announcement)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->category }}</td>
                                        <td>{{ $announcement->createdBy }}</td>
                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- No Records Found Message -->
                    <div id="noRecordsMessage" class="text-center text-muted" style="display: none; font-size: 18px;">
                        No announcement records found.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

