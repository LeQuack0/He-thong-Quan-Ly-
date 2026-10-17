@extends('layouts.layoutmaster')

@section('title', 'Hệ thống quản lý lớp học')

@section('content')
<div class="container py-4">
    <h1>Hệ thống quản lý lớp học</h1>
    <p class="subtitle">Quản lý lớp học, sinh viên, tài khoản và menu.</p>
    <a class="btn btn-primary" href="{{ route('login') }}">Đăng nhập hệ thống</a>
</div>
@endsection
