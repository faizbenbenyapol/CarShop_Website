<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') | Car Shop</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      body {
        font-family: 'Kanit', sans-serif;
        background-color: #f8f9fc;
        font-size: 16px;
      }
      
      .sidebar {
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        z-index: 1000;
        transition: all 0.3s;
      }
      
      .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        margin: 0.2rem 1rem;
        transition: all 0.3s;
      }
      
      .sidebar .nav-link:hover,
      .sidebar .nav-link.active {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
      }
      
      .sidebar .nav-link i {
        width: 25px;
        text-align: center;
        margin-right: 10px;
      }
      
      .main-content {
        margin-left: 250px;
        transition: all 0.3s;
        min-height: 100vh;
      }
      
      .topbar {
        background: white;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        padding: 0.75rem 1.5rem;
      }
      
      .navbar-brand {
        font-weight: 700;
        color: #5a5c69;
      }
      
      .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
      }
      
      .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
      }
      
      .btn-primary:hover {
        background: linear-gradient(45deg, #5a6fd8, #6a4190);
        transform: translateY(-1px);
      }
      
      .page-title {
        color: #5a5c69;
        font-weight: 600;
        margin-bottom: 0;
      }
      
      .text-primary {
        color: #667eea !important;
      }
      
      .badge {
        font-size: 0.85em;
        padding: 0.5em 0.75em;
      }
      
      .table {
        font-size: 15px;
      }
      
      .btn {
        font-size: 14px;
        padding: 0.5rem 1rem;
      }
      
      .card-header h6 {
        font-size: 18px;
      }
      
      .h3 {
        font-size: 1.8rem;
      }
      
      .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        margin: 1rem 0;
      }
      
      @media (max-width: 768px) {
        .sidebar {
          margin-left: -250px;
        }
        
        .main-content {
          margin-left: 0;
        }
        
        .sidebar.show {
          margin-left: 0;
        }
      }
    </style>
    
    @yield('styles')
  </head>

  <body>
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
      <div class="sidebar-brand d-flex align-items-center justify-content-center py-4">
        <div class="sidebar-brand-icon me-3">
          <i class="fas fa-car text-white fa-2x"></i>
        </div>
        <div class="sidebar-brand-text text-white">
          <strong>Car Shop</strong>
          <small class="d-block opacity-75">Admin Panel</small>
        </div>
      </div>

      <hr class="sidebar-divider my-0">

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        @if(session('role') === 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/cars*') ? 'active' : '' }}" href="{{ route('admin.cars.index') }}">
              <i class="fas fa-car"></i>
              <span>จัดการรถยนต์</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
              <i class="fas fa-tags"></i>
              <span>หมวดหมู่</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}" href="{{ route('brands.index') }}">
              <i class="fas fa-industry"></i>
              <span>ยี่ห้อ</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
              <i class="fas fa-users"></i>
              <span>ลูกค้า</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/contact*') ? 'active' : '' }}" href="{{ route('contact.developer') }}">
              <i class="fas fa-envelope"></i>
              <span>ติดต่อผู้พัฒนา</span>
            </a>
          </li>
        @endif

        <hr class="sidebar-divider">
        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}" target="_blank">
            <i class="fas fa-globe"></i>
            <span>ดูหน้าเว็บไซต์</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Topbar -->
      <nav class="navbar navbar-expand topbar static-top shadow mb-4">
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center w-100">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none">
              <i class="fa fa-bars"></i>
            </button>

            <div class="navbar-nav ms-auto">
              <div class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="me-2 d-none d-lg-inline small" style="color: #5a5c69; font-size: 15px;">
                    ยินดีต้อนรับ <strong>{{ session('user_name') }}</strong>
                  </span>
                  <div class="d-inline-block position-relative">
                    <i class="fas fa-user-circle fa-2x" style="color: #667eea;"></i>
                    <span class="badge bg-success position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size: 0.7em;">
                      Admin
                    </span>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow"
                     aria-labelledby="userDropdown">
                  <div class="dropdown-header text-center">
                    <strong>{{ session('user_name') }}</strong>
                    <br><small class="text-muted">ผู้ดูแลระบบ</small>
                  </div>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                    โปรไฟล์
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="return confirm('ต้องการออกจากระบบหรือไม่?');">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                    ออกจากระบบ
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Content -->
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>

    <footer class="text-center py-3 text-muted" style="margin-left: 250px;">
      © 2025 Car Shop Admin Panel
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleTop');
        const sidebar = document.getElementById('sidebar');
        
        if (sidebarToggle) {
          sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
          });
        }
      });
      
      // Tooltip initialization
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    </script>
    
    @include('sweetalert::alert')
    @yield('scripts')

  </body>
</html>