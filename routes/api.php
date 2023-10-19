<?php

use App\Http\Controllers\UserSombiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API-lista
Route::get("get_user",[UserSombiesController::class,"getAll"])->name("api-getAll");
//API-guardar utilizamos la funcion que ya teniamos de guardar
Route::put('saveUser', [UserSombiesController::class, 'saveZom'])->name('api-saveZom');
//API-Editar
Route::post('/editApi/{id}', [UserSombiesController::class, 'editUserApi'])->name('api-editUser');
//API-Para eliminar estudiante
Route::delete('/delateApi/{id}', [UserSombiesController::class,'destroyUser'])->name('api-destroyUser');

//API-para el login de android
Route::post('/login', 'AuthController@login');
