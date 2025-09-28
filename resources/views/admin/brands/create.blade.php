@extends('layouts.backend')

@section('title', 'เพิ่มยี่ห้อใหม่')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-copyright me-2 text-primary"></i>เพิ่มยี่ห้อใหม่
        </h1>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm me-1"></i> กลับไปรายการยี่ห้อ
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-plus me-2"></i>ฟอร์มเพิ่มยี่ห้อใหม่
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-copyright me-1"></i>ชื่อยี่ห้อ <span class="text-danger">*</span>
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
                            <label for="country" class="form-label fw-semibold">
                                <i class="fas fa-globe me-1"></i>ประเทศ <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                   id="country" name="country" value="{{ old('country') }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-1"></i>คำอธิบาย
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label fw-semibold">
                        <i class="fas fa-image me-1"></i>โลโก้ยี่ห้อ
                    </label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                           id="logo" name="logo" accept="image/*">
                    <small class="form-text text-muted">รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">
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