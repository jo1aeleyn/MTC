<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'The username or email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        $credentials = $request->only('password');
        $username = $request->username;

        // Determine if username is an email or a regular username
        $fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$fieldType] = $username;

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['Invalid login credentials.'])->withInput($request->except('password'));
    }
    /**
     * Log out the user.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

     // Display the profile page
     public function showProfilePage()
     {
         return view('auth.ProfilePage', [
             'user' => Auth::user()
         ]);
     }

     // Update profile details (username, password, and profile picture)
     public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'username' => 'required|string|max:255|unique:user_accounts_tbl,username,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);


    // Update username if changed
    if ($request->has('username') && $request->username !== $user->username) {
        $user->username = $request->username;
    }

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete the old picture if it exists
        if ($user->profile_picture && Storage::exists('public/Profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/Profile_pictures/' . $user->profile_picture);
        }

        // Store the new picture and get the filename
        $filename = $request->file('profile_picture')->store('Profile_pictures', 'public');
        $user->profile_picture = basename($filename);
    }

    // Save the updated user data
    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}


}
