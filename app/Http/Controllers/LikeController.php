<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Guardar los likes
    public function store(Request $request, Post $post) {
        // Guardar el like , unicamente le pasamos el id del usuario porque relacionamos el like con el post
        $post->likes()->create([
            'user_id' => $request->user()->id  
        ]);
        return back();
    }

    // Quitar el like
    public function destroy(Request $request,Post $post) {
        // En el request buscamos los likes del usuario donde el post_id sea igual al id del post
        $request->user()->likes()->where('post_id', $post->id)->delete();
        // Devolvemos el post
        return back();
    }
}
