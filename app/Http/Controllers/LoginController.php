<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Renderizar la vista
    public function index()
    {
        return view('auth.login');
    }

    // Funcion para autenticar un usuario
    public function store(Request $request)
    {
        // Validar con laravel
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Si la validacion es incorrecta mostrar un error
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) { // remember = recordarme en la sesion 
            // Si la autenticacion falla mostrar un error
            return back()->with('mensaje', 'Credenciales incorrectas');
        }
        // Si la autenticacion es correcta redireccionar al muro
        return redirect()->route('posts.index');
    }
}
