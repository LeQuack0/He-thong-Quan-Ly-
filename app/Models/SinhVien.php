<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';
    protected $fillable = [
        'ma_sinh_vien', 'ho_ten', 'email', 'so_dien_thoai',
        'ngay_sinh', 'gioi_tinh', 'dia_chi', 'lop_hoc_id',
    ];

    protected function casts(): array
    {
        return ['ngay_sinh' => 'date'];
    }

    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }
}
