<form method="POST" action="{{ route('events.update', $event->id) }}">
    @csrf
    <input type="hidden" name="id" value="{{ $event->id }}">

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Start Date</label>
        <input type="date" class="form-control" name="start_date" value="{{ $event->start_date }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">End Date</label>
        <input type="date" class="form-control" name="end_date" value="{{ $event->end_date }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Type</label>
        <select class="form-control" name="type">
            <option value="holiday" {{ $event->type == 'holiday' ? 'selected' : '' }}>Holiday</option>
            <option value="meeting" {{ $event->type == 'meeting' ? 'selected' : '' }}>Meeting</option>
            <option value="general" {{ $event->type == 'general' ? 'selected' : '' }}>General</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Holiday Type</label>
        <select class="form-control" name="holiday_type">
            <option value="Regular Holiday" {{ $event->holiday_type == 'Regular Holiday' ? 'selected' : '' }}>Regular Holiday</option>
            <option value="Special Non-Working Holiday" {{ $event->holiday_type == 'Special Non-Working Holiday' ? 'selected' : '' }}>Special Non-Working Holiday</option>
        </select>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update Event</button>
        <button type="button" class="btn btn-danger" onclick="deleteEvent({{ $event->id }})">Delete</button>
    </div>
</form>

<script>
function deleteEvent(eventId) {
    if (confirm("Are you sure you want to delete this event?")) {
        fetch(`{{ url('events/delete') }}/${eventId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error("Error deleting event:", error));
    }
}
</script>
