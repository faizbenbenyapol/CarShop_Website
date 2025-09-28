<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Models\Category;
use App\Models\Brand;

class UserController extends Controller
{
    public function profile()
    {
        if (!session('login') || session('role') !== 'user') {
            return redirect()->route('user.login');
        }

        return view('user.profile');
    }

    public function favorites()
    {
        if (!session('login')) {
            return redirect()->route('user.login');
        }

        // ตัวอย่าง: รถที่ชื่นชอบ (สามารถพัฒนาต่อได้)
        $favoriteCars = TestModel::where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('user.favorites', compact('favoriteCars'));
    }
}