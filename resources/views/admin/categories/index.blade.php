@extends('layouts.backend')

@section('title', 'จัดการหมวดหมู่')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-list me-2 text-primary"></i>จัดการหมวดหมู่
        </h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm me-1"></i> เพิ่มหมวดหมู่ใหม่
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-table me-2"></i>รายการหมวดหมู่ทั้งหมด
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-tag me-1"></i>ชื่อหมวดหมู่</th>
                            <th><i class="fas fa-align-left me-1"></i>คำอธิบาย</th>
                            <th><i class="fas fa-car me-1"></i>จำนวนรถ</th>
                            <th><i class="fas fa-calendar me-1"></i>วันที่สร้าง</th>
                            <th><i class="fas fa-cogs me-1"></i>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="fw-bold text-primary">{{ $category->id }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-muted">{{ Str::limit($category->description, 50) }}</td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="fas fa-car me-1"></i>{{ $category->cars_count ?? 0 }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $category->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-1" title="แก้ไข">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบหมวดหมู่นี้?')">
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
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection