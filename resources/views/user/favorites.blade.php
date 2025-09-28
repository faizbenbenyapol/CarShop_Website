@extends('layouts.frontend')

@section('title', 'รถที่ชื่นชอบ')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    </div>
                    <h5>{{ session('user_name') }}</h5>
                    <p class="text-muted">{{ session('role') == 'admin' ? 'ผู้ดูแลระบบ' : 'สมาชิก' }}</p>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                            <i class="fas fa-user me-2"></i>โปรไฟล์
                        </a>
                        <a href="{{ route('user.favorites') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.favorites') ? 'active' : '' }}">
                            <i class="fas fa-heart me-2"></i>รถที่ชื่นชอบ
                        </a>
                        @if(session('role') == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-tachometer-alt me-2"></i>จัดการระบบ
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-heart me-2"></i>รถที่ชื่นชอบ</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($favoriteCars as $car)
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card h-100 card-hover shadow-sm">
                                @if($car->picture)
                                    <img src="{{ asset('uploads/' . $car->picture) }}" class="card-img-top" 
                                         alt="{{ $car->product_name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="fas fa-car fa-3x text-muted"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $car->product_name }}</h6>
                                    <p class="card-text text-muted flex-grow-1 small">
                                        {{ Str::limit($car->product_detail, 80) }}
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-primary">{{ number_format($car->price) }} บาท</span>
                                        <div>
                                            <a href="{{ route('car.detail', $car->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-info-circle me-1"></i>ดูรายละเอียด
                                            </a>
                                            <button class="btn btn-outline-danger btn-sm" onclick="removeFavorite({{ $car->id }})">
                                                <i class="fas fa-heart-broken"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-heart fa-5x text-muted mb-3"></i>
                                <h4>ยังไม่มีรถที่ชื่นชอบ</h4>
                                <p class="text-muted">เริ่มต้นค้นหารถในฝันของคุณ</p>
                                <a href="{{ route('cars') }}" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>ค้นหารถ
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    
                    @if($favoriteCars->count() > 0)
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>หมายเหตุ:</strong> นี่คือรถล่าสุดที่แสดงเป็นตัวอย่าง สามารถพัฒนาระบบ Favorites ที่แท้จริงได้ในอนาคต
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function removeFavorite(carId) {
    Swal.fire({
        title: 'ต้องการเอาออกจากรายการโปรด?',
        text: "รถคันนี้จะถูกเอาออกจากรายการโปรดของคุณ",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, เอาออก',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // ในอนาคตสามารถส่ง AJAX request ไปลบออกจากฐานข้อมูลได้
            Swal.fire('เอาออกแล้ว!', 'รถคันนี้ถูกเอาออกจากรายการโปรดแล้ว', 'success');
        }
    });
}
</script>
@endsection