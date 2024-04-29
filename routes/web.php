<?php

use App\Http\Controllers\EncryptedMessageController;
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

Route::post('/messages/decrypt', [EncryptedMessageController::class,'dcrypt'])->name('messages.decrypt');
Route::get('/messages/view', [EncryptedMessageController::class,'show'])->name('messages.show');
Route::post('/messages', [EncryptedMessageController::class,'store'])->name('messages.store');
Route::get('/', [EncryptedMessageController::class,'create'])->name('messages.create');
