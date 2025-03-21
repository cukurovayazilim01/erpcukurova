<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();

        if ($user->level == $role) {
            return $next($request);
        }

        return redirect('login')->with('error', "Lütfen Kullanıcı Adı Şifre Giriniz");
    }
}
