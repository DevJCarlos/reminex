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
    Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
    Route::get('/student/show', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
    // Route::get('/student/viewrequest', [App\Http\Controllers\StudentController::class, 'viewRequest'])->name('student.viewrequest');
    // Route::get('/student/newsched', [App\Http\Controllers\StudentController::class, 'newSched'])->name('student.newsched');
    Route::get('/student/aboutus', [App\Http\Controllers\StudentController::class, 'aboutUs'])->name('student.aboutus');
    Route::get('/student/changepass', [App\Http\Controllers\StudentController::class, 'changePass'])->name('student.changepass');
    // Route::get('changeprofilePic', [App\Http\Controllers\StudentController::class, 'changeprofilePic'])->name('profilepic.update');
    

    //Request 
    Route::get('/student/createrequest', [App\Http\Controllers\RequestController::class, 'createRequest'])->name('student.createrequest');
    Route::post('/student/createrequest', [App\Http\Controllers\RequestController::class, 'storeRequest'])->name('request.store');
    Route::get('/student/viewrequest', [App\Http\Controllers\RequestController::class, 'showstudentRequest'])->name('student.viewrequest');
    Route::get('/student/newsched', [App\Http\Controllers\RequestController::class, 'showstudentNewSched'])->name('student.newsched');
    Route::get('/student/viewrequest/{filePaths}', [\App\Http\Controllers\RequestController::class, 'requestDownload2'])->name('request.download2');
    Route::get('/layouts/partial/guest-nav', [App\Http\Controllers\RequestController::class, 'studentschedNotif'])->name('layouts.partial.guest-nav');

    // about us
    // Route::get('/bout-us', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
});


