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

        // ตรวจสอบในตาราง admins
        $admin = DB::table('admins')->where('email', $email)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            session(['login' => true, 'role' => 'admin', 'user_name' => $admin->name]);
            return redirect('/test'); // Admin menu
        }

        // ตรวจสอบในตาราง users
        $user = DB::table('users')->where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            session(['login' => true, 'role' => 'user', 'user_name' => $user->name]);
            return redirect('/shop'); // User store
        }

        return back()->withErrors(['email' => 'Email หรือ Password ไม่ถูกต้อง']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
