<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Renderizar la vista
    public function index() {
        return view('auth.register');
    }
    // Funcion para registrar un usuario
    public function store(Request $request) {
        // Validar con laravel
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // Si la validacion es correcta guardar el usuario
        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // Autenticar al usuario
        auth()->attempt($request->only('email', 'password'));
        // Redireccionar al muro
        return redirect()->route('posts.index',
            auth()->user()->username);
    }
}
