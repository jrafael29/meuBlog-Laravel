<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\Site\IndexController::class, 'index'])->name('index');
Route::get('/{slug}', [App\Http\Controllers\Site\IndexController::class, 'visualizar'])->name('visualizar');


Route::prefix('/admin')->group(function(){
    // rota do home painel
    Route::controller(App\Http\Controllers\Admin\HomeController::class)->group(function(){
        Route::get('/painel', 'index')->name('painel');
    });

    // rota de login
    Route::controller(App\Http\Controllers\Admin\LoginController::class)->group(function(){
        Route::get('/login', 'index')->middleware('guest')->name('login');
        Route::post('/login', 'login');

        Route::get('logout', 'logout')->name('logout');
        Route::post('logout', 'logout');
    });

    //rota de registro
    Route::controller(App\Http\Controllers\Admin\RegistroController::class)->group(function(){
        Route::get('/registro', 'index')->name('registro');
        Route::post('registro', 'registro')->name('registroAction');
    });

   
    // rotas de usuarios
    Route::resource('usuarios', App\Http\Controllers\Admin\UsuarioController::class);

    // rotas dos posts
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);

});
