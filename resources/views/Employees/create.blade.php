@include('partials.header')
@include('partials.sidebar')
@include('partials.navbar')



<div class="container">
<div class="page-inner">
<div class="container">
<nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 m-0 fs-5">
            <li class="breadcrumb-item text-muted">Manage Employee</li>
            <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">New Employee Record</li>
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
            <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
    <div class="card">
        <div class="card-body">
                <h5>Application Details</h5>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="referred_by" class="form-label">Referred By</label>
        <input 
            type="text" 
            class="form-control" 
            id="referred_by" 
            name="referred_by" 
            value="{{ old('referred_by') }}" 
            style="background-color: #E2E2E2;"
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
            value="{{ old('date_applied') }}"
            style="background-color: #E2E2E2;"
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
            value="{{ old('date_hired') }}"
            style="background-color: #E2E2E2;"
        >
    </div>
    <div class="col-md-6 mb-3">
    <label for="position" class="form-label">Position</label>
    <select 
        class="form-select" 
        id="position" 
        name="position" 
        required
        style="background-color: #E2E2E2;">
        <option value="" disabled selected>Select Company Positions</option>
        @foreach($positions as $position)
            <option value="{{ $position->DepartmentName }}" {{ old('Position_name') == $position->Position_name ? 'selected' : '' }}>
                {{ $position->Position_name }}
            </option>
        @endforeach
    </select>
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
            <option value="" disabled selected>Select Status</option>
            <option value="Probationary" {{ old('employment_status') == 'Probationary' ? 'selected' : '' }}>Probationary</option>
            <option value="Regular" {{ old('employment_status') == 'Regular' ? 'selected' : '' }}>Regular</option>
            <option value="Contractual" {{ old('employment_status') == 'Contractual' ? 'selected' : '' }}>Contractual</option>
            <option value="Temporary" {{ old('employment_status') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
    <label for="department" class="form-label">Department</label>
    <select 
        class="form-control" 
        id="DepartmentName" 
        name="DepartmentName" 
        required
        style="background-color: #E2E2E2;">
        <option value="" disabled selected>Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->DepartmentName }}" {{ old('DepartmentName') == $department->DepartmentName ? 'selected' : '' }}>
                {{ $department->DepartmentName }}
            </option>
        @endforeach
    </select>
</div>

