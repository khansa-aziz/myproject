
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'name' => $credentials['username'],
        'password' => $credentials['password'],
    ])) {
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username or password is incorrect.',
    ]);
});

Route::get('/dashboard', function () {
    return view('admin.layout.dashboard');
})->middleware(\App\Http\Middleware\AuthMiddleware::class);

Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
});