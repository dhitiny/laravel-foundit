<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle(Request $request, \Closure $next)
    {
        // Cek jika user login DAN statusnya 'banned'
        if (Auth::check() && Auth::user()->status === 'banned') {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Akun Anda telah ditangguhkan karena melanggar aturan platform FoundIt.');
        }

        return $next($request);
    }
}
