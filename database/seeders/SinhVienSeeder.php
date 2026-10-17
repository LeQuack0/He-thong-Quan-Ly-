<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    public function run(): void
    {
        $sinhViens = [
            ['ma_sinh_vien' => 'SV2026001', 'ho_ten' => 'Nguyễn Minh Anh', 'email' => 'minhanh001@example.com', 'so_dien_thoai' => '0911111001', 'ngay_sinh' => '2005-03-12', 'gioi_tinh' => 'Nữ', 'dia_chi' => 'Cầu Giấy, Hà Nội', 'ma_lop' => 'DM23A'],
            ['ma_sinh_vien' => 'SV2026002', 'ho_ten' => 'Trần Quốc Bảo', 'email' => 'quocbao002@example.com', 'so_dien_thoai' => '0911111002', 'ngay_sinh' => '2004-08-21', 'gioi_tinh' => 'Nam', 'dia_chi' => 'Đống Đa, Hà Nội', 'ma_lop' => 'DM23A'],
            ['ma_sinh_vien' => 'SV2026003', 'ho_ten' => 'Lê Thu Hà', 'email' => 'thuha003@example.com', 'so_dien_thoai' => '0911111003', 'ngay_sinh' => '2005-01-17', 'gioi_tinh' => 'Nữ', 'dia_chi' => 'Hải Châu, Đà Nẵng', 'ma_lop' => 'NNA23B'],
            ['ma_sinh_vien' => 'SV2026004', 'ho_ten' => 'Phạm Đức Huy', 'email' => 'duchuy004@example.com', 'so_dien_thoai' => '0911111004', 'ngay_sinh' => '2004-11-05', 'gioi_tinh' => 'Nam', 'dia_chi' => 'Ninh Kiều, Cần Thơ', 'ma_lop' => 'NNA23B'],
            ['ma_sinh_vien' => 'SV2026005', 'ho_ten' => 'Hoàng Ngọc Mai', 'email' => 'ngocmai005@example.com', 'so_dien_thoai' => '0911111005', 'ngay_sinh' => '2005-06-23', 'gioi_tinh' => 'Nữ', 'dia_chi' => 'Thanh Xuân, Hà Nội', 'ma_lop' => 'AI24A'],
            ['ma_sinh_vien' => 'SV2026006', 'ho_ten' => 'Vũ Thành Nam', 'email' => 'thanhnam006@example.com', 'so_dien_thoai' => '0911111006', 'ngay_sinh' => '2004-04-09', 'gioi_tinh' => 'Nam', 'dia_chi' => 'Biên Hòa, Đồng Nai', 'ma_lop' => 'AI24A'],
            ['ma_sinh_vien' => 'SV2026007', 'ho_ten' => 'Đặng Thị Phương', 'email' => 'thiphuong007@example.com', 'so_dien_thoai' => '0911111007', 'ngay_sinh' => '2005-09-14', 'gioi_tinh' => 'Nữ', 'dia_chi' => 'Thủ Đức, Thành phố Hồ Chí Minh', 'ma_lop' => 'TMĐT22B'],
            ['ma_sinh_vien' => 'SV2026008', 'ho_ten' => 'Bùi Hoàng Long', 'email' => 'hoanglong008@example.com', 'so_dien_thoai' => '0911111008', 'ngay_sinh' => '2004-12-02', 'gioi_tinh' => 'Nam', 'dia_chi' => 'Nam Từ Liêm, Hà Nội', 'ma_lop' => 'TMĐT22B'],
            ['ma_sinh_vien' => 'SV2026009', 'ho_ten' => 'Đỗ Khánh Linh', 'email' => 'khanhlinh009@example.com', 'so_dien_thoai' => '0911111009', 'ngay_sinh' => '2005-02-26', 'gioi_tinh' => 'Nữ', 'dia_chi' => 'Lê Chân, Hải Phòng', 'ma_lop' => 'LOG22'],
            ['ma_sinh_vien' => 'SV2026010', 'ho_ten' => 'Ngô Anh Tuấn', 'email' => 'anhtuan010@example.com', 'so_dien_thoai' => '0911111010', 'ngay_sinh' => '2004-07-19', 'gioi_tinh' => 'Nam', 'dia_chi' => 'Thành phố Huế', 'ma_lop' => 'LOG22'],
        ];

        foreach ($sinhViens as $sinhVien) {
            $lopHoc = LopHoc::where('ma_lop', $sinhVien['ma_lop'])->firstOrFail();
            unset($sinhVien['ma_lop']);
            $sinhVien['lop_hoc_id'] = $lopHoc->id;
            SinhVien::updateOrCreate(['ma_sinh_vien' => $sinhVien['ma_sinh_vien']], $sinhVien);
        }
    }
}