document.addEventListener('DOMContentLoaded', function () {
    try {
        // Initialize drag and drop for valid ID section
        initializeDragAndDrop('valid_id', 'valid_id_zone', 'valid_id_gallery', 'reset_valid_id', validIdPath);

        // Initialize drag and drop for ID photo section
        initializeDragAndDrop('id_photo', 'id_photo_zone', 'id_photo_gallery', 'reset_id_photo', idPhotoPath);

        // Handle form submission
        let uploadForm = document.getElementById('uploadForm');
        if (uploadForm) {
            uploadForm.addEventListener('submit', function (event) {
            });
        }
    } catch (error) {
        console.log('Error during DOMContentLoaded event:', error.message);
    }
});

// Function to initialize drag and drop listeners
function initializeDragAndDrop(inputId, dropZoneId, galleryId, resetButtonId, sessionImagePath) {
    try {
        let dropZone = document.getElementById(dropZoneId);
        let input = document.getElementById(inputId);
        let gallery = document.getElementById(galleryId);
        let resetButton = document.getElementById(resetButtonId);

        // Check if required elements are found
        if (!dropZone) throw new Error(`Drop zone element not found: ${dropZoneId}`);
        if (!input) throw new Error(`Input element not found: ${inputId}`);
        if (!gallery) throw new Error(`Gallery element not found: ${galleryId}`);
        if (!resetButton) throw new Error(`Reset button element not found: ${resetButtonId}`);

        // Display the image from session if available
        if (sessionImagePath) {
            let imageElement = document.createElement('img');
            imageElement.classList.add('uploaded-image');
            imageElement.src = sessionImagePath;
            gallery.appendChild(imageElement);
            resetButton.classList.remove('d-none');
        }

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function (event) {
                event.preventDefault();
                event.stopPropagation();
            }, false);
        });

        // Highlight drop area on drag over
        dropZone.addEventListener('dragover', function () {
            dropZone.classList.add('highlight');
        }, false);

        dropZone.addEventListener('dragleave', function () {
            dropZone.classList.remove('highlight');
        }, false);

        // Handle drop event
        dropZone.addEventListener('drop', function (event) {
            event.preventDefault();
            event.stopPropagation();
            dropZone.classList.remove('highlight');
            handleFileDrop(event, inputId, galleryId, resetButtonId);
        }, false);

        // Handle file input change event
        input.addEventListener('change', function (event) {
            event.preventDefault();
            event.stopPropagation();
            handleFileDrop(event, inputId, galleryId, resetButtonId);
        });

        // Check if there are initially images in the gallery to show the reset button
        if (gallery.children.length > 0) {
            resetButton.classList.remove('d-none');
        }
    } catch (error) {
        console.error('Error in initializeDragAndDrop:', error.message);
    }
}

// Function to handle file drop and display images
function handleFileDrop(event, inputId, galleryId, resetButtonId) {
    try {
        let files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
        let gallery = document.getElementById(galleryId);
        let resetButton = document.getElementById(resetButtonId);
        let errorMessage = document.getElementById(inputId + '_message');

        // Check if required elements are found
        if (!gallery) throw new Error(`Gallery element not found: ${galleryId}`);
        if (!resetButton) throw new Error(`Reset button element not found: ${resetButtonId}`);
        if (!errorMessage) throw new Error(`Error message element not found: ${inputId}_message`);

        // Clear existing images in the gallery
        gallery.innerHTML = '';

        // Ensure there is a file to process
        if (files.length === 0) throw new Error('No file found in the event.');

        // Ensure only the first image file is processed
        let file = files[0];

        // Check if the file is an image
        if (!file.type.match('image.*')) {
            errorMessage.textContent = 'Invalid file type. Please upload an image.';
            errorMessage.style.display = 'block';
            resetButton.classList.add('d-none');
            return;
        }

        let reader = new FileReader();

        // Read the image file as a data URL
        reader.onload = function (event) {
            let imageSrc = event.target.result;
            let imageElement = document.createElement('img');
            imageElement.classList.add('uploaded-image');
            imageElement.src = imageSrc;
            gallery.appendChild(imageElement);

            // Show the reset button when an image is displayed
            resetButton.classList.remove('d-none');
            errorMessage.style.display = 'none';
        };

        // Handle FileReader errors
        reader.onerror = function (event) {
            console.error('Error reading file:', event.target.error);
            errorMessage.textContent = 'Error reading file. Please try again.';
            errorMessage.style.display = 'block';
            gallery.innerHTML = '';
            resetButton.classList.add('d-none');
        };

        // Read the image file
        reader.readAsDataURL(file);

        // Update the file input element with the dropped file
        document.getElementById(inputId).files = files;

    } catch (error) {
        console.error('Error in handleFileDrop:', error.message);
    }
}

// Function to reset uploaded images and input field
function resetUpload(inputId, galleryId, resetButtonId) {
    try {
        let input = document.getElementById(inputId);
        let gallery = document.getElementById(galleryId);
        let resetButton = document.getElementById(resetButtonId);

        // Check if required elements are found
        if (!input) throw new Error(`Input element not found: ${inputId}`);
        if (!gallery) throw new Error(`Gallery element not found: ${galleryId}`);
        if (!resetButton) throw new Error(`Reset button element not found: ${resetButtonId}`);

        // Clear the input value and gallery content
        input.value = '';
        gallery.innerHTML = '';
        resetButton.classList.add('d-none');
    } catch (error) {
        console.error('Error in resetUpload:', error.message);
    }
}




