<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $admin = Admin::whereRaw(
        'LOWER(name) = ?',
        [strtolower($credentials['username'])]
    )->first();

    if (!$admin || !password_verify($credentials['password'], $admin->password)) {
        return back()->withErrors([
            'username' => 'Username or password is incorrect.',
        ])->onlyInput('username');
    }

    // Admin ID session mein save karo
    $request->session()->regenerate();
    $request->session()->put('admin_id', $admin->id);

    return redirect()->route('dashboard');
}

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}