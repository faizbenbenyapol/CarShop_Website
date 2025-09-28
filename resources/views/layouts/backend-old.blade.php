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
      }
      
      .topbar {
        background: white;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
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
        font-size: 0.75em;
      }
      
      @media (max-width: 768px) {
        .sidebar {
          margin-left: -250px;
        }
        
        .main-content {
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
        <div class="sidebar-brand-icon">
          <i class="fas fa-car text-white"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-white">
          <strong>Car Shop</strong>
          <small class="d-block">Admin Panel</small>
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
            <a class="nav-link {{ request()->is('admin/members*') ? 'active' : '' }}" href="{{ route('members.index') }}">
              <i class="fas fa-user-friends"></i>
              <span>สมาชิก</span>
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

    <!-- Topbar -->
    <nav class="navbar navbar-expand topbar static-top shadow">
      <div class="main-content w-100">
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none">
              <i class="fa fa-bars"></i>
            </button>

            <div class="navbar-nav ml-auto">
              <div class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline small" style="color: #5a5c69;">
                    ยินดีต้อนรับ <strong>{{ session('user_name') }}</strong>
                  </span>
                  <div class="d-inline-block position-relative">
                    <i class="fas fa-user-circle fa-2x" style="color: #667eea;"></i>
                    <span class="badge bg-success position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size: 0.6em;">
                      Admin
                    </span>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                  <div class="dropdown-header text-center">
                    <strong>{{ session('user_name') }}</strong>
                    <br><small class="text-muted">ผู้ดูแลระบบ</small>
                  </div>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    โปรไฟล์
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="return confirm('ต้องการออกจากระบบหรือไม่?');">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    ออกจากระบบ
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Layout -->
    <div class="container-fluid">
      <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-white border-end vh-100">
          <div class="list-group list-group-flush mt-3">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->is('admin') ? 'active' : '' }}">
              📊 Dashboard
            </a>
            
            @if(session('role') === 'admin')
              <a href="{{ route('admin.cars.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/cars*') ? 'active' : '' }}">
                🚗 จัดการรถยนต์
              </a>
              
              <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/categories*') ? 'active' : '' }}">
                � หมวดหมู่
              </a>
              
              <a href="{{ route('brands.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/brands*') ? 'active' : '' }}">
                🏢 ยี่ห้อ
              </a>
              
              <a href="{{ route('customers.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/customers*') ? 'active' : '' }}">
                👥 ลูกค้า
              </a>
              
              <a href="{{ route('members.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/members*') ? 'active' : '' }}">
                � สมาชิก
              </a>
            @endif

            <hr class="my-2">
            <a href="{{ route('home') }}" class="list-group-item list-group-item-action" target="_blank">
              🌐 ดูหน้าเว็บไซต์
            </a>
          </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
          <div class="card shadow-sm">
            <div class="card-body">
              @yield('content')
            </div>
          </div>
        </main>

      </div>
    </div>

    <footer class="text-center py-3 text-muted">
      © 2025 devbanban.com
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('sweetalert::alert')
    <script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  </script>

  </body>
</html>
