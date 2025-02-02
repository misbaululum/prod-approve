<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';

    public function kagroup()
    {
        return $this->hasMany(Kagroup::class, 'divisi_id', 'id');
    }
}
