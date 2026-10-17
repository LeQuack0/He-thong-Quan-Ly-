<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLopHocRequest;
use App\Http\Requests\UpdateLopHocRequest;
use App\Http\Resources\LopHocResource;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class LopHocController extends Controller
{
    public function index(Request $request)
    {
        $query = LopHoc::query()->when($request->filled('keyword'), function ($q) use ($request) {
            $kw = '%'.$request->keyword.'%';
            $q->where(fn ($sub) => $sub->where('ten_lop', 'like', $kw)->orWhere('ma_lop', 'like', $kw)->orWhere('giao_vien', 'like', $kw));
        });
        return LopHocResource::collection($query->orderBy('id')->paginate(10));
    }
    public function store(StoreLopHocRequest $request) { return (new LopHocResource(LopHoc::create($request->validated())))->response()->setStatusCode(201); }
    public function show(LopHoc $lopHoc) { return new LopHocResource($lopHoc); }
    public function update(UpdateLopHocRequest $request, LopHoc $lopHoc) { $lopHoc->update($request->validated()); return new LopHocResource($lopHoc->refresh()); }
    public function destroy(LopHoc $lopHoc) { $lopHoc->delete(); return response()->json(['message' => 'Đã xóa lớp học.']); }
}
