document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var modalElement = document.getElementById('modalCenter');
    var modalInstance = new bootstrap.Modal(modalElement);
    var eventDetailModal = document.getElementById('eventDetailModal');
    var eventDetailModalInstance = new bootstrap.Modal(eventDetailModal);
  
    // Array of background colors
    const colorPairs = [
        { background: '#fff2d6' },
        { background: '#ffdfda' },
        { background: '#e7e7ff' },
        { background: '#e8fadf' },
        { background: '#d7f5fc' }
    ];
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
            resourceTimelineDay: { type: 'resourceTimelineDay' },
            resourceTimelineWeek: { type: 'resourceTimelineWeek' }
        },
        resources: function (fetchInfo, successCallback, failureCallback) {
            successCallback([
                { id: 'a', title: 'Room A' },
                { id: 'b', title: 'Room B' }
            ]);
        },
        events: function (fetchInfo, successCallback, failureCallback) {
            fetch('/events')
                .then(response => response.json())
                .then(data => {
                    successCallback(data.events.map((event, index) => {
                        // Use modulus to cycle through colors based on event index
                        const { background } = colorPairs[index % colorPairs.length];
                        return {
                            id: event.id,
                            resourceId: event.resourceId || 'a',
                            title: event.title,
                            start: event.start_date,
                            end: event.end_date,
                            extendedProps: {
                                type: event.type,
                                holiday_type: event.holiday_type
                            },
                            backgroundColor: background,
                            textColor: '#333333',
                            borderColor: 'transparent'
                        };
                    }));
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                    failureCallback(error);
                });
        },
        eventClick: function (info) {
            document.getElementById('eventDetailTitleInput').value = info.event.title;
            document.getElementById('eventDetailTypeInput').value = info.event.extendedProps.type;
            document.getElementById('eventDetailHolidayTypeInput').value = info.event.extendedProps.holiday_type;
            document.getElementById('eventDetailStartInput').value = info.event.start ? info.event.start.toISOString().slice(0, 16) : '';
            document.getElementById('eventDetailEndInput').value = info.event.end ? info.event.end.toISOString().slice(0, 16) : '';
  
            let updateForm = document.getElementById('updateEventForm');
            updateForm.action = '/events/' + info.event.id;
  
            let deleteForm = document.getElementById('deleteEventForm');
            if (deleteForm) {
                deleteForm.action = '/events/' + info.event.id;
            }
  
            eventDetailModalInstance.show();
        }
    });
  
    calendar.render();
  
    document.getElementById('saveChangesBtn').addEventListener('click', function () {
        var eventTitle = document.getElementById('eventTitle').value;
        var type = document.getElementById('type').value;
        var holidayType = document.getElementById('holidayType').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        var errorMsg = document.getElementById('errorMsg');
        var successMsg = document.getElementById('successMsg');
  
        errorMsg.style.display = 'none';
        successMsg.style.display = 'none';
  
        if (!startDate) {
            errorMsg.style.display = 'block';
            errorMsg.innerText = 'Start Date is required';
            return;
        }
  
        if (!eventTitle) {
            errorMsg.style.display = 'block';
            errorMsg.innerText = 'Title is required';
            return;
        }
  
        var data = {
            title: eventTitle,
            type: type,
            holiday_type: holidayType,
            start_date: startDate,
            end_date: endDate
        };
  
        fetch('/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err });
            }
            return response.json();
        })
        .then(data => {
            if (data.event) {
                successMsg.style.display = 'block';
                successMsg.innerText = 'Event created successfully!';
  
                modalInstance.hide();
  
                const { background } = colorPairs[Object.keys(calendar.getEvents()).length % colorPairs.length];
  
                calendar.addEvent({
                    id: data.event.id,
                    resourceId: data.event.resourceId || 'a',
                    title: data.event.title,
                    start: data.event.start_date,
                    end: data.event.end_date,
                    extendedProps: {
                        type: data.event.type,
                        holiday_type: data.event.holiday_type
                    },
                    backgroundColor: background,
                    textColor: '#333333',
                    borderColor: 'transparent'
                });
  
                document.getElementById('eventTitle').value = '';
                document.getElementById('type').value = '';
                document.getElementById('holidayType').value = '';
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
            } else {
                errorMsg.style.display = 'block';
                errorMsg.innerText = 'Failed to create event';
            }
        })
        .catch(error => {
            errorMsg.style.display = 'block';
            errorMsg.innerText = 'Error: ' + (error.message || 'Unexpected error');
            console.error('Error:', error);
        });
    });
  });
