<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [App\Http\Controllers\Web\TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [App\Http\Controllers\Web\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [App\Http\Controllers\Web\TaskController::class, 'store'])->name('tasks.store_web');
    Route::get('/tasks/{id}/edit', [App\Http\Controllers\Web\TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'update'])->name('tasks.update_web');
    Route::get('/tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'show'])->name('tasks.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
