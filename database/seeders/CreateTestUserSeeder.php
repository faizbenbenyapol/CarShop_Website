<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUserSeeder extends Seeder
{
    public function run()
    {
        // สร้าง user ทดสอบที่มี role เป็น 'user'
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@carshop.com',
            'password' => Hash::make('123456'),
            'role' => 'user'
        ]);
        
        echo "สร้าง user ทดสอบเสร็จสิ้น!\n";
        echo "Email: customer@carshop.com\n";
        echo "Password: 123456\n";
        echo "Role: user\n";
    }
}