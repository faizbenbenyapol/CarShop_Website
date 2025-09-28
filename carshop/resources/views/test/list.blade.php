@extends('home')

@section('css_before')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-11">

            {{-- หัวตาราง --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Car List</h3>
                <a href="/test/adding" class="btn btn-success btn-sm">+ Add Car</a>
            </div>

            {{-- ตาราง --}}
            <div class="table-responsive shadow-sm">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th width="5%">ลำดับ</th>
                            <th width="20%">ชื่อรถ</th>
                            <th width="25%">รายละเอียด</th>
                            <th width="10%">ราคา</th>
                            <th width="20%">รูปภาพ</th>
                            <th width="10%">แก้ไข</th>
                            <th width="10%">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carList as $row)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->product_detail }}</td>
                            <td class="text-end">{{ number_format($row->price, 2) }}</td>
                            <td class="text-center">
                                @if($row->picture)
                                    <img src="{{ asset('uploads/' . $row->picture) }}" width="100" class="img-thumbnail">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/test/{{ $row->id }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->id }})">Delete</button>

                                <form id="delete-form-{{ $row->id }}" action="/test/remove/{{ $row->id }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $carList->links() }}
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'ยืนยันการลบข้อมูล',
        text: "หากลบแล้วจะไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
