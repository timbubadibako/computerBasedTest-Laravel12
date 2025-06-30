<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            Fortify::username() => ['required', 'email', 'ends_with:@uniku.ac.id'],
            'password' => ['required', 'string'],
        ]);


        $credentials = $request->only(Fortify::username(), 'password');

        $email = $credentials[Fortify::username()];

        // Otomatis deteksi role berdasarkan format email
        if (preg_match('/^[0-9]+(@uniku\.ac\.id)?$/', $email)) {
            $role = 'student';
        } else {
            $role = 'admin';
        }

        $user = \App\Models\User::where(Fortify::username(), $credentials[Fortify::username()])
            ->where('role', $role)
            ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            // Tambahkan flash banner di sini
            $request->session()->flash('banner', 'Login berhasil!');
            $request->session()->flash('bannerStyle', 'success');

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/student/dashboard');
        }

        return back()->withErrors([
            Fortify::username() => __('auth.failed'),
        ]);
    }
}
