<?php

use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\User\GameController as UserGameController;
use App\Http\Controllers\Admin\PublisherController as AdminPublisherController;
use App\Http\Controllers\User\PublisherController as UserPublisherController;

use Database\Seeders\GameSeeder;
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
Route::get('/home/publishers', [App\Http\Controllers\HomeController::class, 'publisherIndex'])->name('home.publisher.index');


// This will create all the routes for Game
// and the routes will only be available when a user is logged in
Route::resource('/admin/games', AdminGameController::class)->middleware(['auth'])->names('admin.games');

Route::resource('/user/games', UserGameController::class)->middleware(['auth'])->names('user.games')->only(['index', 'show']);


//  Publisher Routes, only available when a user is logged in
Route::resource('/admin/publishers', AdminPublisherController::class)->middleware(['auth'])->names('admin.publishers');

// ->only at the end of this statement says only create the index and show routes.
Route::resource('/user/publishers',UserPublisherController::class)->middleware(['auth'])->names('user.publishers')->only(['index', 'show']);