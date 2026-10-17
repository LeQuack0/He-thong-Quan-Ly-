@extends('layouts.layoutmaster')
@section('title', 'Tạo tài khoản')
@section('content')<h1>Tạo tài khoản</h1><form method="POST" action="{{ route('users.store') }}">@csrf @include('users._form')<button class="btn btn-primary">Tạo tài khoản</button> <a class="btn btn-secondary" href="{{ route('users.index') }}">Hủy</a></form>@endsection
