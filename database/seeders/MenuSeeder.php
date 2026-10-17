<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['ten' => 'Tổng quan', 'url' => '/', 'vi_tri' => 'sidebar', 'nhom' => 'Chung', 'thu_tu' => 1, 'trang_thai' => true],
            ['ten' => 'Quản lý lớp học', 'url' => '/lophoc', 'vi_tri' => 'sidebar', 'nhom' => 'Đào tạo', 'thu_tu' => 2, 'trang_thai' => true],
            ['ten' => 'Quản lý sinh viên', 'url' => '/sinhvien', 'vi_tri' => 'sidebar', 'nhom' => 'Đào tạo', 'thu_tu' => 3, 'trang_thai' => true],
            ['ten' => 'Quản lý tài khoản', 'url' => '/users', 'vi_tri' => 'sidebar', 'nhom' => 'Hệ thống', 'thu_tu' => 4, 'trang_thai' => true],
            ['ten' => 'Quản lý menu', 'url' => '/menu', 'vi_tri' => 'sidebar', 'nhom' => 'Hệ thống', 'thu_tu' => 5, 'trang_thai' => true],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(['url' => $menu['url'], 'vi_tri' => $menu['vi_tri']], $menu);
        }
    }
}
