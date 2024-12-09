<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    // Definir los campos que se pueden llenar
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    // Relacion con el modelo User
    public function user() {
        // Un comentario pertenece a un usuario
        return $this->belongsTo(User::class);
    }
}
