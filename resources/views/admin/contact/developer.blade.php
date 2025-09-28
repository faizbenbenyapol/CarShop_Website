@extends('layouts.backend')

@section('title', 'ติดต่อผู้พัฒนา')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users me-2 text-primary"></i>ผู้พัฒนาระบบ
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-white py-4">
                    <h5 class="mb-0 text-center text-gray-800">Car Shop Management System</h5>
                    <p class="text-muted text-center mb-0">ระบบจัดการร้านขายรถยนต์</p>
                </div>
                <div class="card-body p-5">
                    <div class="row">
                        <!-- Developer 1 -->
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                </div>
                                <h5 class="mb-2">นายวันนิพัฒน์ เบญญาพล</h5>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">รหัสนักศึกษา: <strong>2313111086</strong></p>
                                    <p class="text-muted mb-1">สาขา: <strong>IT</strong></p>
                                    <p class="text-muted mb-0">Be.wannipat_st@tni.ac.th</p>
                                </div>
                            </div>
                        </div>

                        <!-- Developer 2 -->
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                </div>
                                <h5 class="mb-2">นายชนินทร เพ็งรัตน์</h5>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">รหัสนักศึกษา: <strong>2313111110</strong></p>
                                    <p class="text-muted mb-1">สาขา: <strong>IT</strong></p>
                                    <p class="text-muted mb-0">Pe.chaninton_st@tni.ac.th</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="p-3">
                                <i class="fab fa-laravel fa-2x text-danger mb-2"></i>
                                <h6 class="mb-1">Laravel</h6>
                                <small class="text-muted">PHP Framework</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3">
                                <i class="fab fa-bootstrap fa-2x text-primary mb-2"></i>
                                <h6 class="mb-1">Bootstrap</h6>
                                <small class="text-muted">CSS Framework</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3">
                                <i class="fas fa-database fa-2x text-success mb-2"></i>
                                <h6 class="mb-1">MySQL</h6>
                                <small class="text-muted">Database</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">Thai-Nichi Institute of Technology</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection