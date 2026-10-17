@extends('layouts.layoutmaster')
@section('title', 'Tài khoản của tôi')
@section('content')
    <h1>Tài khoản của tôi</h1>
    <p class="subtitle">
    <form method="POST" action="{{ route('profile.update') }}">@csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Họ tên</label><input class="form-control" name="name"
                value="{{ old('name', $user->name) }}" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email"
                value="{{ old('email', $user->email) }}" required></div>
        <div class="mb-3"><label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label><input class="form-control"
                type="password" name="password" minlength="8"></div>
        <div class="mb-3"><label class="form-label">Nhập lại mật khẩu mới</label><input class="form-control" type="password"
                name="password_confirmation" minlength="8"></div><button class="btn btn-primary">Cập nhật</button>
</form>@endsection