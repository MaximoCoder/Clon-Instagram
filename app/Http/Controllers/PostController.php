<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User; // Importar el modelo User
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Proteger la ruta para que solo los usuarios autenticados puedan acceder
    public function __construct() {
        $this->middleware('auth')->except('show', 'index'); // Excepciones de rutas 
    }
    // Renderizar la vista de muro
    public function index(User $user) {
        // Obtener los posts de la base de datos
        $posts = Post::where('user_id', $user->id)->paginate(20);
        // Le pasamos los datos del usuario de la ruta
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
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

        // Otra forma de hacer create utilizando las relaciones
        /*
        auth()->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id // Obtener el id del usuario autenticado
        ]);
        */
        // Redireccionar a su muro
        return redirect()->route('posts.index', auth()->user()->username);
    }

    // Show post
    public function show(User $user,Post $post){
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }
}
