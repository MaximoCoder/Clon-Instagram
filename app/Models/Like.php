<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    // Permitir que datos se envíen a la base de datos
    protected $fillable = ['user_id', 'post_id'];
}
