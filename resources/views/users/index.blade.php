@extends('layouts.layoutmaster')

@section('title', 'Quản lý tài khoản')

@push('styles')
<style>
    .sort-link { color: inherit; text-decoration: none; white-space: nowrap; }
    .sort-link:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Quản lý tài khoản</h1>
        <p class="subtitle"></p>
    </div>
    <a class="btn btn-primary" href="{{ route('users.create') }}">+ Tạo tài khoản</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('users.index') }}">
    <input type="hidden" name="sort" value="{{ $sort }}">
    <input type="hidden" name="direction" value="{{ $direction }}">
    <div class="col-md-5">
        <label class="form-label" for="keyword">Từ khóa</label>
        <input id="keyword" class="form-control" name="keyword" value="{{ $filters['keyword'] ?? '' }}"
               placeholder="Tìm tên hoặc email">
    </div>
    <div class="col-md-3">
        <label class="form-label" for="role">Vai trò</label>
        <select id="role" class="form-select" name="role">
            <option value="">Tất cả vai trò</option>
            <option value="admin" @selected(($filters['role'] ?? '') === 'admin')>Admin</option>
            <option value="giang_vien" @selected(($filters['role'] ?? '') === 'giang_vien')>Giảng viên</option>
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label" for="perPage">Số dòng / trang</label>
        <select id="perPage" name="perPage" class="form-select" onchange="this.form.submit()">
            @foreach($perPageOptions as $option)
                <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto d-flex align-items-end gap-2">
        <button class="btn btn-outline-primary" type="submit">Lọc</button>
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Xóa lọc</a>
    </div>
</form>

<p>Tìm thấy <strong>{{ $users->total() }}</strong> tài khoản.</p>

@php
    $columns = [
        'name' => 'Họ tên',
        'email' => 'Email',
        'role' => 'Vai trò',
        'created_at' => 'Ngày tạo',
    ];
@endphp

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            @foreach($columns as $column => $label)
                <th>
                    <a class="sort-link" href="{{ request()->fullUrlWithQuery([
                        'sort' => $column,
                        'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc',
                        'page' => null,
                    ]) }}">
                        {{ $label }}
                        @if($sort === $column)
                            {{ $direction === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
            @endforeach
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role === 'admin' ? 'Admin' : 'Giảng viên' }}</td>
            <td>{{ $user->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user) }}">Sửa</a>
                @if(!$user->is(auth()->user()))
                    <form class="d-inline" method="POST" action="{{ route('users.destroy', $user) }}"
                          onsubmit="return confirm('Xóa tài khoản này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                    </form>
                @else
                    <span class="text-muted small">Tài khoản đang đăng nhập</span>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Chưa có tài khoản.</td></tr>
    @endforelse
    </tbody>
</table>
</div>

{{ $users->links() }}
@endsection
