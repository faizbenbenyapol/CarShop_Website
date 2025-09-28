@extends('layouts.backend')

@section('content')
<div class="container-fluid">
  <h4 class="mb-3">👥 รายชื่อสมาชิก</h4>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>ชื่อ</th>
              <th>นามสกุล</th>
              <th>รหัสประจำตัว</th>
              <th>เพิ่มเมื่อ</th>
            </tr>
          </thead>
          <tbody>
            @forelse($members as $i => $m)
              <tr>
                <td>{{ ($members->currentPage()-1)*$members->perPage() + $i + 1 }}</td>
                <td>{{ $m->first_name }}</td>
                <td>{{ $m->last_name }}</td>
                <td><span class="badge bg-primary">{{ $m->student_code }}</span></td>
                <td>{{ \Carbon\Carbon::parse($m->created_at)->format('Y-m-d') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted">ยังไม่มีข้อมูลสมาชิก</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-center mt-3">
        {{ $members->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
