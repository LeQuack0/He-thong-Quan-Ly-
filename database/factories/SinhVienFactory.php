<?php

namespace Database\Factories;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SinhVien>
 */
class SinhVienFactory extends Factory
{
    public function definition(): array
    {
        $hoTen = fake()->randomElement([
            'Nguyễn Minh Anh', 'Trần Quốc Bảo', 'Lê Thu Hà', 'Phạm Đức Huy',
            'Hoàng Ngọc Mai', 'Vũ Thành Nam', 'Đặng Thị Phương', 'Bùi Hoàng Long',
            'Đỗ Khánh Linh', 'Ngô Anh Tuấn', 'Phan Gia Hân', 'Đinh Quang Huy',
        ]);
        $lopHocId = LopHoc::query()->inRandomOrder()->value('id');

        return [
            'ma_sinh_vien' => strtoupper(fake()->unique()->bothify('SV######')),
            'ho_ten' => $hoTen,
            'email' => fake()->unique()->numerify('sinhvien#####') . '@example.com',
            'so_dien_thoai' => '09' . fake()->numerify('########'),
            'ngay_sinh' => fake()->dateTimeBetween('-24 years', '-18 years')->format('Y-m-d'),
            'gioi_tinh' => fake()->randomElement(['Nam', 'Nữ']),
            'dia_chi' => fake()->randomElement([
                'Cầu Giấy, Hà Nội', 'Đống Đa, Hà Nội', 'Hải Châu, Đà Nẵng',
                'Ninh Kiều, Cần Thơ', 'Thủ Đức, Thành phố Hồ Chí Minh',
                'Lê Chân, Hải Phòng', 'Thành phố Huế',
            ]),
            'lop_hoc_id' => $lopHocId,
        ];
    }
}
