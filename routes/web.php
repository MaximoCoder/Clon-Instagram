<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
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

Route::get('/', HomeController::class)->name('home'); // Index
// Rutas de registro
Route::get('/register', [RegisterController::class, 'index'])->name('register'); // Index register 
Route::post('/register', [RegisterController::class, 'store']);
// Rutas de login
Route::get('/login', [LoginController::class, 'index'])->name('login'); // Index login
Route::post('/login', [LoginController::class, 'store']);
// Ruta de logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // Logout
// Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index'); // Mostrar el formulario para editar el perfil
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store'); // Actualizar el perfil
// Rutas de muro
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
// Ruta de variable hasta el final
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); // Mostrar el muro

// Siguiendo a usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow'); // Seguir
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow'); // Dejar de seguir