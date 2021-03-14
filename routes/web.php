<?php

use App\Http\Controllers\TeacherController as Teacher;
use App\Http\Controllers\StudentController as Student;
use App\Http\Controllers\MarkController as Mark;
use App\Http\Controllers\HomeController as Home;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [Home::class, 'index']);
Route::resource('teachers', Teacher::class);
Route::resource('students', Student::class);
Route::resource('marks', Mark::class);