document.querySelector('form').addEventListener('submit', function (e) {
    var validId = document.getElementById('valid_id').files.length;
    var idPhoto = document.getElementById('id_photo').files.length;

    if (!validId || !idPhoto) {
        e.preventDefault();
        if (!validId) {
            document.getElementById('valid_id_message').style.display = 'block';
        } else {
            document.getElementById('valid_id_message').style.display = 'none';
        }
        if (!idPhoto) {
            document.getElementById('id_photo_message').style.display = 'block';
        } else {
            document.getElementById('id_photo_message').style.display = 'none';
        }
    }
});

// JavaScript function to validate Mobile Number
function validateMobileNumber() {
    const mobileNumberInput = document.getElementById('emerMobile');
    const validationMessage = document.getElementById('validationMessage');

    if (mobileNumberInput && validationMessage) {
        const mobileNumber = mobileNumberInput.value.trim();

        if (mobileNumber === '') {
            validationMessage.textContent = 'Mobile Number cannot be blank.';
            validationMessage.style.display = 'block'; // Show the error message
            mobileNumberInput.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            return false;
        } else if (!/^\d{11}$/.test(mobileNumber)) {
            validationMessage.textContent = 'Please enter 11 digits starting with 09.';
            validationMessage.style.display = 'block'; // Show the error message
            mobileNumberInput.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            return false;
        } else {
            validationMessage.textContent = ''; // Clear any existing error message
            validationMessage.style.display = 'none'; // Hide the error message
            mobileNumberInput.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            return true;
        }
    }

    return false; // Return false by default if input element or validation message not found
}

// Event listener to validate on input change
const emerMobileInput = document.getElementById('emerMobile');
if (emerMobileInput) {
    emerMobileInput.addEventListener('input', validateMobileNumber);
}

document.addEventListener('DOMContentLoaded', function () {
    const formControlInputs = document.querySelectorAll('.form-control');

    formControlInputs.forEach(input => {
        input.addEventListener('input', function () {
            validateNumberInput(input);
        });
    });

    function validateNumberInput(input) {
        const value = input.value.trim();
        const isValid = /^\d+$/.test(value); // Only digits

        const validationMessage = input.parentElement.querySelector('.validation-message');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter numbers only.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const dateEstablishedInput = document.getElementById('DateEstablished');
    if (dateEstablishedInput) {
        dateEstablishedInput.addEventListener('input', function () {
            validateDateEstablished(this);
        });
    }

    function validateDateEstablished(input) {
        const value = input.value.trim();
        
        // Check if the date is in yyyy-mm-dd format and is before today
        const isValid = /^\d{4}-\d{2}-\d{2}$/.test(value) && new Date(value) < new Date();

        const validationMessage = document.getElementById('dateEstablishedValidationMessage');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter a valid date in yyyy-mm-dd format before today.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const contactNumberInput = document.getElementById('ContactNumber');
    if (contactNumberInput) {
        contactNumberInput.addEventListener('input', function () {
            validateContactNumber(this);
        });
    }

    function validateContactNumber(input) {
        const value = input.value.trim();
        const isValid = /^09\d{9}$/.test(value); // Starts with 09 and exactly 11 digits

        const validationMessage = input.parentElement.querySelector('.validation-message');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter a valid 11-digit number starting with 09.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const initialCapitalInput = document.getElementById('InitialCapital');
    if (initialCapitalInput) {
        initialCapitalInput.addEventListener('input', function () {
            validateCapitalInput(this);
        });
    }

    const presentCapitalInput = document.getElementById('PresentCapital');
    if (presentCapitalInput) {
        presentCapitalInput.addEventListener('input', function () {
            validateCapitalInput(this);
        });
    }

    function validateCapitalInput(input) {
        const value = input.value.trim();
        const isValid = /^\d+$/.test(value); // Only digits

        const validationMessage = input.parentElement.querySelector('.validation-message');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter numbers only.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const yellowCardExpiryInput = document.getElementById('YellowCardExpiry');

    yellowCardExpiryInput.addEventListener('input', function () {
        validateNumericInput(this);
    });

    function validateNumericInput(input) {
        const value = input.value.trim();
        const isValid = /^\d+$/.test(value); // Checks if input contains only digits

        const validationMessage = input.parentElement.querySelector('.validation-message');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter numbers only.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});

// not validating di ko alam bakit
document.addEventListener('DOMContentLoaded', function () {
    const residencyYearsMonthsInput = document.getElementById('residency_years_months');

    if (residencyYearsMonthsInput) { // Check if the element exists
        residencyYearsMonthsInput.addEventListener('input', function () {
            validateResidencyYearsMonthsInput(this);
        });
    }

    function validateResidencyYearsMonthsInput(input) {
        const value = input.value.trim();
        const isValid = /^\d+$/.test(value); // Only digits

        const validationMessage = input.parentElement.querySelector('.invalid-feedback');
        if (validationMessage) {
            if (!isValid) {
                validationMessage.textContent = 'Please enter numbers only.';
                input.classList.add('is-invalid'); // Apply Bootstrap is-invalid class
            } else {
                validationMessage.textContent = ''; // Clear validation message
                input.classList.remove('is-invalid'); // Remove Bootstrap is-invalid class
            }
        }
    }
});



