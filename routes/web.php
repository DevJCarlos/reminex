<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // exam
    Route::get('exam/create', [\App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
    Route::post('/fetch-subjects', [\App\Http\Controllers\ExamController::class, 'fetchSubjects'])->name('exam.fetch.subjects');
    Route::post('/upload-csv', [\App\Http\Controllers\ExamController::class, 'uploadCSV'])->name('upload.csv');
    Route::get('exam/index', [\App\Http\Controllers\ExamController::class, 'index'])->name('exam.index');
    
});
