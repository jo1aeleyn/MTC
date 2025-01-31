$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.createuser-button', function (e) {
        var modal = $('#modal-1');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createUserRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.creatbimage-button', function (e) {
        var modal = $('#modal-17');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createBrgyImageRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.createhousehold-button', function (e) {
        e.preventDefault();
        var modal = $('#modal-4');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createUserRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.createfaqs-button', function (e) {
        e.preventDefault();
        var modal = $('#modal-28');
        var contentSection = modal.find('.modal-body_28');
        $.ajax({
            url: createUserRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.createstreets-button', function (e) {
        e.preventDefault();
        var modal = $('#modal-7');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createOfficialsRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.createfaqs-button', function (e) {
        var modal = $('#modal-28');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createFaqsRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.createstepbystep-button', function (e) {
        var modal = $('#modal-30');
        var contentSection = modal.find('.modal-body');
        $.ajax({
            url: createFaqsRoute,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
});

function editBarangayImage(barangayImageId, editBarangayImageRoute) {
    var modal = $('#modal-20');
    var modalBody = $('#modal-20 .at_modal-body_20');

    modal.modal('hide'); 

    $.ajax({
        url: editBarangayImageRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            barangayImageId: barangayImageId
        },
        success: function (response) {
            var htmlContent = $(response);
            var newModalBody = htmlContent.find('.at_modal-body_20').html();
            modalBody.html(newModalBody);

            modal.modal('show'); 
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            modalBody.html("<p>An error occurred while loading content.</p>");

            modal.modal('show'); 
        }
    });
}

function editFAQS(editFAQSId, editFAQSRoute) {
    var modal = $('#modal-29');
    var modalBody = $('#modal-29 .modal-body');
    modal.modal('hide'); 
    $.ajax({
        url: editFAQSRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            editFAQSId: editFAQSId
        },
        success: function (response) {
            var htmlContent = $(response);
            var newModalBody = htmlContent.find('.modal-body').html();
            modalBody.html(newModalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            modalBody.html("<p>An error occurred while loading content.</p>");
            modal.modal('show');
        }
    });
}

function editStep(editStepSId, editStepRoute) {
    var modal = $('#modal-31');
    var modalBody = $('#modal-31 .modal-body');
    modal.modal('hide'); 
    $.ajax({
        url: editStepRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            editStepSId: editStepSId
        },
        success: function (response) {
            var htmlContent = $(response);
            var newModalBody = htmlContent.find('.modal-body').html();
            modalBody.html(newModalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            modalBody.html("<p>An error occurred while loading content.</p>");
            modal.modal('show');
        }
    });
}

function viewUserDetails(usersId, viewUserRoute) {
    var modal = $('#modal-2');
    modal.modal('hide');
    $.ajax({
        url: viewUserRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            usersId: usersId
        },
        success: function (response) {
            $('#modal-2 .at_modal-body_2').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_2');
            $('#modal-2 .at_modal-body_2').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editUser(officialId, editUserRoute) {
    var modal = $('#modal-3');
    modal.modal('hide');
    $.ajax({
        url: editUserRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            officialId: officialId
        },
        success: function (response) {
            $('#modal-3 .at_modal-body_3').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_3');
            $('#modal-3 .at_modal-body_3').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editHouseholdDetails(householdId, editHouseholdRoute) {
    var modal = $('#modal-6');
    modal.modal('hide');
    $.ajax({
        url: editHouseholdRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            householdId: householdId
        },
        success: function (response) {
            $('#modal-6 .at_modal-body_6').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_6');
            $('#modal-6 .at_modal-body_6').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}


function viewStreetNamesDetails(streetnamesId, viewStreetNamesRoute) {
    var modal = $('#modal-8');
    modal.modal('hide');
    $.ajax({
        url: viewStreetNamesRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            streetnamesId: streetnamesId
        },
        success: function (response) {
            $('#modal-8 .at_modal-body_8').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_8');
            $('#modal-8 .at_modal-body_8').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editStreetNamesDetails(officialId, editHouseholdRoute) {
    var modal = $('#modal-9');
    modal.modal('hide');
    $.ajax({
        url: editHouseholdRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            officialId: officialId
        },
        success: function (response) {
            $('#modal-9 .at_modal-body_9').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_9');
            $('#modal-9 .at_modal-body_9').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editHealthTip(healthTipId) {
    const url = `/health-tips/${healthTipId}/edit`;
    $('#editHealthTipModal').modal('hide');
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#editHealthTipForm').attr('action', `/health-tips/${healthTipId}`);
            $('#editHealthTipModal #title').val(response.title);
            $('#editHealthTipModal #content').val(response.content);

            if (response.image) {
                $('#HealthTipsImg').attr('src', `/storage/health_tips/${response.image}`);
                $('#HealthTipsImg').attr('alt', response.title);
            } else {
                $('#HealthTipsImg').attr('src', ''); 
                $('#HealthTipsImg').attr('alt', 'No Image');
            }

            
            $('#editHealthTipModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editSchedule(scheduleId) {
    const url = `/schedules/${scheduleId}/edit`; 
    $('#editScheduleModal').modal('hide');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            
            $('#editScheduleForm').attr('action', `/schedules/${scheduleId}`);
            $('#editScheduleModal #service').val(response.service);
            $('#editScheduleModal #time').val(response.time);
            $('#editScheduleModal #day').val(response.day);
            $('#editScheduleModal #time').val(response.time).change();
            $('#editScheduleModal #day').val(response.day).change();
            $('#editScheduleModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editProfile(profileId) {
    const url = `/profiles/${profileId}/edit`;
    $('#editCenterProfileModal').modal('hide');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#editCenterProfileForm').attr('action', `/profiles/${profileId}`);
            $('#editCenterProfileForm #first_name').val(response.first_name);
            $('#editCenterProfileForm #middle_name').val(response.middle_name || '');
            $('#editCenterProfileForm #last_name').val(response.last_name);
            $('#editCenterProfileForm #position').val(response.position);
            if (response.image) {
                $('#HealthCenterImg').attr('src', `/storage/center_profiles/${response.image}`);
                $('#HealthCenterImg').attr('alt', `${response.last_name} ${response.position}`);
            } else {
                $('#HealthCenterImg').attr('src', '').attr('alt', 'No Image');
            }
            $('#editCenterProfileModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

$(document).ready(function() {
    $(document).on('click', '[data-action="edit-health-tip"]', function() {
        var healthTipId = $(this).data('id');
        editHealthTip(healthTipId);
    });
});

function viewOfficialDetails(officialId, viewRoute) {
    var modal = $('#modal-11');
    if (modal.hasClass('show')) {
        modal.removeClass('show').css('display', 'none');
    }

    $.ajax({
        url: viewRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            officialId: officialId
        },
        success: function (response) {
            $('#modal-11 .at_modal-body_11').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_11');
            $('#modal-11 .at_modal-body_11').html(modalBody);
            modal.addClass('show').css('display', 'block');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function editOfficial(officialId, editOfficialRoute) {
    var modal = $('#modal-12');
    modal.modal('hide');
    $.ajax({
        url: editOfficialRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            officialId: officialId
        },
        success: function (response) {
            $('#modal-12 .at_modal-body_12').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_12');
            $('#modal-12 .at_modal-body_12').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function archiveResident(residentId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Archived!",
                        text: "The resident has been archived.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error archiving the resident.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function archiveResident(residentId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Archived!",
                        text: "The resident has been archived.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error archiving the resident.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function deleteHousehold(householdId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The household has been deleted.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error deleting the household.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function archiveBarangayOfficial(barangayOfficialId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Archived!",
                        text: "The barangay official has been archived.",
                        icon: "success",
                        onClose: function () {
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error archiving the barangay official.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function deleteStreetName(streetNameId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The street name has been deleted.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error deleting the street name.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Archive TransparencyBoard
    window.archiveTransparencyBoard = function(documentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to archive this document?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, archive it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('archiveTransparencyBoardForm').action = `/transparency/${documentId}/archive`;
                document.getElementById('archiveTransparencyBoardForm').submit();
            }
        });
    };

    // Unarchive TransparencyBoard
    window.unarchiveTransparencyBoard = function(documentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to unarchive this document?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, unarchive it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('archiveTransparencyBoardForm').action = `/transparency/${documentId}/unarchive`;
                document.getElementById('archiveTransparencyBoardForm').submit();
            }
        });
    };
});

function archiveProfile(profileId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: 'Cancel',
        reverseButtons: true 
    }).then((result) => {
        if (result.isConfirmed) {
            // Make an AJAX request to archive the profile
            fetch(`/profiles/${profileId}`, {
                method: 'DELETE', // Use DELETE method to archive
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // Parse the JSON response
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                // Handle the success response
                Swal.fire(
                    'Archived!',
                    data.message || 'The profile has been archived.',
                    'success'
                ).then(() => {
                    // Optionally reload the page or update the UI
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'There was a problem archiving the profile.',
                    'error'
                );
            });
        }
    });
}

function deleteHealthTip(healthTipId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById('deleteHealthTipForm');
            form.action = '/health_tips/' + healthTipId;
            form.submit();
        }
    });
}

// archive HealthCenterSchedule
function archiveSchedule(scheduleId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to archive this schedule?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, archive it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('archiveScheduleForm').action = `/schedules/${scheduleId}/archive`;
            document.getElementById('archiveScheduleForm').submit();
        }
    });
}
// unarchive healthcenter schedule
function unarchiveSchedule(scheduleId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to unarchive this schedule?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, unarchive it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('archiveScheduleForm').action = `/schedules/${scheduleId}/unarchive`;
            document.getElementById('archiveScheduleForm').submit();
        }
    });
}

function deleteBarangayImage(barangayImageId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + barangayImageId).submit();
        }
    });
}

function viewContactDetails(contactId, viewContactRoute) {
    var modal = $('#modal-18');
    modal.modal('hide');

    $.ajax({
        url: viewContactRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            contactId: contactId
        },
        success: function (response) {
            console.log("Response:", response);
            modal.find('.at_modal-body_8').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_8');
            modal.find('.at_modal-body_8').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr) {
            console.error("AJAX Error:", xhr.responseText);
        }
    });
}

function editContactDetails(contactId, editContactRoute) {
    var modal = $('#modal-17');
    modal.modal('hide');

    $.ajax({
        url: editContactRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            contactId: contactId
        },
        success: function (response) {
            
            modal.find('.at_modal-body_8').html(""); 
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_8').html();
            modal.find('.at_modal-body_8').html(modalBody);
            
            
            document.getElementById('brgycontactedit').addEventListener('change', function(e) {
                var file = e.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('barangayContactsImgEdit').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            modal.modal('show');
        },
        error: function (xhr) {
            console.error("AJAX Error:", xhr.responseText);
        }
    });
}

function deleteContact(contactID, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The contact name has been archived.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error archiving the contact.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function archiveInformation(informationId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, archive it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'PUT'
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Archived!",
                            text: response.message,
                            icon: "success",
                            onClose: function () {
                                window.location.href = barangayInformationIndexRoute;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error deleting the barangay information",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function deleteBarangayAnnouncement(barangayAnnouncementId, deleteRoute) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE'
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The barangay announcement has been deleted.",
                        icon: "success",
                        onClose: function () {
                            
                            location.reload();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error deleting the barangay announcement.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

function aboutUsImage(aboutUsImageId, aboutUsImageRoute) {
    var modal = $('#modal-13');
    modal.modal('hide');
    $.ajax({
        url: aboutUsImageRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            aboutUsImageId: aboutUsImageId
        },
        success: function (response) {
            $('#modal-13 .at_modal-body_13').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_13');
            $('#modal-13 .at_modal-body_13').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function missionImage(missionImageId, missionImageRoute) {
    var modal = $('#modal-14');
    modal.modal('hide');
    $.ajax({
        url: missionImageRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            missionImageId: missionImageId
        },
        success: function (response) {
            $('#modal-14 .at_modal-body_14').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_14');
            $('#modal-14 .at_modal-body_14').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function visionImage(visionImageId, visionImageRoute) {
    var modal = $('#modal-15');
    modal.modal('hide');
    $.ajax({
        url: visionImageRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            visionImageId: visionImageId
        },
        success: function (response) {
            $('#modal-15 .at_modal-body_15').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_15');
            $('#modal-15 .at_modal-body_15').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function historyImage(historyImageId, historyImageRoute) {
    var modal = $('#modal-16');
    modal.modal('hide');
    $.ajax({
        url: historyImageRoute,
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            historyImageId: historyImageId
        },
        success: function (response) {
            $('#modal-16 .at_modal-body_16').html("");
            var htmlContent = $(response);
            var modalBody = htmlContent.find('.at_modal-body_16');
            $('#modal-16 .at_modal-body_16').html(modalBody);
            modal.modal('show');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function setStatus(link, status, event) {
    event.preventDefault();

    var button = link.closest('.btn-group').querySelector('.dropdown-toggle');
    var form = link.closest('form');
    var row = link.closest('tr');

    if (button.textContent.trim().toLowerCase() !== status.toLowerCase()) {
        button.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        button.classList.remove('btn-primary', 'btn-success', 'btn-danger', 'btn-warning');

        if (status === 'pending') {
            button.classList.add('btn-primary');
        } else if (status === 'approved') {
            button.classList.add('btn-success');
        } else if (status === 'picked-up') {
            button.classList.add('btn-warning');
        } else if (status === 'denied') {
            button.classList.add('btn-danger');
        }

        if (form) {
            var statusInput = form.querySelector('.statusInput');
            var originalStatus = statusInput.value;

            statusInput.value = status;

            if (originalStatus !== status) {
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok.');
                    }
                }).then(data => {
                    if (data && data.status) {
                        if (row) {
                            row.setAttribute('data-status', status);

                            if (status === 'picked-up') {
                                row.style.display = 'none';
                                row.remove();
                            }
                        }

                        var alertSuccess = document.querySelector('.custom-alert-success');
                        if (alertSuccess) {
                            
                            alertSuccess.innerHTML = `
                                ${data.status}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            `;
                            alertSuccess.style.display = 'block';
                        } else {
                            console.error('Custom alert success element not found.');
                        }

                        const currentFilter = document.querySelector('#filterStatusDropdown .dropdown-item.active');
                        const filterStatus = currentFilter ? currentFilter.getAttribute('data-status') : '';
                        filterTable(filterStatus);
                    }
                }).catch(error => {
                    console.error('Fetch error:', error);
                });
            } else {
                console.log('No status change made.');
            }
        }
    }
}

function updateStatus(status) {
    var statusButton = document.querySelector('.statusButton');
    document.querySelector('.statusInput').value = status;

    statusButton.classList.remove('btn-primary', 'btn-success', 'btn-danger', 'btn-warning');

    if (status === 'pending') {
        statusButton.classList.add('btn-primary');
    } else if (status === 'approved') {
        statusButton.classList.add('btn-success');
    } else if (status === 'denied') {
        statusButton.classList.add('btn-danger');
    } else if (status === 'picked-up') {
        statusButton.classList.add('btn-warning');
    }

    statusButton.textContent = status.charAt(0).toUpperCase() + status.slice(1);
}

function confirmActivation(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to activate this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, activate it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('activate-form-' + userId).submit();
        }
    });
}

function confirmDeactivation(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to deactivate this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, deactivate it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deactivate-form-' + userId).submit();
        }
    });
}


function filterTable(status) {
    let matchCount = 0;
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        if (status === '' || rowStatus === status) {
            row.style.display = '';
            matchCount++;
        } else {
            row.style.display = 'none';
        }
    });

    
    const noResultsMessage = document.querySelector('#noResultsMessage'); 
    if (noResultsMessage) {
        if (matchCount === 0) {
            noResultsMessage.innerHTML = `There are no ${status ? status + 's' : 'records'} matching your filter 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }
    }
}

document.querySelectorAll('#filterStatusDropdown .dropdown-item').forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelectorAll('#filterStatusDropdown .dropdown-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        const status = this.getAttribute('data-status');
        filterTable(status);
    });
});

$(document).ready(function() {
    
    $('#imageedit').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#HealthCenterImg').attr('src', e.target.result);
            $('#HealthCenterImg').attr('alt', file.name);
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('#HealthCenterImg').attr('src', '');
            $('#HealthCenterImg').attr('alt', 'No Image');
        }
    });

    $('#healthipsedit').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#HealthCenterImg').attr('src', e.target.result);
            $('#HealthCenterImg').attr('alt', file.name);
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('#HealthCenterImg').attr('src', '');
            $('#HealthCenterImg').attr('alt', 'No Image');
        }
    });

    $('#imagecreate').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#CreateHealthCenterTips').attr('src', e.target.result);
            $('#CreateHealthCenterTips').attr('alt', file.name);
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('#CreateHealthCenterTips').attr('src', '');
            $('#CreateHealthCenterTips').attr('alt', 'No Image');
        }
    });

    $('#imgcontactcreate').change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#BarangayContactsImg').attr('src', e.target.result);
            $('#BarangayContactsImg').css('display', 'block');
            $('#BarangayContactsImg').attr('alt', file.name);
        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('#BarangayContactsImg').attr('src', '');
            $('#BarangayContactsImg').attr('alt', 'No Image');
            $('#BarangayContactsImg').css('display', 'none');
        }
    });

    function deleteDescription(id, route) {
        if (confirm('Are you sure you want to delete this description?')) {
            $.ajax({
                url: route,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    alert('Error deleting description.');
                }
            });
        }
    }

});