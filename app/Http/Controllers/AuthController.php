<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $loginType = $request->input('login_type', 'admin'); // เพิ่มประเภทการ login

        // ตรวจสอบในตาราง users
        $user = DB::table('users')->where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            
            // ตรวจสอบ role ของผู้ใช้จากฐานข้อมูล
            if ($loginType === 'user') {
                // Login เป็น User - อนุญาตทุก role
                session([
                    'login' => true, 
                    'role' => $user->role, // ใช้ role จากฐานข้อมูล
                    'user_name' => $user->name,
                    'user_id' => $user->id
                ]);
                return redirect()->route('home'); // ไปหน้า Home
            } else {
                // Login เป็น Admin - ตรวจสอบว่าเป็น admin จริงหรือไม่
                if ($user->role !== 'admin') {
                    return back()->withErrors(['email' => 'คุณไม่มีสิทธิ์เข้าสู่ระบบผู้ดูแล']);
                }
                
                session([
                    'login' => true, 
                    'role' => $user->role, // ใช้ role จากฐานข้อมูล
                    'user_name' => $user->name,
                    'user_id' => $user->id
                ]);
                return redirect()->route('admin.dashboard'); // ไปหน้า Dashboard
            }
        }

        return back()->withErrors(['email' => 'Email หรือ Password ไม่ถูกต้อง']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
