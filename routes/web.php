<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Redirect;
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


Route::get('images/{filename}', [ImageController::class, 'getImage'])->name('image.display');

Route::get('/password/reset/{code}', function ($code) {
    return Redirect::to('http://localhost:3000/NewPasswordComponent/' . $code);
});




