@extends('layouts.backend')

@section('title', 'แก้ไขข้อมูลรถยนต์')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit me-2 text-primary"></i>แก้ไขข้อมูลรถยนต์
        </h1>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> กลับ
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 0.375rem 0.375rem 0 0;">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="fas fa-car me-2"></i>ฟอร์มแก้ไขข้อมูลรถยนต์
                    </h6>
                </div>
                <div class="card-body">

            <form action="{{ route('admin.cars.update', $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ชื่อรถ </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="product_name" required placeholder="Car Name" minlength="3" value="{{ old('product_name', $product_name) }}">
                        @if(isset($errors) && $errors->has('product_name'))
                            <div class="text-danger"> {{ $errors->first('product_name') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> รายละเอียด </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="product_detail" required placeholder="Car Detail">{{ old('product_detail', $product_detail) }}</textarea>
                        @if(isset($errors) && $errors->has('product_detail'))
                            <div class="text-danger"> {{ $errors->first('product_detail') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ราคา </label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="price" required placeholder="Price" value="{{ old('price', $price) }}">
                        @if(isset($errors) && $errors->has('price'))
                            <div class="text-danger"> {{ $errors->first('price') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> หมวดหมู่ </label>
                    <div class="col-sm-6">
                        <select class="form-control" name="category_id">
                            <option value="">เลือกหมวดหมู่</option>
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ยี่ห้อ </label>
                    <div class="col-sm-6">
                        <select class="form-control" name="brand_id">
                            <option value="">เลือกยี่ห้อ</option>
                            @php
                                $brands = \App\Models\Brand::all();
                            @endphp
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ปีรถ </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="model_year" placeholder="ปีรถ" value="{{ old('model_year', $model_year) }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> เชื้อเพลิง </label>
                    <div class="col-sm-6">
                        <select class="form-control" name="fuel_type">
                            <option value="">เลือกเชื้อเพลิง</option>
                            <option value="Gasoline" {{ old('fuel_type', $fuel_type) == 'Gasoline' ? 'selected' : '' }}>เบนซิน</option>
                            <option value="Diesel" {{ old('fuel_type', $fuel_type) == 'Diesel' ? 'selected' : '' }}>ดีเซล</option>
                            <option value="Hybrid" {{ old('fuel_type', $fuel_type) == 'Hybrid' ? 'selected' : '' }}>ไฮบริด</option>
                            <option value="Electric" {{ old('fuel_type', $fuel_type) == 'Electric' ? 'selected' : '' }}>ไฟฟ้า</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> เกียร์ </label>
                    <div class="col-sm-6">
                        <select class="form-control" name="transmission">
                            <option value="">เลือกเกียร์</option>
                            <option value="Manual" {{ old('transmission', $transmission) == 'Manual' ? 'selected' : '' }}>เกียร์ธรรมดา</option>
                            <option value="Automatic" {{ old('transmission', $transmission) == 'Automatic' ? 'selected' : '' }}>เกียร์อัตโนมัติ</option>
                            <option value="CVT" {{ old('transmission', $transmission) == 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ไมล์ </label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="mileage" placeholder="ไมล์" value="{{ old('mileage', $mileage) }}">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> สถานะ </label>
                    <div class="col-sm-6">
                        <select class="form-control" name="status">
                            <option value="available" {{ old('status', $status) == 'available' ? 'selected' : '' }}>พร้อมขาย</option>
                            <option value="sold" {{ old('status', $status) == 'sold' ? 'selected' : '' }}>ขายแล้ว</option>
                            <option value="reserved" {{ old('status', $status) == 'reserved' ? 'selected' : '' }}>จองแล้ว</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> รูปภาพ </label>
                    <div class="col-sm-6">
                        @if($picture)
                            <p>รูปปัจจุบัน:</p>
                            <img src="{{ asset('uploads/' . $picture) }}" width="150" style="margin-bottom:10px;">
                        @endif
                        <input type="file" class="form-control" name="picture">
                        <small class="text-muted">เลือกไฟล์ใหม่เพื่อเปลี่ยนรูป</small>
                        @if(isset($errors) && $errors->has('picture'))
                            <div class="text-danger"> {{ $errors->first('picture') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> </label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary"> Update </button>
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
