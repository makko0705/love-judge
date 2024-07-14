<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;

Route::get('/', [ChatController::class, 'index'])->name('index');
Route::get('/howto', [ChatController::class, 'howto'])->name('howto');
Route::get('/progress', [ChatController::class, 'progress'])->name('progress');
Route::get('/result', [ChatController::class, 'result'])->name('result');
Route::get('/history', [ChatController::class, 'history'])->name('history');
Route::get('/detail/{id}', [ChatController::class, 'detail'])->name('detail'); // 追加
Route::post('/analyze', [ChatController::class, 'analyze'])->name('analyze');
Route::delete('/delete-consultation/{id}', [ChatController::class, 'deleteConsultation'])->name('delete-consultation');
Route::get('/latest-consultation', [ChatController::class, 'getLatestConsultation'])->name('latest-consultation');

