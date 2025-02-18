@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<style>
    .detail-label {
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }
    .detail-value {
        font-size: 16px;
        color: #555;
    }
    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
        color: #007bff;
    }
</style>

<div class="container">
    <div class="page-inner">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Clients</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">View Client</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">
                    <h5>Client Details</h5>
                    

                <div class="card">
                <div class="card-header text-white rounded-top p-1 d-flex align-items-center mt-5" style="background-color: #326C79">
                    <h6 class ="m-1">Client Information</h6>
                </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="detail-label">Client Type:</span> <span class="detail-value">{{ $client->NewClient ? 'New Client' : 'Old Client '  }}</span></p>
                            <p><span class="detail-label">Registered Company Name:</span> <span class="detail-value">{{ $client->registered_company_name }}</span></p>
                            <p><span class="detail-label">Registered Address:</span> <span class="detail-value">{{ $client->registered_address }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="detail-label">Email Address:</span> <span class="detail-value">{{ $client->email_address_of_authorized_personnel }}</span></p>
                            <p><span class="detail-label">Engagement Year:</span> <span class="detail-value">{{ $client->engagement_year }}</span></p>
                            <p><span class="detail-label">Type of Engagement:</span> <span class="detail-value">{{ $client->type_of_engagement }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="detail-label">Authorized Personnel:</span> <span class="detail-value">{{ $client->authorized_personnel }}</span></p>
                            <p><span class="detail-label">Position of Authorized Personnel:</span> <span class="detail-value">{{ $client->position_of_authorized_personnel }}</span></p>
                            <p><span class="detail-label">Revenue for Current Year:</span> <span class="detail-value">{{ $client->revenue_for_current_year }}</span></p>
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class="card">
                    <div class="card-header text-white rounded-top p-1 d-flex align-items-center"" style="background-color: #326C79">
                    <h6 class ="m-1">Client Distribution</h6>
                </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="detail-label">Company Name:</span> <span class="detail-value">{{ $clientDistribution->company_name }}</span></p>
                            <p><span class="detail-label">Delivery Address:</span> <span class="detail-value">{{ $clientDistribution->delivery_address }}</span></p>
                            <p><span class="detail-label">Contact Person:</span> <span class="detail-value">{{ $clientDistribution->contact_person }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="detail-label">Mobile Number:</span> <span class="detail-value">{{ $clientDistribution->mobile_number }}</span></p>
                            <p><span class="detail-label">Email Address:</span> <span class="detail-value">{{ $clientDistribution->email_address }}</span></p>
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="card">
                    <div class="card-header text-white rounded-top p-1 d-flex align-items-center"" style="background-color: #326C79">
                    <h6 class ="m-1">Client Service of Invoice</h6>
                </div>
                    <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="detail-label">Tax Identification Number:</span> <span class="detail-value">{{ $clientServiceOfInvoice->tax_identification_number }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="detail-label">Registered Company Name (Invoice):</span> <span class="detail-value">{{ $clientServiceOfInvoice->company_name }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="detail-label">Registered Address (Invoice):</span> <span class="detail-value">{{ $clientServiceOfInvoice->registered_address }}</span></p>
                        </div>
                    </div>

                    <div class="section-title" style="color: red;">Required Documents</div>
                    <div class="row">
                        <div class="col-12">
                            @if($client->NewClient== '1')
                                <p><span class="detail-label">Latest Audited Financial Statement:</span> <span class="detail-value">{{ $client->LAFS ? 'Provided' : 'Not Provided' }}</span></p>
                                <p><span class="detail-label">BIR Certificate of Registration:</span> <span class="detail-value">{{ $client->BIR_CoR ? 'Provided' : 'Not Provided' }}</span></p>
                                <p><span class="detail-label">Trial Balance for Current Year:</span> <span class="detail-value">{{ $client->TBCY ? 'Provided' : 'Not Provided' }}</span></p>
                                @else
                                <p><span class="detail-label">Trial Balance for Current Year:</span> <span class="detail-value">{{ $client->TBCY ? 'Provided' : 'Not Provided' }}</span></p>
                            @endif
                        </div>
                    </div>
       </div>
                    </div>
                </div>
            </div>
            <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Clients List
    </a>

        </div>
    </div>
</div>

@include('partials.footer')