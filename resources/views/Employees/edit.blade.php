@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')

<div class="container">
<div class="page-inner">
        <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
            <li class="breadcrumb-item text-muted">Manage Employee</li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Edit Employee</li>
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
            <form method="POST" action="{{ route('employee.update', $employee->uuid) }}" method="POST" method="POST" enctype="multipart/form-data">
                @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-body">
                <h3>Application Details</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="referred_by" class="form-label">Referred By</label>
                        <input
                        type="text"
                        class="form-control"
                        id="referred_by"
                        name="referred_by"
                        value=" {{ old('referred_by', $application->referred_by) }}"

                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_applied" class="form-label">Date Applied</label>
                        <input
                            type="date"
                            class="form-control"
                            id="date_applied"
                            name="date_applied"
                            required
                            value="{{ old('date_applied', $application->date_applied) }}"

                        >
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_hired" class="form-label">Date Hired</label>
                        <input
                            type="date"
                            class="form-control"
                            id="date_hired"
                            name="date_hired"
                            required
                            value="{{ old('date_hired', $application->date_hired) }}"

                        >

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input
                        type="text"
                        class="form-control"
                        id="position"
                        name="position"
                        required
                        value=" {{ old('position', $application->position) }}"
                        >
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
    <label for="employment_status" class="form-label">Employment Status</label>
    <select
        class="form-control"
        id="employment_status"
        name="employment_status"
        required
        style="background-color: #E2E2E2;">
        <option value="Probationary" {{ old('employment_status', $application->EmploymentStatus) == 'Probationary' ? 'selected' : '' }}>Probationary</option>
        <option value="Regular" {{ old('employment_status', $application->EmploymentStatus) == 'Regular' ? 'selected' : '' }}>Regular</option>
        <option value="Contractual" {{ old('employment_status', $application->EmploymentStatus) == 'Contractual' ? 'selected' : '' }}>Contractual</option>
        <option value="Temporary" {{ old('employment_status', $application->EmploymentStatus) == 'Temporary' ? 'selected' : '' }}>Temporary</option>
    </select>
</div>

                </div>


                <h3>Company Details</h3>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="AccessCard_release" class="form-label">Access Card Release Date</label>
        <input
            type="date"
            class="form-control"
            id="AccessCard_release"
            name="AccessCard_release"
            value="{{ old('AccessCard_release', $company->AccessCard_release) }}"
            required
        >
    </div>
    <div class="col-md-6 mb-3">
        <label for="AccesCard_return" class="form-label">Access Card Return Date</label>
        <input
            type="date"
            class="form-control"
            id="AccesCard_return"
            name="AccesCard_return"
            value="{{ old('AccesCard_return', $company->AccesCard_return) }}"
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="CompanyEmail" class="form-label">Company Email</label>
        <input
            type="email"
            class="form-control"
            id="CompanyEmail"
            name="CompanyEmail"
            value="{{ old('CompanyEmail', $company->CompanyEmail) }}"
            required
        >
    </div>
    <div class="col-md-6 mb-3">
        <label for="PayrollAccount" class="form-label">Payroll Account</label>
        <input
            type="text"
            class="form-control"
            id="PayrollAccount"
            name="PayrollAccount"
            value="{{ old('PayrollAccount', $company->PayrollAccount) }}"
            required
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="Cocolife_HMO" class="form-label">Cocolife HMO</label>
        <input
            type="text"
            class="form-control"
            id="Cocolife_HMO"
            name="Cocolife_HMO"
            value="{{ old('Cocolife_HMO', $company->Cocolife_HMO) }}"
        >
    </div>
    <div class="col-md-6 mb-3">
        <label for="Cocolife_ReleaseDate" class="form-label">Cocolife Release Date</label>
        <input
            type="date"
            class="form-control"
            id="Cocolife_ReleaseDate"
            name="Cocolife_ReleaseDate"
            value="{{ old('Cocolife_ReleaseDate', $company->Cocolife_ReleaseDate) }}"
        >
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="Cocolife_ReturnDate" class="form-label">Cocolife Return Date</label>
        <input
            type="date"
            class="form-control"
            id="Cocolife_ReturnDate"
            name="Cocolife_ReturnDate"
            value="{{ old('Cocolife_ReturnDate', $company->Cocolife_ReturnDate) }}"
        >
    </div>
