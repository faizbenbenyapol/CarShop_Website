@extends('layouts.frontend')

@section('title', 'เข้าสู่ระบบ - Admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-user-shield fa-3x text-primary"></i>
                        </div>
                        <h2 class="h4 text-gray-900 mb-2">เข้าสู่ระบบผู้ดูแล</h2>
                        <p class="text-muted">ยินดีต้อนรับผู้ดูแลระบบ</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="user">
                        @csrf
                        <input type="hidden" name="login_type" value="admin">
                        
                        <div class="form-group mb-3">
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="อีเมล" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="รหัสผ่าน" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-user btn-block w-100 mb-3">
                            <i class="fas fa-shield-alt me-2"></i>เข้าสู่ระบบผู้ดูแล
                        </button>
                    </form>

                    <hr>
                    
                    <div class="text-center">
                        <a class="small" href="{{ route('home') }}">
                            <i class="fas fa-arrow-left me-1"></i>กลับหน้าหลัก
                        </a>
                    </div>
                    
                    <div class="text-center mt-2">
                        <a class="small" href="{{ route('user.login') }}">
                            เข้าสู่ระบบผู้ใช้
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.btn-user {
    font-size: 0.8rem;
    border-radius: 10rem;
    padding: 0.75rem 1rem;
}

.form-control-user {
    font-size: 0.8rem;
    border-radius: 10rem;
    padding: 1.5rem 1rem;
}
</style>
@endsection
