@extends('layouts.backend')

@section('title', 'เพิ่มหมวดหมู่ใหม่')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">เพิ่มหมวดหมู่ใหม่</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> กลับ
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">ชื่อหมวดหมู่ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">คำอธิบาย</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">รูปภาพ</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">รองรับไฟล์: JPG, JPEG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> บันทึก
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection