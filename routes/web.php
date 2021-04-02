<?php

use Illuminate\Support\Facades\Route;
/*use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeacherController;*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
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

Route::get('/auth/login', [LoginController::class, 'loginForm'])
->name('login'); 

Route::post('/auth/login', [LoginController::class, 'authenticate'])
->name('authenticate');

Route::get('/auth/logout', [LoginController::class, 'logout'])
->name('logout');

Route::get('/student', [StudentController::class, 'list'])
->name('student-list');

Route::get('/student/{student}', [StudentController::class, 'show'])
->name('student-view');
