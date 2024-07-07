<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    // Proses autentikasi login
    public function AuthLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil!',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Password atau email anda salah',
        ], 401);
    }

    // Proses lupa password
    public function forgotPassword(Request $request)
    {
        // Validasi email yang dikirimkan
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan.'
            ], 404);
        }

        // Buat token untuk reset password dan simpan ke database
        $user->remember_token = Str::random(60);
        $user->save();

        try {
            // Kirim email reset password
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return response()->json([
                'success' => true,
                'message' => 'Silakan periksa email Anda dan reset kata sandi Anda sekarang'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim email reset kata sandi.'
            ], 500);
        }
    }

    // Proses reset password
    public function resetPassword(Request $request, $token)
    {
        // Cetak token untuk memastikan nilainya benar
        error_log("Received token: " . $token);

        // Validasi password baru
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari user berdasarkan token
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.'
            ], 404);
        }

        // Update password dan token user
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Kata sandi berhasil direset.'
        ], 200);
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Hapus semua token milik user
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Anda telah berhasil logout.'
        ], 200);
    }
}
