@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">ภาพรวมระบบจัดการ Car Shop</p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('d/m/Y H:i') }}</small>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">รถทั้งหมด</h6>
                            <h3 class="mb-0">{{ number_format($totalCars) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-car text-primary fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">พร้อมขาย</h6>
                            <h3 class="mb-0 text-success">{{ number_format($availableCars) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-check-circle text-success fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">รถที่ขายแล้ว</h6>
                            <h3 class="mb-0 text-warning">{{ number_format($soldCars) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-dollar-sign text-warning fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">รถที่จองแล้ว</h6>
                            <h3 class="mb-0 text-danger">{{ number_format($reservedCars) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-danger bg-opacity-10 rounded p-3">
                                <i class="fas fa-clock text-danger fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">ลูกค้า</h6>
                            <h3 class="mb-0 text-info">{{ number_format($totalCustomers) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-users text-info fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">หมวดหมู่</h6>
                            <h3 class="mb-0 text-secondary">{{ number_format($totalCategories) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-secondary bg-opacity-10 rounded p-3">
                                <i class="fas fa-tags text-secondary fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">ยี่ห้อ</h6>
                            <h3 class="mb-0 text-dark">{{ number_format($totalBrands) }}</h3>
                        </div>
                        <div class="ms-3">
                            <div class="bg-dark bg-opacity-10 rounded p-3">
                                <i class="fas fa-industry text-dark fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Cars by Category Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0">รถแยกตามหมวดหมู่</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-2 pb-2" style="position: relative; height: 300px;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cars by Brand Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0">รถแยกตามยี่ห้อ</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar pt-2 pb-2" style="position: relative; height: 300px;">
                        <canvas id="brandChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Cars Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0">รถล่าสุด</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">รูปภาพ</th>
                                    <th class="border-0">ชื่อรถ</th>
                                    <th class="border-0">ราคา</th>
                                    <th class="border-0">สถานะ</th>
                                    <th class="border-0">วันที่เพิ่ม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularCars as $car)
                                <tr>
                                    <td class="align-middle">
                                        @if($car->picture)
                                            <img src="{{ asset('uploads/' . $car->picture) }}" alt="{{ $car->product_name }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center text-muted rounded" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-car"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <h6 class="mb-0">{{ $car->product_name }}</h6>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-success fw-semibold">{{ number_format($car->price) }} บาท</span>
                                    </td>
                                    <td class="align-middle">
                                        @if($car->status == 'available')
                                            <span class="badge bg-success-subtle text-success">ว่าง</span>
                                        @elseif($car->status == 'sold')
                                            <span class="badge bg-danger-subtle text-danger">ขายแล้ว</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">จอง</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-muted">{{ $car->created_at ? $car->created_at->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Category Chart - ธรรมชาติและเรียบง่าย
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($categories->pluck('name')->toArray()) !!},
        datasets: [{
            data: {!! json_encode($categories->pluck('cars_count')->toArray()) !!},
            backgroundColor: [
                '#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1'
            ],
            borderWidth: 0
        }]
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 15,
                    font: {
                        size: 14
                    }
                }
            }
        }
    }
});

// Brand Chart - แบบเรียบง่าย
const brandCtx = document.getElementById('brandChart').getContext('2d');
new Chart(brandCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($brands->pluck('name')->toArray()) !!},
        datasets: [{
            label: 'จำนวนรถ',
            data: {!! json_encode($brands->pluck('cars_count')->toArray()) !!},
            backgroundColor: '#0d6efd',
            borderRadius: 4,
            borderSkipped: false,
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f3f4'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection