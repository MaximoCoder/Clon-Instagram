<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Proteger la ruta para que solo los usuarios autenticados puedan acceder
    public function __construct() {
        $this->middleware('auth');
    }
    // Renderizar la vista de muro
    public function index() {
        return view('dashboard');
    }
}
