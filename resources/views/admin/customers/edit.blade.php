@extends('layouts.backend')

@section('title', 'แก้ไขข้อมูลลูกค้า')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-edit me-2 text-warning"></i>แก้ไขข้อมูลลูกค้า
        </h1>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm me-1"></i> กลับไปรายการลูกค้า
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); border-radius: 0.375rem 0.375rem 0 0;">
            <h6 class="m-0 fw-bold text-white">
                <i class="fas fa-edit me-2"></i>ฟอร์มแก้ไขข้อมูลลูกค้า
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>ชื่อ-นามสกุล <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $customer->name) }}" required 
                                   placeholder="เช่น นางสาว จันทรี">
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
                                   id="email" name="email" value="{{ old('email', $customer->email) }}" required 
                                   placeholder="customer@example.com">
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
                                   id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required 
                                   placeholder="เช่น 089-123-4567">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="line_id" class="form-label fw-semibold">
                                <i class="fab fa-line me-1 text-success"></i>Line ID
                            </label>
                            <input type="text" class="form-control @error('line_id') is-invalid @enderror" 
                                   id="line_id" name="line_id" value="{{ old('line_id', $customer->line_id) }}" 
                                   placeholder="เช่น @customer123">
                            @error('line_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt me-1"></i>ที่อยู่ <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="4" required 
                                      placeholder="กรอกที่อยู่ เช่น 123 หมู่ 4 ต.สมเด็จ อ.เมือง จ.กรุงเทพฯ 10100">{{ old('address', $customer->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save me-1"></i>บันทึกการแก้ไข
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection