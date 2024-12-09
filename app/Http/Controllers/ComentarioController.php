<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Funcion para guardar un comentario
    public function store(Request $request, User $user, Post $post) {
        // Validar con laravel
        $request->validate([
            'comentario' => ['required', 'string', 'max:255'],
        ]);
        // Guardar el comentario
        Comentario::create([
            'user_id' => auth()->user()->id, // Obtener el id del usuario autenticado
            'post_id' => $post->id, // Obtener el id del post que estamos comentando
            'comentario' => $request->comentario
        ]);
        // Mostrar mensaje de exito
        return back()->with('mensaje', 'Comentario creado correctamente');
    }
}
