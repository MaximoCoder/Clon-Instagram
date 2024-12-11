<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // Funcion para seguir a un usuario
    public function store(User $user)
    {
        // Usamos attach porque relacionamos con la misma tabla
        $user->followers()->attach( auth()->user()->id ); // Esto va a llamar al metodo attach de la relacion followers
        return back();
    }
    // Funcion para dejar de seguir a un usuario
    public function destroy(User $user)
    {
        // Usamos detach para dejar de seguir a un usuario
        $user->followers()->detach( auth()->user()->id ); 
        return back();
    }
}
