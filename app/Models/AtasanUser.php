<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtasanUser extends Model
{
    use HasFactory;

    protected $table = 'atasan_user';
    public $timestamps = false;
}
