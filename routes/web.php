<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use OpenAI\Laravel\Facades\OpenAI;
use \App\Http\Controllers\ChatController;

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
    return redirect()->route('login');
});
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat', [ChatController::class, 'addChat']);
    Route::get('/newChat', [ChatController::class, 'newChat'])->name('newChat');
    Route::delete('/deleteChat/{id}', [ChatController::class, 'deleteChat'])->name('delete');
    Route::delete('/deletehistory', [ChatController::class, 'deleteHistory'])->name('deletehistory');

    Route::get('/error', function(){
        return Inertia::render('Error');
    })->name('error');

    Route::get('/errorApi', function(){
        return Inertia::render('ErrorApi');
    })->name('errorApi');
});



require __DIR__.'/auth.php';
