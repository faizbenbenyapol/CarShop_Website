@extends('layouts.frontend')

@section('title', 'โปรไฟล์ของฉัน')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    </div>
                    <h5>{{ session('user_name') }}</h5>
                    <p class="text-muted">{{ session('role') == 'admin' ? 'ผู้ดูแลระบบ' : 'สมาชิก' }}</p>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                            <i class="fas fa-user me-2"></i>โปรไฟล์
                        </a>
                        <a href="{{ route('user.favorites') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.favorites') ? 'active' : '' }}">
                            <i class="fas fa-heart me-2"></i>รถที่ชื่นชอบ
                        </a>
                        @if(session('role') == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-tachometer-alt me-2"></i>จัดการระบบ
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-user me-2"></i>ข้อมูลโปรไฟล์</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">ชื่อผู้ใช้</label>
                                <input type="text" class="form-control" value="{{ session('user_name') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">สถานะ</label>
                                <input type="text" class="form-control" value="{{ session('role') == 'admin' ? 'ผู้ดูแลระบบ' : 'สมาชิก' }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">User ID</label>
                        <input type="text" class="form-control" value="{{ session('user_id') }}" readonly>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>หมายเหตุ:</strong> ข้อมูลโปรไฟล์นี้แสดงจากข้อมูลที่เก็บใน Session หากต้องการแก้ไขข้อมูลเพิ่มเติม สามารถพัฒนาต่อได้
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection