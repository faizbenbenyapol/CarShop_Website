<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@carshop.com',
        ]);

        // Create regular user for testing
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@carshop.com',
        ]);

        // Categories
        $categories = [
            ['name' => 'รถเก๋ง', 'description' => 'รถยนต์นั่งส่วนบุคคลขนาดเล็กถึงกลาง'],
            ['name' => 'รถ SUV', 'description' => 'รถยนต์อเนกประสงค์สำหรับครอบครัว'],
            ['name' => 'รถกระบะ', 'description' => 'รถยนต์บรรทุกขนาดเล็กสำหรับงานและใช้ส่วนตัว'],
            ['name' => 'รถสปอร์ต', 'description' => 'รถยนต์สมรรถนะสูงและดีไซน์สวยงาม'],
            ['name' => 'รถไฟฟ้า', 'description' => 'รถยนต์พลังงานสะอาดเพื่อสิ่งแวดล้อม'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Brands  
        $brands = [
            ['name' => 'Toyota', 'country' => 'ญี่ปุ่น', 'description' => 'ยี่ห้อรถยนต์ชั้นนำจากญี่ปุ่น'],
            ['name' => 'Honda', 'country' => 'ญี่ปุ่น', 'description' => 'รถยนต์คุณภาพสูงและประหยัดน้ำมัน'],
            ['name' => 'BMW', 'country' => 'เยอรมนี', 'description' => 'รถยนต์หรูและสมรรถนะสูง'],
            ['name' => 'Mercedes-Benz', 'country' => 'เยอรมนี', 'description' => 'รถยนต์หรูระดับพรีเมี่ยม'],
            ['name' => 'Nissan', 'country' => 'ญี่ปุ่น', 'description' => 'นวัตกรรมและเทคโนโลยีล้ำสมัย'],
            ['name' => 'Mazda', 'country' => 'ญี่ปุ่น', 'description' => 'ดีไซน์สวยงามและขับขี่สนุก'],
            ['name' => 'Ford', 'country' => 'สหรัฐอเมริกา', 'description' => 'ประสบการณ์และความแข็งแกร่ง'],
            ['name' => 'Hyundai', 'country' => 'เกาหลีใต้', 'description' => 'คุณภาพดีในราคาที่เหมาะสม'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Customers
        $customers = [
            [
                'name' => 'สมชาย ใจดี',
                'email' => 'somchai@email.com',
                'phone' => '081-234-5678',
                'address' => '123 ถนนสุขุมวิท แขวงคลองตัน เขตวัฒนา กรุงเทพฯ 10110'
            ],
            [
                'name' => 'สมหญิง รักษ์ดี',
                'email' => 'somying@email.com', 
                'phone' => '082-345-6789',
                'address' => '456 ถนนเพชรบุรี แขวงมักกะสัน เขตราชเทวี กรุงเทพฯ 10400'
            ],
            [
                'name' => 'นางสาวมาลี สวยงาม',
                'email' => 'malee@email.com',
                'phone' => '083-456-7890', 
                'address' => '789 ถนนพหลโยธิน แขวงลาดยาว เขตจตุจักร กรุงเทพฯ 10900'
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Demo cars (ใช้รูปตัวอย่างที่มีอยู่ใน public/uploads)
        $this->call(CarDemoSeeder::class);
    }
}
