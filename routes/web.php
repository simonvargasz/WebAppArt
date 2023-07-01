<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\HomeController;

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
//middleware


//public
Route::get('/', [ImagenController::class, 'redirect'])->name('public');

Route::get('/login',function(){
    return view('public/login');
});


//login, register, logout y contrasena olvidada
Route::post('/login',[CuentaController::class,'login'])->name('user.login');
Route::post('/register',[CuentaController::class,'store'])->name('user.store');
Route::get('/register',[CuentaController::class,'register'])->name('register');
Route::get('/logout',[CuentaController::class,'logout'])->name('logout');
Route::put('/change-password',[CuentaController::class,'changePassword'])->name('change');

//public Home
Route::get('/home',[ImagenController::class,'index'])->name('home');
Route::get('/home/{user}',[ImagenController::class,'show'])->name('filtered');

//session
Route::get('/session', [CuentaController::class, 'index'])->name('session');
Route::get('/session/{user}', [CuentaController::class, 'show'])->name('session.show');

Route::delete('/session/{id}', [CuentaController::class, 'destroy'])->name('delete.image');
Route::put('/session/{titulo}', [CuentaController::class, 'update'])->name('title.change');

Route::post('/session/{user}', [ImagenController::class, 'store'])->name('image.upload');

//Admin
Route::post('/admin/{id}', [ImagenController::class, 'update'])->name('image.ban');
Route::get('/usuarios', [CuentaController::class, 'showUsers'])->name('show.users');
Route::put('/usuarios/ban-{user}', [CuentaController::class, 'updateUser'])->name('ban.user');
Route::put('/usuarios/edit-{user}', [CuentaController::class, 'editUser'])->name('edit.user');





