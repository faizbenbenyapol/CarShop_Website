<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ใช้ pagination แบบ Bootstrap 5 ให้ตรงกับ layout (ค่าเริ่มต้นเป็น Tailwind ทำให้ลูกศรใหญ่ผิดปกติ)
        Paginator::useBootstrapFive();
    }
}
