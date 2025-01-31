document.addEventListener('DOMContentLoaded', function () {
    const NumberOfDependentInput = document.getElementById('NumberOfDependent');
    const dependentContainer = document.getElementById('updatedependentContainer');

    function createChildInputs(NumberOfDependent) {
        dependentContainer.innerHTML = '';

        for (let i = 0; i < NumberOfDependent; i++) {
            const childDiv = document.createElement('div');
            childDiv.classList.add('child-inputs');
            childDiv.innerHTML = `
                <div class="card mt-3">
                    <h5 class="card-header">Dependent Information ${i + 1}</h5>
                    <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][firstname]" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="dependent[${i}][firstname]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][lastname]" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="dependent[${i}][lastname]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][middlename]" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="dependent[${i}][middlename]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="dependent[${i}][extension]" class="form-label">Extension</label>
                            <input type="text" class="form-control" name="dependent[${i}][extension]">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][dateofbirth]" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" name="dependent[${i}][dateofbirth]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][sex]" class="form-label">Sex</label>
                                <select class="form-control" name="dependent[${i}][sex]" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][placeofbirth]" class="form-label">Place of Birth</label>
                                <input type="text" class="form-control" name="dependent[${i}][placeofbirth]" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][civilstatus]" class="form-label">Civil Status</label>
                                <select class="form-control" name="dependent[${i}][civilstatus]" required>
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][citizenship]" class="form-label">Citizenship</label>
                                <input type="text" class="form-control" name="dependent[${i}][citizenship]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dependent[${i}][student]" class="form-label">Student</label>
                                <select class="form-control student-select" name="dependent[${i}][student]" data-child-index="${i}" required>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="mb-3 col-md-3">
                            <label for="voter_yes" class="form-label">Voter:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Voter toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][voter]" id="voter_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="voter_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][voter]" id="voter_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="voter_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="yellow_card_yes" class="form-label">Yellow Card:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Yellow Card toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][yellow_card]" id="yellow_card_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="yellow_card_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][yellow_card]" id="yellow_card_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="yellow_card_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="makatizen_yes" class="form-label">Makatizen:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Makatizen toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][makatizen]" id="makatizen_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="makatizen_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][makatizen]" id="makatizen_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="makatizen_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="pwd_yes" class="form-label">PWD:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="PWD toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][pwd]" id="pwd_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="pwd_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][pwd]" id="pwd_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="pwd_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="mb-3 col-md-3">
                            <label for="blu_card_yes" class="form-label">Blue Card:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Blue Card toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][blu_card]" id="blu_card_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="blu_card_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][blu_card]" id="blu_card_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="blu_card_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="separation_certificate_yes" class="form-label">Separation Certificate:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Separation Certificate toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][separation_certificate]" id="separation_certificate_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="separation_certificate_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][separation_certificate]" id="separation_certificate_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="separation_certificate_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="senior_card_yes" class="form-label">Senior Card:</label>
                            <div class="d-flex flex-column">
                                <div class="btn-group mb-2" role="group" aria-label="Senior Card toggle button group">
                                    <input type="radio" class="btn-check" name="dependent[${i}][senior_card]" id="senior_card_yes_${i}" value="Yes" required>
                                    <label class="btn btn-outline-primary" for="senior_card_yes_${i}">Yes</label>
                                    <input type="radio" class="btn-check" name="dependent[${i}][senior_card]" id="senior_card_no_${i}" value="No" required>
                                    <label class="btn btn-outline-primary" for="senior_card_no_${i}">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            dependentContainer.appendChild(childDiv);
        }
    }

    NumberOfDependentInput.addEventListener('input', function () {
        const numberOfDependents = parseInt(this.value, 10) || 0;
        createChildInputs(numberOfDependents);
    });

    // Initial call to populate fields if needed
    NumberOfDependentInput.dispatchEvent(new Event('input'));
});
document.addEventListener('DOMContentLoaded', function () {
    const civilStatusSelect = document.getElementById('civilstatus');
    const partnerDetailsSection = document.getElementById('partner-details');
    const partnerInputs = partnerDetailsSection.querySelectorAll('input');

    function togglePartnerDetails() {
        const selectedStatus = civilStatusSelect.value;
        if (selectedStatus === 'Married' || selectedStatus === 'LiveIn') {
            partnerDetailsSection.style.display = 'block';
            partnerInputs.forEach(input => input.required = true);
        } else {
            partnerDetailsSection.style.display = 'none';
            partnerInputs.forEach(input => input.required = false);
        }
    }

    // Initial check based on the current value of civil status
    togglePartnerDetails();

    // Event listener for changes in civil status
    civilStatusSelect.addEventListener('change', togglePartnerDetails);
});
// document.addEventListener('DOMContentLoaded', function () {
//     var checkbox = document.getElementById('head_of_family_checkbox');
//     var hiddenInput = document.querySelector('input[name="head_of_family"][type="hidden"]');
    
//     // Function to update the value of hidden input based on checkbox state
//     function updateHiddenInput() {
//         if (hiddenInput) { // Check if hiddenInput is not null
//             hiddenInput.value = checkbox.checked ? 'Yes' : 'No';
//         } else {
//             console.error('Hidden input element not found.');
//         }
//     }

//     // Initial UI update
//     updateHiddenInput();

//     // Add event listener for checkbox change
//     if (checkbox) { // Check if checkbox is not null
//         checkbox.addEventListener('change', function () {
//             updateHiddenInput();
//         });
//     } else {
//         console.error('Checkbox element not found.');
//     }
// });


    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('head_of_family_checkbox');
        const uncheckedIcon = document.getElementById('unchecked_icon');
        const checkedIcon = document.getElementById('checked_icon');
        
        function updateIcons() {
            if (checkbox.checked) {
                uncheckedIcon.classList.add('d-none');
                checkedIcon.classList.remove('d-none');
            } else {
                uncheckedIcon.classList.remove('d-none');
                checkedIcon.classList.add('d-none');
            }
        }
        updateIcons(); 
        checkbox.addEventListener('change', function() {
            updateIcons();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const houseNumberInput = document.getElementById('housenumber');
        const streetNameSelect = document.getElementById('streetname');
        const householdCodeSelect = document.getElementById('household_code');
        const uniqueCodeInput = document.getElementById('unique_code');
    
        function updateHouseholdCodes() {
            const houseNumber = houseNumberInput.value.trim();
            const streetName = streetNameSelect.value.trim();
            
            if (houseNumber && streetName) {
                fetch(`/filter-household-codes?housenumber=${houseNumber}&streetname=${streetName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            householdCodeSelect.innerHTML = '<option value="" disabled selected>Select Household Code</option>';
                            
                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.unique_code;
                                option.text = `${item.name} - ${item.unique_code}`;
                                householdCodeSelect.appendChild(option);
                            });
                        } else {
                            console.error('Expected an array but received:', data);
                        }
                    })
                    .catch(error => console.error('Error fetching household codes:', error));
            } else {
                householdCodeSelect.innerHTML = '<option value="" disabled selected>Select Household Code</option>';
            }
        }
    
        // Add event listeners to update the dropdown when input changes
        houseNumberInput.addEventListener('input', updateHouseholdCodes);
        streetNameSelect.addEventListener('change', updateHouseholdCodes);
        
        // Add event listener to handle selection
        householdCodeSelect.addEventListener('change', function() {
            const selectedUniqueCode = this.value;
            if (selectedUniqueCode) {
                uniqueCodeInput.value = selectedUniqueCode; // Set the selected household code to unique_code input
            }
        });
    });
    