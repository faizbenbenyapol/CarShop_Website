@extends('layouts.backend')

@section('title', 'เพิ่มรถยนต์ใหม่')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-9">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">เพิ่มรถยนต์ใหม่</h1>
                <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> กลับ
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.cars.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_name">ชื่อรถ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                                           id="product_name" name="product_name" required placeholder="ชื่อรถยนต์" 
                                           minlength="3" value="{{ old('product_name') }}">
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="price">ราคา <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" required placeholder="ราคา" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category_id">หมวดหมู่</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id">
                                        <option value="">เลือกหมวดหมู่</option>
                                        @php
                                            $categories = \App\Models\Category::all();
                                        @endphp
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="brand_id">ยี่ห้อ</label>
                                    <select class="form-control @error('brand_id') is-invalid @enderror" 
                                            id="brand_id" name="brand_id">
                                        <option value="">เลือกยี่ห้อ</option>
                                        @php
                                            $brands = \App\Models\Brand::all();
                                        @endphp
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" 
                                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="model_year">ปี</label>
                                    <input type="text" class="form-control @error('model_year') is-invalid @enderror" 
                                           id="model_year" name="model_year" placeholder="เช่น 2024" value="{{ old('model_year') }}">
                                    @error('model_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="fuel_type">เชื้อเพลิง</label>
                                    <select class="form-control @error('fuel_type') is-invalid @enderror" 
                                            id="fuel_type" name="fuel_type">
                                        <option value="">เลือกเชื้อเพลิง</option>
                                        <option value="เบนซิน" {{ old('fuel_type') == 'เบนซิน' ? 'selected' : '' }}>เบนซิน</option>
                                        <option value="ดีเซล" {{ old('fuel_type') == 'ดีเซล' ? 'selected' : '' }}>ดีเซล</option>
                                        <option value="ไฟฟ้า" {{ old('fuel_type') == 'ไฟฟ้า' ? 'selected' : '' }}>ไฟฟ้า</option>
                                        <option value="ไฮบริด" {{ old('fuel_type') == 'ไฮบริด' ? 'selected' : '' }}>ไฮบริด</option>
                                    </select>
                                    @error('fuel_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="transmission">เกียร์</label>
                                    <select class="form-control @error('transmission') is-invalid @enderror" 
                                            id="transmission" name="transmission">
                                        <option value="">เลือกเกียร์</option>
                                        <option value="อัตโนมัติ" {{ old('transmission') == 'อัตโนมัติ' ? 'selected' : '' }}>อัตโนมัติ</option>
                                        <option value="เกียร์ธรรมดา" {{ old('transmission') == 'เกียร์ธรรมดา' ? 'selected' : '' }}>เกียร์ธรรมดา</option>
                                        <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                                    </select>
                                    @error('transmission')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="mileage">ไมล์ (กิโลเมตร)</label>
                                    <input type="number" class="form-control @error('mileage') is-invalid @enderror" 
                                           id="mileage" name="mileage" placeholder="ไมล์" value="{{ old('mileage') }}">
                                    @error('mileage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status">สถานะ</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status">
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>พร้อมขาย</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>ขายแล้ว</option>
                                        <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>จองแล้ว</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_detail">รายละเอียด <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('product_detail') is-invalid @enderror" 
                                      id="product_detail" name="product_detail" required placeholder="รายละเอียดรถยนต์" 
                                      rows="4">{{ old('product_detail') }}</textarea>
                            @error('product_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="picture">รูปภาพ</label>
                            <input type="file" class="form-control @error('picture') is-invalid @enderror" 
                                   id="picture" name="picture" accept="image/*">
                            @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">รองรับไฟล์: JPG, JPEG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> บันทึก
                            </button>
                            <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">ยกเลิก</a>
                        </div>

                    </form>
                </div>
            </div>

@endsection
