document.addEventListener('DOMContentLoaded', function () {
    // Elements for checkbox and icon toggling
    const elements = {
        isForSelfCheckbox: document.getElementById('is_for_self_checkbox'),
        uncheckedIcon: document.querySelector('.form-check-icon.unchecked'),
        checkedIcon: document.querySelector('.form-check-icon.checked'),
        yesIAmText: document.querySelector('.text-active'),
        areYouRequestingText: document.querySelector('.text-content'),
        toggleText: document.querySelector('.toggle-text'),
        recipientRelationshipSection: document.getElementById('recipient_relationship_section'),
        filerNameSection: document.getElementById('filer_name_section'),
        filerFirstNameInput: document.getElementById('filer_first_name'),
        filerLastNameInput: document.getElementById('filer_last_name'),
        filerMiddleNameInput: document.getElementById('filer_middle_name'),
        dashedLine: document.querySelector('.dashed'),
        recipientRelationship: document.getElementById('recipient_relationship')
    };

    function toggleSections() {
        const isChecked = elements.isForSelfCheckbox.checked;

        // Toggle icons based on checkbox state
        elements.uncheckedIcon.classList.toggle('d-none', isChecked);
        elements.checkedIcon.classList.toggle('d-none', !isChecked);

        // Toggle other elements based on checkbox state
        elements.dashedLine.style.display = isChecked ? 'block' : 'none';
        elements.recipientRelationshipSection.style.display = isChecked ? 'block' : 'none';
        elements.filerNameSection.style.display = isChecked ? 'block' : 'none';
        elements.yesIAmText.classList.toggle('d-none', !isChecked);
        elements.areYouRequestingText.classList.toggle('d-none', isChecked);
        elements.toggleText.classList.toggle('d-none', isChecked);

        // Clear input values if checkbox is not checked
        if (!isChecked) {
            elements.filerFirstNameInput.value = '';
            elements.filerLastNameInput.value = '';
            elements.filerMiddleNameInput.value = '';
            elements.recipientRelationship.value = '';
        }
    }

    // Initial setup
    elements.isForSelfCheckbox.addEventListener('change', toggleSections);

    // Trigger initial toggleSections call
    toggleSections();

    // Validate Contact Number
    const contactNumberInput = document.getElementById('contact_number');
    if (contactNumberInput) {
        contactNumberInput.addEventListener('input', function () {
            //remove any non-numeric characters except +63 from the beginning
            const value = this.value.replace(/^\+63/, '');

            //check if number begins with 0
            if (value.startsWith('0')) {
                document.getElementById('contactNumberValidationMessage').textContent = 'The number should not start with 0 after +63.';
                return;
            }

            //check if it starts with +63 and is followed by 10 digits
            validateInput(this, /^\d{10}$/, 'Please enter a valid 10-digit number starting with +63.', 'contactNumberValidationMessage');
        });
    }

    // Validate Birthdate
    const birthdateInput = document.getElementById('birthdate');
    if (birthdateInput) {
        birthdateInput.addEventListener('input', function () {
            const value = this.value.trim();
            const isValid = /^\d{4}-\d{2}-\d{2}$/.test(value) && new Date(value) <= new Date();
            validateInput(this, isValid, 'Please enter a valid date in yyyy-mm-dd format before today.', 'birthdateValidationMessage');
        });
    }

    function validateInput(input, regexOrCondition, errorMessage, validationMessageId) {
        const value = input.value.trim();
        const isValid = typeof regexOrCondition === 'boolean' ? regexOrCondition : regexOrCondition.test(value);
        const validationMessage = document.getElementById(validationMessageId);

        if (!isValid) {
            showError(input, validationMessage, errorMessage);
        } else {
            clearError(input, validationMessage);
        }
    }

    function showError(input, validationMessage, message) {
        validationMessage.textContent = message;
        validationMessage.style.display = 'block';
        input.classList.add('is-invalid');
    }

    function clearError(input, validationMessage) {
        validationMessage.textContent = '';
        validationMessage.style.display = 'none';
        input.classList.remove('is-invalid');
    }
});

function disableSelectOption(selectElement) {
    // Get the "Select Sex" option
    var selectSexOption = selectElement.options[0];

    // Disable the "Select Sex" option if a value other than '' (empty string) is selected
    selectSexOption.disabled = selectElement.value !== '';
}
