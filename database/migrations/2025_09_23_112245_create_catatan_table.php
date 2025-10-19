<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('catatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); // terkait tiket solve
            $table->unsignedBigInteger('admin_id'); // siapa admin solve
            $table->text('isi_catatan');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('catatan');
    }
};