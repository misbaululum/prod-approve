<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi';

    protected $fillable = [
        'nomor',
        'user_id',
        'user_input',
        'tanggal',
        'nama_produk',
        'ukuran_ml',
        'ukuran_l',
        'waktu_awal',
        'waktu_akhir',
        'downtime',
        'foto_awal_dt',
        'foto_akhir_dt',
        'keterangan',
        'penanggung_jawab',
        'total_jam',
        // Add other fields as needed
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
