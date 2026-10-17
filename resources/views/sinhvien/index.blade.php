@extends('layouts.layoutmaster')

@section('title', 'Quản lý sinh viên')

@push('styles')
<style>
    .sort-link { color: inherit; text-decoration: none; white-space: nowrap; }
    .sort-link:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Quản lý sinh viên</h1>
        <p class="subtitle">Danh sách sinh viên trong hệ thống.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('sinhvien.create') }}">+ Thêm sinh viên</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('sinhvien.index') }}">
    <input type="hidden" name="sort" value="{{ $sort }}">
    <input type="hidden" name="direction" value="{{ $direction }}">
    <div class="col-md-5">
        <label class="form-label" for="keyword">Từ khóa</label>
        <input id="keyword" class="form-control" name="keyword" placeholder="Tìm mã, họ tên, email"
               value="{{ $filters['keyword'] ?? '' }}">
    </div>
    <div class="col-md-3">
        <label class="form-label" for="lop_hoc_id">Lớp học</label>
        <select id="lop_hoc_id" class="form-select" name="lop_hoc_id">
            <option value="">Tất cả lớp</option>
            @foreach($lopHocs as $lop)
                <option value="{{ $lop->id }}" @selected(($filters['lop_hoc_id'] ?? '') == $lop->id)>
                    {{ $lop->ma_lop }} - {{ $lop->ten_lop }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-auto d-flex align-items-end gap-2">
        <button class="btn btn-outline-primary" type="submit">Lọc</button>
        <a class="btn btn-outline-secondary" href="{{ route('sinhvien.index') }}">Xóa lọc</a>
    </div>
</form>

<p>Tìm thấy <strong>{{ $sinhViens->total() }}</strong> sinh viên.</p>

@php
    $columns = [
        'ma_sinh_vien' => 'Mã SV',
        'ho_ten' => 'Họ tên',
        'email' => 'Email',
        'ngay_sinh' => 'Ngày sinh',
    ];
@endphp

<div class="table-responsive">
<table class="table table-striped table-bordered align-middle">
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
            <th>Điện thoại</th>
            <th>Lớp</th>
            <th style="width:190px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    @forelse($sinhViens as $sv)
        <tr>
            <td>{{ $sv->ma_sinh_vien }}</td>
            <td>{{ $sv->ho_ten }}</td>
            <td>{{ $sv->email ?: '—' }}</td>
            <td>{{ $sv->ngay_sinh?->format('d/m/Y') ?? '—' }}</td>
            <td>{{ $sv->so_dien_thoai ?: '—' }}</td>
            <td>{{ $sv->lopHoc?->ma_lop ?? 'Chưa xếp lớp' }}</td>
            <td>
                <a class="btn btn-sm btn-info" href="{{ route('sinhvien.show', $sv) }}">Xem</a>
                <a class="btn btn-sm btn-warning" href="{{ route('sinhvien.edit', $sv) }}">Sửa</a>
                <form class="d-inline" method="POST" action="{{ route('sinhvien.destroy', $sv) }}"
                      onsubmit="return confirm('Bạn chắc chắn muốn xóa sinh viên này?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Chưa có sinh viên.</td></tr>
    @endforelse
    </tbody>
</table>
</div>

{{ $sinhViens->links() }}
@endsection
