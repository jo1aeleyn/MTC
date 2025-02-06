<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
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

        <h2>Create Client</h2>
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

            <h4>Client Distribution</h4>

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

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email_address" class="form-control" required>
            </div>

            <h4>Client Service of Invoice</h4>

            <div class="mb-3">
    <label class="form-label">Tax Identification Number</label>
    <input type="text" name="tax_identification_number" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Registered Company Name</label>
    <input type="text" name="registered_company_name" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Registered Address</label>
    <input type="text" name="registered_address" class="form-control" required>
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
</body>
</html>
