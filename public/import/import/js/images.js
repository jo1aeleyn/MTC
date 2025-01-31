$(document).ready(function() {
    $('#image').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImages').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#image2').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImages2').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#image3').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImages3').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#image4').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImages4').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#images').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImagesj').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});
$(document).ready(function() {
    $('#image5').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadedImages5').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});


$(document).ready(function() {
    $('.image-input').change(function() {
        var fileInput = $(this);
        var file = fileInput.prop('files')[0];
        var reader = new FileReader();
        
        reader.onload = function(e) {
            var targetImageId = fileInput.data('target');
            $('#' + targetImageId).attr('src', e.target.result);
        };
        
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#image19').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imageEditgallery').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#BarangayLogo').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#BarangayLogoImg').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#healthipsedit').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#HealthTipsImg').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

$(document).ready(function() {
    $('#imagecreate').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#CreateHealthCenterImg').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
});

// CONTACTS IMAGE PREVIEW JS
console.log("images.js is loaded");
// $(document).ready(function() {
//   $('#brgycontactedit').change(function() {
//     var file = $(this).prop('files')[0];

//     if (!file) {
//       console.error('No file selected');
//       return;
//     }

//     // Check if the file is an image
//     if (!file.type.startsWith('image/')) {
//       alert('Please select a valid image file.');
//       return;
//     }

//     var reader = new FileReader();

//     reader.onload = function(e) {
//       // Update the image preview with the new image
//       $('#brgycontactedit').next().find('img').attr('src', e.target.result);
//     };

//     reader.onerror = function(e) {
//       console.error('Error reading file', e);
//       alert('An error occurred while reading the file. Please try again.');
//     };

//     reader.readAsDataURL(file);
//   });
// });

$(document).ready(function() {
    $('#file_path3').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();

        if (file) {
            var fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                reader.onload = function(e) {
                    $('#uploadedCreateBOfficials').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#uploadedCreateBOfficials').hide();
                alert('Only image files (jpg, jpeg, png) are allowed.');
            }
        } else {
            $('#uploadedCreateBOfficials').hide();
        }
    });
});
