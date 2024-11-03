<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);
// Courses
Route::prefix('course')->group(function () {
    // Show All Courses
    Route::get('/', [CourseController::class, 'index']);
    // Show a single course
    Route::get('/{id}/show', [CourseController::class, 'show']);
    // Show a video from chapter
    Route::get('/{id}/chapter/{chapterid}/', [VideoController::class, 'chaptershow']);
    // Show a video
    Route::get('/{id}/chapter/{chapterid}/video/{videoid}', [VideoController::class, 'videoshow']);
});

// Articles
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/article/{id}', [ArticleController::class, 'show']);

// E-Library
Route::prefix('elibrary')->group(function () {
    // Route to display all books
    Route::get('/', [LibraryController::class, 'index'])->name('elibrary.index');

    // Route to show a specific book
    Route::get('/book/{id}', [LibraryController::class, 'show'])->name('elibrary.show');

    // Route to read free book
    Route::get('/book/{id}/read', [LibraryController::class, 'read'])->name('elibrary.show');

    // Route to show the buy page for a specific book
    Route::get('/book/{id}/buy', [LibraryController::class, 'buy'])->name('elibrary.buy');

    // Route to process the payment
    Route::post('/process-payment', [LibraryController::class, 'processPayment'])->name('elibrary.processPayment');

    // Route to show the success page after payment
    Route::get('/payment-success', [LibraryController::class, 'success'])->name('elibrary.success');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware(['custom'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);

        // User Resource
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destory']);

        // Role Resource
        Route::get('/roles', [RoleController::class, 'index']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::put('/roles/{id}', [RoleController::class, 'update']);
        Route::delete('/roles/{id}', [RoleController::class, 'destory']);
    });
});
