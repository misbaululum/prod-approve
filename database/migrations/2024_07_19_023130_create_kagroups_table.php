<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('kagroup', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('divisi_id')->constrained('divisi');
            $table->string('nama_divisi');
            $table->string('nama');
            $table->enum('Jenis_Kelamin', ['L', 'P']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kagroup');
        Schema::dropIfExists('divisi');
    }
};
