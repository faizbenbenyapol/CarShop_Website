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

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>รถยนต์ประเภท {{ $category->name }}</h2>
                <span class="text-muted">พบ {{ $cars->total() }} คัน</span>
            </div>
        </div>
    </div>

    @if($cars->count() > 0)
        <div class="row">
            @foreach($cars as $car)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 car-card">
                        <div class="position-relative">
                            @if($car->product_img)
                                <img src="{{ asset('uploads/' . $car->product_img) }}" 
                                     class="card-img-top" 
                                     alt="{{ $car->product_name }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="fas fa-car fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-primary">{{ $car->category->category_name ?? 'ไม่ระบุ' }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $car->product_name }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($car->product_detail, 80) }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="h5 text-primary mb-0">
                                        ฿{{ number_format($car->price) }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="fas fa-factory me-1"></i>
                                        {{ $car->brand->brand_name ?? 'ไม่ระบุ' }}
                                    </small>
                                </div>
                                
                                <div class="d-grid">
                                    <a href="{{ route('car.detail', $car->id) }}" 
                                       class="btn btn-outline-primary btn-sm">
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
            <h4 class="text-muted">ไม่พบรถยนต์ในหมวดหมู่นี้</h4>
            <p class="text-muted">ลองเลือกหมวดหมู่อื่น หรือ <a href="{{ route('cars') }}">ดูรถยนต์ทั้งหมด</a></p>
        </div>
    @endif
</div>

<style>
.car-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e9ecef;
}

.car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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