<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
{
    // Retrieve announcements where IsArchived is 0, ordered by latest
    $announcements = Announcement::where('IsArchived', 0)->latest()->get();

    return view('announcements.index', compact('announcements'));
}


    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);

        // Handle the file upload if there's an image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements', 'public');
        } else {
            $imagePath = null; // If no image is uploaded
        }

        // Create a new announcement without specifying the 'id' field (auto-incremented)
        Announcement::create([
            'uuid' => Str::uuid(), // Generate a unique UUID and store it in the 'uuid' column
            'announcementID' => 'ANN-' . time(), // Generate a custom announcement ID using the current timestamp
            'title' => $request->title, // Title from the form input
            'content' => $request->content, // Content from the form input
            'category' => $request->category, // Category from the form input
            'createdBy' => Auth::id(), // The ID of the authenticated user
            'image' => $imagePath, // Save the image path
        ]);

        // Redirect to the announcement index page with a success message
        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        ]);

        // Handle image upload if a new image is uploaded
        $imagePath = $announcement->image; // Keep the existing image path by default
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($announcement->image && Storage::exists('public/' . $announcement->image)) {
                Storage::delete('public/' . $announcement->image);
            }

            // Store the new image and get its path
            $imagePath = $request->file('image')->store('announcements', 'public');
        }

        // Update the announcement
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'editedBy' => auth()->id(),
            'image' => $imagePath, // Update the image path
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
