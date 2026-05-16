<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil role user dan pastikan huruf kecil
        $userRole = strtolower(Auth::user()->role);

        // 3. Jika role sesuai dengan yang diminta rute, IZINKAN MASUK
        if ($userRole === $role) {
            return $next($request);
        }

        // 4. Jika role tidak sesuai, tendang ke rumah masing-masing
        if ($userRole === 'admin') {
            return redirect()->route('dashboard');
        }

        if ($userRole === 'customer') {
            return redirect()->route('customer.dashboard');
        }

        // Jika tidak punya role yang jelas
        abort(403, 'Akses Ditolak.');
    }
}