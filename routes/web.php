<?php

use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeacherController;*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
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
    return redirect('/auth/login');
});

Route::get('/auth/login', [LoginController::class, 'loginForm'])
->name('login'); 

Route::post('/auth/login', [LoginController::class, 'authenticate'])
->name('authenticate');

Route::get('/auth/logout', [LoginController::class, 'logout'])
->name('logout');
// -----------------------------------------------------------
Route::get('/student', [StudentController::class, 'list'])
->name('student-list');

Route::get('/student/create', [StudentController::class, 'createForm'])
->name('student-create-form');

Route::post('/student/create', [StudentController::class, 'create'])
->name('student-create');

Route::get('/student/{student}', [StudentController::class, 'show'])
->name('student-view');

Route::get('/student/{student}/update', [StudentController::class, 'updateForm'])
->name('student-update-form');

Route::post('/student/{student}/update', [StudentController::class, 'update'])
->name('student-update');

Route::get('/student/{student}/delete', [StudentController::class, 'delete'])
->name('student-delete');

Route::get('/student/{student}/course/add',[StudentController::class, 'addCourseForm'])
->name('student-add-course-form');

Route::post('/student/{student}/course/add',[StudentController::class, 'addCourse'])
->name('student-add-course');

Route::get('/student/{student}/course/{course}/remove',[StudentController::class, 'removeCourse'])
->name('student-remove-course');
// -----------------------------------------------------------
// -----------------------------------------------------------

Route::get('/course', [CourseController::class, 'list'])
->name('course-list');

Route::get('/course/create', [CourseController::class, 'createForm'])
->name('course-create-form');

Route::post('/course/create', [CourseController::class, 'create'])
->name('course-create');

Route::get('/course/{course}', [CourseController::class, 'show'])
->name('course-view');

Route::get('/course/{course}/update', [CourseController::class, 'updateForm'])
->name('course-update-form');

Route::post('/course/{course}/update', [CourseController::class, 'update'])
->name('course-update');



