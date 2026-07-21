<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\TestModel;
use Illuminate\Database\Seeder;

class CarDemoSeeder extends Seeder
{
    /**
     * Seed demo cars using the sample photos already in public/uploads.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id', 'name');
        $brandIds = Brand::pluck('id', 'name');

        $sedan = $categoryIds['รถเก๋ง'] ?? null;
        $suv = $categoryIds['รถ SUV'] ?? null;
        $sport = $categoryIds['รถสปอร์ต'] ?? null;
        $ev = $categoryIds['รถไฟฟ้า'] ?? null;

        $tesla = Brand::firstOrCreate(
            ['name' => 'Tesla'],
            ['country' => 'สหรัฐอเมริกา', 'description' => 'ผู้นำด้านรถยนต์ไฟฟ้าและเทคโนโลยีล้ำสมัย']
        );

        $cars = [
            [
                'product_name' => 'Honda e:Ny1',
                'product_detail' => 'SUV ไฟฟ้าจาก Honda ดีไซน์ทันสมัย ขับขี่เงียบ ประหยัดพลังงาน',
                'price' => 1299000,
                'picture' => '1755417409_honda06.jpg',
                'category_id' => $ev,
                'brand_id' => $brandIds['Honda'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'ไฟฟ้า',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 8000,
            ],
            [
                'product_name' => 'Honda WR-V RS',
                'product_detail' => 'SUV คอมแพกต์ สไตล์สปอร์ต ตัวถัง RS สีแดงสด โดดเด่น',
                'price' => 789000,
                'picture' => '1755417883_honda05.jpg',
                'category_id' => $suv,
                'brand_id' => $brandIds['Honda'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 15000,
            ],
            [
                'product_name' => 'Toyota Camry',
                'product_detail' => 'ซีดานหรู ขับสบาย เครื่องยนต์นุ่มนวล เหมาะสำหรับครอบครัว',
                'price' => 1450000,
                'picture' => '1755419961_toyota05.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Toyota'] ?? null,
                'model_year' => '2025',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 12000,
            ],
            [
                'product_name' => 'Toyota GR Corolla',
                'product_detail' => 'แฮทช์แบ็กสมรรถนะสูงจากค่าย Gazoo Racing ขับสนุก เร้าใจ',
                'price' => 1899000,
                'picture' => '1755423335_toyota04.jpg',
                'category_id' => $sport,
                'brand_id' => $brandIds['Toyota'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 6000,
            ],
            [
                'product_name' => 'Toyota Alphard',
                'product_detail' => 'รถตู้หรูระดับพรีเมียม เบาะนั่งสบาย เหมาะสำหรับผู้บริหารและครอบครัวใหญ่',
                'price' => 3500000,
                'picture' => '1755423477_toyota01.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Toyota'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 9000,
            ],
            [
                'product_name' => 'Mercedes-Benz C-Class',
                'product_detail' => 'ซีดานหรูสัญชาติเยอรมัน ดีไซน์คลาสสิก ขับขี่นุ่มนวล',
                'price' => 2890000,
                'picture' => '1755423286_benz01.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Mercedes-Benz'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 11000,
            ],
            [
                'product_name' => 'Mercedes-Benz EQE SUV',
                'product_detail' => 'SUV ไฟฟ้าหรู เทคโนโลยีล้ำสมัย ระยะทางวิ่งไกล',
                'price' => 4990000,
                'picture' => '1755423308_benz02.jpg',
                'category_id' => $ev,
                'brand_id' => $brandIds['Mercedes-Benz'] ?? null,
                'model_year' => '2024',
                'fuel_type' => 'ไฟฟ้า',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 4000,
            ],
            [
                'product_name' => 'Mercedes-Benz S-Class',
                'product_detail' => 'ซีดานเรือธง หรูหราที่สุดในตระกูล Mercedes-Benz',
                'price' => 8900000,
                'picture' => '1755423361_benz04.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Mercedes-Benz'] ?? null,
                'model_year' => '2023',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 18000,
            ],
            [
                'product_name' => 'Mercedes-AMG GT R',
                'product_detail' => 'สปอร์ตคาร์สมรรถนะสูง ตัวถัง AMG สีน้ำเงินสวยงาม',
                'price' => 12500000,
                'picture' => '1755423407_benz05.jpg',
                'category_id' => $sport,
                'brand_id' => $brandIds['Mercedes-Benz'] ?? null,
                'model_year' => '2023',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 5000,
            ],
            [
                'product_name' => 'Mercedes-Benz Vito',
                'product_detail' => 'รถตู้อเนกประสงค์ พื้นที่กว้างขวาง เหมาะสำหรับผู้บริหารและครอบครัว',
                'price' => 2690000,
                'picture' => '1755423508_benz08.jpg',
                'category_id' => null,
                'brand_id' => $brandIds['Mercedes-Benz'] ?? null,
                'model_year' => '2023',
                'fuel_type' => 'ดีเซล',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 22000,
            ],
            [
                'product_name' => 'Tesla Model Y',
                'product_detail' => 'SUV ไฟฟ้ายอดนิยม ขับขี่อัจฉริยะ พร้อมระบบ Autopilot',
                'price' => 1890000,
                'picture' => '1759069571_tesla_model_y.jpg',
                'category_id' => $ev,
                'brand_id' => $tesla->id,
                'model_year' => '2025',
                'fuel_type' => 'ไฟฟ้า',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 3000,
            ],
            [
                'product_name' => 'Tesla Model 3',
                'product_detail' => 'ซีดานไฟฟ้าดีไซน์เรียบหรู ประหยัดพลังงาน เทคโนโลยีล้ำสมัย',
                'price' => 1699000,
                'picture' => '1759069875_tesla_model_3.png',
                'category_id' => $ev,
                'brand_id' => $tesla->id,
                'model_year' => '2025',
                'fuel_type' => 'ไฟฟ้า',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 2000,
            ],
            [
                'product_name' => 'Tesla Model 3 Performance',
                'product_detail' => 'รุ่นสมรรถนะสูงสุดของ Model 3 อัตราเร่งดุดัน ควบคุมง่าย',
                'price' => 2199000,
                'picture' => '1759069947_Tesla_Model3_-Performance_026.jpg',
                'category_id' => $sport,
                'brand_id' => $tesla->id,
                'model_year' => '2025',
                'fuel_type' => 'ไฟฟ้า',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 1500,
            ],
            [
                'product_name' => 'Ford Focus',
                'product_detail' => 'แฮทช์แบ็กขับสนุก ทรงสวย เหมาะกับการใช้งานในเมือง',
                'price' => 589000,
                'picture' => '1759070283_2-moo.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Ford'] ?? null,
                'model_year' => '2019',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 45000,
            ],
            [
                'product_name' => 'Ford Focus Titanium',
                'product_detail' => 'ซีดานรุ่น Titanium ออปชันครบ สภาพดี พร้อมใช้งาน',
                'price' => 459000,
                'picture' => '1759070329_2018-ford-focus-titanium-sedan-angular-front-exterior-view_100644242_m.jpg',
                'category_id' => $sedan,
                'brand_id' => $brandIds['Ford'] ?? null,
                'model_year' => '2018',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 62000,
            ],
            [
                'product_name' => 'Ford Mustang',
                'product_detail' => 'มัสเซิลคาร์ในตำนาน สีแดงสะดุดตา เสียงเครื่องยนต์ทรงพลัง',
                'price' => 2890000,
                'picture' => '1759070679_JB1_2_LC.jpg',
                'category_id' => $sport,
                'brand_id' => $brandIds['Ford'] ?? null,
                'model_year' => '2023',
                'fuel_type' => 'เบนซิน',
                'transmission' => 'อัตโนมัติ',
                'mileage' => 7000,
            ],
        ];

        foreach ($cars as $car) {
            TestModel::firstOrCreate(
                ['product_name' => $car['product_name']],
                $car + ['status' => 'available']
            );
        }
    }
}
