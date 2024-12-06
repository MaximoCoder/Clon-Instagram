<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // Ruta de logout
    public function store() {
        // Cerrar la sesion
        auth()->logout();
        // Redireccionar a login
        return redirect()->route('login');
    }
}
