<?php

use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeacherController;*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

// -----------------------------------------------------------

Route::get('/teacher', [TeacherController::class, 'list'])
->name('teacher-list');

Route::get('/teacher/create', [TeacherController::class, 'createForm'])
->name('teacher-create-form');

Route::post('/teacher/create', [TeacherController::class, 'create'])
->name('teacher-create');

Route::get('/teacher/{teacher}', [TeacherController::class, 'show'])
->name('teacher-view');

Route::get('/teacher/{teacher}/update', [TeacherController::class, 'updateForm'])
->name('teacher-update-form');

Route::post('/teacher/{teacher}/update', [TeacherController::class, 'update'])
->name('teacher-update');

Route::get('/teacher/{teacher}/delete', [TeacherController::class, 'delete'])
->name('teacher-delete');

// -----------------------------------------------------------