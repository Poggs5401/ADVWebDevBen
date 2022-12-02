<?php

use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\User\GameController as UserGameController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Game

Route::get('/games', [GameController::class, 'index']);
Route::get('/games/create', [GameController::class, 'create']);
Route::post('/games', [GameController::class, 'store']);

Route::resource('/games', GameController::class)->middleware(['auth']);

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// This will create all the routes for Book
// and the routes will only be available when a user is logged in
Route::resource('/admin/games', AdminGameController::class)->middleware(['auth'])->names('admin.games');

Route::resource('/user/games', UserGameController::class)->middleware(['auth'])->names('user.games')->only(['index', 'show']);