@extends('layouts.backend')

@section('title', 'จัดการยี่ห้อ')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-copyright me-2 text-primary"></i>จัดการยี่ห้อ
        </h1>
        <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm me-1"></i> เพิ่มยี่ห้อใหม่
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-table me-2"></i>รายการยี่ห้อทั้งหมด
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-image me-1"></i>โลโก้</th>
                            <th><i class="fas fa-copyright me-1"></i>ชื่อยี่ห้อ</th>
                            <th><i class="fas fa-globe me-1"></i>ประเทศ</th>
                            <th><i class="fas fa-align-left me-1"></i>คำอธิบาย</th>
                            <th><i class="fas fa-car me-1"></i>จำนวนรถ</th>
                            <th><i class="fas fa-calendar me-1"></i>วันที่สร้าง</th>
                            <th><i class="fas fa-cogs me-1"></i>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td class="fw-bold text-primary">{{ $brand->id }}</td>
                            <td>
                                @if($brand->logo)
                                    <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}"
                                         style="width: 60px; height: 60px; object-fit: contain;" class="rounded shadow-sm">
                                @else
                                    <div class="bg-gradient-secondary d-flex align-items-center justify-content-center text-white rounded shadow-sm"
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-industry fa-lg"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $brand->name }}</td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="fas fa-globe me-1"></i>{{ $brand->country }}
                                </span>
                            </td>
                            <td class="text-muted">{{ Str::limit($brand->description, 50) }}</td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="fas fa-car me-1"></i>{{ $brand->cars_count ?? 0 }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $brand->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm me-1" title="แก้ไข">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบยี่ห้อนี้?')">
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
            {{ $brands->links() }}
        </div>
    </div>
</div>
@endsection