<?php

use App\Http\Controllers\UserSombiesController;
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
    return view('auth/login');
});

//Visualizar la lista de usuario
Route::get('/home', [UserSombiesController::class, 'index'])->name('index')->middleware('auth');;
//Agregar usuario
Route::get('/formUser', [UserSombiesController::class, 'createZom'])->name('createZom');
//Guardar usuario
Route::post('/saveUser', [UserSombiesController::class, 'saveZom'])->name('zombie.saveZom');
//Formulario de editar
Route::get('/edit/{id}',  [UserSombiesController::class, 'editZom'])->name('editZom')->middleware('auth');;
//Guardar edicion
Route::patch('/post/{id}',[UserSombiesController::class, 'updateZom'])->name('updateZom')->middleware('auth');;
//Para eliminar
Route::delete('/delete/{id}',[UserSombiesController::class, 'destroy'])->name('deleteZom')->middleware('auth');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
