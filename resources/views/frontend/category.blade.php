@extends('layouts.frontend')

@section('title', $category->name . ' - รถยนต์')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cars') }}">รถยนต์ทั้งหมด</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, 
            @if($category->name == 'รถเก๋ง')
                #e74c3c, #c0392b
            @elseif($category->name == 'รถ SUV') 
                #27ae60, #229954
            @elseif($category->name == 'รถกระบะ')
                #f39c12, #e67e22
            @elseif($category->name == 'รถสปอร์ต')
                #9b59b6, #8e44ad
            @elseif($category->name == 'รถไฟฟ้า')
                #3498db, #2980b9
            @else
                #34495e, #2c3e50
            @endif
            );">
                <div class="card-body text-center text-white py-5">
                    <i class="fas fa-tags fa-4x mb-3"></i>
                    <h1 class="fw-bold mb-2">รถยนต์ประเภท {{ $category->name }}</h1>
                    @if($category->description)
                        <p class="mb-3">{{ $category->description }}</p>
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
                            <small>หมวดหมู่ยอดนิยม</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Sort Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark border px-3 py-2">
                                    <i class="fas fa-filter me-1"></i>เรียงตาม:
                                </span>
                                <button class="btn btn-outline-primary btn-sm active">ราคาต่ำ-สูง</button>
                                <button class="btn btn-outline-primary btn-sm">ราคาสูง-ต่ำ</button>
                                <button class="btn btn-outline-primary btn-sm">ล่าสุด</button>
                                <button class="btn btn-outline-primary btn-sm">ยอดนิยม</button>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                            <small class="text-muted">
                                <i class="fas fa-list-ul me-1"></i>
                                แสดง {{ $cars->firstItem() ?? 0 }}-{{ $cars->lastItem() ?? 0 }} จาก {{ $cars->total() }} รายการ
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($cars->count() > 0)
        <div class="row">
            @foreach($cars as $car)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 car-card border-0 shadow-sm">
                        <div class="position-relative overflow-hidden">
                            @if($car->picture)
                                <img src="{{ asset('uploads/' . $car->picture) }}" 
                                     class="card-img-top car-image" 
                                     alt="{{ $car->product_name }}"
                                     style="height: 250px; object-fit: cover; transition: transform 0.3s;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 250px;">
                                    <i class="fas fa-car fa-4x text-secondary"></i>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="position-absolute top-0 end-0 m-2">
                                @if($car->status == 'available')
                                    <span class="badge bg-success shadow-sm">
                                        <i class="fas fa-check me-1"></i>พร้อมขาย
                                    </span>
                                @elseif($car->status == 'sold')
                                    <span class="badge bg-danger shadow-sm">
                                        <i class="fas fa-times me-1"></i>ขายแล้ว
                                    </span>
                                @elseif($car->status == 'reserved')
                                    <span class="badge bg-warning text-dark shadow-sm">
                                        <i class="fas fa-clock me-1"></i>จองแล้ว
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-primary shadow-sm">
                                    <i class="fas fa-tags me-1"></i>{{ $category->name }}
                                </span>
                            </div>
                            
                            <!-- Price Overlay -->
                            <div class="position-absolute bottom-0 start-0 end-0 p-3" 
                                 style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <h4 class="text-white mb-0 fw-bold">
                                    ฿{{ number_format($car->price) }}
                                </h4>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold mb-0">{{ $car->product_name }}</h5>
                                <small class="text-muted">
                                    <i class="fas fa-industry me-1"></i>{{ $car->brand->name ?? 'ไม่ระบุ' }}
                                </small>
                            </div>
                            
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($car->product_detail, 100) }}
                            </p>
                            
                            <!-- Car Details -->
                            <div class="row text-center mb-3 border-top pt-3">
                                <div class="col-4">
                                    <i class="fas fa-calendar-alt text-primary d-block mb-1"></i>
                                    <small class="text-muted">{{ $car->year ?? '2024' }}</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-tachometer-alt text-success d-block mb-1"></i>
                                    <small class="text-muted">{{ number_format($car->mileage ?? 0) }} กม.</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-gas-pump text-warning d-block mb-1"></i>
                                    <small class="text-muted">{{ $car->fuel_type ?? 'เบนซิน' }}</small>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <a href="{{ route('car.detail', $car->id) }}" 
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-eye me-2"></i>ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $cars->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-search fa-5x text-muted"></i>
            </div>
            <h3 class="text-muted mb-3">ไม่พบรถยนต์ในหมวดหมู่นี้</h3>
            <p class="text-muted mb-4">
                ขณะนี้ยังไม่มีรถยนต์ในหมวดหมู่ "{{ $category->name }}" <br>
                กรุณาลองเลือกหมวดหมู่อื่น หรือกลับมาดูใหม่ภายหลัง
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('frontend.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i>กลับหน้าหลัก
                </a>
                <a href="{{ route('cars') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-car me-2"></i>ดูรถยนต์ทั้งหมด
                </a>
            </div>
        </div>
    @endif
</div>

<style>
/* Card Styles */
.car-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.car-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.car-card:hover .car-image {
    transform: scale(1.05);
}

/* Breadcrumb Styles */
.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 0;
}

.breadcrumb-item {
    font-size: 0.95rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #6c757d;
}

.breadcrumb-item.active {
    color: #0d6efd;
    font-weight: 500;
}

/* Filter Bar Styles */
.btn-outline-primary.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

/* Badge Styles */
.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
}

/* Price Overlay */
.position-absolute.bottom-0 h4 {
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

/* Responsive Design */
@media (max-width: 768px) {
    .car-card {
        margin-bottom: 1.5rem;
    }
    
    .d-flex.flex-wrap.gap-2 {
        justify-content: center;
    }
    
    .btn-outline-primary.btn-sm {
        margin-bottom: 0.25rem;
    }
}

/* Loading Animation */
.car-image {
    background: linear-gradient(90deg, #f0f0f0, #e0e0e0, #f0f0f0);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Pagination Styling */
.pagination {
    border-radius: 10px;
    overflow: hidden;
}

.page-link {
    border: none;
    color: #6c757d;
    padding: 0.75rem 1rem;
}

.page-link:hover {
    background-color: #0d6efd;
    color: white;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endsection