<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User; // Importar el modelo User
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Proteger la ruta para que solo los usuarios autenticados puedan acceder
    public function __construct() {
        $this->middleware('auth');
    }
    // Renderizar la vista de muro
    public function index(User $user) {
        // Le pasamos los datos del usuario de la ruta
        return view('dashboard',[
            'user' => $user
        ]);
    }

    // Create post
    public function create(){
        return view('posts.create');
    }

    // Store post
    public function store(Request $request){
        $this ->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
        // Guardar el post en la base de datos
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id // Obtener el id del usuario autenticado
        ]);

        // Otra forma de hacer create
        /* 
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();
        */
        // Redireccionar a su muro
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
