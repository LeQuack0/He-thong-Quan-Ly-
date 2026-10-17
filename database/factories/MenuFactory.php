<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        $menus = [
            ['ten' => 'Tổng quan', 'url' => '/'],
            ['ten' => 'Quản lý lớp học', 'url' => '/lophoc'],
            ['ten' => 'Quản lý sinh viên', 'url' => '/sinhvien'],
            ['ten' => 'Quản lý tài khoản', 'url' => '/users'],
            ['ten' => 'Quản lý menu', 'url' => '/menu'],
        ];
        $menu = fake()->randomElement($menus);

        return [
            'ten' => $menu['ten'],
            'url' => $menu['url'],
            'vi_tri' => fake()->randomElement(array_keys(Menu::VI_TRI)),
            'nhom' => fake()->randomElement(['Chung', 'Đào tạo', 'Hệ thống']),
            'thu_tu' => fake()->numberBetween(1, 20),
            'trang_thai' => true,
        ];
    }
}
