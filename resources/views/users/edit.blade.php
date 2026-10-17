@extends('layouts.layoutmaster')
@section('title', 'Sửa tài khoản')
@section('content')<h1>Sửa tài khoản</h1><form method="POST" action="{{ route('users.update', $user) }}">@csrf @method('PUT') @include('users._form')<button class="btn btn-primary">Lưu thay đổi</button> <a class="btn btn-secondary" href="{{ route('users.index') }}">Hủy</a></form>@endsection
