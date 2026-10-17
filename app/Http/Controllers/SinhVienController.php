<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinhVienController extends Controller
{
    private const SORTABLE = ['id', 'ma_sinh_vien', 'ho_ten', 'email', 'ngay_sinh', 'created_at'];

    public function index(Request $request)
    {
        $filters = Validator::make($request->query(), [
            'keyword' => 'nullable|string|max:100',
            'lop_hoc_id' => 'nullable|integer|exists:lop_hocs,id',
            'sort' => 'nullable|in:'.implode(',', self::SORTABLE),
            'direction' => 'nullable|in:asc,desc',
        ])->valid();
        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';
        $sinhViens = SinhVien::with('lopHoc')
            ->when(isset($filters['keyword']), function ($q) use ($filters) {
                $keyword = '%'.$filters['keyword'].'%';
                $q->where(fn ($sub) => $sub->where('ma_sinh_vien', 'like', $keyword)->orWhere('ho_ten', 'like', $keyword)->orWhere('email', 'like', $keyword));
            })
            ->when(isset($filters['lop_hoc_id']), fn ($q) => $q->where('lop_hoc_id', $filters['lop_hoc_id']))
            ->orderBy($sort, $direction)->paginate(10)->withQueryString();
        $lopHocs = LopHoc::orderBy('ten_lop')->get();
        return view('sinhvien.index', compact('sinhViens', 'lopHocs', 'filters', 'sort', 'direction'));
    }

    public function create() { return view('sinhvien.create', ['sinhVien' => new SinhVien(), 'lopHocs' => LopHoc::orderBy('ten_lop')->get()]); }
    public function store(StoreSinhVienRequest $request)
    {
        SinhVien::create($request->validated());
        return redirect()->route('sinhvien.index')->with('success', 'Đã thêm sinh viên.');
    }
    public function show(SinhVien $sinhvien)
    {
        $sinhvien->load('lopHoc');
        return view('sinhvien.show', ['sinhVien' => $sinhvien]);
    }
    public function edit(SinhVien $sinhvien) { return view('sinhvien.edit', ['sinhVien' => $sinhvien, 'lopHocs' => LopHoc::orderBy('ten_lop')->get()]); }
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());
        return redirect()->route('sinhvien.index')->with('success', 'Đã cập nhật sinh viên.');
    }
    public function destroy(SinhVien $sinhvien)
    {
        $sinhvien->delete();
        return back()->with('success', 'Đã xóa sinh viên.');
    }
}
