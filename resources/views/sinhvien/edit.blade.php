@extends('layouts.layoutmaster')
@section('title', 'Sửa sinh viên')
@section('content')<h1>Sửa sinh viên</h1><p class="subtitle">Cập nhật thông tin sinh viên.</p><form method="POST" action="{{ route('sinhvien.update', $sinhVien) }}">@csrf @method('PUT') @include('sinhvien._form')<button class="btn btn-primary">Cập nhật</button> <a class="btn btn-secondary" href="{{ route('sinhvien.index') }}">Hủy</a></form>@endsection
