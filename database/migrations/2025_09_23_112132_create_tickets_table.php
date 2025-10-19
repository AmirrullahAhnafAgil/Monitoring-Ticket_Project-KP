<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('no_tiket')->unique(); // nomor tiket otomatis
        $table->unsignedBigInteger('user_id');
        $table->string('aktivitas'); // ganti judul
        $table->text('deskripsi');
        $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('tickets');
    }
};