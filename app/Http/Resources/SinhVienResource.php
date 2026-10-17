<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinhVienResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ma_sinh_vien' => $this->ma_sinh_vien,
            'ho_ten' => $this->ho_ten,
            'email' => $this->email,
            'so_dien_thoai' => $this->so_dien_thoai,
            'ngay_sinh' => $this->ngay_sinh?->toDateString(),
            'gioi_tinh' => $this->gioi_tinh,
            'dia_chi' => $this->dia_chi,
            'lop_hoc' => $this->whenLoaded('lopHoc', fn () => $this->lopHoc ? ['id' => $this->lopHoc->id, 'ma_lop' => $this->lopHoc->ma_lop, 'ten_lop' => $this->lopHoc->ten_lop] : null),
        ];
    }
}
