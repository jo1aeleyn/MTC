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
                          start: event.start,
                          end: event.end,
                          extendedProps: {
                              audience: event.audience
                          },
                          // Set the background and a single text color for all events
                          backgroundColor: background,
                          textColor: '#333333', // Set a single text color (dark gray)
                          borderColor: 'transparent' // Remove border color
                      };
                  }));
              })
              .catch(error => {
                  console.error('Error fetching events:', error);
                  failureCallback(error);
              });
      },
      eventClick: function (info) {
          // Populate the form fields in the edit modal
          document.getElementById('eventDetailTitleInput').value = info.event.title;
          document.getElementById('eventDetailAudienceInput').value = info.event.extendedProps.audience;
          document.getElementById('eventDetailStartInput').value = info.event.start ? info.event.start.toISOString().slice(0, 16) : '';
          document.getElementById('eventDetailEndInput').value = info.event.end ? info.event.end.toISOString().slice(0, 16) : '';

          // Set the form action URLs for update and delete
          let updateForm = document.getElementById('updateEventForm');
          updateForm.action = '/events/' + info.event.id;

          let deleteForm = document.getElementById('deleteEventForm');
          if (deleteForm) {
              deleteForm.action = '/events/' + info.event.id;
          }

          // Show the edit modal
          eventDetailModalInstance.show();
      }
  });

  calendar.render();

  // Handle Save Changes in Add Event Modal
  document.getElementById('saveChangesBtn').addEventListener('click', function () {
      var eventTitle = document.getElementById('eventTitle').value;
      var audience = document.getElementById('audience').value;
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
          audience: audience,
          start: startDate,
          end: endDate
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

              // Randomly pick a color pair for new events
              const { background } = colorPairs[Object.keys(calendar.getEvents()).length % colorPairs.length]; // Use total event count

              calendar.addEvent({
                  id: data.event.id,
                  resourceId: data.event.resourceId || 'a',
                  title: data.event.title,
                  audience: data.event.audience,
                  start: data.event.start,
                  end: data.event.end,
                  extendedProps: {
                      audience: data.event.audience
                  },
                  // Set the background and a single text color for all events
                  backgroundColor: background,
                  textColor: '#333333', // Set a single text color (dark gray)
                  borderColor: 'transparent' // Remove border color
              });

              document.getElementById('eventTitle').value = '';
              document.getElementById('audience').value = '';
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

  function removeExtraBackdrops() {
      var backdrops = document.querySelectorAll('.modal-backdrop');
      backdrops.forEach(function (backdrop) {
          backdrop.parentNode.removeChild(backdrop);
      });
  }

  modalElement.addEventListener('hidden.bs.modal', function () {
      removeExtraBackdrops();
      document.body.style.overflow = 'auto';  // Allow scrolling again
  });

  eventDetailModal.addEventListener('hidden.bs.modal', function () {
      removeExtraBackdrops();
      document.body.style.overflow = 'auto';  // Allow scrolling again
  });

  modalElement.addEventListener('show.bs.modal', function () {
      removeExtraBackdrops();
  });

  eventDetailModal.addEventListener('show.bs.modal', function () {
      removeExtraBackdrops();
  });
});

// SweetAlert for Archive Confirmation
function confirmArchiveCalendar() {
  Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to archive this event?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, archive it!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {
          document.getElementById('deleteEventForm').submit();
      }
  });
}

function openEventModal(eventId, eventTitle, audience, startTime, endTime) {
  // Populate the form fields
  document.getElementById('eventDetailTitleInput').value = eventTitle;
  document.getElementById('eventDetailAudienceInput').value = audience;
  document.getElementById('eventDetailStartInput').value = startTime;
  document.getElementById('eventDetailEndInput').value = endTime;

  // Update the form action URLs
  document.getElementById('updateEventForm').action = `/events/${eventId}`;
  document.getElementById('deleteEventForm').action = `/events/${eventId}`;

  // Show the modal
  $('#eventDetailModal').modal('show');
}
