<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact_no' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('first_name', 'last_name', 'middle_name', 'email', 'contact_no'));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    /**
     * Update profile photo.
     */
    public function updatePhoto(Request $request)
    {
        try {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = auth()->user();

            // Check if user exists
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            // Delete old profile photo if exists
            try {
                if ($user->profile_photo) {
                    $oldPath = $user->profile_photo;
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Error deleting old profile photo: ' . $e->getMessage());
                // Continue with upload even if delete fails
            }

            // Store new image
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            
            if (!$path) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload image.'
                ], 500);
            }

            // Update user record
            $user->profile_photo = $path;
            $user->save();

            // Get the full URL for the image
            $imageUrl = Storage::url($path);

            // Return JSON response for AJAX requests
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile photo updated successfully!',
                    'image_url' => $imageUrl
                ]);
            }

            return back()->with('success', 'Profile photo updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Profile photo upload error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove profile photo.
     */
    public function removePhoto(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            if ($user->profile_photo) {
                // Delete the file
                if (Storage::disk('public')->exists($user->profile_photo)) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
                
                // Update user record
                $user->profile_photo = null;
                $user->save();
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile photo removed successfully!'
                ]);
            }

            return back()->with('success', 'Profile photo removed successfully!');

        } catch (\Exception $e) {
            Log::error('Profile photo removal error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing the photo.'
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = auth()->user();

        // Delete profile photo if exists
        if ($user->profile_photo) {
            try {
                if (Storage::disk('public')->exists($user->profile_photo)) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
            } catch (\Exception $e) {
                Log::warning('Error deleting profile photo during account deletion: ' . $e->getMessage());
            }
        }
        
        auth()->logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully!');
    }
}