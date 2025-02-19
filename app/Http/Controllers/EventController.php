<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display the Calendar View
    public function index()
    {
        return view('calendar.index');
    }

    // Fetch Events for FullCalendar
    public function getEvents()
    {
        $events = Event::where('is_archived', false)->get();

        $eventData = [];
        foreach ($events as $event) {
            $color = $event->type == 'holiday' ? ($event->holiday_type == 'regular' ? 'red' : 'blue') : 'green';

            $eventData[] = [
                'id'    => $event->id,
                'title' => $event->title,
                'start' => $event->start_date,
                'end'   => $event->end_date,
                'color' => $color,
            ];
        }
        return response()->json($eventData);
    }

    // Store a New Event/Holiday
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'type'         => 'required|in:event,holiday',
            'holiday_type' => 'nullable|in:Regular Holiday,Special Holiday',
        ]);
    
        Event::create($request->all());
    
        return response()->json(['success' => true, 'message' => 'Event added successfully.']);
    }
    


    

    // Edit an Event/Holiday
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('calendar.edit', compact('event'));
    }

    // Update an Event/Holiday
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $request->validate([
            'title'        => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'type'         => 'required|in:event,holiday',
            'holiday_type' => 'nullable|in:regular,special,none',
        ]);

        $event->update($request->all());
        return redirect()->route('calendar.index')->with('success', 'Event updated successfully.');
    }

    // Archive an Event/Holiday
    public function archive($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['is_archived' => true]);

        return redirect()->route('calendar.index')->with('success', 'Event archived successfully.');
    }
}
