<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบก่อน');
        }

        return $next($request);
    }
}