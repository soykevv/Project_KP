<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah.');
        }

        Auth::login($user);

        if ($user->role == 'gudang') {
            return redirect('/dashboard-gudang');
        }

        return redirect('/dashboard-sales');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}

