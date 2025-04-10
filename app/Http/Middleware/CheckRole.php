<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role !== $role) {
            if ($role === 'admin') {
                return redirect('/')->with('error', 'Bạn không có quyền truy cập trang quản trị!');
            }
            return redirect('/admin/dashboard')->with('error', 'Bạn không có quyền truy cập trang này!');
        }

        return $next($request);
    }
}