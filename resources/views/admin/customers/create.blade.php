@extends('layouts.backend')

@section('title', 'เพิ่มลูกค้าใหม่')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-plus me-2 text-primary"></i>เพิ่มลูกค้าใหม่
        </h1>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm me-1"></i> กลับไปรายการลูกค้า
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-plus me-2"></i>ฟอร์มเพิ่มลูกค้าใหม่
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>ชื่อ-นามสกุล <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-1"></i>อีเมล <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="fas fa-phone me-1"></i>เบอร์โทรศัพท์ <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profile_image" class="form-label fw-semibold">
                                <i class="fas fa-user-circle me-1"></i>รูปโปรไฟล์
                            </label>
                            <input type="file" class="form-control @error('profile_image') is-invalid @enderror" 
                                   id="profile_image" name="profile_image" accept="image/*">
                            <small class="form-text text-muted">รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">
                        <i class="fas fa-map-marker-alt me-1"></i>ที่อยู่ <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" name="address" rows="4" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>บันทึกข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection