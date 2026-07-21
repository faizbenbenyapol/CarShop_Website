<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateUserRolesSeeder extends Seeder
{
    public function run()
    {
        // อัปเดต user ทั้งหมดให้เป็น admin (เนื่องจากอาจเป็น admin ที่มีอยู่)
        User::where('role', 'user')->update(['role' => 'admin']);
        
        echo "อัปเดต roles ของ users เสร็จสิ้น!\n";
        
        $users = User::all();
        foreach($users as $user) {
            echo "User: {$user->name} - Email: {$user->email} - Role: {$user->role}\n";
        }
    }
}