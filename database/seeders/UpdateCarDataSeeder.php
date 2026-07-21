<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestModel;
use App\Models\Category;
use App\Models\Brand;

class UpdateCarDataSeeder extends Seeder
{
    public function run()
    {
        // ดึงข้อมูล categories และ brands
        $categories = Category::all();
        $brands = Brand::all();
        
        if ($categories->isEmpty() || $brands->isEmpty()) {
            echo "ไม่มีข้อมูล categories หรือ brands\n";
            return;
        }
        
        // อัปเดตข้อมูลรถยนต์
        $cars = TestModel::whereNull('category_id')->orWhereNull('brand_id')->get();
        
        foreach ($cars as $car) {
            $randomCategory = $categories->random();
            $randomBrand = $brands->random();
            
            $car->update([
                'category_id' => $randomCategory->id,
                'brand_id' => $randomBrand->id
            ]);
            
            echo "อัปเดตรถยนต์ ID: {$car->id} - Category: {$randomCategory->name}, Brand: {$randomBrand->name}\n";
        }
        
        echo "อัปเดตข้อมูลเสร็จสิ้น!\n";
    }
}