<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\AnnouncementMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;


class AnnouncementController extends Controller
{
    public function index()
{
    // Retrieve announcements where IsArchived is 0, ordered by latest
    $announcements = Announcement::where('IsArchived', 0)->latest()->get();

    return view('announcements.index', compact('announcements'));
}  
public function companyannouncements()
{
    // Retrieve paginated announcements where IsArchived is 0, ordered by latest
    $announcements = Announcement::where('IsArchived', 0)->latest()->paginate(6); // Adjust the number per page if needed

    return view('announcements.companyAnnouncements', compact('announcements'));
}



    public function create()
    {
        return view('announcements.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements', 'public');
            $imagePath = basename($imagePath);
        }
    
        $announcement = Announcement::create([
            'uuid' => Str::uuid(),
            'announcementID' => 'ANN-' . time(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'createdBy' => Auth::id(),
            'image' => $imagePath,
        ]);
    
        // Fetch only active employee emails
        $employeeEmails = Employee::where('is_archived', 0)->pluck('email')->toArray();
    
        // Send email only if there are recipients
        if (!empty($employeeEmails)) {
            Mail::to($employeeEmails)->send(new AnnouncementMail($announcement));
        }
    
        return redirect()->route('announcements.index')->with('success', 'Announcement created and emailed successfully.');
    }
    
    


public function show(Announcement $announcement)
{
    $announcement->load('createdByUser'); // Eager load the user account

    return view('announcements.show', compact('announcement'));
}

    public function edit($uuid)
    {
        $announcement = Announcement::where('uuid', $uuid)->firstOrFail(); // Fetch by UUID
        return view('announcements.edit', compact('announcement'));
    }
    
    public function update(Request $request, $uuid)
    {
        // Find the announcement using UUID
        $announcement = Announcement::where('uuid', $uuid)->firstOrFail();
    
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image upload if a new image is provided
        $imagePath = $announcement->image; // Keep the existing image if not updated
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($announcement->image && Storage::exists('public/announcements/' . $announcement->image)) {
                Storage::delete('public/announcements/' . $announcement->image);
            }
    
            // Store the new image and get only the filename
            $imagePath = $request->file('image')->store('announcements', 'public');
            $imagePath = basename($imagePath); // Extract only the filename
        }
    
        // Update the announcement
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'editedBy' => auth()->id(),
            'image' => $imagePath, // Save only the filename
        ]);
    
        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }
    

    public function archive(Announcement $announcement)
    {
        $announcement->update([
            'IsArchived' => true,
            'ArchivedBy' => auth()->id(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement archived successfully.');
    }
}
