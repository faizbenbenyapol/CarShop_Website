@extends('layouts.backend')

@section('title', 'จัดการรถยนต์')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-car me-2 text-primary"></i>จัดการรถยนต์
        </h1>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm me-1"></i> เพิ่มรถยนต์ใหม่
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-table me-2"></i>รายการรถยนต์ทั้งหมด
            </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-image me-1"></i>รูปภาพ</th>
                            <th><i class="fas fa-car me-1"></i>ชื่อรถ</th>
                            <th><i class="fas fa-list me-1"></i>หมวดหมู่</th>
                            <th><i class="fas fa-copyright me-1"></i>ยี่ห้อ</th>
                            <th><i class="fas fa-money-bill-wave me-1"></i>ราคา</th>
                            <th><i class="fas fa-info-circle me-1"></i>สถานะ</th>
                            <th><i class="fas fa-calendar me-1"></i>วันที่สร้าง</th>
                            <th><i class="fas fa-cogs me-1"></i>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carList as $row)
                        <tr>
                            <td class="fw-bold text-primary">{{ $row->id }}</td>
                            <td class="text-center">
                                @if($row->picture)
                                    <img src="{{ asset('uploads/' . $row->picture) }}" alt="{{ $row->product_name }}" 
                                         style="width: 80px; height: 80px; object-fit: cover;" class="rounded shadow-sm">
                                @else
                                    <div class="bg-gradient-primary d-flex align-items-center justify-content-center text-white rounded shadow-sm" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-car fa-2x"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $row->product_name }}</div>
                                <small class="text-muted">{{ Str::limit($row->product_detail, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="fas fa-list me-1"></i>{{ $row->category->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-copyright me-1"></i>{{ $row->brand->name ?? '-' }}
                                </span>
                            </td>
                            <td class="text-success fw-bold">{{ number_format($row->price) }} บาท</td>
                            <td>
                                @if($row->status == 'available')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>พร้อมขาย
                                    </span>
                                @elseif($row->status == 'sold')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle me-1"></i>ขายแล้ว
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>จองแล้ว
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.cars.edit', $row->id) }}" class="btn btn-warning btn-sm me-1" title="แก้ไข">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})" title="ลบ">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <form id="delete-form-{{ $row->id }}" action="{{ route('admin.cars.destroy', $row->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $carList->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'ยืนยันการลบข้อมูล',
        text: "หากลบแล้วจะไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
