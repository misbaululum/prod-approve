<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kagroup extends Model
{
    use HasFactory;

    protected $table = 'kagroup';
    protected $guarded = ['id'];

    public function divisi() {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'id');
    }
}