</div>


                <h5>Personal Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="surname" 
                        name="surname" 
                        required
                        value="{{ old('surname') }}"
                         style="background-color: #E2E2E2;"
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
                        value="{{ old('first_name') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="middle_name" 
                        name="middle_name" 
                        value="{{ old('middle_name') }}"
                         style="background-color: #E2E2E2;"
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
                        value="{{ old('nickname') }}"
                         style="background-color: #E2E2E2;"
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
                        value="{{ old('birthdate') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Birthplace" class="form-label">Birthplace</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="Birthplace" 
                        name="Birthplace" 
                        value="{{ old('Birthplace') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-control" id="sex" name="sex" style="background-color: #E2E2E2;" required>
                            <option value="">Select</option>
                            <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status" style="background-color: #E2E2E2;" required>
                            <option value="">Select</option>
                            <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="nationality" 
                        name="nationality" 
                        value="{{ old('nationality', 'Filipino') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="Religion" class="form-label">Religion</label>
                        <select class="form-control" id="Religion" name="Religion" style="background-color: #E2E2E2;" >
                            <option value="" selected disabled>Select Religion</option>
                            <option value="Catholic" {{ old('Religion') == 'Catholic' ? 'selected' : '' }}>Catholic</option>
                            <option value="Christianity" {{ old('Religion') == 'Christianity' ? 'selected' : '' }}>Christianity</option>
                            <option value="Iglesia ni Cristo" {{ old('Religion') == 'Iglesia ni Cristo' ? 'selected' : '' }}>Iglesia ni Cristo</option>
                            <option value="Islam" {{ old('Religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Hinduism" {{ old('Religion') == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                            <option value="Buddhism" {{ old('Religion') == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                            <option value="Judaism" {{ old('Religion') == 'Judaism' ? 'selected' : '' }}>Judaism</option>
                            <option value="Folk Religion" {{ old('Religion') == 'Folk Religion' ? 'selected' : '' }}>Folk Religion</option>
                            <option value="Other" {{ old('Religion') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="BloodType" class="form-label">Blood Type</label>
                        <select class="form-control" id="BloodType" name="BloodType" style="background-color: #E2E2E2;">
                            <option value="" selected disabled>Select Blood Type</option>
                            <option value="A+" {{ old('BloodType') == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('BloodType') == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('BloodType') == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('BloodType') == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ old('BloodType') == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('BloodType') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ old('BloodType') == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('BloodType') == 'O-' ? 'selected' : '' }}>O-</option>
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
                        value="{{ old('contact_num') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        required
                        value="{{ old('email') }}"
                         style="background-color: #E2E2E2;"
                        >
                    </div>
                </div>
                
                <h5>Address</h5>

<div class="row">
    <div class="col-md-3 mb-3">
        <label for="house_number" class="form-label">House Number</label>
        <input type="text" class="form-control" id="house_number" name="house_number" value="{{ old('house_number') }}" style="background-color: #E2E2E2;" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="street_name" class="form-label">Street Name</label>
        <input type="text" class="form-control" id="street_name" name="street_name" value="{{ old('street_name') }}" style="background-color: #E2E2E2;" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="barangay" class="form-label">Barangay</label>
        <input type="text" class="form-control" id="barangay" name="barangay" value="{{ old('barangay') }}" style="background-color: #E2E2E2;" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" style="background-color: #E2E2E2;" required>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="zip_code" class="form-label">Zipcode</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" style="background-color: #E2E2E2;" pattern="\d{4}" title="Please enter a valid 4-digit ZIP code." required>
    </div>

    <div class="col-md-4 mb-3">
        <label for="province" class="form-label">Province</label>
        <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" style="background-color: #E2E2E2;">
    </div>

    <div class="col-md-4 mb-3">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" style="background-color: #E2E2E2;" required>
    </div>
</div>
                
<div id="familyBackgroundSection">
    <h5>Family Background</h5>
    <div id="familyBackgroundWrapper">
        <div class="familyBackgroundRow mb-3 row" id="familyBackgroundRow1">
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[0][name]" 
                    class="form-control" 
                    placeholder="Name" 
                    value="{{ old('family_background.0.name') }}" 
                    style="background-color: #E2E2E2;"
                    required>
            </div>
            <div class="col-md-4 mb-3">
                <select 
                    name="family_background[0][relationship]" 
                    class="form-control" style="background-color: #E2E2E2;"
                    required>
                    <option value="" selected disabled>Select Relationship</option>
                    <option value="Mother" {{ old('family_background.0.relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                    <option value="Father" {{ old('family_background.0.relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                    <option value="Sibling" {{ old('family_background.0.relationship') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[0][occupation]" 
                    class="form-control" 
                    placeholder="Occupation" 
                    value="{{ old('family_background.0.occupation') }}"
                    style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="date" 
                    name="family_background[0][birthdate]" 
                    class="form-control" 
                    value="{{ old('family_background.0.birthdate') }}" 
                    style="background-color: #E2E2E2;"
                    placeholder="Birthdate">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[0][address]" 
                    class="form-control" 
                    placeholder="Address" 
                    value="{{ old('family_background.0.address') }}"
                    style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[0][phone]" 
                    class="form-control" 
                    placeholder="Phone" 
                    pattern="09[0-9]{9}" 
                    title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits." 
                    value="{{ old('family_background.0.phone') }}"
                    style="background-color: #E2E2E2;" 
                    required>
            </div>
            <div class="col-md-12" style="float:left;">
                <button type="button" class="btn btn-danger mb-3 removeFamilyBackground" style="display: none;">Remove</button>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <button type="button" id="addFamilyBackground" class="btn btn-secondary mb-3">Add More</button>
    </div>
</div>
<div id="emergencyContactSection">
    <h5>Emergency Contact Details</h5>
    <div id="emergencyContactWrapper">

        <div class="emergencyContactRow mb-3 row" id="emergencyContactRow1">
            <div class="col-md-3 mb-3">
                <input 
                    type="text" 
                    name="emergency_contacts[0][name]" 
                    class="form-control" 
                    placeholder="Name" 
                    value="{{ old('emergency_contacts.0.name') }}" 
                    style="background-color: #E2E2E2;"
                    required>
            </div>
            <div class="col-md-3 mb-3">
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
            <div class="col-md-3 mb-3">
                <input 
                    type="text" 
                    name="emergency_contacts[0][address]" 
                    class="form-control" 
                    placeholder="Address" 
                    value="{{ old('emergency_contacts.0.address') }}"
                    style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-3 mb-3">
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
            <div class="col-md-12" style="float:left;">
                <button type="button" class="btn btn-danger mb-3 removeEmergencyContact" style="display: none;">Remove</button>
            </div>
        </div>

    </div>
    <div class="col-md-12 mb-3 d-flex justify-content-start">
        <button type="button" id="addEmergencyContact" class="btn btn-secondary mb-3">Add More</button>
    </div>
</div>
        
        
        <h5>Employment Information</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="tin_num" class="form-label">TIN Number</label>
                <input 
                type="text" 
                class="form-control" 
                id="tin_num" 
                name="tin_num" 
                value="{{ old('tin_num') }}"
                style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-4 mb-3">
                <label for="sss_num" class="form-label">SSS Number</label>
                <input 
                type="text" 
                class="form-control" 
                id="sss_num" 
                name="sss_num" 
                value="{{ old('sss_num') }}"
                style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pag_ibig_num" class="form-label">Pag-Ibig Number</label>
                <input 
                type="text" 
                class="form-control" 
                id="pag_ibig_num" 
                name="pag_ibig_num" 
                value="{{ old('pag_ibig_num') }}"
                style="background-color: #E2E2E2;">
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
                value="{{ old('philhealth_num') }}"
                style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-6 mb-3">
                <label for="tax_status" class="form-label">Tax Status</label>
                <select 
                class="form-control" 
                id="tax_status" 
                name="tax_status" 
                style="background-color: #E2E2E2;"
                required>
                <option value="" selected disabled>Select Tax Status</option>
                <option value="Single" {{ old('tax_status') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="HF1" {{ old('tax_status') == 'HF1' ? 'selected' : '' }}>HF1</option>
                <option value="HF2" {{ old('tax_status') == 'HF2' ? 'selected' : '' }}>HF2</option>
                <option value="Married without children (MOSE)" {{ old('tax_status') == 'Married without children (MOSE)' ? 'selected' : '' }}>
                    Married without children (MOSE)
                </option>
                <option value="M1OSE" {{ old('tax_status') == 'M1OSE' ? 'selected' : '' }}>M1OSE</option>
                <option value="M2OSE" {{ old('tax_status') == 'M2OSE' ? 'selected' : '' }}>M2OSE</option>
                <option value="M3OSE" {{ old('tax_status') == 'M3OSE' ? 'selected' : '' }}>M3OSE</option>
                <option value="M4OSE" {{ old('tax_status') == 'M4OSE' ? 'selected' : '' }}>M4OSE</option>
                <option value="Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)" 
                {{ old('tax_status') == 'Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)' ? 'selected' : '' }}>
                Employed Husband/Wife Unemployed or Employed Wife/Husband Unemployed(EHWE)
            </option>
            <option value="Other" {{ old('tax_status') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
</div>


<!-- Employment History Section -->
<div class="employment-history">
<h5>Employment History</h5>
    <div class="employment-item mb-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date" class="form-label">Date:</label>
                <input type="date" name="employment_history[0][date]" id="date" class="form-control"style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-6">
                <label for="position" class="form-label">Position:</label>
                <input type="text" name="employment_history[0][position]" id="position" class="form-control"style="background-color: #E2E2E2;">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="salary" class="form-label">Salary:</label>
                <input type="number" name="employment_history[0][salary]" id="salary" class="form-control" style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-6">
                <label for="superior" class="form-label">Superior:</label>
                <input type="text" name="employment_history[0][superior]" id="superior" class="form-control"style="background-color: #E2E2E2;">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="department" class="form-label">Department:</label>
                <input type="text" name="employment_history[0][department]" id="department" class="form-control" style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="employment_history[0][address]" id="address" class="form-control" style="background-color: #E2E2E2;">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="company" class="form-label">Company:</label>
                <input type="text" name="employment_history[0][company]" id="company" class="form-control" style="background-color: #E2E2E2;">
            </div>
            <div class="col-md-6">
                <label for="telephone" class="form-label">Telephone:</label>
                <input 
                type="text" 
                name="employment_history[0][telephone]" 
                id="telephone" 
                class="form-control"
                pattern="\d{2}-\d{7}" 
                title="Please enter a valid telephone number in the format 02-1234567." 
                style="background-color: #E2E2E2;"
                required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="reason_for_leaving" class="form-label">Reason for Leaving:</label>
                <textarea name="employment_history[0][reason_for_leaving]" id="reason_for_leaving" class="form-control" style="background-color: #E2E2E2;"></textarea>
            </div>
        </div>
    </div>
</div>


<h5>Educational Background</h5>
<div id="educational-background">
    <!-- Educational Background Entry -->
    <div class="educational-background-entry">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-control" name="educational_bg[0][level]" style="background-color: #E2E2E2;" required>
                    <option value="" selected disabled>Select Level</option>
                    <option value="Elementary" {{ old('educational_bg.0.level') == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                    <option value="Junior High School" {{ old('educational_bg.0.level') == 'Junior High School' ? 'selected' : '' }}>Junior High School</option>
                    <option value="Senior High School" {{ old('educational_bg.0.level') == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                    <option value="College" {{ old('educational_bg.0.level') == 'College' ? 'selected' : '' }}>College</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="school" class="form-label">School</label>
                <input 
                type="text" 
                class="form-control" 
                name="educational_bg[0][school]" 
                value="{{ old('educational_bg.0.school') }}"
                style="background-color: #E2E2E2;" 
                required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="degree" class="form-label">Degree</label>
                <input 
                type="text" 
                class="form-control" 
                name="educational_bg[0][degree]" 
                value="{{ old('educational_bg.0.degree') }}" 
                style="background-color: #E2E2E2;"
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
                value="{{ old('educational_bg.0.year_attended_from') }}" 
                style="background-color: #E2E2E2;"
                required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="year_attended_to" class="form-label">Year Attended To</label>
                <input 
                type="text" 
                class="form-control" 
                name="educational_bg[0][year_attended_to]" 
                value="{{ old('educational_bg.0.year_attended_to') }}" 
                style="background-color: #E2E2E2;"
                required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="honors_received" class="form-label">Honors Received</label>
                <input 
                type="text" 
                class="form-control" 
                name="educational_bg[0][honors_received]" 
                value="{{ old('educational_bg.0.honors_received') }}"
                style="background-color: #E2E2E2;">
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-secondary mb-3" onclick="addEducationField()" id="add-education-btn">Add More</button>

<h5>Training</h5>
<div id="training">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="title" class="form-label">Title</label>
            <input 
            type="text" 
            class="form-control" 
            id="title" 
            name="title[]" 
            value="{{ old('title.0') }}" 
            style="background-color: #E2E2E2;"
            required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="inclusive_dates" class="form-label">Inclusive Dates</label>
            <input 
            type="text" 
            class="form-control" 
            id="inclusive_dates" 
            name="inclusive_dates[]" 
            value="{{ old('inclusive_dates.0') }}"
            style="background-color: #E2E2E2;" 
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
            value="{{ old('conducted_by.0') }}" 
            style="background-color: #E2E2E2;"
            required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input 
            type="text" 
            class="form-control" 
            id="venue" 
            name="venue[]" 
            value="{{ old('venue.0') }}" 
            style="background-color: #E2E2E2;"
            required>
        </div>
    </div>
</div>
<button type="button" class="btn btn-secondary mb-3" onclick="addTrainingField()" id="addTrainingBtn">Add More</button>



</div>

</div>
<button type="submit" class="btn mb-4" style="float: right; background-color: #289DD2;">Submit</button>
</form>
</div>
<div style="text-align: left;">
    <a href="{{ url('employees') }}" style="color: #289DD2; font-size: 90%; font-weight: 600; text-decoration: none; transition: 0.3s;">
        Back to Employee List
    </a>
</div>
</div>
</div>
</div>


@include('partials.footer')
