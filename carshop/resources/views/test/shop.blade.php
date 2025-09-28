@extends('layouts.backend')

@section('content')
<style>
    .car-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .car-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    .car-image {
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }
    .badge-year {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: rgba(0, 123, 255, 0.9);
        color: white;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 8px;
    }
    .car-title {
        font-weight: 600;
        font-size: 1.1rem;
    }
    .car-price {
        font-size: 1rem;
        font-weight: bold;
        color: #28a745;
    }
    .car-card a {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">🚗 รายการรถทั้งหมด</h2>

    <div class="row g-4">
        @foreach($carList as $car)
        @php($buyUrl = config('buy.' . $car->id))
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm car-card position-relative rounded-4 overflow-hidden">

                {{-- Badge ปี (ดึงคำสุดท้ายจากรายละเอียด ถ้าไม่มีจะเว้นไว้) --}}
                @php($yearText = \Illuminate\Support\Str::afterLast($car->product_detail ?? '', ' '))
                @if($yearText && $yearText !== $car->product_detail)
                    <div class="badge-year">{{ $yearText }}</div>
                @endif

                {{-- รูปภาพ --}}
                @if($car->picture)
                    <img src="{{ asset('uploads/' . $car->picture) }}"
                         class="card-img-top car-image" alt="{{ $car->product_name }}">
                @else
                    <img src="{{ asset('assets/pic/default-car.jpg') }}"
                         class="card-img-top car-image" alt="No Image">
                @endif

                {{-- เนื้อหา --}}
                <div class="card-body px-3 py-2">
                    <div class="car-title mb-1">{{ $car->product_name }}</div>
                    <div class="text-muted small mb-2">{{ $car->product_detail }}</div>
                    <div class="car-price mb-3">{{ number_format($car->price, 0) }} ฿</div>

                    {{-- ปุ่ม Buy: เด้งไป URL ตามที่กำหนดใน config/buy.php --}}
                    @if($buyUrl)
                        <a href="{{ $buyUrl }}" target="_blank"
                           class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-bag-check-fill"></i> Buy
                        </a>
                    @else
                        <button type="button"
                                class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2"
                                disabled data-bs-toggle="tooltip" data-bs-title="ยังไม่ได้ตั้งค่า URL สำหรับคันนี้">
                            <i class="bi bi-bag-check-fill"></i> Buy
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $carList->links() }}
    </div>
</div>
@endsection
