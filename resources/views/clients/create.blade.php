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
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Create New Client</li>
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
                    <h5>Preparation of Engagement Letter</h5>
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Client Type</label><br>
                            <div class="form-check form-check-inline" style="margin-right: -30px;">
                                <input class="form-check-input visually-hidden" type="radio" name="client_type" id="client_type_new" value="new" required onclick="toggleCheckboxes()">
                                <label class="form-check-label client-type-label" for="client_type_new" id="label_client_type_new">New Client</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input visually-hidden" type="radio" name="client_type" id="client_type_old" value="old" required onclick="toggleCheckboxes()">
                                <label class="form-check-label client-type-label" for="client_type_old" id="label_client_type_old">Old Client</label>
                            </div>
                        </div>

                        <!-- Main Form Content with Responsive Grid -->
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Company Name</label>
                                    <input type="text" id="registered_company_name" name="registered_company_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Registered Address</label>
                                    <input type="text" id="registered_address" name="registered_address" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address of Authorized Personnel</label>
                                    <input type="email" id="email_address_of_authorized_personnel" name="email_address_of_authorized_personnel" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Engagement Year</label>
                                    <input type="text" id="engagement_year" name="engagement_year" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type of Engagement</label>
                                    <select id="type_of_engagement" name="type_of_engagement" class="form-control" required>
                                        <option value="" disabled selected>Select Type of Engagement</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Agreed-upon">Agreed-upon</option>
                                        <option value="Audit">Audit</option>
                                        <option value="Tax">Tax</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Authorized Personnel (In attention of Engagement)</label>
                                    <input type="text" id="authorized_personnel" name="authorized_personnel" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Position of Authorized Personnel</label>
                                    <input type="text" id="position_of_authorized_personnel" name="position_of_authorized_personnel" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Revenue for Current Year</label>
                                    <input type="number" id="revenue_for_current_year" name="revenue_for_current_year" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Prior Year's Auditor (if not MTC)</label>
                                    <input type="text" id="prior_years_auditor" name="prior_years_auditor" class="form-control">
                                </div>
                            </div>
                        </div>

                        <h5>Client Distribution</h5>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Delivery Address</label>
                                    <input type="text" id="delivery_address" name="delivery_address" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" id="contact_person" name="contact_person" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" id="email_address" name="email_address" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <h5>Client Service of Invoice</h5>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tax Identification Number</label>
                                    <input type="text" id="tax_identification_number" name="tax_identification_number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Company Name</label>
                                    <input type="text" id="invoice_registered_company_name" name="registered_company_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Registered Address</label>
                                    <input type="text" id="invoice_registered_address" name="registered_address" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dynamic Checkboxes for New/Old Client -->
                        <div id="newClientCheckboxes" style="display:none;">
                            <h5>Required Documents for New Client</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="latest_audited_financial_statement" name="latest_audited_financial_statement">
                                <label class="form-check-label" for="latest_audited_financial_statement">Latest Audited Financial Statement</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bir_certificate_of_registration" name="bir_certificate_of_registration">
                                <label class="form-check-label" for="bir_certificate_of_registration">BIR Certificate of Registration</label>
                            </div>
                        </div>

                        <div id="oldClientCheckboxes" style="display:none;">
                            <h5>Required Documents for Old Client</h5>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="trial_balance_current_year" name="trial_balance_current_year" required>
                            <label class="form-check-label" for="trial_balance_current_year">Trial balance for Current year</label>
                        </div>

                    
                </div>
            </div>
            <div style="text-align: left;">
    <a href="javascript:history.back()" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Client List
    </a>
</div>
            <button type="submit" class="btn mb-3" style="background-color:#326C79; color: white; float:right;">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleCheckboxes() {
        const clientType = document.querySelector('input[name="client_type"]:checked').value;
        const newClientCheckboxes = document.getElementById('newClientCheckboxes');
        const oldClientCheckboxes = document.getElementById('oldClientCheckboxes');
        
        if (clientType === 'new') {
            newClientCheckboxes.style.display = 'block';
            oldClientCheckboxes.style.display = 'none';
        } else {
            newClientCheckboxes.style.display = 'none';
            oldClientCheckboxes.style.display = 'block';
        }
    }
</script>

@include('partials.footer')
