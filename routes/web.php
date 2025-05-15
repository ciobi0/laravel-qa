<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('questions', App\Http\Controllers\QuestionsController::class)->except('show');
Route::get('/questions/{slug}', [App\Http\Controllers\QuestionsController::class, 'show'])->name('questions.show');
