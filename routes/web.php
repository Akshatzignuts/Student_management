<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get(
    '/dashboard',
    [AcademyController::class, 'display']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => '/course'], function () {
        Route::get('/', [AcademyController::class, 'course'])->name('academy.course');
        Route::post('/add', [AcademyController::class, 'add'])->name('addcourse');
        Route::get('/edit/{id}', [AcademyController::class, 'edit']);
        Route::post('/edit/{id}', [AcademyController::class, 'update']);
        Route::get('/delete/{id}', [AcademyController::class, 'delete']);
        Route::get('/view/', [AcademyController::class, 'view']);
    });

    Route::group(['prefix' => '/student'], function () {
        Route::get('/', [StudentController::class, 'student'])->name('student');
        Route::post('/add', [StudentController::class, 'add'])->name('addstudent');
        Route::get('/display', [StudentController::class, 'displayStudent'])->name('students');
        Route::get('/delete/{id}', [StudentController::class, 'delete']);
        Route::get('/edit/{id}', [StudentController::class, 'edit']);
        Route::post('/edited/{id}', [StudentController::class, 'update']);
    });


    Route::group(['prefix' => '/teacher'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('teacher');
        Route::post('/add', [StudentController::class, 'add'])->name('addteacher');
        Route::get('/display', [StudentController::class, 'displayTeacher'])->name('teacherdisplay');
        Route::get('/edit/{id}', [studentController::class, 'edit']);
        Route::post('/edited/{id}', [StudentController::class, 'update']);
        Route::get('/delete/{id}', [StudentController::class,  'delete']);
    });

    Route::get('/send-mail', [SendMailController::class, 'index']);
});
require __DIR__ . '/auth.php';
