document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#manageusers', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true },
            {orderable:false,
                targets:[0,5]
            }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Barangay Officials found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageusers_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#manageresidents', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true },
            {
                orderable: false,
                targets: [0, 2]
            }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Barangay Residents found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageresidents_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
    
    
    new DataTable('#managehousehold', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true },
            {orderable:false,
                targets:[0,4]
            }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Barangay Household found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="managehousehold_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#managestreetnames', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Street Names found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="managestreetnames_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#managefeedbacks', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Feedback(s) found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="managefeedbacks_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#managerequests', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true },
            {orderable:false,
                targets:[0,4,5,6]
            }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Document Requests found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="managerequests_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
    
    new DataTable('#manageTransparencyBoard', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { 
                orderable: false,
                targets: [0, 3, 4]
            }
        ],
        language: {
            emptyTable: 'No Transparency Document found.'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageTransparencyBoard_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#manageSchedules', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Schedule found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageSchedules_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#manageLogs', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Logs found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageLogs_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
    new DataTable('#manageVitaminA', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Vitamin A found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageVitaminA_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#manageMNP', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Logs found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageMNP_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });

    new DataTable('#manageAuditLogs', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Audit Logs found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageAuditLogs_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
    
    new DataTable('#manageInventory', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Inventory found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageInventory_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
    
    new DataTable('#manageInventoryLogs', {
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                fade: true
            },
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [
            { type: 'null', targets: '_all' },
            { targets: -1, visible: true }
        ],
        language: {
            emptyTable: '<div class="alert-danger">No Inventory found.</div>'
        },
        initComplete: function () {
            const dropdown = $('select[name="manageInventoryLogs_length"]');
            dropdown.removeClass('custom-select custom-select-sm form-control form-control-sm')
                    .addClass('form-select');
        }
    });
});

