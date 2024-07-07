<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileApiController extends Controller
{
    public function profile()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'Pengguna tidak valid.');
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:50',
            'about_me' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->postal_code = $request->input('postal_code');
        $user->about_me = $request->input('about_me');

        if ($request->hasFile('foto_profil')) {
            // Handle the file upload
            $image = $request->file('foto_profil');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profil-foto');
            $image->move($destinationPath, $name);

            // Save the file name to the database
            $user->foto_profil = $name;
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update profile: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }
}
