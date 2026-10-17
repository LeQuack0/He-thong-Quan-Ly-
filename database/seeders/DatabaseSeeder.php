<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        DB::transaction(function (): void {
            DB::table('sinh_viens')->delete();
            DB::table('lop_hocs')->delete();
            DB::table('menus')->delete();

            $this->call([
                LopHocSeeder::class,
                SinhVienSeeder::class,
                MenuSeeder::class,
            ]);

            User::updateOrCreate(
                ['email' => 'admin@gmail.com'],
                [
                    'name' => 'Quản trị viên',
                    'password' => Hash::make('Admin@12345'),
                    'role' => 'admin',
                ]
            );

            User::updateOrCreate(
                ['email' => 'giangvien@gmail.com'],
                [
                    'name' => 'Dang Minh Duc',
                    'password' => Hash::make('GiangVien@123'),
                    'role' => 'giang_vien',
                ]
            );
        });
    }
}