Route::group(['middleware' => ['auth', 'role:teacher']], function(){
    //butangi ang mga wala dri 
    Route::get('/faculty', [App\Http\Controllers\TeacherController::class, 'index'])->name('faculty.index');
    Route::get('/faculty/examsched', [App\Http\Controllers\TeacherController::class, 'show'])->name('faculty.show');
    // Route::get('/faculty/managerequest', [App\Http\Controllers\TeacherController::class, 'manageRequest'])->name('faculty.managerequest');
    Route::get('/faculty/requestarchive', [App\Http\Controllers\TeacherController::class, 'requestArchive'])->name('faculty.requestarchive');
    Route::get('/faculty/aboutus', [App\Http\Controllers\TeacherController::class, 'aboutUs'])->name('faculty.aboutus');
    Route::get('/faculty/changepass', [App\Http\Controllers\TeacherController::class, 'changePass'])->name('faculty.changepass');
    // Route::get('changeprofilePic', [App\Http\Controllers\TeacherController::class, 'changeprofilePic'])->name('profilepic.update');

    //Request 
    Route::get('/faculty/managerequest', [App\Http\Controllers\RequestController::class, 'showRequest2'])->name('faculty.managerequest');
    Route::post('/faculty/managerequest', [App\Http\Controllers\RequestController::class, 'storeSched'])->name('sched.store');
    Route::get('/newsched_created/{id}', [\App\Http\Controllers\RequestController::class, 'newschedCreated'])->name('newsched_created');
    Route::get('/faculty/createdNewsched', [App\Http\Controllers\RequestController::class, 'showfacultyNewSched'])->name('faculty.createdNewsched');
    
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
    Route::view('about', 'about')->name('about');

    //registration
    Route::post('createadmin',  [\App\Http\Controllers\Auth\RegisterController::class, 'createAdmin'])->name('createadmin');
    Route::delete('users/{user}', [\App\Http\Controllers\Auth\RegisterController::class, 'destroy'])->name('users.destroy');

    //Users module
    Route::get('admin-users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    
    //
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');

    // exam generate sa create
    // Route::get('/exam', [\App\Http\Controllers\ExamController::class, 'index'])->name('exams.index');
    
    Route::get('exam/create', [\App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
    Route::post('/fetch-subjects', [\App\Http\Controllers\ExamController::class, 'fetchSubjects'])->name('exam.fetch.subjects');
    Route::post('/upload-csv', [\App\Http\Controllers\ExamController::class, 'uploadCSV'])->name('upload.csv');
    Route::post('exam/additionalInfo',[\App\Http\Controllers\ExamController::class,'fetchAdditionalInfo'])->name('exam.fetch.additionalInfo');
    Route::post('exam/displaytable',[\App\Http\Controllers\ExamController::class,'displaygentable'])->name('displaygentab');

    //saving exam periods
    Route::post('/periods', [\App\Http\Controllers\PeriodController::class, 'store'])->name('periods.store');

    Route::post('/exam-days', [\App\Http\Controllers\ExamDayController::class, 'saveDay'])->name('examdays.save');
    Route::get('/exam-days-show', [\App\Http\Controllers\ExamDayController::class, 'index'])->name('examdays.show');

    //ExamsTime
    Route::post('/exam-times', [\App\Http\Controllers\ExamTimeController::class, 'saveExamTimes'])->name('examtimes.save');
    Route::get('/exam', [\App\Http\Controllers\ExamTimeController::class, 'index'])->name('exams.index');


    //fetch
    Route::post('/exam/fetch', [\App\Http\Controllers\ExamTimeController::class, 'fetch'])->name('exams.fetch');
    


    //ExamRooms
    Route::post('/exam-rooms', [\App\Http\Controllers\ExamRoomController::class, 'saveExamRooms'])->name('examrooms.save');

    //ExamSubject
    Route::post('/exam-subjects', [\App\Http\Controllers\ExamSubjectController::class, 'saveExamSubjects'])->name('examsubjects.save');
    Route::get('/exams-subjects-index', [\App\Http\Controllers\ExamSubjectController::class, 'index'])->name('examsubjects.index');
    //ExamSection
    Route::post('/exam-SecPro', [\App\Http\Controllers\ExamSectionController::class, 'saveExamSections'])->name('examsections.save');

    //Rooms
    Route::get('exams/room', [\App\Http\Controllers\RoomController::class, 'index'])->name('exams.room');
    Route::post('/add-room', [\App\Http\Controllers\RoomController::class, 'addRoom']);
    Route::post('/delete-room', [\App\Http\Controllers\RoomController::class, 'deleteRoom']);
    Route::post('/update-room', [\App\Http\Controllers\RoomController::class, 'updateRoom']);



    


    // class record
    
    Route::post('/upload-sec', [\App\Http\Controllers\HomeController::class, 'saveData'])->name('listbysec.csv');

    //request management

    // Route::get('/requests', [\App\Http\Controllers\RequestController::class, 'requests'])->name('requests');
    Route::get('/requests', [App\Http\Controllers\RequestController::class, 'showRequest'])->name('requests');
    Route::get('/approve_request/{id}', [\App\Http\Controllers\RequestController::class, 'approveRequest'])->name('approve_request');
    Route::get('/approve_request2/{id}', [\App\Http\Controllers\RequestController::class, 'approveRequest2'])->name('approve_request2');
    Route::post('/reject_request/{id}', [\App\Http\Controllers\RequestController::class, 'rejectRequest'])->name('reject_request');
    Route::get('/requests/download/{filePaths}', [\App\Http\Controllers\RequestController::class, 'requestDownload'])->name('request.download');
    Route::get('adminArchiveRequest', [App\Http\Controllers\RequestController::class, 'adminRequestArchive'])->name('adminArchiveRequest');
    // Route::delete('requests/{requestdata}', [\App\Http\Controllers\RequestController::class, 'destroyRequest'])->name('request.destroy');
    Route::delete('/requests/{id}', [\App\Http\Controllers\RequestController::class, 'destroyRequest'])->name('requests.destroy');


});
