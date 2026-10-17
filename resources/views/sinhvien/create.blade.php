@extends('layouts.layoutmaster')
@section('title', 'Thêm sinh viên')
@section('content')<h1>Thêm sinh viên</h1><p class="subtitle">Nhập thông tin sinh viên mới.</p><form method="POST" action="{{ route('sinhvien.store') }}">@csrf @include('sinhvien._form')<button class="btn btn-primary">Lưu sinh viên</button> <a class="btn btn-secondary" href="{{ route('sinhvien.index') }}">Hủy</a></form>@endsection
