<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
            'password' => 'required|string|min:8|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'user_role' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile_picture = null;
        if ($request->hasFile('profile_picture')) {
            $destinationPath = public_path('profile_pictures'); 
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $filename = 'user_' . time() . '.' . $extension;
            $request->file('profile_picture')->move($destinationPath, $filename);
            $profile_picture = $filename;
        }

        UserAccount::create([
            'uuid' => \Str::uuid(),
            'email' => $request->email,
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
            $destinationPath = public_path('profile_pictures'); 

            // Delete old profile picture if exists
            if ($user->profile_picture && File::exists($destinationPath . '/' . $user->profile_picture)) {
                File::delete($destinationPath . '/' . $user->profile_picture);
            }

            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $filename = 'user_' . time() . '.' . $extension;
            $request->file('profile_picture')->move($destinationPath, $filename);
            $user->profile_picture = $filename;
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
