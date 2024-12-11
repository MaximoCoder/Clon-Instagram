<?php

use App\Http\Controllers\ComentarioController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});
// Rutas de registro
Route::get('/register', [RegisterController::class, 'index'])->name('register'); // Name para la ruta 
Route::post('/register', [RegisterController::class, 'store']);
// Rutas de login
Route::get('/login', [LoginController::class, 'index'])->name('login'); // Name para la ruta 
Route::post('/login', [LoginController::class, 'store']);
// Ruta de logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // Name para la ruta 
// Rutas de muro
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); // Mostrar el muro
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // mostrar el formulario para crear un post
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // Mostrar la publicacion 
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Guardar la publicacion
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Eliminar la publicacion
// Like a las publicaciones
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store'); // Dar like a la publicacion
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy'); // Quitar like a la publicacion
// Rutas comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store'); // Mostrar la publicacion 

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store'); // Name para la ruta 

