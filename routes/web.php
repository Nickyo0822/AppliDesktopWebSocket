<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
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

// Partie message
Route::middleware('auth')->group(function () {
    Route::get(uri:'/', action: 'App\Http\Controllers\PusherController@index')->name('sendmsg');
    Route::post(uri:'/broadcast', action: 'App\Http\Controllers\PusherController@broadcast');
    Route::get(uri:'/receive', action: 'App\Http\Controllers\PusherController@receive')->name('receive');
    Route::post(uri:'/receive', action: 'App\Http\Controllers\PusherController@receive');
});

// Changement inc
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Partie profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('profile', [ProfileController::class, 'picture'])->name('profile.picture');

require __DIR__.'/auth.php';
