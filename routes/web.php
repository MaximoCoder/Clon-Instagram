<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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
// Rutas de muro
Route::get('/muro', [PostController::class, 'index'])->name('posts.index'); // Name para la ruta 

