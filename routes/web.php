<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\StudentAssignmentController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/student', [LoginController::class, 'showStudentLoginForm']);
Route::get('/login/lecturer', [LoginController::class,'showLecturerLoginForm']);
Route::get('/register/student', [RegisterController::class,'showStudentRegisterForm']);
Route::get('/register/lecturer', [RegisterController::class,'showLecturerRegisterForm']);

Route::post('/login/student', [LoginController::class,'studentLogin']);
Route::post('/login/lecturer', [LoginController::class,'lecturerLogin']);
Route::post('/register/student', [RegisterController::class,'createStudent']);
Route::post('/register/lecturer', [RegisterController::class,'createLecturer']);

Route::group(['middleware' => 'auth:lecturer'], function () {
    Route::view('/lecturer', 'lecturer');
    Route::view('/lecturer/createclass','layouts.lecturer.createclass');
    Route::post('/lecturer/createclass', [App\Http\Controllers\ClassController::class, 'create_class']);
    Route::get('/lecturer/viewclass', [App\Http\Controllers\ClassController::class, 'view_class']);
    Route::get('/lecturer/viewclassdetail/{id}',[App\Http\Controllers\ClassController::class, 'view_class_detail']);
    Route::get('/lecturer/viewclassdetail/{id}/createassignment',[App\Http\Controllers\ClassController::class, 'create_assignment']);
    Route::post('/lecturer/viewclassdetail/{id}/createassignment',[App\Http\Controllers\ClassController::class, 'submit_create_assignment']);
    Route::get('/lecturer/viewclassdetail/{id}',[App\Http\Controllers\ClassController::class, 'view_assignment']);
    Route::get('/lecturer/viewclassdetail/{id}/viewassignmentdetail/{assignment_id}',[App\Http\Controllers\ClassController::class, 'view_assignment_detail']);
    Route::get('/lecturer/viewclassdetail/{id}/deleteassignment/{assignment_id}',[App\Http\Controllers\ClassController::class, 'delete_assignment']);    
    Route::get('/lecturer/viewclassdetail/{id}/editassignment/{assignment_id}',[App\Http\Controllers\ClassController::class, 'edit_assignment_detail']);
    Route::post('/lecturer/viewclassdetail/{id}/editassignment/{assignment_id}',[App\Http\Controllers\ClassController::class, 'update_assignment_detail']);
});
 
Route::group(['middleware' => 'auth:student'], function () {
    Route::get('/student', [App\Http\Controllers\ClassController::class, 'student_dashboard']);
    Route::post('/student', [App\Http\Controllers\ClassController::class, 'add_class']);
    Route::get('/student/assignments-list',[App\Http\Controllers\AssignmentController::class, 'show_assignments_list']);
    Route::get('/student/grade-appeal',[App\Http\Controllers\AssignmentController::class, 'show_grade_appeal_list']);
    Route::view('/student/user-profile','layouts.student.userprofile');
    Route::view('/student/user-information-edit','layouts.student.userinformationedit');
    Route::post('/student/user-information-edit',[App\Http\Controllers\StudentController::class, 'update_student_information']);
    Route::view('/student/user-password-edit','layouts.student.userpasswordedit');
    Route::post('/student/user-password-edit',[App\Http\Controllers\StudentController::class, 'update_student_password']);
    Route::get('/student/{class_name}/{id}',[App\Http\Controllers\AssignmentController::class, 'show_assignments']);
    Route::get('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit',[App\Http\Controllers\StudentAssignmentController::class, 'submit_phase']);
    Route::post('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit',[App\Http\Controllers\StudentAssignmentController::class, 'submit_draft_report']);
    Route::get('/download/draft_report/{class_id}/{assignment_id}',[App\Http\Controllers\StudentAssignmentController::class, 'download_draft_report']);
    Route::get('/delete/draft_report/{class_id}/{assignment_id}',[App\Http\Controllers\StudentAssignmentController::class, 'delete_draft_report']);
    Route::get('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/feedback',[App\Http\Controllers\StudentAssignmentController::class, 'feedback_phase']);
    Route::get('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit_final_report',[App\Http\Controllers\StudentAssignmentController::class, 'submit_final_report']);
    Route::get('/download/final_report/{class_id}/{assignment_id}',[App\Http\Controllers\StudentAssignmentController::class, 'download_final_report']);
    Route::post('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/submit_feedback',[App\Http\Controllers\StudentAssignmentController::class, 'submit_feedback']);
    Route::get('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/evaluate',[App\Http\Controllers\StudentAssignmentController::class, 'evaluate_phase']);
    Route::get('/student/{class_name}/{class_id}/{assignment_name}/{assignment_id}/result',[App\Http\Controllers\StudentAssignmentController::class, 'result_phase']);
    //Route::get('/student/create_record',[App\Http\Controllers\StudentAssignmentController::class, 'create_student_assignment_record']);
});

Route::get('logout', [LoginController::class,'logout']);
