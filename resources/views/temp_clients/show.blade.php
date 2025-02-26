@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Temporary Clients</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">View Temporary Client Details</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h5>Temporary Client Details</h5>
                    <form>
                        @csrf
                        <div class="row">

                            <!-- Requested By -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Requested By</label>
                                    <input type="text" class="form-control" value="{{ $tempClient->requestedByEmployee->surname }}, {{ $tempClient->requestedByEmployee->first_name }}" readonly>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" value="{{ $tempClient->department->DepartmentName }}" readonly>
                                </div>
                            </div>

                            <!-- Client Name -->
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name</label>
                                    <input type="text" class="form-control" value="{{ $tempClient->client->registered_company_name }}" readonly>
                                </div>
                            </div>

                            <!-- Purpose -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Purpose</label>
                                    <textarea class="form-control" readonly>{{ $tempClient->purpose }}</textarea>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('temp.clients.index') }}" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
                            Back to List
                        </a>    

                     
                            <button type="button" class="btn mb-3" style="background-color:#FF9800; color:white; float:right;" 
                                onclick="updateStatus('{{ $tempClient->id }}', 'Recommended')">
                                Recommend
                            </button>
                     

                        @if(auth()->user()->user_role === 'Partners')
                            <button type="button" class="btn mb-3" style="background-color:#4CAF50; color:white; float:right;" 
                                onclick="updateStatus('{{ $tempClient->id }}', 'Approved')">
                                Approve
                            </button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateStatus(tempClientId, newStatus) {
        fetch(`/temp-clients/${tempClientId}/update-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('temp.clients.index') }}?success=" + encodeURIComponent(data.message);
            } else {
                alert('Failed to update status');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@include('partials.footer')
