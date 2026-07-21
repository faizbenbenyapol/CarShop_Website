<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // สถิติสำหรับ Dashboard
        $totalCars = TestModel::count();
        $availableCars = TestModel::where('status', 'available')->count();
        $soldCars = TestModel::where('status', 'sold')->count();
        $reservedCars = TestModel::where('status', 'reserved')->count();
        $totalCustomers = Customer::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        // ข้อมูลสำหรับ Chart
        $carsByCategory = Category::withCount('cars')->get();
        $carsByBrand = Brand::withCount('cars')->get();
        
        // รถที่ขายดีที่สุด (ตัวอย่าง)
        $popularCars = TestModel::orderBy('id', 'desc')->limit(5)->get();

        // ยอดขายรายเดือน (ตัวอย่าง)
        $monthlySales = DB::table('cars')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalCars', 'availableCars', 'soldCars', 'reservedCars', 'totalCustomers',
            'totalCategories', 'totalBrands', 'popularCars'
        ))->with([
            'categories' => $carsByCategory,
            'brands' => $carsByBrand
        ]);
    }
}