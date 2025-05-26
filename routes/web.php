<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('questions', App\Http\Controllers\QuestionsController::class)->except('show');
// Route::post('/questions/{question}/answers', [App\Http\Controllers\AnswersController::class, 'store'])->name('answers.store');
Route::resource('questions.answers', App\Http\Controllers\AnswersController::class)->except('index', 'create', 'show');
Route::get('/questions/{slug}', [App\Http\Controllers\QuestionsController::class, 'show'])->name('questions.show');
Route::post('/answers/{answer}/accept', App\Http\Controllers\AcceptAnswerController::class)->name('answers.accept');
