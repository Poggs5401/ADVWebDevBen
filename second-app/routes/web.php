<?php

use App\Http\Controllers\PageController;
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

Route::get('/home', [PageController::class, 'home'])->name('home');

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/contactus', [PageController::class, 'contactus'])->name('contactus');

// Route::get('/contactus', function () {
//     return view('contactus');
// });

Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');

// Route::get('/aboutus', function () {
//     return view('aboutus');
// });
