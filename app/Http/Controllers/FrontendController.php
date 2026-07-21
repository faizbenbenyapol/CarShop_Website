<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Models\Category;
use App\Models\Brand;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredCars = TestModel::where('status', 'available')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        
        $categories = Category::withCount('cars')->limit(8)->get();
        $brands = Brand::withCount('cars')->limit(8)->get();
        
        return view('frontend.index', compact('featuredCars', 'categories', 'brands'));
    }

    public function cars(Request $request)
    {
        $query = TestModel::query()->where('status', 'available');

        // ค้นหา
        if ($request->has('search') && $request->search) {
            $query->where('product_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('product_detail', 'LIKE', '%' . $request->search . '%');
        }

        // กรองตามหมวดหมู่
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // กรองตามยี่ห้อ
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }

        // กรองตามราคา
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // เรียงลำดับ
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('product_name', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        $cars = $query->paginate(12);
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.cars', compact('cars', 'categories', 'brands'));
    }

    public function carDetail($id)
    {
        $car = TestModel::findOrFail($id);
        $relatedCars = TestModel::where('category_id', $car->category_id)
            ->where('id', '!=', $id)
            ->where('status', 'available')
            ->limit(4)
            ->get();

        return view('frontend.car-detail', compact('car', 'relatedCars'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $cars = TestModel::with(['category', 'brand'])
            ->where('category_id', $id)
            ->where('status', 'available')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('frontend.category', compact('category', 'cars'));
    }

    public function brand($id)
    {
        $brand = Brand::findOrFail($id);
        $cars = TestModel::with(['category', 'brand'])
            ->where('brand_id', $id)
            ->where('status', 'available')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('frontend.brand', compact('brand', 'cars'));
    }
}