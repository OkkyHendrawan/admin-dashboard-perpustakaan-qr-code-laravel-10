<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();
        $data['header_tittle']= "Profile";

        return view('admin.profile.profile', compact('user'), $data);
    }

    public function edit()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();
        $data['header_tittle']= "Edit Profile";
        return view('admin.profile.edit', compact('user'), $data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'Pengguna tidak valid.');
        }
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:50',
            'about_me' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048', // Validation for image
        ]);

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
            return redirect()->back()->with('error', 'Gagal menyimpan profil: ' . $e->getMessage());
        }
        return redirect()->route('admin.profile.profile')->with('success', 'Profil berhasil diperbarui!');
    }

}
