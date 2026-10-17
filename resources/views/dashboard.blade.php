@extends('layouts.layoutmaster')
@section('title', 'Tổng quan')
@section('content')
<h1>Trang tổng quan</h1><p class="subtitle">Xin chào {{ auth()->user()->name }} — vai trò: {{ auth()->user()->role === 'admin' ? 'Admin' : 'Giảng viên' }}.</p>
<div class="row g-3"><div class="col-md-3"><div class="card"><h4>Lớp học</h4><p class="fs-3">{{ $soLop }}</p><a href="{{ route('lophoc.index') }}">Xem lớp học</a></div></div><div class="col-md-3"><div class="card"><h4>Sinh viên</h4><p class="fs-3">{{ $soSinhVien }}</p><a href="{{ route('sinhvien.index') }}">Xem sinh viên</a></div></div><div class="col-md-3"><div class="card"><h4>Tài khoản</h4><p class="fs-3">{{ $soNguoiDung }}</p>@if(auth()->user()->isAdmin())<a href="{{ route('users.index') }}">Quản lý tài khoản</a>@else<span>Quản lý bởi Admin</span>@endif</div></div><div class="col-md-3"><div class="card"><h4>Menu</h4><p class="fs-3">{{ $soMenu }}</p>@if(auth()->user()->isAdmin())<a href="{{ route('menu.index') }}">Quản lý menu</a>@else<span>Quản lý bởi Admin</span>@endif</div></div></div>
<div class="mt-4 alert alert-info">Hệ thống quản lý lớp học, sinh viên, menu và tài khoản. Dùng thanh điều hướng bên trái để mở chức năng.</div>
@endsection
