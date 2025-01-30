<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = UserAccount::where('is_archived', 0)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_accounts_tbl,username',
            'password' => 'required|string|min:8|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'user_role' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile_picture = null;
        if ($request->hasFile('profile_picture')) {
            $filename = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('profile_pictures'), $filename);
            $profile_picture = $filename;
        }

        UserAccount::create([
            'uuid' => \Str::uuid(),
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'user_role' => $request->user_role,
            'profile_picture' => $profile_picture,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = UserAccount::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = UserAccount::findOrFail($id);

    $request->validate([
        'username' => 'required|string|max:255|unique:user_accounts_tbl,username,' . $id,
        'password' => 'nullable|string|min:8|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'user_role' => 'required',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update username if changed
    if ($request->has('username') && $request->username !== $user->username) {
        $user->username = $request->username;
    }

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete the old picture if it exists
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        // Store the new picture and get the filename
        $filename = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = basename($filename);
    }

    // Update user role and edited_by
    $user->user_role = $request->user_role;
    $user->edited_by = auth()->id();

    // Save the updated user data
    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = UserAccount::findOrFail($id);
        $user->update(['is_archived' => 1, 'archived_by' => auth()->id()]);

        return redirect()->route('users.index')->with('success', 'User archived successfully.');
    }
}
