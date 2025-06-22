<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'home'])->name('home');
Route::post('/start-quiz', [QuizController::class, 'startQuiz'])->name('start.quiz');
Route::get('/quiz', [QuizController::class, 'showQuiz'])->name('quiz');
Route::post('/submit-answer', [QuizController::class, 'submitAnswer'])->name('submit.answer');
Route::get('/results', [QuizController::class, 'results'])->name('results');
Route::get('/training', [QuizController::class, 'training'])->name('training');