</div>

                <h3>Personal Information</h3>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input
            type="text"
            class="form-control"
            id="surname"
            name="surname"
            required
            value="{{ old('surname', $employee->surname) }}"
        >
    </div>
    <div class="col-md-4 mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input
            type="text"
            class="form-control"
            id="first_name"
            name="first_name"
            required
            value=" {{ old('first_name', $employee->first_name) }}"
        >
    </div>
    <div class="col-md-4 mb-3">
        <label for="middle_name" class="form-label">Middle Name</label>
        <input
            type="text"
            class="form-control"
            id="middle_name"
            name="middle_name"
            value=" {{ old('middle_name', $employee->middle_name) }}"
        >
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="nickname" class="form-label">Nickname</label>
        <input
            type="text"
            class="form-control"
            id="nickname"
            name="nickname"
            value=" {{ old('nickname', $employee->nickname) }}"
        >
    </div>
    <div class="col-md-4 mb-3">
        <label for="birthdate" class="form-label">Birthdate</label>
        <input
            type="date"
            class="form-control"
            id="birthdate"
            name="birthdate"
            required
            value="{{ old('birthdate', $employee->birthdate) }}"
        >
    </div>
    <div class="col-md-4 mb-3">
        <label for="Birthplace" class="form-label">Birthplace</label>
        <input
            type="text"
            class="form-control"
            id="Birthplace"
            name="Birthplace"
            value=" {{ old('Birthplace', $employee->Birthplace) }}"
        >
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-4">
        <label for="sex" class="form-label">Sex</label>
        <select class="form-control" id="sex" name="sex" required>
            <option value="">Select</option>
            <option value="Male" {{ old('sex', $employee->sex) === 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('sex', $employee->sex) === 'Female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>
    <div class="col-md-3 mb-4">
        <label for="civil_status" class="form-label">Civil Status</label>
        <select class="form-control" id="civil_status" name="civil_status" required>
            <option value="">Select</option>
            <option value="Single" {{ old('civil_status', $employee->civil_status) === 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Married" {{ old('civil_status', $employee->civil_status) === 'Married' ? 'selected' : '' }}>Married</option>
            <option value="Widowed" {{ old('civil_status', $employee->civil_status) === 'Widowed' ? 'selected' : '' }}>Widowed</option>
        </select>
    </div>
    <div class="col-md-3 mb-4">
        <label for="nationality" class="form-label">Nationality</label>
        <input
            type="text"
            class="form-control"
            id="nationality"
            name="nationality"
            value=" {{ old('nationality', $employee->nationality) }}"
        >
    </div>

    <div class="col-lg-3 mb-4">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employee->address) }}" required>
    </div>
</div>
<div class="row">

<div class="col-md-3 mb-3">
    <label for="Religion" class="form-label">Religion</label>
    <select class="form-control" id="Religion" name="Religion" required>
        <option value="" disabled>Select Religion</option>
        <option value="Catholic" {{ old('Religion', $employee->religion) == 'Catholic' ? 'selected' : '' }}>Catholic</option>
        <option value="Christianity" {{ old('Religion', $employee->religion) == 'Christianity' ? 'selected' : '' }}>Christianity</option>
        <option value="Iglesia ni Cristo" {{ old('Religion', $employee->religion) == 'Iglesia ni Cristo' ? 'selected' : '' }}>Iglesia ni Cristo</option>
        <option value="Islam" {{ old('Religion', $employee->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
        <option value="Hinduism" {{ old('Religion', $employee->religion) == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
        <option value="Buddhism" {{ old('Religion', $employee->religion) == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
        <option value="Judaism" {{ old('Religion', $employee->religion) == 'Judaism' ? 'selected' : '' }}>Judaism</option>
        <option value="Folk Religion" {{ old('Religion', $employee->religion) == 'Folk Religion' ? 'selected' : '' }}>Folk Religion</option>
        <option value="Other" {{ old('Religion', $employee->religion) == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>


    <div class="col-md-3 mb-3">
    <label for="BloodType" class="form-label">Blood Type</label>
    <select class="form-control" id="BloodType" name="BloodType" required>
        <option value="">Select</option>
        <option value="A+" {{ old('BloodType', $employee->blood_type) === 'A+' ? 'selected' : '' }}>A+</option>
        <option value="A-" {{ old('BloodType', $employee->blood_type) === 'A-' ? 'selected' : '' }}>A-</option>
        <option value="B+" {{ old('BloodType', $employee->blood_type) === 'B+' ? 'selected' : '' }}>B+</option>
        <option value="B-" {{ old('BloodType', $employee->blood_type) === 'B-' ? 'selected' : '' }}>B-</option>
        <option value="AB+" {{ old('BloodType', $employee->blood_type) === 'AB+' ? 'selected' : '' }}>AB+</option>
        <option value="AB-" {{ old('BloodType', $employee->blood_type) === 'AB-' ? 'selected' : '' }}>AB-</option>
        <option value="O+" {{ old('BloodType', $employee->blood_type) === 'O+' ? 'selected' : '' }}>O+</option>
        <option value="O-" {{ old('BloodType', $employee->blood_type) === 'O-' ? 'selected' : '' }}>O-</option>
    </select>
</div>


    <div class="col-md-3 mb-3">
        <label for="contact_num" class="form-label">Contact Number</label>
        <input
            type="text"
            class="form-control"
            id="contact_num"
            name="contact_num"
            pattern="09[0-9]{9}"
            title="Please enter a valid Philippine number starting with 09 and containing 11 digits."
            required
            value=" {{ old('contact_num', $employee->contact_num) }}"
        >
    </div>
    <div class="col-md-3 mb-3   ">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            required
            value=" {{ old('email', $employee->email) }}"
        >
    </div>
</div>


                <div id="familyBackgroundSection">
                    <h3>Family Background</h3>
                    <div id="familyBackgroundWrapper">
                        @forelse ($family as $index => $member)
                            <div class="familyBackgroundRow mb-3 row">
                                <!-- Name -->
                                <div class="col-md-4 mb-3">
                                    <input
                                        type="text"
                                        name="family_background[{{ $index }}][name]"
                                        id ="famname"
                                        class="form-control"
                                        placeholder="Name"
                                        value="{{ old('family_background.' . $index . '.name', $member->name) }}"
                                        required>
                                </div>
                                <!-- Relationship -->
                                <div class="col-md-4 mb-3">
                                    <select
                                        name="family_background[{{ $index }}][relationship]"
                                        class="form-control"
                                        id="famrelation"
                                        required>
                                        <option value="" selected disabled>Select Relationship</option>
                                        <option value="Mother" {{ old('family_background.' . $index . '.relationship', $member->relationship) == 'Mother' ? 'selected' : '' }}>Mother</option>
                                        <option value="Father" {{ old('family_background.' . $index . '.relationship', $member->relationship) == 'Father' ? 'selected' : '' }}>Father</option>
                                        <option value="Sibling" {{ old('family_background.' . $index . '.relationship', $member->relationship) == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                                    </select>
                                </div>
                                <!-- Occupation -->
                                <div class="col-md-4 mb-3">
                                    <input
                                        type="text"
                                        name="family_background[{{ $index }}][occupation]"
                                        class="form-control"
                                        id="famoccupation"
                                        placeholder="Occupation"
                                        value="{{ old('family_background.' . $index . '.occupation', $member->occupation) }}"
                                        >
                                </div>
                                <!-- Birthdate -->
                                <div class="col-md-4 mb-3">
                                    <input
                                        type="date"
                                        name="family_background[{{ $index }}][birthdate]"
                                        class="form-control"
                                        id="fambdate"
                                        value="{{ old('family_background.' . $index . '.birthdate', $member->birthdate) }}"
                                        placeholder="Birthdate"
                                      >
                                </div>
                                <!-- Address -->
                                <div class="col-md-4 mb-3">
                                    <input
                                        type="text"
                                        name="family_background[{{ $index }}][address]"
                                        class="form-control"
                                        id="famaddress"
                                        placeholder="Address"
                                        value="{{ old('family_background.' . $index . '.address', $member->address) }}"
                                 >
                                </div>
                                <!-- Phone -->
                                <div class="col-md-4 mb-3">
                                    <input
                                        type="text"
                                        name="family_background[{{ $index }}][phone]"
                                        class="form-control"
                                        placeholder="Phone"
                                        id="famphone"
                                        pattern="09[0-9]{9}"
                                        title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits."
                                        value="{{ old('family_background.' . $index . '.phone', $member->phone) }}"
                                      >
                                </div>

                        @empty
                            <p>No family background data found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-12 mb-3" style="text-align: center;">
                            <button type="button" id="addFamilyBackground" class="btn btn-secondary mb-3">Add More</button>
                </div>
            </div>

            <div id="emergencyContactWrapper">
                <h3>Emergency</h3>
                @forelse ($emergencyContacts as $index => $contact)
                    <div class="emergencyContactRow mb-3 row">
                        <!-- Name -->
                        <div class="col-md-3 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[{{ $index }}][name]"
                                id="emergencyname"
                                class="form-control"
                                placeholder="Name"
                                value="{{ old('emergency_contacts.' . $index . '.name', $contact->name) }}"

                                required>
                        </div>
                        <!-- Relationship -->
                        <div class="col-md-3 mb-3">
                            <select
                                name="emergency_contacts[{{ $index }}][relationship]"
                                class="form-control"
                                id="emergencyrel"
                                required>
                                <option value="" selected disabled>Select Relationship</option>
                                <option value="Mother" {{ old('emergency_contacts.' . $index . '.relationship', $contact->relationship) == 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Father" {{ old('emergency_contacts.' . $index . '.relationship', $contact->relationship) == 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Sibling" {{ old('emergency_contacts.' . $index . '.relationship', $contact->relationship) == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="col-md-3 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[{{ $index }}][address]"
                                id="emergencyaddress"
                                class="form-control"
                                placeholder="Address"
                                value="{{ old('emergency_contacts.' . $index . '.address', $contact->address) }}"
                                style="background-color: #E2E2E2;">
                        </div>
                        <!-- Contact Number -->
                        <div class="col-md-3 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[{{ $index }}][contact_num]"
                                class="form-control"
                                id="emergencynumber"
                                placeholder="Contact Number"
                                pattern="09[0-9]{9}"
                                title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits."
                                value="{{ old('emergency_contacts.' . $index . '.contact_num', $contact->contact_num) }}"
                                style="background-color: #E2E2E2;"
                                required>
                        </div>

                    </div>
                @empty
                    <!-- Display an empty row if no emergency contact exists -->
                    <div class="emergencyContactRow mb-3 row">
                        <div class="col-md-4 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[0][name]"
                                class="form-control"
                                placeholder="Name"
                                value="{{ old('emergency_contacts.0.name') }}"
                                style="background-color: #E2E2E2;"
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select
                                name="emergency_contacts[0][relationship]"
                                class="form-control"
                                style="background-color: #E2E2E2;"
                                required>
                                <option value="" selected disabled>Select Relationship</option>
                                <option value="Mother" {{ old('emergency_contacts.0.relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Father" {{ old('emergency_contacts.0.relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Sibling" {{ old('emergency_contacts.0.relationship') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[0][address]"
                                class="form-control"
                                placeholder="Address"
                                value="{{ old('emergency_contacts.0.address') }}"
                                style="background-color: #E2E2E2;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input
                                type="text"
                                name="emergency_contacts[0][contact_num]"
                                class="form-control"
                                placeholder="Contact Number"
                                pattern="09[0-9]{9}"
                                title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits."
                                value="{{ old('emergency_contacts.0.contact_num') }}"
                                style="background-color: #E2E2E2;"
                                required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="button" class="removeRow btn btn-danger">Remove</button>
                        </div>
                    </div>
                @endforelse

                <div class="col-md-12 mb-3" style="text-align: center;">
                     <button type="button" id="addEmergencyContact" class="btn btn-secondary mb-3">Add More</button>
                </div>

            </div>

        <h3>Employment Information</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="tin_num" class="form-label">TIN Number</label>
                <input
                type="text"
                class="form-control"
                id="tin_num"
                name="tin_num"
                value=" {{ old('tin_num', $employee->tin_num) }}"
            >
            </div>
            <div class="col-md-4 mb-3">
                <label for="sss_num" class="form-label">SSS Number</label>
                <input
                type="text"
                class="form-control"
                id="sss_num"
                name="sss_num"
                value=" {{ old('sss_num', $employee->sss_num) }}"
             >
            </div>
            <div class="col-md-4 mb-3">
                <label for="pag_ibig_num" class="form-label">Pag-Ibig Number</label>
                <input
                type="text"
                class="form-control"
                id="pag_ibig_num"
                name="pag_ibig_num"
                value=" {{ old('pag_ibig_num', $employee->pag_ibig_num) }}"
              >
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="philhealth_num" class="form-label">PhilHealth Number</label>
                <input
                type="text"
                class="form-control"
                id="philhealth_num"
                name="philhealth_num"
                value=" {{ old('philhealth_num', $employee->philhealth_num) }}"
       >
            </div>
            <div class="col-md-6 mb-3">
            <label for="tax_status" class="form-label">Tax Status</label>
<select
    class="form-control"
    id="tax_status"
    name="tax_status"
    required>
    <option value="" selected disabled>Select Tax Status</option>
    <option value="Single" {{ old('tax_status', $employee->tax_status) == 'Single' ? 'selected' : '' }}>Single</option>
    <option value="HF1" {{ old('tax_status', $employee->tax_status) == 'HF1' ? 'selected' : '' }}>HF1</option>
    <option value="HF2" {{ old('tax_status', $employee->tax_status) == 'HF2' ? 'selected' : '' }}>HF2</option>
    <option value="Married without children (MOSE)" {{ old('tax_status', $employee->tax_status) == 'Married without children (MOSE)' ? 'selected' : '' }}>
        Married without children (MOSE)
    </option>
    <option value="M1OSE" {{ old('tax_status', $employee->tax_status) == 'M1OSE' ? 'selected' : '' }}>M1OSE</option>
    <option value="M2OSE" {{ old('tax_status', $employee->tax_status) == 'M2OSE' ? 'selected' : '' }}>M2OSE</option>
    <option value="M3OSE" {{ old('tax_status', $employee->tax_status) == 'M3OSE' ? 'selected' : '' }}>M3OSE</option>
    <option value="M4OSE" {{ old('tax_status', $employee->tax_status) == 'M4OSE' ? 'selected' : '' }}>M4OSE</option>
    <option value="Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)"
        {{ old('tax_status', $employee->tax_status) == 'Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)' ? 'selected' : '' }}>
        Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)
    </option>
    <option value="Other" {{ old('tax_status', $employee->tax_status) == 'Other' ? 'selected' : '' }}>Other</option>
</select>

    </div>
</div>

<!-- Employment History Section -->
<div class="employment-history">
    <h3>Employment History</h3>

    <!-- Even if no records, display the form -->
    @foreach ($employment as $index => $history)
        <div class="employment-item mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_{{ $index }}" class="form-label">Date:</label>
                    <input
                        type="date"
                        name="employment_history[{{ $index }}][date]"
                        value="{{ old('employment_history.' . $index . '.date', $history->date ?? '') }}"
                        id="date_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="position_{{ $index }}" class="form-label">Position:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][position]"
                        value="{{ old('employment_history.' . $index . '.position', $history->position ?? '') }}"
                        id="position_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="salary_{{ $index }}" class="form-label">Salary:</label>
                    <input
                        type="number"
                        name="employment_history[{{ $index }}][salary]"
                        value="{{ old('employment_history.' . $index . '.salary', $history->salary ?? '') }}"
                        id="salary_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="superior_{{ $index }}" class="form-label">Superior:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][superior]"
                        value="{{ old('employment_history.' . $index . '.superior', $history->superior ?? '') }}"
                        id="superior_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="department_{{ $index }}" class="form-label">Department:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][department]"
                        value="{{ old('employment_history.' . $index . '.department', $history->department ?? '') }}"
                        id="department_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="address_{{ $index }}" class="form-label">Address:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][address]"
                        value="{{ old('employment_history.' . $index . '.address', $history->address ?? '') }}"
                        id="address_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="company_{{ $index }}" class="form-label">Company:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][company]"
                        value="{{ old('employment_history.' . $index . '.company', $history->company ?? '') }}"
                        id="company_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="telephone_{{ $index }}" class="form-label">Telephone:</label>
                    <input
                        type="text"
                        name="employment_history[{{ $index }}][telephone]"
                        value="{{ old('employment_history.' . $index . '.telephone', $history->telephone ?? '') }}"
                        id="telephone_{{ $index }}"
                        class="form-control"
                        pattern="\d{2}-\d{7}"
                        style="background-color: #E2E2E2;"
                        title="Please enter a valid telephone number in the format 02-1234567."
                        required
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="reason_for_leaving_{{ $index }}" class="form-label">Reason for Leaving:</label>
                    <textarea
                        name="employment_history[{{ $index }}][reason_for_leaving]"
                        id="reason_for_leaving_{{ $index }}"
                        style="background-color: #E2E2E2;"
                        class="form-control">{{ old('employment_history.' . $index . '.reason_for_leaving', $history->reason_for_leaving ?? '') }}</textarea>
                </div>
            </div>
        </div>
    @endforeach

    <!-- If no records, display empty fields for a new entry -->
    @if($employment->isEmpty())
        <div class="employment-item mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_0" class="form-label">Date:</label>
                    <input
                        type="date"
                        name="employment_history[0][date]"
                        value="{{ old('employment_history.0.date') }}"
                        id="date_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="position_0" class="form-label">Position:</label>
                    <input
                        type="text"
                        name="employment_history[0][position]"
                        value="{{ old('employment_history.0.position') }}"
                        id="position_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="salary_0" class="form-label">Salary:</label>
                    <input
                        type="number"
                        name="employment_history[0][salary]"
                        value="{{ old('employment_history.0.salary') }}"
                        id="salary_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="superior_0" class="form-label">Superior:</label>
                    <input
                        type="text"
                        name="employment_history[0][superior]"
                        value="{{ old('employment_history.0.superior') }}"
                        id="superior_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="department_0" class="form-label">Department:</label>
                    <input
                        type="text"
                        name="employment_history[0][department]"
                        value="{{ old('employment_history.0.department') }}"
                        id="department_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="address_0" class="form-label">Address:</label>
                    <input
                        type="text"
                        name="employment_history[0][address]"
                        value="{{ old('employment_history.0.address') }}"
                        id="address_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="company_0" class="form-label">Company:</label>
                    <input
                        type="text"
                        name="employment_history[0][company]"
                        value="{{ old('employment_history.0.company') }}"
                        id="company_0"
                        style="background-color: #E2E2E2;"
                        class="form-control"
                    >
                </div>
                <div class="col-md-6">
                    <label for="telephone_0" class="form-label">Telephone:</label>
                    <input
                        type="text"
                        name="employment_history[0][telephone]"
                        value="{{ old('employment_history.0.telephone') }}"
                        id="telephone_0"
                        class="form-control"
                        pattern="\d{2}-\d{7}"
                        style="background-color: #E2E2E2;"
                        title="Please enter a valid telephone number in the format 02-1234567."
                        required
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="reason_for_leaving_0" class="form-label">Reason for Leaving:</label>
                    <textarea
                        name="employment_history[0][reason_for_leaving]"
                        id="reason_for_leaving_0"
                        style="background-color: #E2E2E2;"
                        class="form-control">{{ old('employment_history.0.reason_for_leaving') }}</textarea>
                </div>
            </div>
        </div>
    @endif
</div>



<h3>Educational Background</h3>
<div id="educational-background">
    @foreach ($education as $edu)
        <div class="educational-background-entry">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-control" name="educational_bg[0][level]" id="educlevel" required>
                        <option value="" selected disabled>Select Level</option>
                        <option value="Elementary" {{ old('educational_bg.0.level', $edu->level) == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                        <option value="Junior High School" {{ old('educational_bg.0.level', $edu->level) == 'Junior High School' ? 'selected' : '' }}>Junior High School</option>
                        <option value="Senior High School" {{ old('educational_bg.0.level', $edu->level) == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                        <option value="College" {{ old('educational_bg.0.level', $edu->level) == 'College' ? 'selected' : '' }}>College</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="school" class="form-label">School</label>
                    <input
                    type="text"
                    class="form-control"
                    name="educational_bg[0][school]"
                    id="schoolname"
                    value="{{ old('educational_bg.0.school', $edu->school) }}"

                    required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="degree" class="form-label">Degree</label>
                    <input
                    type="text"
                    class="form-control"
                    name="educational_bg[0][degree]"
                    id="schooldeg"
                    value="{{ old('educational_bg.0.degree', $edu->degree) }}"
                    required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="year_attended_from" class="form-label">Year Attended From</label>
                    <input
                    type="text"
                    class="form-control"
                    name="educational_bg[0][year_attended_from]"
                    id="schfrom"
                    value="{{ old('educational_bg.0.year_attended_from', $edu->year_attended_from) }}"
                    required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="year_attended_to" class="form-label">Year Attended To</label>
                    <input
                    type="text"
                    class="form-control"
                    name="educational_bg[0][year_attended_to]"
                    id="schto"
                    value="{{ old('educational_bg.0.year_attended_to', $edu->year_attended_to) }}"
                    required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="honors_received" class="form-label">Honors Received</label>
                    <input
                    type="text"
                    class="form-control"
                    id="honorsrec"
                    name="educational_bg[0][honors_received]"
                    value="{{ old('educational_bg.0.honors_received', $edu->honors_received) }}">
                </div>
            </div>
        </div>
    @endforeach
</div>
<button type="button" class="btn btn-secondary mb-3" onclick="addEducationField()" id="add-education-btn">Add More</button>


<h3>Training</h3>
<div id="training">
    @foreach ($training as $train)
        <div class="training-entry">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                    type="text"
                    class="form-control"
                    id="title"
                    name="title[]"
                    value="{{ old('title.0', $train->title) }}"
                    required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inclusive_dates" class="form-label">Inclusive Dates</label>
                    <input
                    type="text"
                    class="form-control"
                    id="inclusive_dates"
                    name="inclusive_dates[]"
                    value="{{ old('inclusive_dates.0', $train->inclusive_dates) }}"
                    required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="conducted_by" class="form-label">Conducted By</label>
                    <input
                    type="text"
                    class="form-control"
                    id="conducted_by"
                    name="conducted_by[]"
                    value="{{ old('conducted_by.0', $train->conducted_by) }}"
                    required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="venue" class="form-label">Venue</label>
                    <input
                    type="text"
                    class="form-control"
                    id="venue"
                    name="venue[]"
                    value="{{ old('venue.0', $train->venue) }}"
                    required>
                </div>
            </div>
        </div>
    @endforeach
</div>
<button type="button" class="btn btn-secondary mb-3" onclick="addTrainingField()" id="addTrainingBtn">Add Mores</button>
<button style="float: right; background-color: #326c79;"type="submit" class="btn btn-primary">Save</button>


</form>
</div>

</div>
<div style="display: flex; justify-content: center; align-items: center; padding-bottom: 50px;">
    <button onclick="window.location.href='{{ url('employees') }}';" class="btn btn-primary" style="background-color: #326c79;">Back To Employee List</button>
</div>
</div>
</div>
</div>

@include('partials.footer')
