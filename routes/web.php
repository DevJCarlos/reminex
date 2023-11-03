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

Route::get('/facultyLogin', function () {
    return view('login.loginfaculty');
})->name('faculty');

Route::get('/adminLogin', function () {
    return view('login.loginadmin');
})->name('admin');



Auth::routes();

Route::group(['middleware' => ['auth', 'role:student']], function(){
    Route::get('student/', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');

    // about us
    // Route::get('/bout-us', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
});


Route::group(['middleware' => ['auth', 'role:teacher']], function(){
    //butangi ang mga wala dri 
    Route::get('/faculty', [App\Http\Controllers\TeacherController::class, 'index'])->name('faculty.index');
    Route::get('/faculty/examsched', [App\Http\Controllers\TeacherController::class, 'examsched'])->name('faculty.examsched');

    Route::get('/faculty/managerequests', [App\Http\Controllers\TeacherController::class, 'ManageRequest'])->name('managerequest.index');
    Route::get('/faculty/archive', [App\Http\Controllers\TeacherController::class, 'definethis'])->name('faculty.index');
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {

    // Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logouts'])->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
    Route::view('about', 'about')->name('about');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');

    // exam generate sa create
    Route::get('/exam', [\App\Http\Controllers\ExamController::class, 'index'])->name('exams.index');
    Route::get('exam/create', [\App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
    Route::post('/fetch-subjects', [\App\Http\Controllers\ExamController::class, 'fetchSubjects'])->name('exam.fetch.subjects');
    Route::post('/upload-csv', [\App\Http\Controllers\ExamController::class, 'uploadCSV'])->name('upload.csv');
    Route::post('exam/additionalInfo',[\App\Http\Controllers\ExamController::class,'fetchAdditionalInfo'])->name('exam.fetch.additionalInfo');
    Route::post('exam/displaytable',[\App\Http\Controllers\ExamController::class,'displaygentable'])->name('displaygentab');

    //saving exam periods
    Route::post('/periods', [\App\Http\Controllers\PeriodController::class, 'store'])->name('periods.store');

    Route::post('/exam-days', [\App\Http\Controllers\ExamDayController::class, 'saveDay'])->name('examdays.save');

    //ExamsTime
    Route::post('/exam-times', [\App\Http\Controllers\ExamTimeController::class, 'saveExamTimes'])->name('examtimes.save');
    Route::get('/exam-times-index', [\App\Http\Controllers\ExamTimeController::class, 'index'])->name('examtimes.index');
    

    //ExamRooms
    Route::post('/exam-rooms', [\App\Http\Controllers\ExamRoomController::class, 'saveExamRooms'])->name('examrooms.save');

    //ExamSubject
    Route::post('/exam-subjects', [\App\Http\Controllers\ExamSubjectController::class, 'saveExamSubjects'])->name('examsubjects.save');
    Route::get('/exams-subjects-index', [\App\Http\Controllers\ExamSubjectController::class, 'index'])->name('examsubjects.index');
    //ExamSection
    Route::post('/exam-SecPro', [\App\Http\Controllers\ExamSectionController::class, 'saveExamSections'])->name('examsections.save');

    //Rooms
    Route::get('exams/room', [\App\Http\Controllers\RoomController::class, 'index'])->name('exams.room');
    


    // class record
    
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');


});
