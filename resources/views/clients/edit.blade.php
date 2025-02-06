@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<link rel="stylesheet" href="{{ asset('/css/forms.css') }}">

<style>
    .client-type-label {
        display: inline-block;
        padding: 10px 20px;
        border: 2px solid #ccc;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .client-type-label:hover {
        background-color: #f1f3f5;
    }
    .form-check-input:checked + .client-type-label {
        background-color: #ffde59;
        color: white;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }
</style>

<div class="container">
    <div class="page-inner">

        <div class="container ">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
                    <li class="breadcrumb-item text-muted">Manage Clients</li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Client</li>
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
                    <h3>Preparation of Engagement Letter</h3>
                    <form action="{{ route('clients.update', ['uuid' => $client->uuid]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Client Type</label><br>
                            <div class="form-check form-check-inline" style="margin-right: -30px;">
                                <input class="form-check-input visually-hidden" type="radio" name="client_type" id="client_type_new" value="new" required 
                                {{ old('NewClient', $client->NewClient) === '1' ? 'checked' : '' }} onclick="toggleCheckboxes()">
                                <label class="form-check-label client-type-label" for="client_type_new" id="label_client_type_new">New Client</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input visually-hidden" type="radio" name="client_type" id="client_type_old" value="old" required 
                                {{ old('NewClient', $client->NewClient) === '0' ? 'checked' : '' }} onclick="toggleCheckboxes()">
                                <label class="form-check-label client-type-label" for="client_type_old" id="label_client_type_old">Old Client</label>
                            </div>
                        </div>

                        <!-- Main Form Content with Responsive Grid -->
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Company Name</label>
                                    <input type="text" id="registered_company_name" name="registered_company_name" class="form-control" value="{{ old('registered_company_name', $client->registered_company_name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Registered Address</label>
                                    <input type="text" id="registered_address" name="registered_address" class="form-control" value="{{ old('registered_address', $client->registered_address) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address of Authorized Personnel</label>
                                    <input type="email" id="email_address_of_authorized_personnel" name="email_address_of_authorized_personnel" class="form-control" value="{{ old('email_address_of_authorized_personnel', $client->email_address_of_authorized_personnel) }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Engagement Year</label>
                                    <input type="text" id="engagement_year" name="engagement_year" class="form-control" value="{{ old('engagement_year', $client->engagement_year) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type of Engagement</label>
                                    <select id="type_of_engagement" name="type_of_engagement" class="form-control" required>
                                        <option value="" disabled>Select Type of Engagement</option>
                                        <option value="Accounting" {{ old('type_of_engagement', $client->type_of_engagement) === 'Accounting' ? 'selected' : '' }}>Accounting</option>
                                        <option value="Agreed-upon" {{ old('type_of_engagement', $client->type_of_engagement) === 'Agreed-upon' ? 'selected' : '' }}>Agreed-upon</option>
                                        <option value="Audit" {{ old('type_of_engagement', $client->type_of_engagement) === 'Audit' ? 'selected' : '' }}>Audit</option>
                                        <option value="Tax" {{ old('type_of_engagement', $client->type_of_engagement) === 'Tax' ? 'selected' : '' }}>Tax</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Authorized Personnel (In attention of Engagement)</label>
                                    <input type="text" id="authorized_personnel" name="authorized_personnel" class="form-control" value="{{ old('authorized_personnel', $client->authorized_personnel) }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Position of Authorized Personnel</label>
                                    <input type="text" id="position_of_authorized_personnel" name="position_of_authorized_personnel" class="form-control" value="{{ old('position_of_authorized_personnel', $client->position_of_authorized_personnel) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Revenue for Current Year</label>
                                    <input type="number" id="revenue_for_current_year" name="revenue_for_current_year" class="form-control" value="{{ old('revenue_for_current_year', $client->revenue_for_current_year) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Prior Year's Auditor (if not MTC)</label>
                                    <input type="text" id="prior_years_auditor" name="prior_years_auditor" class="form-control" value="{{ old('prior_years_auditor', $client->prior_years_auditor) }}">
                                </div>
                            </div>
                        </div>

                        <h3>Client Distribution</h3>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', $clientDistribution->company_name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Delivery Address</label>
                                    <input type="text" id="delivery_address" name="delivery_address" class="form-control" value="{{ old('delivery_address', $clientDistribution->delivery_address) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" id="contact_person" name="contact_person" class="form-control" value="{{ old('contact_person', $clientDistribution->contact_person) }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('mobile_number', $clientDistribution->mobile_number) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" id="email_address" name="email_address" class="form-control" value="{{ old('email_address', $clientDistribution->email_address) }}" required>
                                </div>
                            </div>
                        </div>

                        <h3>Client Service of Invoice</h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tax Identification Number</label>
                                    <input type="text" id="tax_identification_number" name="tax_identification_number" class="form-control" value="{{ old('tax_identification_number', $clientServiceOfInvoice->tax_identification_number) }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Company Name</label>
                                    <input type="text" id="invoice_registered_company_name" name="registered_company_name" class="form-control" value="{{ old('company_name', $clientServiceOfInvoice->company_name) }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Address</label>
                                    <input type="text" id="invoice_registered_address" name="registered_address" class="form-control" value="{{ old('registered_address', $clientServiceOfInvoice-> registered_address,
) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dynamic Checkboxes for New/Old Client -->
                        <div id="newClientCheckboxes" style="display:{{ old('NewClient', $client->NewClient) === '1' ? 'block' : 'none' }}">
                            <h5>Required Documents for New Client</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="latest_audited_financial_statement" name="latest_audited_financial_statement" 
                                {{ old('LAFS', $client->LAFS) ? 'checked' : '' }}>
                                <label class="form-check-label" for="latest_audited_financial_statement">Latest Audited Financial Statement</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bir_certificate_of_registration" name="bir_certificate_of_registration" 
                                {{ old('BIR_CoR', $client->BIR_CoR) ? 'checked' : '' }}>
                                <label class="form-check-label" for="bir_certificate_of_registration">BIR Certificate of Registration</label>
                            </div>
                        </div>

                        <div id="oldClientCheckboxes" style="display:{{ old('NewClient', $client->NewClient) === '0' ? 'block' : 'none' }}">
                            <h5>Existing Client Document</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="old_tax_compliance_certificate" name="old_tax_compliance_certificate" 
                                {{ old('TBCY', $client->TBCY) ? 'checked' : '' }}>
                                <label class="form-check-label" for="old_tax_compliance_certificate">Tax Compliance Certificate</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')

<script>
    // Function to toggle the visibility of checkboxes based on 'NewClient' selection
    function toggleClientCheckboxes() {
        const isNewClient = document.getElementById('client_type_new').checked;
        const isOldClient = document.getElementById('client_type_old').checked;

        // Show the checkboxes based on client type
        document.getElementById('newClientCheckboxes').style.display = isNewClient ? 'block' : 'none';
        document.getElementById('oldClientCheckboxes').style.display = isOldClient ? 'block' : 'none';
    }

    // Ensure the toggle function is called when the form is loaded or on change
    document.addEventListener('DOMContentLoaded', toggleClientCheckboxes);
</script>