<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/cars', [FrontendController::class, 'cars'])->name('cars');
Route::get('/car/{id}', [FrontendController::class, 'carDetail'])->name('car.detail');
Route::get('/category/{id}', [FrontendController::class, 'category'])->name('category.cars');
Route::get('/brand/{id}', [FrontendController::class, 'brand'])->name('brand.cars');

// Login / Logout
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/user-login', function () {
    return view('user-login');
})->name('user.login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::middleware(['web'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/favorites', [UserController::class, 'favorites'])->name('user.favorites');
});

// Admin Routes (ต้อง login และเป็น admin)
Route::middleware(['web', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Cars (Test) Management
    Route::get('/admin/cars', [TestController::class, 'index'])->name('admin.cars.index');
    Route::get('/admin/cars/create', [TestController::class, 'adding'])->name('admin.cars.create');
    Route::post('/admin/cars', [TestController::class, 'create'])->name('admin.cars.store');
    Route::get('/admin/cars/{id}/edit', [TestController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/admin/cars/{id}', [TestController::class, 'update'])->name('admin.cars.update');
    Route::delete('/admin/cars/{id}', [TestController::class, 'remove'])->name('admin.cars.destroy');
    
    // Categories Management
    Route::resource('admin/categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);
    
    // Brands Management
    Route::resource('admin/brands', BrandController::class)->names([
        'index' => 'brands.index',
        'create' => 'brands.create',
        'store' => 'brands.store',
        'edit' => 'brands.edit',
        'update' => 'brands.update',
        'destroy' => 'brands.destroy'
    ]);
    
    // Customers Management
    Route::resource('admin/customers', CustomerController::class)->names([
        'index' => 'customers.index',
        'create' => 'customers.create',
        'store' => 'customers.store',
        'edit' => 'customers.edit',
        'update' => 'customers.update',
        'destroy' => 'customers.destroy'
    ]);
    
    // Contact Developer
    Route::get('/admin/contact', function() {
        return view('admin.contact.developer');
    })->name('contact.developer');
});

// Route ชั่วคราว - แสดงข้อมูล users
Route::get('/show-users', function () {
    $users = \App\Models\User::all();
    $html = '<style>table{border-collapse:collapse;width:100%}th,td{border:1px solid #ddd;padding:8px;text-align:left}th{background-color:#f2f2f2}</style>';
    $html .= '<h2>🔐 ข้อมูล Users ในระบบ Car Shop</h2>';
    $html .= '<table><tr><th>ID</th><th>ชื่อ</th><th>Email</th><th>Role</th><th>สถานะ</th></tr>';
    
    foreach($users as $user) {
        $roleColor = $user->role == 'admin' ? 'color:red;font-weight:bold' : 'color:blue';
        $status = $user->role == 'admin' ? '✅ เข้า Admin ได้' : '❌ เข้า Admin ไม่ได้';
        $html .= "<tr><td>{$user->id}</td><td>{$user->name}</td><td>{$user->email}</td><td style='{$roleColor}'>{$user->role}</td><td>{$status}</td></tr>";
    }
    
    $html .= '</table><br>';
    $html .= '<h3>🧪 ข้อมูลสำหรับทดสอบ:</h3>';
    $html .= '<div style="background:#f0f8ff;padding:15px;border-radius:8px">';
    $html .= '<h4 style="color:red">👑 Admin Users (เข้า Admin Panel ได้):</h4>';
    $html .= '<p>📧 <strong>admin@carshop.com</strong> / 🔑 <strong>123456</strong></p>';
    $html .= '<p>📧 <strong>user@carshop.com</strong> / 🔑 <strong>123456</strong></p>';
    $html .= '</div><br>';
    
    $html .= '<div style="background:#fff0f5;padding:15px;border-radius:8px">';
    $html .= '<h4 style="color:blue">👤 Regular User (เข้า Admin Panel ไม่ได้):</h4>';
    $html .= '<p>📧 <strong>customer@carshop.com</strong> / 🔑 <strong>123456</strong></p>';
    $html .= '</div><br>';
    
    $html .= '<div style="background:#f0fff0;padding:15px;border-radius:8px">';
    $html .= '<h4>🔗 ลิงก์สำหรับทดสอบ:</h4>';
    $html .= '<p><a href="/login" style="color:red;font-weight:bold">🔐 Admin Login</a> - เฉพาะ Admin เท่านั้น</p>';
    $html .= '<p><a href="/user-login" style="color:blue;font-weight:bold">👤 User Login</a> - ทุกคนล็อกอินได้</p>';
    $html .= '</div>';
    
    return $html;
});

// Legacy routes (for backward compatibility)
Route::get('/test', [TestController::class, 'index']);
Route::get('/shop', [TestController::class, 'shop']);








