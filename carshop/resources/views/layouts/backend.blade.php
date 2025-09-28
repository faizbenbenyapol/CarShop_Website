<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Laravel 12</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (ใหม่: ใช้สำหรับไอคอนปุ่ม/logout) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="/">Car shop</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbar"
                aria-controls="topbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="topbar">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- วางเมนูบน navbar ได้ถ้าต้องการ -->
          </ul>

          <!-- ขวาบน: ชื่อผู้ใช้ + เมนู Logout แบบสวย ๆ -->
          <div class="d-flex align-items-center gap-2">
            <span class="navbar-text text-white d-none d-sm-inline">
              ยินดีต้อนรับคุณ <b>{{ session('user_name') }}</b>
            </span>

            <div class="dropdown">
              <button class="btn btn-outline-light btn-sm rounded-pill d-flex align-items-center gap-2 px-3"
                      type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                <span class="d-none d-sm-inline">บัญชีผู้ใช้</span>
                <i class="bi bi-caret-down-fill small"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow">
                <li class="px-3 py-2 small text-muted">
                  {{ session('user_name') }}
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <!-- ใช้ลิงก์ /logout แบบเดิม ไม่ทำให้ของเดิมพัง -->
                  <a href="/logout"
                     class="dropdown-item d-flex align-items-center gap-2 text-danger"
                     onclick="return confirm('ต้องการออกจากระบบหรือไม่?');">
                    <i class="bi bi-box-arrow-right"></i> Logout
                  </a>
                </li>

                <!-- ถ้าวันหน้าจะเปลี่ยนเป็น POST + route('logout') ให้ใช้ฟอร์มแทนลิงก์นี้ -->
                <!--
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                      <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                  </form>
                </li>
                -->
              </ul>
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
            @if(session('role') === 'admin')
              <a href="/test" class="list-group-item list-group-item-action {{ request()->is('test*') ? 'active' : '' }}">🏠 Admin menu</a>
            @endif

            <a href="/shop" class="list-group-item list-group-item-action {{ request()->is('shop') ? 'active' : '' }}">🛒 Store</a>

            <!-- 👇 เพิ่มเมนู Members ตรงนี้ -->
            <a href="/members"
               class="list-group-item list-group-item-action {{ request()->is('members*') ? 'active' : '' }}">
               👥 Members
            </a>
            <!-- 👆 จบเพิ่ม -->

            <a href="/login" class="list-group-item list-group-item-action">🔑 Login</a>
          </div>
        </nav>

        <!-- Main Content -->
       
<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
  <div class="card shadow-sm">
    <div class="card-body">

      <!-- Search + Back Button -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        
        <!-- Back Button -->
        @if(isset($keyword) && $keyword != '')
          <a href="{{ url('/shop') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
          </a>
        @else
          <div></div> 
        @endif

       <!-- Search -->
        <form action="/search" method="get" class="d-flex" role="search">
          <input class="form-control me-2"
                 type="text"
                 name="keyword"
                 placeholder="ค้นหาชื่อสินค้า"
                 aria-label="Search"
                 required
                 value="{{ $keyword ?? '' }}">
          <button class="btn btn-success" type="submit">ค้นหา</button>
        </form>

      </div>

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
@yield('js_before')
  </body>
</html>
