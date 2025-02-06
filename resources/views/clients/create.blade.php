@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')



    <link rel="stylesheet" href="{{ asset('/css/forms.css') }}">
<div class="container">
<div class="page-inner">
    <div class="container mt-5">
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
        <h3>CLIENT INFORMATION SHEET</h3>
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <!-- Radio Button for New or Old Client -->
            <div class="mb-3">
                <label class="form-label">Client Type</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="client_type" id="new_client" value="new" required onclick="toggleCheckboxes()">
                    <label class="form-check-label" for="new_client">New Client</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="client_type" id="old_client" value="old" required onclick="toggleCheckboxes()">
                    <label class="form-check-label" for="old_client">Old Client</label>
                </div>
            </div>



        <div class="row">

            <div class="col-4">

            <div class="mb-3">
                <label class="form-label">Registered Company Name</label>
                <input type="text" name="registered_company_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Registered Address</label>
                <input type="text" name="registered_address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address of Authorized Personnel</label>
                <input type="email" name="email_address_of_authorized_personnel" class="form-control" required>
            </div>
       
            </div>


            <div class="col-4">

            <div class="mb-3">
                <label class="form-label">Engagement Year</label>
                <input type="text" name="engagement_year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type of Engagement (Accounting, Agreed-upon, Audit, Tax)</label>
                <input type="text" name="type_of_engagement" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Authorized Personnel (In attention of Engagement)</label>
                <input type="text" name="authorized_personnel" class="form-control" required>
            </div>
            </div>
            

            <div class="col-4">
            <div class="mb-3">
                <label class="form-label">Position of Authorized Personnel</label>
                <input type="text" name="position_of_authorized_personnel" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Revenue for Current Year</label>
                <input type="number" name="revenue_for_current_year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prior Year's Auditor (if not MTC)</label>
                <input type="text" name="prior_years_auditor" class="form-control">
            </div>
            </div>



            </div>

            <h3>Client Distribution</h3>


        <div class="row">
            <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Address</label>
                <input type="text" name="delivery_address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Person</label>
                <input type="text" name="contact_person" class="form-control" required>
            </div>
            </div>
            <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email_address" class="form-control" required>
            </div>
            </div>
        </div>

            <h3>Client Service of Invoice</h3>

<div class="row">   
            <div class="mb-3 col-4">
                <label class="form-label">Tax Identification Number</label>
                <input type="text" name="tax_identification_number" class="form-control" required>
            </div>

            <div class="mb-3 col-4">
                <label class="form-label">Registered Company Name</label>
                <input type="text" name="registered_company_name" class="form-control" required>
            </div>

            <div class="mb-3 col-4">
                <label class="form-label">Registered Address</label>
                <input type="text" name="registered_address" class="form-control" required>
            </div>
</div>
            <!-- Dynamic Checkboxes for New/Old Client -->
            <div id="newClientCheckboxes" style="display:none;">
                <h5>Required Documents for New Client</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="latest_audited_financial_statement" id="latest_audited_financial_statement">
                    <label class="form-check-label" for="latest_audited_financial_statement">Latest Audited Financial Statement</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="bir_certificate_of_registration" id="bir_certificate_of_registration">
                    <label class="form-check-label" for="bir_certificate_of_registration">BIR Certificate of Registration</label>
                </div>
            </div>

            <div id="oldClientCheckboxes" style="display:none;">
                <h5>Required Documents for Old Client</h5>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="trial_balance_current_year" id="trial_balance_current_year" required>
                <label class="form-check-label" for="trial_balance_current_year">Trial balance for Current year</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
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