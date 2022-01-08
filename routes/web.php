<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LockScreen;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('home', function () {
//         return view('home');
//     });
// });

Auth::routes();


// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// // ----------------------------- user profile ------------------------------//
// Route::get('profile_user', [App\Http\Controllers\UserManagementController::class, 'profile'])->name('profile_user');
// Route::post('profile_user/store', [App\Http\Controllers\UserManagementController::class, 'profileStore'])->name('profile_user/store');
Route::group(
    ['prefix' => 'admin', 'middleware' => 'isAdmin'],
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        // ----------------------------- user userManagement -----------------------//
        Route::get('userManagement', [App\Http\Controllers\UserManagementController::class, 'index'])->name('userManagement');
        Route::get('user/add/new', [App\Http\Controllers\UserManagementController::class, 'addNewUser'])->name('user/add/new');
        Route::post('user/add/save', [App\Http\Controllers\UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
        Route::get('view/detail/{id}', [App\Http\Controllers\UserManagementController::class, 'viewDetail']);
        Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('update');
        Route::get('delete_user/{id}', [App\Http\Controllers\UserManagementController::class, 'delete']);
        Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->name('activity/log');
        Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->name('activity/login/logout');

        // ----------------------------- form change password ------------------------------//
        Route::get('change/password', [App\Http\Controllers\UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
        Route::post('change/password/db', [App\Http\Controllers\UserManagementController::class, 'changePasswordDB'])->name('change/password/db');
        //  Session //
        Route::get('session/list', [App\Http\Controllers\YearSessionController::class, 'index'])->name('session.list');
        Route::get('session/add', [App\Http\Controllers\YearSessionController::class, 'create'])->name('session.add');
        Route::post('session/save', [App\Http\Controllers\YearSessionController::class, 'store'])->name('session.save');
        Route::get('session/edit/{id}', [App\Http\Controllers\YearSessionController::class, 'edit'])->name('session.edit');
        Route::post('session/update', [App\Http\Controllers\YearSessionController::class, 'update'])->name('session.update');
        Route::get('session/delete/{id}', [App\Http\Controllers\YearSessionController::class, 'delete'])->name('session.delete');
        // ----------------------------- student ------------------------------//
        Route::get('student/list', [App\Http\Controllers\StudentController::class, 'index'])->name('student/list');
        Route::get('student/add', [App\Http\Controllers\StudentController::class, 'create'])->name('student/add');
        Route::post('student/save', [App\Http\Controllers\StudentController::class, 'store'])->name('student/save');
        Route::get('student/show', [App\Http\Controllers\StudentController::class, 'show'])->name('student/show');
        Route::get('student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student/edit');
        Route::post('student/update', [App\Http\Controllers\StudentController::class, 'update'])->name('student/update');
        Route::get('student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete'])->name('student/delete');
        #PDF
        Route::get('student/pdf-export', [App\Http\Controllers\StudentController::class, 'PDFGenerate'])->name('student/pdf-export');
        //----------Classes--------------------//
        Route::get('classes/list', [App\Http\Controllers\ClassesController::class, 'index'])->name('classes/list');
        Route::get('classes/add', [App\Http\Controllers\ClassesController::class, 'create'])->name('classes/add');
        Route::post('classes/save', [App\Http\Controllers\ClassesController::class, 'store'])->name('classes/save');
        Route::get('classes/show/{id}', [App\Http\Controllers\ClassesController::class, 'show'])->name('classes/show');
        Route::get('classes/edit/{id}', [App\Http\Controllers\ClassesController::class, 'edit'])->name('classes/edit');
        Route::post('classes/update', [App\Http\Controllers\ClassesController::class, 'update'])->name('classes/update');
        Route::get('classes/delete/{id}', [App\Http\Controllers\ClassesController::class, 'delete'])->name('classes/delete');
        Route::get('classes/timetable/{id}', [App\Http\Controllers\ClassesController::class, 'showTimetable'])->name('classes/timetable');

        //----------Classroom--------------//
        Route::get('classroom/list', [App\Http\Controllers\ClassroomController::class, 'index'])->name('classroom/list');
        Route::get('classroom/add', [App\Http\Controllers\ClassroomController::class, 'create'])->name('classroom/add');
        Route::post('classroom/save', [App\Http\Controllers\ClassroomController::class, 'store'])->name('classroom/save');
        Route::get('classroom/show', [App\Http\Controllers\ClassroomController::class, 'show'])->name('classroom/show');
        Route::get('classroom/edit/{id}', [App\Http\Controllers\ClassroomController::class, 'edit'])->name('classroom/edit');
        Route::post('classroom/update', [App\Http\Controllers\ClassroomController::class, 'update'])->name('classroom/update');
        Route::get('classroom/delete/{id}', [App\Http\Controllers\ClassroomController::class, 'delete'])->name('classroom/delete');
        ///--------------Batches----------//
        Route::get('batch/list', [App\Http\Controllers\BatchController::class, 'index'])->name('batch/list');
        Route::get('batch/add', [App\Http\Controllers\BatchController::class, 'create'])->name('batch/add');
        Route::post('batch/save', [App\Http\Controllers\BatchController::class, 'store'])->name('batch/save');
        Route::get('batch/show', [App\Http\Controllers\BatchController::class, 'show'])->name('batch/show');
        Route::get('batch/edit/{id}', [App\Http\Controllers\BatchController::class, 'edit'])->name('batch/edit');
        Route::post('batch/update', [App\Http\Controllers\BatchController::class, 'update'])->name('batch/update');
        Route::get('batch/delete/{id}', [App\Http\Controllers\BatchController::class, 'delete'])->name('batch/delete');
        //-------Course----------//
        Route::get('course/list', [App\Http\Controllers\CourseController::class, 'index'])->name('course/list');
        Route::get('course/add', [App\Http\Controllers\CourseController::class, 'create'])->name('course/add');
        Route::post('course/save', [App\Http\Controllers\CourseController::class, 'store'])->name('course/save');
        Route::get('course/show', [App\Http\Controllers\CourseController::class, 'show'])->name('course/show');
        Route::get('course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('course/edit');
        Route::post('course/update', [App\Http\Controllers\CourseController::class, 'update'])->name('course/update');
        Route::get('course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('course/delete');
        //--------Semester--------//
        Route::get('semester/list', [App\Http\Controllers\SemesterController::class, 'index'])->name('semester/list');
        Route::get('semester/add', [App\Http\Controllers\SemesterController::class, 'create'])->name('semester/add');
        Route::post('semester/save', [App\Http\Controllers\SemesterController::class, 'store'])->name('semester/save');
        Route::get('semester/show', [App\Http\Controllers\SemesterController::class, 'show'])->name('semester/show');
        Route::get('semester/edit/{id}', [App\Http\Controllers\SemesterController::class, 'edit'])->name('semester/edit');
        Route::post('semester/update', [App\Http\Controllers\SemesterController::class, 'update'])->name('semester/update');
        Route::get('semester/delete/{id}', [App\Http\Controllers\SemesterController::class, 'delete'])->name('semester/delete');
        //-------Day------------//
        Route::get('day/list', [App\Http\Controllers\DayController::class, 'index'])->name('day/list');
        Route::get('day/add', [App\Http\Controllers\DayController::class, 'create'])->name('day/add');
        Route::post('day/save', [App\Http\Controllers\DayController::class, 'store'])->name('day/save');
        Route::get('day/show', [App\Http\Controllers\DayController::class, 'show'])->name('day/show');
        Route::get('day/edit/{id}', [App\Http\Controllers\DayController::class, 'edit'])->name('day/edit');
        Route::post('day/update', [App\Http\Controllers\DayController::class, 'update'])->name('day/update');
        Route::get('day/delete/{id}', [App\Http\Controllers\DayController::class, 'delete'])->name('day/delete');
        //-----------Time-----------//
        Route::get('time/list', [App\Http\Controllers\TimeController::class, 'index'])->name('time/list');
        Route::get('time/add', [App\Http\Controllers\TimeController::class, 'create'])->name('time/add');
        Route::post('time/save', [App\Http\Controllers\TimeController::class, 'store'])->name('time/save');
        Route::get('time/show', [App\Http\Controllers\TimeController::class, 'show'])->name('time/show');
        Route::get('time/edit/{id}', [App\Http\Controllers\TimeController::class, 'edit'])->name('time/edit');
        Route::post('time/update', [App\Http\Controllers\TimeController::class, 'update'])->name('time/update');
        Route::get('time/delete/{id}', [App\Http\Controllers\TimeController::class, 'delete'])->name('time/delete');
        //--------------Teacher------------//
        Route::get('teacher/list', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher/list');
        Route::get('teacher/add', [App\Http\Controllers\TeacherController::class, 'create'])->name('teacher/add');
        Route::post('teacher/save', [App\Http\Controllers\TeacherController::class, 'store'])->name('teacher/save');
        // Route::get('teacher/show', [App\Http\Controllers\TeacherController::class, 'show'])->name('teacher/show');
        Route::get('teacher/edit/{id}', [App\Http\Controllers\TeacherController::class, 'edit'])->name('teacher/edit');
        Route::post('teacher/update', [App\Http\Controllers\TeacherController::class, 'update'])->name('teacher/update');
        Route::get('teacher/delete/{id}', [App\Http\Controllers\TeacherController::class, 'delete'])->name('teacher/delete');
        #PDF
        Route::get('teacher/pdf-export', [App\Http\Controllers\TeacherController::class, 'PDFGenerate'])->name('teacher/pdf-export');
        //---------Timetable-------//
        Route::get('lesson/list', [App\Http\Controllers\LessonController::class, 'index'])->name('lesson/list');
        Route::get('lesson/add', [App\Http\Controllers\LessonController::class, 'create'])->name('lesson/add');
        Route::post('lesson/save', [App\Http\Controllers\LessonController::class, 'store'])->name('lesson/save');
        Route::get('lesson/edit/{id}', [App\Http\Controllers\LessonController::class, 'edit'])->name('lesson/edit');
        Route::post('lesson/update', [App\Http\Controllers\LessonController::class, 'update'])->name('lesson/update');
        Route::get('lesson/delete/{id}', [App\Http\Controllers\LessonController::class, 'delete'])->name('lesson/delete');
        //---------Promotion-------//
        Route::get('promotion/index', [App\Http\Controllers\PromotionController::class, 'index'])->name('promotion.index');
        Route::get('promotion/create', [App\Http\Controllers\PromotionController::class, 'create'])->name('promotion.create');
        Route::post('promotion/save', [App\Http\Controllers\PromotionController::class, 'store'])->name('promotion.store');
    }
);
#Student
Route::group(['prefix' => 'student', 'middleware' => 'isStudent'], function () {
    Route::get('/home', [App\Http\Controllers\StudentRole\StudentController::class, 'index'])->name('homeStudent');
    Route::get('/profile', [App\Http\Controllers\StudentRole\StudentController::class, 'showProfile'])->name('studentProfile');
    Route::get('timetable', [App\Http\Controllers\StudentRole\TimetableController::class, 'searchTimetable'])->name('student.timetable.search');
    Route::get('timetable/get', [App\Http\Controllers\StudentRole\TimetableController::class, 'showTimetable'])->name('student.timetable.get');
    Route::get('timetable/details/view', [App\Http\Controllers\StudentRole\TimetableController::class, 'timetableDetailsIndex'])->name('timetableDetails');
    Route::get('timetable/details/get', [App\Http\Controllers\StudentRole\TimetableController::class, 'timetableDetails'])->name('timetableDetails.get');
    Route::get('mark/view', [App\Http\Controllers\StudentRole\MarkController::class, 'show'])->name('student.mark.view');
    Route::get('mark/get', [App\Http\Controllers\StudentRole\MarkController::class, 'getMark'])->name('student.mark.get');
    Route::get('attendance/show', [App\Http\Controllers\StudentRole\AttendanceController::class, 'showAttendance'])->name('student.attendance.show');
    Route::get('attendance/get', [App\Http\Controllers\StudentRole\AttendanceController::class, 'getAttendance'])->name('student.attendance.get');
    Route::get('attendance/course/get', [App\Http\Controllers\StudentRole\AttendanceController::class, 'getCourse'])->name('student.attendance.course.get');
});
#Teacher
Route::group(['prefix' => 'teacher', 'middleware' => 'isTeacher'], function () {
    Route::get('/home', [App\Http\Controllers\TeacherRole\TeacherController::class, 'index'])->name('homeTeacher');
    Route::get('/timetable', [App\Http\Controllers\TeacherRole\TeacherController::class, 'showTimetable'])->name('teacher.timetable.show');
    Route::get('/timetable/search', [App\Http\Controllers\TeacherRole\TeacherController::class, 'timetableSearch'])->name('teacher.timetable.search');
    Route::get('/class/list', [App\Http\Controllers\TeacherRole\TeacherController::class, 'showClass'])->name('teacher.class.list');
    Route::get('/all-class', [App\Http\Controllers\TeacherRole\TeacherController::class, 'showAll'])->name('classAll');
    Route::get('/all-class/about/{id}', [App\Http\Controllers\TeacherRole\TeacherController::class, 'showClassDetail'])->name('classDetail');
    #Student Mark
    Route::prefix('mark')->group(function () {
        Route::get('search/list', [App\Http\Controllers\TeacherRole\MarkController::class, 'search'])->name('mark.search.list');
        Route::get('getclass', [App\Http\Controllers\TeacherRole\MarkController::class, 'getClass'])->name('mark.get.class');
        Route::get('getcourse', [App\Http\Controllers\TeacherRole\MarkController::class, 'getCourse'])->name('mark.get.course');
        Route::get('/add', [App\Http\Controllers\TeacherRole\MarkController::class, 'create'])->name('mark.add');
        Route::post('/save', [App\Http\Controllers\TeacherRole\MarkController::class, 'store'])->name('mark.save');
        Route::get('/edit', [App\Http\Controllers\TeacherRole\MarkController::class, 'edit'])->name('mark.edit');
        Route::get('/edit/list', [App\Http\Controllers\TeacherRole\MarkController::class, 'getEditList'])->name('mark.edit.list');
        Route::post('/update', [App\Http\Controllers\TeacherRole\MarkController::class, 'update'])->name('mark.update');
    });
    Route::prefix('attendance')->group(function () {
        Route::get('/add', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'create'])->name('attendance.add');
        Route::post('/save', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/details', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'show'])->name('attendance.details');
        Route::get('/get/date', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'getDate'])->name('date.get');
        Route::get('/show', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'getAtten'])->name('attendance.get');
    });
});
