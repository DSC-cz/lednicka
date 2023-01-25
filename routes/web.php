<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fridge;

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

date_default_timezone_set('Europe/Prague');

Route::get('/', function(){
    return redirect('/main');
});

Route::get('/main/{page?}', [Fridge::class, 'index']);

Route::get('/fridge/detail/{id}', [Fridge::class, 'detail']);
Route::post('/fridge/detail/{id}', [Fridge::class, 'delete']);

Route::get('/fridge/add', [Fridge::class, 'add']);
Route::post('/fridge/add', [Fridge::class, 'add_submit']);

Route::get('/fridge/edit/{id}', [Fridge::class, 'edit']);
Route::post('/fridge/edit/{id}', [Fridge::class, 'edit_submit']);
