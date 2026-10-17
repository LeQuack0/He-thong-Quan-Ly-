<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use Illuminate\Database\Seeder;

class LopHocSeeder extends Seeder
{
    public function run(): void
    {
        $lopHocs = [
            [
                'ten_lop' => 'Digital Marketing K23A',
                'ma_lop' => 'DM23A',
                'giao_vien' => 'Lê Văn Nam',
                'so_dien_thoai_gvcn' => '0905123456',
                'ghi_chu' => 'Lớp Digital Marketing khóa 23, cơ sở TP.HCM.',
                'si_so' => 40,
                'trang_thai' => true,
            ],
            [
                'ten_lop' => 'Ngôn ngữ Anh K23B',
                'ma_lop' => 'NNA23B',
                'giao_vien' => 'Trần Mai Linh',
                'so_dien_thoai_gvcn' => '0918234567',
                'ghi_chu' => 'Lớp Ngôn ngữ Anh khóa 23.',
                'si_so' => 35,
                'trang_thai' => true,
            ],
            [
                'ten_lop' => 'Trí tuệ nhân tạo K24A',
                'ma_lop' => 'AI24A',
                'giao_vien' => 'Phạm Quốc Hưng',
                'so_dien_thoai_gvcn' => '0978345678',
                'ghi_chu' => 'Lớp Trí tuệ nhân tạo (AI) khóa 24.',
                'si_so' => 30,
                'trang_thai' => true,
            ],
            [
                'ten_lop' => 'Thương mại điện tử K22B',
                'ma_lop' => 'TMĐT22B',
                'giao_vien' => 'Vũ Thanh Trúc',
                'so_dien_thoai_gvcn' => '0935456789',
                'ghi_chu' => 'Lớp Thương mại điện tử khóa 22.',
                'si_so' => 38,
                'trang_thai' => true,
            ],
            [
                'ten_lop' => 'Logistics và Chuỗi cung ứng K22',
                'ma_lop' => 'LOG22',
                'giao_vien' => 'Bùi Đình Trọng',
                'so_dien_thoai_gvcn' => '0969567890',
                'ghi_chu' => 'Lớp Logistics và Quản lý chuỗi cung ứng khóa 22.',
                'si_so' => 32,
                'trang_thai' => true,
            ],
        ];

        foreach ($lopHocs as $lopHoc) {
            LopHoc::updateOrCreate(['ma_lop' => $lopHoc['ma_lop']], $lopHoc);
        }
    }
}