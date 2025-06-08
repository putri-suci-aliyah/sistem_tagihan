<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('pages.login.login');
    }

    public function login(Request $request)
    {
        $userName_or_email = $request->email;
        $password = $request->password;

        $user = User::where('name', $userName_or_email)->orWhere('email', $userName_or_email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->to('penduduk');
        } else {
            return back()->withInput()->withErrors(['email' => 'User tidak ditemukan. Silahkan login kembali']);
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
