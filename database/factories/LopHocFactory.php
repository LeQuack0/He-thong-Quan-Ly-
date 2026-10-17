<?php

namespace Database\Factories;

use App\Models\LopHoc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LopHoc>
 */
class LopHocFactory extends Factory
{
    public function definition(): array
    {
        $nganh = fake()->randomElement([
            ['ten' => 'Công nghệ thông tin', 'ma' => 'CNTT'],
            ['ten' => 'Kế toán', 'ma' => 'KT'],
            ['ten' => 'Quản trị kinh doanh', 'ma' => 'QTKD'],
            ['ten' => 'Thiết kế đồ họa', 'ma' => 'TKDH'],
        ]);
        $khoa = fake()->numberBetween(20, 24);
        $lop = fake()->randomElement(['A', 'B', 'C']);

        return [
            'ten_lop' => $nganh['ten'] . ' K' . $khoa . $lop,
            'ma_lop' => strtoupper(fake()->unique()->bothify('LH####')),
            'giao_vien' => fake()->randomElement(['Nguyễn Văn Minh', 'Trần Thị Lan', 'Lê Thu Hương', 'Phạm Quốc Tuấn', 'Hoàng Thu Hà']),
            'so_dien_thoai_gvcn' => '09' . fake()->numerify('########'),
            'ghi_chu' => fake()->randomElement(['Lớp học chính quy.', 'Lớp học thực hành.', 'Lớp học chuyên ngành.']),
            'si_so' => fake()->numberBetween(20, 45),
            'trang_thai' => fake()->boolean(90),
        ];
    }
}
