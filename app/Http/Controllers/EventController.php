<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('IsArchived', 0)->get()->map(function ($event) {
            return [
                'id'    => $event->id,
                'title' => $event->title,
                'start' => $event->start_date,
                'end'   => $event->end_date,
                'color' => $event->type == 'holiday' ? ($event->holiday_type == 'Regular Holiday' ? 'red' : 'blue') : 'green',
            ];
        });

        return view('calendar.index', compact('events'));
    }

public function getEvents()
{
    $events = Event::where('IsArchived', 0)->get()->map(function ($event) {
        return [
            'id'    => $event->id,
            'title' => $event->title,
            'start' => $event->start_date,
            'end'   => $event->end_date,
            'color' => $event->type == 'holiday' ? ($event->holiday_type == 'Regular Holiday' ? 'red' : 'blue') : 'green',
        ];
    });

    return response()->json($events);
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
 
    public function edit($id)
    {
        // Find the event by ID and return as JSON response
        $event = Event::find($id);
        return response()->json($event);
    }


    
public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);
    $event->update($request->all());

    return response()->json(['success' => true, 'message' => 'Event updated successfully.']);
}

    

public function archive($id)
{
    $event = Event::find($id);

    if (!$event) {
        return response()->json(['success' => false, 'message' => 'Event not found'], 404);
    }

    $event->IsArchived = 1;
    $event->ArchivedBy = auth()->user()->id;
    $event->ArchivedDate = now();
    $event->save();

    return response()->json(['success' => true, 'message' => 'Event archived successfully']);
}



}
