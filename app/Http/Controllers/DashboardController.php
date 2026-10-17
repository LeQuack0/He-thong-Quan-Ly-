<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use App\Models\Menu;
use App\Models\SinhVien;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'soLop' => LopHoc::count(),
            'soSinhVien' => SinhVien::count(),
            'soNguoiDung' => User::count(),
            'soMenu' => Menu::count(),
        ]);
    }
}
