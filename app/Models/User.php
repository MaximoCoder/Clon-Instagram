<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Añadimos el username para que tambien lo pueda recibir
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relacion con el modelo Post
    public function posts() {
        // Un usuario tiene muchos posts
        return $this->hasMany(Post::class);
    }
    // Relacion con los likes
    public function likes() {
        // Un usuario tiene muchos likes
        return $this->hasMany(Like::class);
    }
    // Funcion para almacenar los seguidores de un usuario
    public function followers() {
        // Un usuario tiene muchos seguidores
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    // Funcion para almacenar los seguidos de un usuario
    public function following() {
        // Un usuario tiene muchos seguidos
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    // Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user) {
        return $this->followers->contains( $user->id );
    }
}
