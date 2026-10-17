<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSinhVienRequest extends StoreSinhVienRequest
{
    public function rules(): array
    {
        $sinhVien = $this->route('sinhvien');
        $id = is_object($sinhVien) ? $sinhVien->id : $sinhVien;
        return [
            'ma_sinh_vien' => ['required', 'string', 'max:20', Rule::unique('sinh_viens', 'ma_sinh_vien')->ignore($id)],
            'ho_ten' => 'required|string|max:255',
            'email' => ['nullable', 'email', 'max:255', Rule::unique('sinh_viens', 'email')->ignore($id)],
            'so_dien_thoai' => 'nullable|string|max:20',
            'ngay_sinh' => 'nullable|date|before:today',
            'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác',
            'dia_chi' => 'nullable|string|max:1000',
            'lop_hoc_id' => 'nullable|exists:lop_hocs,id',
        ];
    }
}
