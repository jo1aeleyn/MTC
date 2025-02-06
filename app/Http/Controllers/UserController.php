<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


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
        'email' => 'required|unique:user_accounts_tbl,email',
        'user_role' => 'required',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Generate a random password
    $randomPassword = Str::random(8); // You can adjust the length here

    // Hash the password
    $hashedPassword = Hash::make($randomPassword);

    // Upload the profile picture if provided
    $profile_picture = null;
    if ($request->hasFile('profile_picture')) {
        $destinationPath = public_path('profile_pictures'); 
        $extension = $request->file('profile_picture')->getClientOriginalExtension();
        $filename = 'user_' . time() . '.' . $extension;
        $request->file('profile_picture')->move($destinationPath, $filename);
        $profile_picture = $filename;
    }

    // Create the user account
    $user = UserAccount::create([
        'uuid' => \Str::uuid(),
        'email' => $request->email,
        'username' => $request->username,
        'password' => $hashedPassword,
        'user_role' => $request->user_role,
        'profile_picture' => $profile_picture,
        'created_by' => auth()->id(),
    ]);

    // Send the generated password to the user's email
    Mail::to($request->email)->send(new \App\Mail\UserPasswordMail($randomPassword));

    return redirect()->route('users.index')->with('success', 'User created successfully. The password has been emailed.');
}

    public function edit($uuid)
    {
        $user = UserAccount::where('uuid', $uuid)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $uuid)
{
    $user = UserAccount::where('uuid', $uuid)->firstOrFail();

    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:user_accounts_tbl,username,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'user_role' => 'required|in:admin,user',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $updatedFields = [];

    // Update username if changed
    if ($request->has('username') && $request->username !== $user->username) {
        $updatedFields['username'] = $request->username;
    }

    // Update password only if provided
    if ($request->filled('password')) {
        $updatedFields['password'] = bcrypt($request->password);
    }

    // Update user role if changed
    if ($request->has('user_role') && $request->user_role !== $user->user_role) {
        $updatedFields['user_role'] = $request->user_role;
    }

    // Handle profile picture update
    if ($request->hasFile('profile_picture')) {
        $destinationPath = public_path('profile_pictures');

        // Delete old profile picture if exists
        if ($user->profile_picture && File::exists($destinationPath . '/' . $user->profile_picture)) {
            File::delete($destinationPath . '/' . $user->profile_picture);
        }

        $extension = $request->file('profile_picture')->getClientOriginalExtension();
        $filename = 'user_' . time() . '.' . $extension;
        $request->file('profile_picture')->move($destinationPath, $filename);
        $updatedFields['profile_picture'] = $filename;
    }

    // If any field was updated, save changes and update `edited_by`
    if (!empty($updatedFields)) {
        $updatedFields['edited_by'] = auth()->id();
        $user->update($updatedFields);
    }

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}
public function resetPassword($uuid)
{
    $user = UserAccount::where('uuid', $uuid)->firstOrFail();

    // Generate a new random password
    $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&*!'), 0, 12);

    // Update the user's password in the database
    $user->update(['password' => Hash::make($newPassword)]);

    // Send email with new password
    Mail::to($user->email)->send(new ResetPasswordMail($newPassword));

    return redirect()->route('users.index')->with('success', 'A new password has been sent to the user\'s email.');
}

    public function destroy($id)
    {
        $user = UserAccount::findOrFail($id);
        $user->update(['is_archived' => 1, 'archived_by' => auth()->id()]);

        return redirect()->route('users.index')->with('success', 'User archived successfully.');
    }
}
