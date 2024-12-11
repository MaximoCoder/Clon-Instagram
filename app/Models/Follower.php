<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    // Permitir que datos se almacenen en la base de datos
    protected $fillable = [
        'user_id',
        'follower_id',
    ];
}
