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
    return view('auth.login', [
        'title' => 'Đăng nhập'
    ]);
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
        Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('user.update');
        Route::get('delete_user/{id}', [App\Http\Controllers\UserManagementController::class, 'delete']);




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
        Route::post('student/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');
        Route::get('student/list', [App\Http\Controllers\StudentController::class, 'index'])->name('student.list');
        Route::get('student/add', [App\Http\Controllers\StudentController::class, 'create'])->name('student.add');
        Route::post('student/save', [App\Http\Controllers\StudentController::class, 'store'])->name('student.save');
        Route::get('student/show', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
        Route::get('student/edit/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
        Route::post('student/update', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');
        Route::get('student/delete/{id}', [App\Http\Controllers\StudentController::class, 'delete'])->name('student.delete');
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


        //----------Classroom--------------//
        Route::get('classroom/list', [App\Http\Controllers\ClassroomController::class, 'index'])->name('classroom/list');
        Route::get('classroom/add', [App\Http\Controllers\ClassroomController::class, 'create'])->name('classroom/add');
        Route::post('classroom/save', [App\Http\Controllers\ClassroomController::class, 'store'])->name('classroom/save');
        Route::get('classroom/edit/{id}', [App\Http\Controllers\ClassroomController::class, 'edit'])->name('classroom/edit');
        Route::post('classroom/update', [App\Http\Controllers\ClassroomController::class, 'update'])->name('classroom/update');
        Route::get('classroom/delete/{id}', [App\Http\Controllers\ClassroomController::class, 'delete'])->name('classroom/delete');
        ///--------------Batches----------//
        Route::get('batch/list', [App\Http\Controllers\BatchController::class, 'index'])->name('batch/list');
        Route::get('batch/add', [App\Http\Controllers\BatchController::class, 'create'])->name('batch/add');
        Route::post('batch/save', [App\Http\Controllers\BatchController::class, 'store'])->name('batch/save');
        Route::get('batch/edit/{id}', [App\Http\Controllers\BatchController::class, 'edit'])->name('batch/edit');
        Route::post('batch/update', [App\Http\Controllers\BatchController::class, 'update'])->name('batch/update');
        Route::get('batch/delete/{id}', [App\Http\Controllers\BatchController::class, 'delete'])->name('batch/delete');
        //-------Course----------//
        Route::get('course/list', [App\Http\Controllers\CourseController::class, 'index'])->name('course/list');
        Route::get('course/add', [App\Http\Controllers\CourseController::class, 'create'])->name('course/add');
        Route::post('course/save', [App\Http\Controllers\CourseController::class, 'store'])->name('course/save');
        Route::get('course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('course/edit');
        Route::post('course/update', [App\Http\Controllers\CourseController::class, 'update'])->name('course/update');
        Route::get('course/delete/{id}', [App\Http\Controllers\CourseController::class, 'delete'])->name('course/delete');
        //--------Semester--------//
        Route::get('semester/list', [App\Http\Controllers\SemesterController::class, 'index'])->name('semester/list');
        Route::get('semester/add', [App\Http\Controllers\SemesterController::class, 'create'])->name('semester/add');
        Route::post('semester/save', [App\Http\Controllers\SemesterController::class, 'store'])->name('semester/save');
        Route::get('semester/edit/{id}', [App\Http\Controllers\SemesterController::class, 'edit'])->name('semester/edit');
        Route::post('semester/update', [App\Http\Controllers\SemesterController::class, 'update'])->name('semester/update');
        Route::get('semester/delete/{id}', [App\Http\Controllers\SemesterController::class, 'delete'])->name('semester/delete');
        //-------Day------------//
        Route::get('day/list', [App\Http\Controllers\DayController::class, 'index'])->name('day/list');
        Route::get('day/add', [App\Http\Controllers\DayController::class, 'create'])->name('day/add');
        Route::post('day/save', [App\Http\Controllers\DayController::class, 'store'])->name('day/save');
        Route::get('day/edit/{id}', [App\Http\Controllers\DayController::class, 'edit'])->name('day/edit');
        Route::post('day/update', [App\Http\Controllers\DayController::class, 'update'])->name('day/update');
        Route::get('day/delete/{id}', [App\Http\Controllers\DayController::class, 'delete'])->name('day/delete');
        //-----------Time-----------//
        Route::get('time/list', [App\Http\Controllers\TimeController::class, 'index'])->name('time/list');
        Route::get('time/add', [App\Http\Controllers\TimeController::class, 'create'])->name('time/add');
        Route::post('time/save', [App\Http\Controllers\TimeController::class, 'store'])->name('time/save');
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
        Route::get('teacher/assign', [App\Http\Controllers\AssignTeacherController::class, 'create'])->name('teacher.assign');
        Route::post('teacher/assign/add', [App\Http\Controllers\AssignTeacherController::class, 'store'])->name('teacher.assign.store');
        Route::get('teacher/assign/list', [App\Http\Controllers\AssignTeacherController::class, 'index'])->name('teacher.assign.list');
        Route::get('teacher/assign/list/get', [App\Http\Controllers\AssignTeacherController::class, 'getFormTeacher'])->name('teacher.assign.list.get');
        #PDF
        Route::get('teacher/pdf-export', [App\Http\Controllers\TeacherController::class, 'PDFGenerate'])->name('teacher/pdf-export');
        //---------Timetable-------//
        Route::get('lesson/list', [App\Http\Controllers\LessonController::class, 'index'])->name('lesson/list');
        Route::get('lesson/add', [App\Http\Controllers\LessonController::class, 'create'])->name('lesson/add');
        Route::post('lesson/save', [App\Http\Controllers\LessonController::class, 'store'])->name('lesson/save');
        Route::get('lesson/edit/{id}', [App\Http\Controllers\LessonController::class, 'edit'])->name('lesson/edit');
        Route::post('lesson/update', [App\Http\Controllers\LessonController::class, 'update'])->name('lesson/update');
        Route::get('lesson/delete/{id}', [App\Http\Controllers\LessonController::class, 'delete'])->name('lesson/delete');
        Route::post('lesson/search', [App\Http\Controllers\LessonController::class, 'search'])->name('lesson.search');
        //---------Promotion-------//
        Route::get('promotion/index', [App\Http\Controllers\PromotionController::class, 'index'])->name('promotion.index');
        Route::get('promotion/create', [App\Http\Controllers\PromotionController::class, 'create'])->name('promotion.create');
        Route::post('promotion/save', [App\Http\Controllers\PromotionController::class, 'store'])->name('promotion.store');
        //---------Notice-------//

        Route::get('notice/create', [App\Http\Controllers\BoardingNoticeController::class, 'create'])->name('boarding.create');
        Route::post('notice/save', [App\Http\Controllers\BoardingNoticeController::class, 'store'])->name('boarding.store');
        //---------Reward-------//
        Route::get('reward/list', [App\Http\Controllers\RewardController::class, 'index'])->name('reward.list');
        Route::post('reward/add', [App\Http\Controllers\RewardController::class, 'ImportExcel'])->name('reward.import');
        Route::get('reward/delete/{id}', [App\Http\Controllers\RewardController::class, 'delete'])->name('reward.delete');
        Route::get('reward/pdf-export', [App\Http\Controllers\RewardController::class, 'PDFGenerate'])->name('reward.pdf-export');
        Route::post('reward/search', [App\Http\Controllers\RewardController::class, 'search'])->name('reward.search');
        //---------Excel-------//
        Route::get('excel-export-teacher', [App\Http\Controllers\TeacherController::class, 'ExcelExport'])->name('teacher.excel.export');
    }
);
Route::get('notice/list', [App\Http\Controllers\BoardingNoticeController::class, 'index'])->name('boarding.list');
Route::get('notice/markAsRead', [App\Http\Controllers\BoardingNoticeController::class, 'readNotice'])->name('boarding.readNotice');
#Student
Route::group(['prefix' => 'student', 'middleware' => 'isStudent'], function () {
    Route::get('/home', [App\Http\Controllers\StudentRole\StudentController::class, 'index'])->name('homeStudent');
    Route::get('/profile', [App\Http\Controllers\StudentRole\StudentController::class, 'showProfile'])->name('studentProfile');
    Route::get('timetable', [App\Http\Controllers\StudentRole\TimetableController::class, 'searchTimetable'])->name('student.timetable.search');
    Route::get('timetable/get', [App\Http\Controllers\StudentRole\TimetableController::class, 'showTimetable'])->name('student.timetable.get');
    Route::get('timetable/details', [App\Http\Controllers\StudentRole\TimetableController::class, 'timetableDetailsIndex'])->name('timetableDetails');
    Route::get('timetable/details/get', [App\Http\Controllers\StudentRole\TimetableController::class, 'timetableDetails'])->name('timetableDetails.get');
    Route::get('mark', [App\Http\Controllers\StudentRole\MarkController::class, 'show'])->name('student.mark.view');
    Route::get('mark/get', [App\Http\Controllers\StudentRole\MarkController::class, 'getMark'])->name('student.mark.get');
    Route::get('attendance', [App\Http\Controllers\StudentRole\AttendanceController::class, 'showAttendance'])->name('student.attendance.show');
    Route::get('attendance/get', [App\Http\Controllers\StudentRole\AttendanceController::class, 'getAttendance'])->name('student.attendance.get');
    Route::get('attendance/course/get', [App\Http\Controllers\StudentRole\AttendanceController::class, 'getCourse'])->name('student.attendance.course.get');
    Route::get('ability-quality', [App\Http\Controllers\StudentRole\AbilityQualityController::class, 'index'])->name('student.a-q.search');
    Route::get('ability-quality/get', [App\Http\Controllers\StudentRole\AbilityQualityController::class, 'getAQ'])->name('student.a-q.get');
    Route::get('conduct/get', [App\Http\Controllers\StudentRole\ConductController::class, 'index'])->name('student.conduct.get');
    Route::get('document/list/{id}', [App\Http\Controllers\StudentRole\TimetableController::class, 'getDocumentList']);
    Route::get('comment/view', [App\Http\Controllers\StudentRole\CourseCommentController::class, 'searchComment'])->name('student.comment.show');
    Route::get('comment/get', [App\Http\Controllers\StudentRole\CourseCommentController::class, 'getTeacherComment'])->name('student.comment.get');
});
#Teacher
Route::group(['prefix' => 'teacher', 'middleware' => 'isTeacher'], function () {
    Route::get('home', [App\Http\Controllers\TeacherRole\TeacherController::class, 'index'])->name('homeTeacher');
    Route::get('timetable', [App\Http\Controllers\TeacherRole\TimetableController::class, 'showTimetable'])->name('teacher.timetable.show');
    Route::get('timetable/search', [App\Http\Controllers\TeacherRole\TimetableController::class, 'timetableSearch'])->name('teacher.timetable.search');
    // note
    Route::get('timetable/note/add/{id}', [App\Http\Controllers\TeacherRole\TimetableController::class, 'addNoteView']);
    Route::post('lesson_note/save', [App\Http\Controllers\TeacherRole\TimetableController::class, 'addNote'])->name('teacher.lesson.note.add');
    Route::get('timetable/note/edit/{id}', [App\Http\Controllers\TeacherRole\TimetableController::class, 'editNote'])->name('teacher.lesson.note.edit');
    Route::post('timetable/note/update', [App\Http\Controllers\TeacherRole\TimetableController::class, 'updateNote'])->name('teacher.lesson.note.update');
    // document
    Route::get('document/upload/{id}', [App\Http\Controllers\TeacherRole\DocumentController::class, 'create'])->name('teacher.document.upload');
    Route::post('document/store', [App\Http\Controllers\TeacherRole\DocumentController::class, 'storeDocument'])->name('teacher.document.store');
    Route::get('document/list/{id}', [App\Http\Controllers\TeacherRole\DocumentController::class, 'getDocumentList'])->name('teacher.document.list.get');
    // details
    Route::get('timetable-details/add/{lesson}', [App\Http\Controllers\TeacherRole\LessonDetailsController::class, 'index'])->name('teacher.lesson-details.add');
    Route::post('timetable-details/store', [App\Http\Controllers\TeacherRole\LessonDetailsController::class, 'store'])->name('teacher.lesson-details.store');
    Route::get('timetable-details/edit/{id}', [App\Http\Controllers\TeacherRole\LessonDetailsController::class, 'edit'])->name('teacher.lesson-details.edit');
    Route::post('timetable-details/update', [App\Http\Controllers\TeacherRole\LessonDetailsController::class, 'update'])->name('teacher.lesson-details.update');
    Route::get('timetable-details/delete/{id}', [App\Http\Controllers\TeacherRole\LessonDetailsController::class, 'delete'])->name('teacher.lesson-details.delete');
    #Student Mark
    Route::prefix('mark')->group(function () {
        Route::get('search/list', [App\Http\Controllers\TeacherRole\MarkController::class, 'search'])->name('mark.search.list');
        Route::get('getClass', [App\Http\Controllers\TeacherRole\MarkController::class, 'getClass'])->name('mark.get.class');
        Route::get('getCourse', [App\Http\Controllers\TeacherRole\MarkController::class, 'getCourse'])->name('mark.get.course');
        Route::get('/add', [App\Http\Controllers\TeacherRole\MarkController::class, 'create'])->name('mark.add');
        Route::post('/save', [App\Http\Controllers\TeacherRole\MarkController::class, 'store'])->name('mark.save');
        Route::get('/edit', [App\Http\Controllers\TeacherRole\MarkController::class, 'edit'])->name('mark.edit');
        Route::get('/edit/list', [App\Http\Controllers\TeacherRole\MarkController::class, 'getEditList'])->name('mark.edit.list');
        Route::post('/update', [App\Http\Controllers\TeacherRole\MarkController::class, 'update'])->name('mark.update');
    });
    Route::prefix('attendance')->group(function () {
        Route::get('/add', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'create'])->name('attendance.add');
        Route::get('/getList', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'getAttendanceStudent'])->name('attendance.list.get');
        Route::post('/save', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/details', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'show'])->name('attendance.details');
        Route::get('/get/date', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'getDate'])->name('date.get');
        Route::get('/show', [App\Http\Controllers\TeacherRole\AttendanceController::class, 'getAtten'])->name('attendance.get');
    });

    Route::prefix('conduct')->group(function () {
        Route::get('/class', [App\Http\Controllers\TeacherRole\ConductController::class, 'allClass'])->name('conduct.teacher.form.class');
        Route::get('/add/{class}/{year}', [App\Http\Controllers\TeacherRole\ConductController::class, 'getStudentByClass'])->name('conduct.teacher.form.class.student');
        Route::post('/save', [App\Http\Controllers\TeacherRole\ConductController::class, 'store'])->name('conduct.store');
        Route::get('/edit/class', [App\Http\Controllers\TeacherRole\ConductController::class, 'allClassEdit'])->name('conduct.teacher.form.class.edit');
        Route::get('/edit/{class}/{year}', [App\Http\Controllers\TeacherRole\ConductController::class, 'edit'])->name('conduct.edit');
        Route::get('/show', [App\Http\Controllers\TeacherRole\ConductController::class, 'show'])->name('conduct.edit.show');
        Route::post('/update', [App\Http\Controllers\TeacherRole\ConductController::class, 'update'])->name('conduct.update');
    });
    Route::prefix('course-comment')->group(function () {
        Route::get('/search', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'search'])->name('comment.search');
        Route::get('/add', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'create'])->name('comment.add');
        Route::post('/save', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'store'])->name('comment.store');
        Route::get('/show', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'show'])->name('comment.show');
        Route::get('/edit/list', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'edit'])->name('comment.edit');
        Route::post('/update', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'update'])->name('comment.update');
    });
    Route::prefix('ability-quality')->group(function () {
        Route::get('/search', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'allClass'])->name('a-q.class.search');
        Route::get('/list/{class}/{year}', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'classList'])->name('a-q.list');
        Route::get('/add/{student}/{class}/{year}', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'add'])->name('a-q.add');
        Route::post('/save', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'store'])->name('a-q.store');
        Route::get('/show/{student}/{class}/{year}', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'show'])->name('a-q.show');
        Route::get('/get', [App\Http\Controllers\TeacherRole\AbilityQualityController::class, 'showDetails'])->name('a-q.get');
        Route::post('/update', [App\Http\Controllers\TeacherRole\CourseCommentController::class, 'update'])->name('comment.update');
    });
});
