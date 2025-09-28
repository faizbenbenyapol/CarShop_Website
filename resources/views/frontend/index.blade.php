@extends('layouts.frontend')

@section('title', 'Car Shop - ศูนย์รวมรถยนต์คุณภาพ')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">ค้นหารถในฝันของคุณ</h1>
                <p class="lead mb-4">ศูนย์รวมรถยนต์คุณภาพ พร้อมบริการครบครันและราคาที่เป็นธรรม</p>
                <a href="{{ route('cars') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-search me-2"></i>เริ่มค้นหา
                </a>
            </div>
            <div class="col-lg-6">
                <div class="search-form">
                    <h4 class="mb-3">ค้นหารถยนต์</h4>
                    <form action="{{ route('cars') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="search" 
                                       placeholder="ค้นหาชื่อรถ..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="category">
                                    <option value="">เลือกหมวดหมู่</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="min_price" 
                                       placeholder="ราคาต่ำสุด" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="max_price" 
                                       placeholder="ราคาสูงสุด" value="{{ request('max_price') }}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>ค้นหา
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Cars -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">รถยนต์แนะนำ</h2>
        <div class="row">
            @foreach($featuredCars as $car)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 card-hover shadow-sm">
                    @if($car->picture)
                        <img src="{{ asset('uploads/' . $car->picture) }}" class="card-img-top" 
                             alt="{{ $car->product_name }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 250px;">
                            <i class="fas fa-car fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $car->product_name }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($car->product_detail, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag">{{ number_format($car->price) }} บาท</span>
                            <a href="{{ route('car.detail', $car->id) }}" class="btn btn-primary">
                                <i class="fas fa-info-circle me-1"></i>ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('cars') }}" class="btn btn-outline-primary btn-lg">
                ดูรถทั้งหมด <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">หมวดหมู่รถยนต์</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center card-hover">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" class="card-img-top" 
                             alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-tags fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="text-muted">{{ $category->cars_count }} คัน</p>
                        <a href="{{ route('category.cars', $category->id) }}" class="btn btn-outline-primary">
                            ดูรถในหมวดนี้
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Brands Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">ยี่ห้อรถยนต์</h2>
        <div class="row">
            @foreach($brands as $brand)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card text-center card-hover">
                    @if($brand->logo)
                        <img src="{{ Storage::url($brand->logo) }}" class="card-img-top" 
                             alt="{{ $brand->name }}" style="height: 150px; object-fit: contain; padding: 20px;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                             style="height: 150px;">
                            <i class="fas fa-industry fa-2x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $brand->name }}</h5>
                        @if($brand->country)
                            <p class="text-muted">{{ $brand->country }}</p>
                        @endif
                        <p class="text-muted">{{ $brand->cars_count }} คัน</p>
                        <a href="{{ route('brand.cars', $brand->id) }}" class="btn btn-outline-primary">
                            ดูรถยี่ห้อนี้
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="mb-3">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>
                <h5>รับประกันคุณภาพ</h5>
                <p>รถทุกคันผ่านการตรวจสอบคุณภาพอย่างเข้มงวด</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="mb-3">
                    <i class="fas fa-handshake fa-3x text-primary"></i>
                </div>
                <h5>บริการหลังการขาย</h5>
                <p>ให้คำปรึกษาและดูแลหลังการขายอย่างใส่ใจ</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="mb-3">
                    <i class="fas fa-dollar-sign fa-3x text-primary"></i>
                </div>
                <h5>ราคายุติธรรม</h5>
                <p>ให้ราคาที่เป็นธรรมและโปร่งใส</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="mb-3">
                    <i class="fas fa-clock fa-3x text-primary"></i>
                </div>
                <h5>บริการรวดเร็ว</h5>
                <p>ให้บริการรวดเร็วและตรงต่อเวลา</p>
            </div>
        </div>
    </div>
</section>
@endsection