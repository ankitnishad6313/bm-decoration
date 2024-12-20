<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        if ($request->input('email') !== $user->email) {
            $user->email_verified_at = null;
        }

        // Fill the user model with validated data
        $user->fill($request->only(['name', 'email', 'phone', 'profile_pic', 'gender', 'current_address']));

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $user->profile_pic = uploadFile($request, 'profile_pic', 'uploads/profile');
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a status message
        return redirect()->route('admin-profile')->with('success', 'Profile Updated Successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Successfully!');
    }
}
