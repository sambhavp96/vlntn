<?php

use App\Http\Controllers\MessageUploadController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/message/upload', [MessageUploadController::class, 'index'])->name('message.upload');
Route::post('/message/upload', [MessageUploadController::class, 'upload']);
