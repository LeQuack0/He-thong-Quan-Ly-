<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Http\Resources\SinhVienResource;
use App\Models\SinhVien;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    public function index(Request $request)
    {
        $query = SinhVien::with('lopHoc')->when($request->filled('keyword'), function ($q) use ($request) {
            $kw = '%'.$request->keyword.'%';
            $q->where(fn ($sub) => $sub->where('ma_sinh_vien', 'like', $kw)->orWhere('ho_ten', 'like', $kw)->orWhere('email', 'like', $kw));
        });
        return SinhVienResource::collection($query->orderBy('id')->paginate(10));
    }
    public function store(StoreSinhVienRequest $request) { return (new SinhVienResource(SinhVien::create($request->validated())->load('lopHoc')))->response()->setStatusCode(201); }
    public function show(SinhVien $sinhvien) { return new SinhVienResource($sinhvien->load('lopHoc')); }
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien) { $sinhvien->update($request->validated()); return new SinhVienResource($sinhvien->refresh()->load('lopHoc')); }
    public function destroy(SinhVien $sinhvien) { $sinhvien->delete(); return response()->json(['message' => 'Đã xóa sinh viên.']); }
}
