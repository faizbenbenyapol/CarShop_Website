<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Car Shop - ศูนย์รวมรถยนต์คุณภาพ')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .card-hover {
            transition: transform 0.3s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }
        .price-tag {
            font-weight: 600;
            font-size: 1.2rem;
            color: #e74c3c;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        .search-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-car me-2"></i>Car Shop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cars') }}">รถทั้งหมด</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @if(session('login'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ session('user_name') }}
                                @if(session('role') == 'admin')
                                    <span class="badge bg-danger ms-1">Admin</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                @if(session('role') == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>จัดการระบบ
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @elseif(session('role') == 'user')
                                    <li><a class="dropdown-item" href="{{ route('user.profile') }}">
                                        <i class="fas fa-user me-2"></i>โปรไฟล์
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.favorites') }}">
                                        <i class="fas fa-heart me-2"></i>รถที่ชื่นชอบ
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                                </a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-sign-in-alt me-1"></i>เข้าสู่ระบบ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.login') }}">
                                    <i class="fas fa-user me-2"></i>เข้าสู่ระบบผู้ใช้
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="fas fa-user-shield me-2"></i>เข้าสู่ระบบผู้ดูแล
                                </a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="margin-top: 76px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5><i class="fas fa-car me-2"></i>Car Shop</h5>
                    <p>ศูนย์รวมรถยนต์คุณภาพ พร้อมให้บริการด้วยความใส่ใจ</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-line"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>เมนูหลัก</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50">หน้าแรก</a></li>
                        <li><a href="{{ route('cars') }}" class="text-white-50">รถทั้งหมด</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>ติดต่อเรา</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="fas fa-map-marker-alt me-2"></i>123 ถนนสุขุมวิท กรุงเทพฯ</li>
                        <li><i class="fas fa-phone me-2"></i>02-123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i>info@carshop.com</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>เวลาทำการ</h6>
                    <ul class="list-unstyled text-white-50">
                        <li>จันทร์ - ศุกร์: 08:00 - 18:00</li>
                        <li>เสาร์ - อาทิตย์: 09:00 - 17:00</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Car Shop. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Powered by Laravel & Bootstrap 5</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>