document.addEventListener("DOMContentLoaded", function () {
    // Educational Background Section
    let educationIndex = 1;
    
    document.getElementById("add-education-btn").addEventListener("click", function () {
        const container = document.getElementById("educational-background");
        const newEntry = document.createElement("div");
        newEntry.classList.add("educational-background-entry");
        
        newEntry.innerHTML = `
            <div class="row">
            <div class="col-md-4 mb-3">
    <label for="level" class="form-label">Level</label>
    <select class="form-control" name="educational_bg[${educationIndex}][level]" required>
        <option value="" selected disabled>Select Level</option>
        <option value="Elementary">Elementary</option>
        <option value="Junior High School">Junior High School</option>
        <option value="Senior High School">Senior High School</option>
        <option value="College">College</option>
    </select>
</div>

                <div class="col-md-4 mb-3">
                    <label for="school" class="form-label">School</label>
                    <input type="text" class="form-control" name="educational_bg[${educationIndex}][school]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="degree" class="form-label">Degree</label>
                    <input type="text" class="form-control" name="educational_bg[${educationIndex}][degree]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
    <label for="year_attended_from" class="form-label">Year Attended From</label>
    <input 
        type="text" 
        class="form-control" 
        name="educational_bg[${educationIndex}][year_attended_from]" 
        required 
        placeholder="Select Year">
</div>

<div class="col-md-6 mb-3">
    <label for="year_attended_to" class="form-label">Year Attended To</label>
    <input 
        type="text" 
        class="form-control" 
        name="educational_bg[${educationIndex}][year_attended_to]" 
        required 
        placeholder="Select Year">
</div>

            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="honors_received" class="form-label">Honors Received</label>
                    <input type="text" class="form-control" name="educational_bg[${educationIndex}][honors_received]">
                </div>
            </div>
            <button type="button" class="remove-education-entry">Remove</button>
        `;
        
        container.appendChild(newEntry);
        educationIndex++;
        
        // Add event listener to remove the entry
        newEntry.querySelector('.remove-education-entry').addEventListener('click', function () {
            container.removeChild(newEntry);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Training Section
    let trainingIndex = 1;
    
    document.getElementById("addTrainingBtn").addEventListener("click", function () {
        const container = document.getElementById("training");
        const newField = document.createElement("div");
        newField.classList.add("training-entry");
        
        newField.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="training[${trainingIndex}][title]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inclusive_dates" class="form-label">Inclusive Dates</label>
                    <input type="text" class="form-control" name="training[${trainingIndex}][inclusive_dates]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="conducted_by" class="form-label">Conducted By</label>
                    <input type="text" class="form-control" name="training[${trainingIndex}][conducted_by]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="venue" class="form-label">Venue</label>
                    <input type="text" class="form-control" name="training[${trainingIndex}][venue]" required>
                </div>
            </div>
            <button type="button" class="remove-training-entry">Remove</button>
        `;
        
        container.appendChild(newField);
        trainingIndex++;
        
        // Add event listener to remove the training field entry
        newField.querySelector('.remove-training-entry').addEventListener('click', function () {
            container.removeChild(newField);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
// Family Background Section
let familyBackgroundIndex = 1;  // Start from 1, since 0 is already used for the first record

document.getElementById("addFamilyBackground").addEventListener("click", function () {
    const wrapper = document.getElementById("familyBackgroundWrapper");
    const newRow = document.createElement("div");
    newRow.classList.add("familyBackgroundRow");
    newRow.innerHTML = `
        <div class="familyBackgroundRow mb-3 row">
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[${familyBackgroundIndex}][name]" 
                    class="form-control" 
                    placeholder="Name" 
                    required>
            </div>
            <div class="col-md-4 mb-3">
                <select 
                    name="family_background[${familyBackgroundIndex}][relationship]" 
                    class="form-control" 
                    required>
                    <option value="" selected disabled>Select Relationship</option>
                    <option value="Mother">Mother</option>
                    <option value="Father">Father</option>
                    <option value="Sibling">Sibling</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[${familyBackgroundIndex}][occupation]" 
                    class="form-control" 
                    placeholder="Occupation">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="date" 
                    name="family_background[${familyBackgroundIndex}][birthdate]" 
                    class="form-control" 
                    placeholder="Birthdate">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[${familyBackgroundIndex}][address]" 
                    class="form-control" 
                    placeholder="Address">
            </div>
            <div class="col-md-4 mb-3">
                <input 
                    type="text" 
                    name="family_background[${familyBackgroundIndex}][phone]" 
                    class="form-control" 
                    placeholder="Phone" 
                    pattern="09[0-9]{9}" 
                    title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits." 
                    required>
            </div>
        </div>
        <button type="button" class="removeRow" style="background-color: #CA0B00; color: white; border-radius:10px; padding: 5px 10px; font-size: 16px; display: block; margin: auto;">
            Remove
        </button>
    `;
    
    wrapper.appendChild(newRow);
    familyBackgroundIndex++;  // Increment index for the next entry
    
    // Add remove functionality for the new row
    newRow.querySelector('.removeRow').addEventListener("click", function () {
        wrapper.removeChild(newRow);
    });
});


    // Emergency Contact Section
    let emergencyContactIndex = 1; // Start from index 1 for new rows

document.getElementById("addEmergencyContact").addEventListener("click", function () {
const wrapper = document.getElementById("emergencyContactWrapper");
const newRow = document.createElement("div");
newRow.classList.add("emergencyContactRow");

newRow.innerHTML = `
    <div class="emergencyContactRow mb-3 row">
        <div class="col-md-3 mb-3">
            <input 
                type="text" 
                name="emergency_contacts[${emergencyContactIndex}][name]" 
                class="form-control" 
                placeholder="Name" 
                value="{{ old('emergency_contacts.${emergencyContactIndex}.name') }}" 
                style="background-color: #E2E2E2;"
                required>
        </div>
        <div class="col-md-3 mb-3">
            <select 
                name="emergency_contacts[${emergencyContactIndex}][relationship]" 
                class="form-control"
                style="background-color: #E2E2E2;"
                required>
                <option value="" selected disabled>Select Relationship</option>
                <option value="Mother" {{ old('emergency_contacts.${emergencyContactIndex}.relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                <option value="Father" {{ old('emergency_contacts.${emergencyContactIndex}.relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                <option value="Sibling" {{ old('emergency_contacts.${emergencyContactIndex}.relationship') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <input 
                type="text" 
                name="emergency_contacts[${emergencyContactIndex}][address]" 
                class="form-control" 
                placeholder="Address" 
                value="{{ old('emergency_contacts.${emergencyContactIndex}.address') }}"
                style="background-color: #E2E2E2;">
        </div>
        <div class="col-md-3 mb-3">
            <input 
                type="text" 
                name="emergency_contacts[${emergencyContactIndex}][contact_num]" 
                class="form-control" 
                placeholder="Contact Number" 
                pattern="09[0-9]{9}" 
                title="Please enter a valid Philippine phone number starting with 09 and containing 11 digits." 
                value="{{ old('emergency_contacts.${emergencyContactIndex}.contact_num') }}" 
                style="background-color: #E2E2E2;"
                required>
        </div>
    </div>
    <button type="button" class="removeRow" style="background-color: #CA0B00; color: white; border-radius:10px; padding: 5px 10px; font-size: 16px; display: block; margin: auto;">
        Remove
    </button>
`;

wrapper.appendChild(newRow);
emergencyContactIndex++; // Increment the index for the next row
});
    // Remove Row Button
    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("removeRow")) {
            e.target.parentElement.remove();
        }
    });
});
