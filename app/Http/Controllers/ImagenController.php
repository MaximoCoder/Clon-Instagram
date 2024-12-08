<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request){
       // Obtener la imagen
       $imagen = $request->file('file');
       // Generar un nombre unico
       $nombreImagen = Str::uuid().".". $imagen->extension();
       // Guardar la imagen en el servidor
       $imagenServidor = Image::read($imagen);
       $imagenServidor->resize(1000, 1000); // Redimensionar la imagen
       $imagenPath = public_path('uploads') . '/' . $nombreImagen; // Ruta de la imagen
       $imagenServidor->save($imagenPath); // Guardar la imagen
       // Return de la imagen
       return response()->json([
           'imagen' => $nombreImagen]);
    }
}
