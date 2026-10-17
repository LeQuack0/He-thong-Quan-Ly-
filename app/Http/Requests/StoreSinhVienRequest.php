<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSinhVienRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }

    public function rules(): array
    {
        return [
            'ma_sinh_vien' => 'required|string|max:20|unique:sinh_viens,ma_sinh_vien',
            'ho_ten' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:sinh_viens,email',
            'so_dien_thoai' => 'nullable|string|max:20',
            'ngay_sinh' => 'nullable|date|before:today',
            'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác',
            'dia_chi' => 'nullable|string|max:1000',
            'lop_hoc_id' => 'nullable|exists:lop_hocs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'unique' => ':attribute đã tồn tại.',
            'email.email' => 'Email không đúng định dạng.',
            'ngay_sinh.before' => 'Ngày sinh phải trước ngày hôm nay.',
            'lop_hoc_id.exists' => 'Lớp học đã chọn không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'ma_sinh_vien' => 'Mã sinh viên', 'ho_ten' => 'Họ tên', 'email' => 'Email',
            'so_dien_thoai' => 'Số điện thoại', 'ngay_sinh' => 'Ngày sinh',
            'gioi_tinh' => 'Giới tính', 'dia_chi' => 'Địa chỉ', 'lop_hoc_id' => 'Lớp học',
        ];
    }
}
