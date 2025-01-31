<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


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
             // Define the upload path
             $destinationPath = public_path('profile_pictures'); 
     
             // Delete the old picture if it exists
             if ($user->profile_picture && File::exists($destinationPath . '/' . $user->profile_picture)) {
                 File::delete($destinationPath . '/' . $user->profile_picture);
             }
     
             // Get file extension
             $extension = $request->file('profile_picture')->getClientOriginalExtension();
     
             // Define the new filename (Example: user_1_timestamp.jpg)
             $filename = 'user_' . $user->id . '_' . time() . '.' . $extension;
     
             // Move the uploaded file to public/profile_pictures
             $request->file('profile_picture')->move($destinationPath, $filename);
     
             // Save only the filename in the database
             $user->profile_picture = $filename;
         }
     
         // Save the updated user data
         $user->save();
     
         return redirect()->route('profile')->with('success', 'Profile updated successfully.');
     }


}
