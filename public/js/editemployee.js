document.addEventListener("DOMContentLoaded", function () {
    // Educational Background Section
    let educationIndex = 1;

    document.getElementById("add-education-btn").addEventListener("click", function () {
        const container = document.getElementById("educational-background");
        const newEntry = document.createElement("div");
        newEntry.classList.add("educational-background-entry");

        newEntry.innerHTML = `
    <hr>
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
        <input type="text" class="form-control" name="educational_bg[${educationIndex}][school]" value="" required>
    </div>
    <div class="col-md-4 mb-3">
        <label for="degree" class="form-label">Degree</label>
        <input type="text" class="form-control" name="educational_bg[${educationIndex}][degree]" value="" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="year_attended_from" class="form-label">Year Attended From</label>
        <input type="text" class="form-control" name="educational_bg[${educationIndex}][year_attended_from]" required placeholder="Select Year">
    </div>

    <div class="col-md-6 mb-3">
        <label for="year_attended_to" class="form-label">Year Attended To</label>
        <input type="text" class="form-control" name="educational_bg[${educationIndex}][year_attended_to]" required placeholder="Select Year">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="honors_received" class="form-label">Honors Received</label>
        <input type="text" class="form-control" name="educational_bg[${educationIndex}][honors_received]" value="">
    </div>
</div>

<!-- Remove Button aligned to the right -->
<div class="col-md-12 mb-3 d-flex justify-content-end">
    <button type="button" class="remove-education-entry btn btn-danger">Remove</button>
</div>

<hr>

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
      <hr>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title[]" value="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="inclusive_dates" class="form-label">Inclusive Dates</label>
                <input type="text" class="form-control" name="inclusive_dates[]" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="conducted_by" class="form-label">Conducted By</label>
                <input type="text" class="form-control" name="conducted_by[]" value="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="venue" class="form-label">Venue</label>
                <input type="text" class="form-control" name="venue[]" value="" required>
            </div>
        </div>

        <!-- Remove Button aligned to the right -->
        <div class="col-md-12 mb-3 d-flex justify-content-end">
            <button type="button" class="remove-training-entry btn btn-danger">Remove</button>
        </div>

        <hr>

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
        let familyBackgroundIndex = document.querySelectorAll(".familyBackgroundRow").length;

document.getElementById("addFamilyBackground").addEventListener("click", function () {
    const wrapper = document.getElementById("familyBackgroundWrapper");
    const newRow = document.createElement("div");
    newRow.classList.add("familyBackgroundRow", "mb-3", "row");
    newRow.innerHTML = `
    <hr>
        <div class="col-md-4 mb-3">
            <input type="text" name="family_background[${familyBackgroundIndex}][name]" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-4 mb-3">
            <select name="family_background[${familyBackgroundIndex}][relationship]" class="form-control" required>
                <option value="" selected disabled>Select Relationship</option>
                <option value="Mother">Mother</option>
                <option value="Father">Father</option>
                <option value="Sibling">Sibling</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="family_background[${familyBackgroundIndex}][occupation]" class="form-control" placeholder="Occupation">
        </div>
        <div class="col-md-4 mb-3">
            <input type="date" name="family_background[${familyBackgroundIndex}][birthdate]" class="form-control" placeholder="Birthdate">
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="family_background[${familyBackgroundIndex}][address]" class="form-control" placeholder="Address">
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" name="family_background[${familyBackgroundIndex}][phone]" class="form-control" placeholder="Phone" pattern="09[0-9]{9}" title="Phone number must start with 09 and be 11 digits long">
        </div>
        <div class="col-12 text-end">
            <button type="button" class="btn btn-danger removeRow">Remove</button>
        </div>
        <hr>
    `;
    wrapper.appendChild(newRow);
    familyBackgroundIndex++;
});

document.getElementById("familyBackgroundWrapper").addEventListener("click", function (e) {
    if (e.target.classList.contains("removeRow")) {
        e.target.closest(".familyBackgroundRow").remove();
    }
});

         // Emergency Contact Section
    let emergencyContactIndex = document.querySelectorAll(".emergencyContactRow").length || 0;

document.getElementById("addEmergencyContact").addEventListener("click", function () {
    const wrapper = document.getElementById("emergencyContactWrapper");
    const newRow = document.createElement("div");
    newRow.classList.add("emergencyContactRow", "mb-3", "row");

    newRow.innerHTML = `
                    <hr>
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-3 mb-3">
                            <input type="text" name="emergency_contacts[${emergencyContactIndex}][name]"
                                class="form-control"
                                placeholder="Name" required>
                        </div>

                        <!-- Relationship -->
                        <div class="col-md-3 mb-3">
                            <select class="form-control" name="emergency_contacts[${emergencyContactIndex}][relationship]" required>
                                <option value="" selected disabled>Select Relationship</option>
                                <option value="Mother">Mother</option>
                                <option value="Father">Father</option>
                                <option value="Sibling">Sibling</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-3 mb-3">
                            <input type="text" name="emergency_contacts[${emergencyContactIndex}][address]"
                                class="form-control"
                                placeholder="Address">
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-3 mb-3">
                            <input type="text" name="emergency_contacts[${emergencyContactIndex}][contact_num]"
                                class="form-control"
                                placeholder="Phone (e.g., 09123456789)"
                                pattern="^(09)\\d{9}$" required
                                title="Phone number must start with 09 and be 11 digits long">
                        </div>

                        <!-- Remove Button aligned to the far right -->
                        <div class="col-md-12 mb-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger removeRow">Remove</button>
                        </div>
                    </div>
                    <hr>


    `;

    wrapper.appendChild(newRow);
    emergencyContactIndex++;
});

// Remove Row Button
document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("removeRow")) {
        e.target.closest(".emergencyContactRow").remove();
    }
});
    });