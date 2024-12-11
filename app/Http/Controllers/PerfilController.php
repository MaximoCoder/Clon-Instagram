<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class PerfilController extends Controller
{
    // Proteger la ruta
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Funcion para mostrar editar
    public function index()
    {
        // Renderizar la vista
        return view('perfil.index');
    }

    // Funcion para guardar los cambios al editar perfil

    public function store(Request $request)
    {
        // Modificar el request para agregar un username slugificado
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validar los datos de entrada
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:30',
                'min:3',
                'unique:users,username,' . auth()->user()->id, // Permite que el usuario mantenga su username actual
                'not_in:editar-perfil' // Restricción de nombres prohibidos
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . auth()->user()->id
            ],
        ]);

        // Obtener el usuario autenticado
        $usuario = User::find(auth()->user()->id);

        // Validar si el usuario desea cambiar su password
        if ($request->password) {
            if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                // Detener el proceso si el password actual es incorrecto
                return back()->with('mensaje', 'El Password actual es incorrecto');
            }

            // Si el password actual es correcto y hay un nuevo password, encriptarlo
            if ($request->new_password) {
                $usuario->password = bcrypt($request->new_password);
            }
        }

        // Manejar la imagen de perfil
        if ($request->imagen) {
            $imagen = $request->file('imagen');

            // Generar un nombre único para la imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Guardar y redimensionar la imagen
            $imagenServidor = Image::read($imagen);
            $imagenServidor->resize(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

            // Asignar el nombre de la imagen al usuario
            $usuario->imagen = $nombreImagen;
        } else {
            // Mantener la imagen anterior si no se sube una nueva
            $usuario->imagen = auth()->user()->imagen ?? '';
        }

        // Actualizar los datos del usuario
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        // Guardar los cambios en la base de datos
        $usuario->save();

        // Redireccionar al perfil del usuario actualizado
        return redirect()->route('posts.index', $usuario->username);
    }
}
