<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;

Route::post('/forgot-password',[ForgotPasswordController::class, 'sendResetLink'])->middleware('throttle:5,1');

Route::get('/user', function (Request $request) {
    return $request->user();})->middleware('auth:sanctum');


use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/students', [StudentController::class, 'index'])->middleware('can:view students');
    Route::get('/students/{student}', [StudentController::class, 'show'])->middleware('can:view students');
    Route::post('/students', [StudentController::class, 'store'])->middleware('can:create students');
    Route::put('/students/{student}', [StudentController::class, 'update'])->middleware('can:edit students');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->middleware('can:edit students');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->middleware('can:delete students');

    Route::get('/courses', [CourseController::class, 'index'])->middleware('can:view courses');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware('can:view courses');
    Route::post('/courses', [CourseController::class, 'store'])->middleware('can:create courses');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('can:edit courses');
    Route::patch('/courses/{course}', [CourseController::class, 'update'])->middleware('can:edit courses');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('can:delete courses');

    Route::get('/enrollments', [EnrollmentController::class, 'index'])->middleware('can:view enrollments');
    Route::get('/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->middleware('can:view enrollments');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->middleware('can:create enrollments');
    Route::put('/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->middleware('can:edit enrollments');
    Route::patch('/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->middleware('can:edit enrollments');
    Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->middleware('can:delete enrollments');
});