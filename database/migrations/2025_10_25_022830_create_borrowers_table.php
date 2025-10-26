<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('class_name')->nullable(); // Tambah kolom untuk kelas siswa
            $table->text('purpose');
            $table->date('borrow_date');
            $table->time('borrow_time');
            $table->date('return_date');
            $table->time('return_time');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
