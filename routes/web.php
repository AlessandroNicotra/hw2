<?php

use App\Http\Controllers\DBController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [UserController::class, 'logged'])->name('login');
Route::post('/authenticate', [UserController::class, 'authenticate']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/index', function () {
    return view('index');
})->middleware('auth');

Route::get('/search/{id}/{page}', [APIController::class, 'search'])->name('search');
Route::post('/search_f', function (Request $request){
    return redirect('/search/' . $request->input('cerca') . '/1');
});

Route::get('/result/{id}', function () {
    return view('result');
});

Route::get('/lista/{type}', function () {
    return view('lista');
});

Route::get('/setmovie/{titolo}/{id}/{poster}/{value}/{val}', [DBController::class, 'setValue'])->name('setMovie');
Route::get('/setrate/{id}/{rating}', [DBController::class, 'updateRating'])->name('setRating');
Route::get('/setfav/{id}', [DBController::class, 'setPreferito'])->name('setPreferito');
Route::get('/validate/{type}/{val}', [UserController::class, 'validation']);
