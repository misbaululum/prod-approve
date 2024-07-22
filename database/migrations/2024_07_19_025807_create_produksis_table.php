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
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nomor')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->string('user_input');
            $table->date('tanggal'); // Tanggal
            $table->string('nama_produk'); // Nama Produk
            
            $table->enum('ukuran_ml', array_map(fn($v) => (string) $v, array_merge(
                range(10, 100, 10),
                range(200, 800, 100),
                [150, 250, 350, 450, 550, 650, 750]
            )))->unique()->nullable();
            $table->enum('ukuran_l', array_map(fn($v) => (string) $v, range(1, 20)))->unique()->nullable();
            $table->enum('bagian', [
                'Filling Manual',
                'Filling Auto',
                'Injection Seal/Press',
                'Injection Seal',
                'Injection Press',
                'Induction Seal',
                'Tutup Dalam/Nimbang',
                'Tutup Dalam',
                'Nimbang',
                'Pasang Tutup',
                'Pengecekkan Tutup Luar',
                'Pasang Heat Shrink',
                'Shrink Tunnel',
                'Packing Dus',
                'Strapping/Penimbangan',
                'Pallet',
            ])->nullable(); // Bagian (enum)

            $table->string('foto_real'); // Foto Real (camera capture)
            $operators = array_map(fn($v) => 'Operator ' . $v, range(1, 20));
            $table->enum('penanggung_jawab', $operators); // Penanggung Jawab (enum)
            $table->time('waktu_awal')->nullable(); // Waktu Awal
            $table->time('waktu_akhir')->nullable(); // Waktu Akhir

            // Menambahkan kolom downtime, total_jam, dan keterangan
            $table->integer('downtime')->nullable(); // Downtime (in minutes)
            $table->decimal('total_jam', 8, 2)->nullable(); // Total Jam Kerja
            $table->text('keterangan')->nullable(); // Keterangan

            // Menambahkan kolom foto_awal_dt dan foto_akhir_dt
            $table->string('foto_awal_dt')->nullable();
            $table->string('foto_akhir_dt')->nullable();

            // Status approve dan relasi user
            $table->boolean('status_approve')->nullable();
            $table->foreignId('user_approve_id')->nullable()->constrained('users');
            $table->string('user_approve')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi');
    }
};
