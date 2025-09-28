@extends('layouts.frontend')

@section('title', 'รถยนต์ทั้งหมด - Car Shop')

@section('content')
<!-- Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold">รถยนต์ทั้งหมด</h1>
                <p class="lead">เลือกรถที่ใช่สำหรับคุณ</p>
            </div>
            <div class="col-md-6">
                <form action="{{ route('cars') }}" method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" name="search" 
                           placeholder="ค้นหารถยนต์..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-light">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>กรองผลการค้นหา</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cars') }}" method="GET">
                        <!-- Search -->
                        <div class="mb-3">
                            <label class="form-label">ค้นหา</label>
                            <input type="text" class="form-control" name="search" 
                                   placeholder="ชื่อรถ..." value="{{ request('search') }}">
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">หมวดหมู่</label>
                            <select class="form-select" name="category">
                                <option value="">ทั้งหมด</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand -->
                        <div class="mb-3">
                            <label class="form-label">ยี่ห้อ</label>
                            <select class="form-select" name="brand">
                                <option value="">ทั้งหมด</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label">ช่วงราคา</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" class="form-control" name="min_price" 
                                           placeholder="ต่ำสุด" value="{{ request('min_price') }}">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="max_price" 
                                           placeholder="สูงสุด" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>ค้นหา
                        </button>
                        <a href="{{ route('cars') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-times me-2"></i>ล้างตัวกรอง
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cars Grid -->
        <div class="col-lg-9">
            <!-- Sort Options -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5>พบรถยนต์ {{ $cars->total() }} คัน</h5>
                </div>
                <div>
                    <form action="{{ route('cars') }}" method="GET" class="d-inline">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" class="form-select" onchange="this.form.submit()" style="width: auto;">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>ราคาต่ำ-สูง</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>ราคาสูง-ต่ำ</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>ชื่อ A-Z</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Cars Cards -->
            <div class="row">
                @forelse($cars as $car)
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
                                {{ Str::limit($car->product_detail, 80) }}
                            </p>
                            
                            <!-- Car Info -->
                            <div class="mb-3">
                                @if($car->model_year)
                                    <small class="badge bg-secondary me-1">{{ $car->model_year }}</small>
                                @endif
                                @if($car->fuel_type)
                                    <small class="badge bg-info me-1">{{ $car->fuel_type }}</small>
                                @endif
                                @if($car->transmission)
                                    <small class="badge bg-warning me-1">{{ $car->transmission }}</small>
                                @endif
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price-tag">{{ number_format($car->price) }} บาท</span>
                                <a href="{{ route('car.detail', $car->id) }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle me-1"></i>ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-car fa-5x text-muted mb-3"></i>
                        <h4>ไม่พบรถยนต์</h4>
                        <p class="text-muted">ลองเปลี่ยนเงื่อนไขการค้นหาใหม่</p>
                        <a href="{{ route('cars') }}" class="btn btn-primary">ดูรถทั้งหมด</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $cars->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection