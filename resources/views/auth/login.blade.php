@extends('layouts.layoutmaster')

@section('title', 'Đăng nhập hệ thống')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-12 col-md-7 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 mb-2 text-center">Đăng nhập hệ thống</h1>
                <p class="text-muted text-center mb-4">Hệ thống quản lý lớp học và sinh viên</p>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email"
                               value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input class="form-control" id="password" type="password" name="password"
                               required autocomplete="current-password">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                </form>

                <hr>
                <div class="small text-muted">
                    <p class="mb-1"><strong>tai khoan</strong>TK: admin@example.com  MK:Admin@12345</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
