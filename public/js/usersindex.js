$(document).ready(function () {
    $('#usersTable').DataTable();
});

function confirmDelete(event, button) {
    event.preventDefault(); // Prevents the form from submitting immediately

    Swal.fire({
        title: 'Are you sure?',
        text: 'Are you sure you want to archive this?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, archive it!',
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('form').submit(); // Submit the form if confirmed
        }
    });
}