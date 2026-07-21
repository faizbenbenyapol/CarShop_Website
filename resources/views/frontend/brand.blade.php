@extends('layouts.frontend')

@section('title', $brand->name . ' - รถยนต์')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cars') }}">รถยนต์ทั้งหมด</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
        </ol>
    </nav>

    <!-- Brand Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, 
            @if($brand->name == 'Toyota')
                #e74c3c, #c0392b
            @elseif($brand->name == 'Honda') 
                #3498db, #2980b9
            @elseif($brand->name == 'Mercedes-Benz')
                #34495e, #2c3e50
            @elseif($brand->name == 'BMW')
                #9b59b6, #8e44ad
            @elseif($brand->name == 'Audi')
                #f39c12, #e67e22
            @else
                #667eea, #764ba2
            @endif
            );">
                <div class="card-body text-center text-white py-5">
                    <i class="fas fa-car fa-4x mb-3"></i>
                    <h1 class="fw-bold mb-2">รถยนต์ยี่ห้อ {{ $brand->name }}</h1>
                    @if($brand->country)
                        <p class="mb-2">
                            <i class="fas fa-flag me-2"></i>จาก {{ $brand->country }}
                        </p>
                    @endif
                    @if($brand->description)
                        <p class="mb-3">{{ $brand->description }}</p>
                    @endif
                    <div class="d-flex justify-content-center align-items-center gap-4">
                        <div class="text-center">
                            <h3 class="mb-0">{{ $cars->total() }}</h3>
                            <small>รถยนต์ทั้งหมด</small>
                        </div>
                        <div class="vr" style="height: 40px;"></div>
                        <div class="text-center">
                            <h3 class="mb-0">
                                <i class="fas fa-star text-warning"></i>
                            </h3>
                            <small>ยี่ห้อยอดนิยม</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($cars->count() > 0)
        <div class="row">
            @foreach($cars as $car)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 car-card border-0 shadow-sm">
                        <div class="position-relative overflow-hidden">
                            @if($car->picture)
                                <img src="{{ asset('uploads/' . $car->picture) }}" 
                                     class="card-img-top" 
                                     alt="{{ $car->product_name }}"
                                     style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                            @else
                                <div class="card-img-top bg-gradient-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                    <i class="fas fa-car fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="position-absolute top-0 start-0 m-2">
                                @if($car->status == 'available')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>พร้อมขาย
                                    </span>
                                @elseif($car->status == 'sold')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle me-1"></i>ขายแล้ว
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>จองแล้ว
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Brand Badge -->
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-primary">{{ $brand->name }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $car->product_name }}</h5>
                            
                            <!-- Car Details -->
                            <div class="mb-2">
                                @if($car->model_year)
                                    <small class="text-muted me-3">
                                        <i class="fas fa-calendar me-1"></i>{{ $car->model_year }}
                                    </small>
                                @endif
                                @if($car->fuel_type)
                                    <small class="text-muted me-3">
                                        <i class="fas fa-gas-pump me-1"></i>{{ $car->fuel_type }}
                                    </small>
                                @endif
                            </div>
                            
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($car->product_detail, 80) }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="h5 text-primary mb-0 fw-bold">
                                        ฿{{ number_format($car->price) }}
                                    </span>
                                    @if($car->category)
                                        <small class="text-muted">
                                            <i class="fas fa-tags me-1"></i>
                                            {{ $car->category->name }}
                                        </small>
                                    @endif
                                </div>
                                
                                <div class="d-grid">
                                    <a href="{{ route('car.detail', $car->id) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $cars->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-car fa-5x text-muted mb-3"></i>
            <h4 class="text-muted">ไม่พบรถยนต์ยี่ห้อนี้</h4>
            <p class="text-muted">ลองเลือกยี่ห้ออื่น หรือ <a href="{{ route('cars') }}">ดูรถยนต์ทั้งหมด</a></p>
        </div>
    @endif
</div>

<style>
.car-card {
    transition: all 0.3s ease;
    border: none !important;
}

.car-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.car-card:hover img {
    transform: scale(1.05);
}

.car-card .card-img-top {
    border-radius: 0.375rem 0.375rem 0 0;
}

.badge {
    font-size: 0.75em;
    padding: 0.35em 0.65em;
}

.vr {
    background-color: rgba(255,255,255,0.3) !important;
    width: 1px !important;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-1px);
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
}
</style>
@endsection