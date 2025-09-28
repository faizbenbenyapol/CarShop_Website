<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController; // เพิ่ม
use App\Http\Controllers\MemberController;
// Home page
Route::get('/', [TestController::class, 'index']);

// Test CRUD (Admin menu)
Route::get('/test', [TestController::class, 'index']);
Route::get('/test/adding',  [TestController::class, 'adding']);
Route::post('/test',  [TestController::class, 'create']);
Route::get('/test/{id}',  [TestController::class, 'edit']);
Route::put('/test/{id}',  [TestController::class, 'update']);
Route::delete('/test/remove/{id}',  [TestController::class, 'remove']);

// Login / Logout
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']); // POST login
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Register

// Shop (สำหรับ user)
Route::get('/shop', [TestController::class, 'shop']);
Route::get('/members', [MemberController::class, 'index'])->name('members.index');

//search
Route::get('/search', [TestController::class, 'search'])->name('cars.search');







