<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\TestModel;
use Illuminate\Pagination\Paginator;

class TestController extends Controller
{
    public function index()
    {
        try {
            Paginator::useBootstrap();
            $carList = TestModel::orderBy('id', 'desc')->paginate(5);
            return view('test.list', compact('carList'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function adding()
    {
        return view('test.create');
    }

    public function create(Request $request)
    {
        // Validation messages
        $messages = [
            'product_name.required'   => 'กรุณากรอกชื่อสินค้า',
            'product_name.min'        => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'product_name.unique'     => 'สินค้านี้มีอยู่แล้ว',
            'product_detail.required' => 'กรุณากรอกรายละเอียดสินค้า',
            'price.required'          => 'กรุณากรอกราคา',
            'price.numeric'           => 'ราคาต้องเป็นตัวเลข',
            'picture.image'           => 'ไฟล์ต้องเป็นรูปภาพ',
            'picture.mimes'           => 'รองรับไฟล์ jpeg,png,jpg,gif เท่านั้น',
            'picture.max'             => 'ไฟล์ขนาดไม่เกิน 2MB',
        ];

        // Validation rules
        $validator = Validator::make($request->all(), [
            'product_name'   => 'required|min:3|unique:cars',
            'product_detail' => 'required',
            'price'          => 'required|numeric',
            'picture'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id'    => 'nullable|exists:categories,id',
            'brand_id'       => 'nullable|exists:brands,id',
            'model_year'     => 'nullable|string|max:10',
            'fuel_type'      => 'nullable|string|max:50',
            'transmission'   => 'nullable|string|max:50',
            'mileage'        => 'nullable|integer|min:0',
            'status'         => 'required|in:available,sold,reserved',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('admin.cars.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $filename = null;
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
            }

            TestModel::create([
                'product_name'   => strip_tags($request->input('product_name')),
                'product_detail' => strip_tags($request->input('product_detail')),
                'price'          => strip_tags($request->input('price')),
                'picture'        => $filename,
                'category_id'    => $request->input('category_id'),
                'brand_id'       => $request->input('brand_id'),
                'model_year'     => $request->input('model_year'),
                'fuel_type'      => $request->input('fuel_type'),
                'transmission'   => $request->input('transmission'),
                'mileage'        => $request->input('mileage'),
                'status'         => $request->input('status', 'available'),
            ]);

            Alert::success('เพิ่มรถยนต์สำเร็จ');
            return redirect()->route('admin.cars.index');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function edit($id)
    {
        try {
            $car = TestModel::findOrFail($id);
            return view('test.edit', [
                'id'             => $car->id,
                'product_name'   => $car->product_name,
                'product_detail' => $car->product_detail,
                'price'          => $car->price,
                'picture'        => $car->picture,
            ]);
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function update($id, Request $request)
    {
        $messages = [
            'product_name.required'   => 'กรุณากรอกชื่อสินค้า',
            'product_name.min'        => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'product_name.unique'     => 'สินค้านี้มีอยู่แล้ว',
            'product_detail.required' => 'กรุณากรอกรายละเอียดสินค้า',
            'price.required'          => 'กรุณากรอกราคา',
            'price.numeric'           => 'ราคาต้องเป็นตัวเลข',
            'picture.image'           => 'ไฟล์ต้องเป็นรูปภาพ',
            'picture.mimes'           => 'รองรับไฟล์ jpeg,png,jpg,gif เท่านั้น',
            'picture.max'             => 'ไฟล์ขนาดไม่เกิน 2MB',
        ];

        $validator = Validator::make($request->all(), [
            'product_name'   => [
                'required',
                'min:3',
                Rule::unique('cars', 'product_name')->ignore($id, 'id'),
            ],
            'product_detail' => 'required',
            'price'          => 'required|numeric',
            'picture'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($validator->fails()) {
            return redirect('test/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $car = TestModel::find($id);
            $filename = $car->picture; // เก็บชื่อไฟล์เดิม
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
            }

            $car->update([
                'product_name'   => strip_tags($request->input('product_name')),
                'product_detail' => strip_tags($request->input('product_detail')),
                'price'          => strip_tags($request->input('price')),
                'picture'        => $filename,
            ]);

            Alert::success('ปรับปรุงสินค้าสำเร็จ');
            return redirect('/test');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function remove($id)
    {
        try {
            $car = TestModel::find($id);
            $car->delete();
            Alert::success('ลบสินค้าสำเร็จ');
            return redirect('/test');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
    public function shop()
{
    $carList = TestModel::orderBy('id', 'desc')->paginate(12); // แสดง 12 คันต่อหน้า
    return view('test.shop', compact('carList'));
}
}
