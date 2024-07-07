<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Proses autentikasi login
    public function AuthLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, arahkan ke halaman dashboard dengan pesan sukses
            return redirect()->intended('admin/dashboard')->with('success', 'Login berhasil!');
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function forgotpassword()
        {
            return view('auth.forgot');
        }

    public function PostForgotPassword(Request $request)
        {
              $email = $request->validate(['email' => 'required|email']);

              $user = User::where('email', $email)->first();

              if (!$user) {
                  return redirect()->back()->with('error', 'Email tidak ditemukan.');
              }

              $recipient = $user;

              $recipient->remember_token = Str::random(60);
              $recipient->save();

              try {
                Mail::to($recipient->email)->send(new ForgotPasswordMail($recipient));
                return redirect()->back()->with('success', "Please check your email and reset your password");
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'There was an error sending the password reset email.');
            }
        }

    public function reset($remember_token)
        {
            $user = User::getTokenSingle($remember_token);

            if (!empty($user)) {
                $data['user'] = $user;
                return view('auth.reset', $data);
            } else {
                abort(404);
            }
        }

    public function PostReset($token, Request $request)
        {
            $user = User::getTokenSingle($token);

            if (!empty($user)) {
                $model = $user;
            } else {
                abort(404);
            }

            if ($request->password == $request->cpassword) {
                $model->password = Hash::make($request->password);
                $model->remember_token = Str::random(60);
                $model->save();

                return redirect(url(''))->with('success', "Password successfully reset.");
            } else {
                return redirect()->back()->with('error', 'Password and confirm password do not match');
            }
        }

    // Proses logout
    public function logout()
     {
         Auth::logout();
         return redirect(url(''))->with('success', 'Anda telah berhasil logout.');
     }

}

