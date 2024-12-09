<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Atributos que se pueden asignar al modelo
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Relacion con el modelo User
    public function user() {
        // Un post pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
}
