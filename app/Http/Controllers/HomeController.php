<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Proteger la ruta
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Usamos Invoke cuando el controller unicamente tendra un metodo
    public function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->following->pluck('id')->toArray();
        // WHERE IN  VERIFICA SI EL ID DEL USUARIO ESTA EN EL ARRAY
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home',
            [
                'posts' => $posts // pasar a la vista
            ]);
    }
}
