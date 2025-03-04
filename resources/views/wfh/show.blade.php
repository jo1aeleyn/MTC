@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Work From Home</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">View WFH Details</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    @if($wfhRecords->isNotEmpty())
                        @php $wfh = $wfhRecords->first(); @endphp

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Date Filed</label>
                                <input type="date" value="{{ $wfh->Date_filed ?? '' }}" class="form-control" disabled>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Date of WFH</label>
                                <input type="date" value="{{ $wfh->Date_WFH ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Engagement</label>
                                <input type="text" value="{{ $wfh->Engagement ?? '' }}" class="form-control" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Client Name</label>
                                <input type="text" value="{{ $wfh->client_name ?? '' }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th colspan="2">Assigned Task/Deliverables</th>
                                        <th colspan="2">Task Completed/Output</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 15%;">Budgeted Time</th>
                                        <th style="width: 35%;">Details</th>
                                        <th style="width: 35%;">Summary of Work Done</th>
                                        <th style="width: 15%;">Time Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wfhRecords as $wfh)
                                        <tr>
                                            <td>
                                                <input type="number" value="{{ $wfh->Budgetted_time ?? '' }}" class="form-control form-control-sm" disabled>
                                            </td>
                                            <td>
                                                <textarea class="form-control form-control-sm" rows="2" disabled>{{ $wfh->Details ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control form-control-sm" rows="2" disabled>{{ $wfh->SummaryOfWorkDone ?? '' }}</textarea>
                                            </td>
                                            <td>
                                                <input type="time" value="{{ $wfh->TimeSubmitted ?? '' }}" class="form-control form-control-sm" disabled>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Buttons: Only visible to Partners and if IsArchived is false -->
                        @if(auth()->user()->user_role === 'Partners' && !$wfh->IsArchived)
                            <div class="mt-4">
                                <form action="{{ route('wfh.approve', $wfh->uuid) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>

                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapproveModal">
                                    Disapprove
                                </button>
                            </div>
                        @endif

                    @else
                        <p class="text-center text-danger">No records found.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Disapprove Modal -->
<div class="modal fade" id="disapproveModal" tabindex="-1" aria-labelledby="disapproveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Added 'modal-dialog-centered' -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disapproveModalLabel">Reason for Disapproval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('wfh.disapprove', $wfh->uuid) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <textarea name="disapproval_reason" class="form-control" rows="4" required placeholder="Enter reason for disapproval..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


@include('partials.footer')
