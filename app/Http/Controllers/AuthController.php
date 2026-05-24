<?php

namespace App\Http\Controllers;

use App\Models\CaptchaModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        $a = rand(1, 10);
        $b = rand(1, 10);

        // simpan hasilnya ke session agar bisa diverifikasi
        session(['captcha_sum' => $a + $b]);

        return view('/login', compact('a', 'b'));
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'          => ['required', 'email'],
            'password'       => ['required'],
            'role'           => ['required'],
            'captcha_answer'  => ['required', 'numeric'],
        ]);

        // cek captcha
        if ((int)$request->captcha_answer !== (int)session('captcha_sum')) {
            return back()
                ->withInput()
                ->withErrors(['captcha_answer' => 'Jawaban penjumlahan salah.']);
        }

        $guard = match ($request->role) {
            'Ketua'      => 'ketua',
            'Wakil'      => 'wakil',
            'Bendahara'  => 'bendahara',
            'Sekretaris' => 'sekretaris',
            'Pokja_1'    => 'pokja_1',
            'Pokja_2'    => 'pokja_2',
            'Pokja_3'    => 'pokja_3',
            'Pokja_4'    => 'pokja_4',
            'Admin'      => 'admin',
            default => 'web',
        };

        // autentikasi user
        $credentials = $request->only('email', 'password');
        if (! Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();
        $user = Auth::guard($guard)->user();

        // cek role
        if ($user->role !== $request->role) {
            Auth::guard($guard)->logout();
            return redirect('/login')->with('error', 'Role tidak sesuai.');
        }

        // simpan hasil captcha ke tabel captcha
        CaptchaModels::create([
            'id_users' => $user->id,
            'number'   => session('captcha_sum'),
        ]);

        // redirect sesuai role
        return match ($user->role) {
            'Ketua' => redirect('ketua/dashboard'),
            'Wakil' => redirect('wakil/dashboard'),
            'Bendahara' => redirect('bendahara/dashboard'),
            'Sekretaris' => redirect('sekretaris/dashboard'),
            'Pokja_1' => redirect('pokja_1/dashboard'),
            'Pokja_2' => redirect('pokja_2/dashboard'),
            'Pokja_3' => redirect('pokja_3/dashboard'),
            'Pokja_4' => redirect('pokja_4/dashboard'),
            'Admin' => redirect('admin/dashboard'),
            default    => tap(back(), fn() => Auth::guard($guard)->logout())
                ->with('error', 'Tidak ada hak akses'),
        };
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('ketua')->logout();
        Auth::guard('wakil')->logout();
        Auth::guard('bendahara')->logout();
        Auth::guard('sekretaris')->logout();
        Auth::guard('pokja_1')->logout();
        Auth::guard('pokja_2')->logout();
        Auth::guard('pokja_3')->logout();
        Auth::guard('pokja_4')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landing'); // redirect setelah logout
    }
}
