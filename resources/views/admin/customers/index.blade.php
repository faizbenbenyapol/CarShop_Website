@extends('layouts.backend')

@section('title', 'จัดการลูกค้า')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users me-2 text-primary"></i>จัดการลูกค้า
        </h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm me-1"></i> เพิ่มลูกค้าใหม่
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-table me-2"></i>รายการลูกค้าทั้งหมด
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-user-circle me-1"></i>รูปภาพ</th>
                            <th><i class="fas fa-user me-1"></i>ชื่อ</th>
                            <th><i class="fas fa-envelope me-1"></i>อีเมล</th>
                            <th><i class="fas fa-phone me-1"></i>โทรศัพท์</th>
                            <th><i class="fas fa-map-marker-alt me-1"></i>ที่อยู่</th>
                            <th><i class="fas fa-calendar me-1"></i>วันที่สร้าง</th>
                            <th><i class="fas fa-cogs me-1"></i>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td class="fw-bold text-primary">{{ $customer->id }}</td>
                            <td>
                                @if($customer->profile_image)
                                    <img src="{{ Storage::url($customer->profile_image) }}" alt="{{ $customer->name }}"
                                         style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle shadow-sm">
                                @else
                                    <div class="bg-gradient-info d-flex align-items-center justify-content-center text-white rounded-circle shadow-sm"
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-lg"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $customer->name }}</td>
                            <td>
                                <a href="mailto:{{ $customer->email }}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-1 text-muted"></i>{{ $customer->email }}
                                </a>
                            </td>
                            <td>
                                <a href="tel:{{ $customer->phone }}" class="text-decoration-none">
                                    <i class="fas fa-phone me-1 text-muted"></i>{{ $customer->phone }}
                                </a>
                            </td>
                            <td class="text-muted">{{ Str::limit($customer->address, 50) }}</td>
                            <td class="text-muted">{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm me-1" title="แก้ไข">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบลูกค้านี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="ลบ">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection