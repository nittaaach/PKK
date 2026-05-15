<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        $user = Auth::user();

        // Pastikan user login
        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil role user, misal langsung dari kolom drole_id di tabel users
        $userRole = $user->role;

        // Cek apakah role user termasuk salah satu role yg diizinkan
        if (! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
