<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลจากตาราง members (ที่คุณสร้างด้วย SQL แล้ว)
        $members = DB::table('members')->orderBy('id','desc')->paginate(10);
        return view('members.index', compact('members'));
    }
}
