<?php

use App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('todo.app');
// });

Route::get('/', [Controllers\Todo\TodoController::class, 'index'])->name('todo');
Route::post('/', [Controllers\Todo\TodoController::class, 'store'])->name('todo.post');
Route::put('/{id}', [Controllers\Todo\TodoController::class, 'update'])->name('todo.update');
Route::delete('/{id}', [Controllers\Todo\TodoController::class, 'destroy'])->name('todo.delete');