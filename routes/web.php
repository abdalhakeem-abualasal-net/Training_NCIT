<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard',[CourseController::class,'show'])->name('dashboard')->middleware('auth');
Route::get('/courses',[CourseController::class,'myCourses'])->name('courses')->middleware('auth');
Route::get('/users',[UserController::class,'showUsers'])->name('allusers');
Route::post('/deleteusers', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::post('/updateUserRole', [UserController::class, 'updateUserRole'])->name('updateUserRole');


Route::post('/addCourse', [CourseController::class , 'addCourse'])->name('addCourse');
Route::post('/deleteCourse', [CourseController::class , 'deleteCourse'])->name('deleteCourse');
Route::post('/enrollCourse/{course}', [CourseController::class, 'enrollCourse'])->name('enrollCourse');
Route::post('/leave-course/{course}', [CourseController::class, 'leaveCourse'])->name('leaveCourse');
Route::post('/updateCourse', [CourseController::class,'updateCourse'])->name('updateCourse');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
