@extends('layouts.backend')

@section('title', 'แก้ไขหมวดหมู่')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">
                <i class="fas fa-edit me-2"></i>แก้ไขหมวดหมู่
            </h1>
            <p class="text-muted mb-0">แก้ไขข้อมูลหมวดหมู่รถยนต์</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">จัดการหมวดหมู่</a></li>
                <li class="breadcrumb-item active">แก้ไขหมวดหมู่</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tags me-2"></i>
                        <h5 class="mb-0">แก้ไขข้อมูลหมวดหมู่: {{ $category->name }}</h5>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-tag text-primary me-2"></i>ชื่อหมวดหมู่
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $category->name) }}" 
                                   placeholder="กรอกชื่อหมวดหมู่รถยนต์ เช่น รถเก๋ง, รถ SUV, รถกระบะ" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                กรุณาระบุชื่อหมวดหมู่รถยนต์ที่ต้องการแก้ไข
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-secondary me-2"></i>คำอธิบาย
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="กรอกคำอธิบายเกี่ยวกับหมวดหมู่นี้">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="text-muted small">
                                <i class="fas fa-info-circle me-1"></i>
                                กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนบันทึก
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                    <i class="fas fa-arrow-left me-2"></i>ยกเลิก
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-save me-2"></i>บันทึกการแก้ไข
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-header {
    border-bottom: none;
    padding: 1.5rem;
}

.btn {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: #6c757d;
}

.breadcrumb-item.active {
    color: #0d6efd;
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .btn-lg {
        width: 100%;
    }
}
</style>
@endsection