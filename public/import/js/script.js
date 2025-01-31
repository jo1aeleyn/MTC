// PROFILE MANAGEMENT:

// Upload new image button to display preview
$(document).ready(function() {
    $('#upload').change(function() {
        // Get the selected file
        var file = $(this).prop('files')[0];
        // Display the selected file as a preview
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedAvatar').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#image').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedAnnouncement').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

//Save button
function toggleSaveButton() {
    if ($('#upload').get(0).files.length === 0) {
        $('#saveImage').prop('disabled', true);
    } else {
        $('#saveImage').prop('disabled', false);
    }
}

$(document).ready(function() {
    $('#saveImage').prop('disabled', true);
    $('#upload').on('change', function() {
        toggleSaveButton();
    });
    $('#saveImage').click(function() {
        $('#formImageUpload').submit();
    });
});
// function toggleSaveButton() {
//     if ($('#upload').get(0).files.length === 0) {
//         $('#saveImage').prop('disabled', true);
//     } else {
//         $('#saveImage').prop('disabled', false);
//     }
// }

$(document).ready(function() {
    toggleSaveButton(); 

    $('#upload').change(function() {
        toggleSaveButton();
    });
});


// Reset button
$(document).ready(function() {
    $('.account-image-reset').click(function() {
        // Reset the file input value to allow selecting the same file again
        $('#upload').val('');
        // Reset the preview image to the default avatar
        $('#uploadedAvatar').attr('src', '../assets/img/avatars/1.png');
    });
});

// Cancel Button
function cancelUpdate() {
    // Reset form fields
    document.getElementById("formAccountSettings").reset();
    // Reset Image preview
    //document.getElementById("uploadedAvatar").src = "{{ asset('public/import/img/avatars/' . Auth::user()->image) }}";
}

// Deactivation Button
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('accountActivation');
    const button = document.getElementById('deactivateButton');

    checkbox.addEventListener('change', function() {
        button.disabled = !checkbox.checked;
    });
});