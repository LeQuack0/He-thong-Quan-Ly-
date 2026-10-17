<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_sinh_vien', 20)->unique();
            $table->string('ho_ten');
            $table->string('email')->nullable()->unique();
            $table->string('so_dien_thoai', 20)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('gioi_tinh', 20)->nullable();
            $table->text('dia_chi')->nullable();
            $table->foreignId('lop_hoc_id')->nullable()->constrained('lop_hocs')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sinh_viens');
    }
};
