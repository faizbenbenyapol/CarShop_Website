<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าล็อกอินแล้วหรือไม่
        if (!session('login')) {
            return redirect('/login')->with('error', 'กรุณาเข้าสู่ระบบก่อน');
        }
        
        // ตรวจสอบว่าเป็น admin หรือไม่
        if (session('role') !== 'admin') {
            return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }
        
        return $next($request);
    }
}
