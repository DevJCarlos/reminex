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
    return view('login.loginstudent');
})->name('student');

Route::get('/faculty', function () {
    return view('login.loginfaculty');
})->name('faculty');

Route::get('/admin', function () {
    return view('login.loginadmin');
})->name('admin');



Auth::routes();

Route::group(['middleware' => ['auth', 'role:student']], function(){
    Route::get('student/', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');

    // 
    
    // about us
    Route::get('/bout-us', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
});


Route::group(['middleware' => ['auth', 'role:teacher']], function(){
    Route::get('student/', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');

    // exam generate sa create
    Route::get('exam/index', [\App\Http\Controllers\ExamController::class, 'index'])->name('exams.index');

    Route::get('exam/create', [\App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
    Route::post('/fetch-subjects', [\App\Http\Controllers\ExamController::class, 'fetchSubjects'])->name('exam.fetch.subjects');
    Route::post('/upload-csv', [\App\Http\Controllers\ExamController::class, 'uploadCSV'])->name('upload.csv');
    Route::post('exam/additionalInfo',[\App\Http\Controllers\ExamController::class,'fetchAdditionalInfo'])->name('exam.fetch.additionalInfo');
    Route::post('exam/displaytable',[\App\Http\Controllers\ExamController::class,'displaygentable'])->name('displaygentab');

    //saving periods
    Route::post('/periods', [\App\Http\Controllers\PeriodController::class, 'store'])->name('periods.store');






    // class recor
    
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');


});
