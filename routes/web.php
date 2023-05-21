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

Route::get('/chat', [ChatController::class, 'index'])->middleware(['auth', 'verified'])->name('chat');

Route::get('/error', function(){
    return Inertia::render('Error');
})->middleware(['auth', 'verified'])->name('error');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/prueba', function () {
        $result = OpenAI::completions()->create([
            'model' => 'text-curie-001',
            'prompt' => '¿Que es el marmol?',
        ]);
        echo $result['choices'][0]['text'];
    });

    Route::post('/chat', [ChatController::class, 'addChat']);
    Route::get('/newChat', [ChatController::class, 'newChat'])->name('newChat');
    Route::delete('/deleteChat/{id}', [\App\Http\Controllers\ChatController::class, 'deleteChat'])->name('delete');

    Route::get('/prueba2', function () {
        return Inertia::render('Prueba');
    })->name('prueba2');
});



require __DIR__.'/auth.php';
