<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  {{-- Bootstrap CSS CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Custom CSS (ถ้ามี) --}}
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

  @yield('css_before')

  <style>
    /* พื้นหลังเต็มจอ */
    body, html {
      height: 100%;
      margin: 0;
    }

    .login-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      background: url('/images/bg.jpg') center/cover no-repeat; /* เปลี่ยนภาพได้ตามต้องการ */
    }

    .card {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    @yield('content')
  </div>

  @yield('footer')
  @yield('js_before')

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



