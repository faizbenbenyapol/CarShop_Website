@extends('layouts.frontend')

@section('title', $car->product_name . ' - Car Shop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cars') }}">รถยนต์ทั้งหมด</a></li>
            <li class="breadcrumb-item active">{{ $car->product_name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Car Image -->
        <div class="col-lg-6 mb-4">
            @if($car->picture)
                <img src="{{ asset('uploads/' . $car->picture) }}" class="img-fluid rounded shadow" 
                     alt="{{ $car->product_name }}" style="width: 100%; height: 400px; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                     style="height: 400px;">
                    <i class="fas fa-car fa-5x text-muted"></i>
                </div>
            @endif
        </div>

        <!-- Car Details -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h1 class="card-title h2">{{ $car->product_name }}</h1>
                    <div class="price-tag h3 mb-4">{{ number_format($car->price) }} บาท</div>
                    
                    <!-- Status Badge -->
                    <div class="mb-3">
                        @if($car->status == 'available')
                            <span class="badge bg-success fs-6"><i class="fas fa-check-circle me-1"></i>พร้อมขาย</span>
                        @elseif($car->status == 'sold')
                            <span class="badge bg-danger fs-6"><i class="fas fa-times-circle me-1"></i>ขายแล้ว</span>
                        @else
                            <span class="badge bg-warning fs-6"><i class="fas fa-clock me-1"></i>จองแล้ว</span>
                        @endif
                    </div>

                    <!-- Car Specifications -->
                    <div class="row mb-4">
                        @if($car->model_year)
                        <div class="col-6 mb-2">
                            <strong><i class="fas fa-calendar me-2"></i>ปี:</strong>
                            <span>{{ $car->model_year }}</span>
                        </div>
                        @endif
                        
                        @if($car->fuel_type)
                        <div class="col-6 mb-2">
                            <strong><i class="fas fa-gas-pump me-2"></i>เชื้อเพลิง:</strong>
                            <span>{{ $car->fuel_type }}</span>
                        </div>
                        @endif
                        
                        @if($car->transmission)
                        <div class="col-6 mb-2">
                            <strong><i class="fas fa-cogs me-2"></i>เกียร์:</strong>
                            <span>{{ $car->transmission }}</span>
                        </div>
                        @endif
                        
                        @if($car->mileage)
                        <div class="col-6 mb-2">
                            <strong><i class="fas fa-tachometer-alt me-2"></i>ไมล์:</strong>
                            <span>{{ number_format($car->mileage) }} กม.</span>
                        </div>
                        @endif
                    </div>

                    <!-- Contact Buttons -->
                    <div class="d-grid gap-2">
                        <a href="tel:02-123-4567" class="btn btn-success btn-lg">
                            <i class="fas fa-phone me-2"></i>โทรสอบถาม: 02-123-4567
                        </a>
                        <a href="https://line.me/ti/p/~@carshop" class="btn btn-primary">
                            <i class="fab fa-line me-2"></i>สอบถาม Line: @carshop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Car Description -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle me-2"></i>รายละเอียดรถยนต์</h3>
                </div>
                <div class="card-body">
                    <p class="card-text" style="white-space: pre-line;">{{ $car->product_detail }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Cars -->
    @if($relatedCars->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4"><i class="fas fa-cars me-2"></i>รถที่เกี่ยวข้อง</h3>
            <div class="row">
                @foreach($relatedCars as $relatedCar)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 card-hover shadow-sm">
                        @if($relatedCar->picture)
                            <img src="{{ asset('uploads/' . $relatedCar->picture) }}" class="card-img-top" 
                                 alt="{{ $relatedCar->product_name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-car fa-2x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ $relatedCar->product_name }}</h6>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($relatedCar->product_detail, 60) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">{{ number_format($relatedCar->price) }} บาท</span>
                                <a href="{{ route('car.detail', $relatedCar->id) }}" class="btn btn-outline-primary btn-sm">
                                    ดูรายละเอียด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Add any specific JavaScript for car detail page here
</script>
@endsection