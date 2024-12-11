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

    // Relacion con el modelo Comentario
    public function comentarios() {
        // Un post tiene muchos comentarios
        return $this->hasMany(Comentario::class);
    }

    // Relacion con likes
    public function likes() {
        // Un post tiene muchos likes
        return $this->hasMany(Like::class);
    }

    // Comprobar si un usuario ha dado like
    public function checkLike(User $user) {
        // Comprobar si el usuario actual ha dado like al post
        return $this->likes->contains('user_id', $user->id);
    }
}
