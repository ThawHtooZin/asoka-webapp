<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardArticleCategoryController;
use App\Http\Controllers\DashboardArticleController;
use App\Http\Controllers\DashboardChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCourseCategoryController;
use App\Http\Controllers\DashboardCourseController;
use App\Http\Controllers\DashboardElibraryController;
use App\Http\Controllers\DashboardRequestController;
use App\Http\Controllers\DashboardVideoController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('index');
});
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);

// Courses
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']); // Show all courses

    // This should be a separate route group, applying middleware correctly
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/{id}/show', [CourseController::class, 'show']); // Show a single course
        Route::get('/{id}/buy', [CourseController::class, 'buy']); // Buying a course
        Route::post('/{id}/buy', [CourseController::class, 'Purchase']); // Purchasing a course
        Route::get('/{course}/chapters/{chapter}/videos', [VideoController::class, 'chaptershow'])->name('chaptershow'); // Show all videos in a chapter
        Route::get('/{course}/chapters/{chapter}/videos/{video}', [VideoController::class, 'videoshow'])->name('videoshow'); // Show a specific video
        Route::get('/{course}/quiz/{quizzes}/questions/{question}', [QuestionController::class, 'questionshow'])->name('questionshow'); // Show a specific question
        Route::post('/{course}/quiz/{quiz}/questions/{question}/submit', [QuestionController::class, 'submitAnswer'])->name('submitquizanswer');
    });
});



// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index'); // Show all articles
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show'); // Show a specific article

// E-Library
Route::prefix('elibrary')->group(function () {
    Route::get('/', [LibraryController::class, 'index'])->name('elibrary.index'); // Show all books
    Route::get('/book/{id}', [LibraryController::class, 'show'])->name('elibrary.show'); // Show a specific book
    Route::get('/book/{id}/read', [LibraryController::class, 'read'])->name('elibrary.read'); // Read free book
    Route::get('/book/{id}/buy', [LibraryController::class, 'buy'])->name('elibrary.buy'); // Buy specific book
    Route::post('/process-payment', [LibraryController::class, 'processPayment'])->name('elibrary.processPayment'); // Process payment
    Route::get('/payment-success', [LibraryController::class, 'success'])->name('elibrary.success'); // Payment success page
});

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login'); // Show login form
    Route::post('/login', [LoginController::class, 'login']); // Process login
    Route::get('/register', [RegisterController::class, 'index']); // Show registration form
    Route::post('/register', [RegisterController::class, 'register']); // Process registration
});

// Authenticated User Routes
Route::middleware(['custom'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']); // Dashboard

        // User Management
        Route::get('users', [UserController::class, 'index'])->name('users.index'); // List users
        Route::post('users', [UserController::class, 'store'])->name('users.store'); // Store user
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update'); // Update user
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete user

        // Role Management
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index'); // List roles
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store'); // Store role
        Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update'); // Update role
        Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); // Delete role

        // Article Management
        Route::get('articles', [DashboardArticleController::class, 'index'])->name('articles.index'); // List articles
        Route::post('articles', [DashboardArticleController::class, 'store'])->name('articles.store'); // Store article
        Route::put('articles/{id}', [DashboardArticleController::class, 'update'])->name('articles.update'); // Update article
        Route::delete('articles/{id}', [DashboardArticleController::class, 'destroy'])->name('articles.destroy'); // Delete article

        // Article Categories Management
        Route::get('articles/categories', [DashboardArticleCategoryController::class, 'index']); // List Article Categories
        Route::post('articles/categories', [DashboardArticleCategoryController::class, 'store']); // Store Article Categories
        Route::put('articles/categories/{id}', [DashboardArticleCategoryController::class, 'update']); // Update Article Categories
        Route::delete('articles/categories/{id}', [DashboardArticleCategoryController::class, 'destroy']); // Delete Article Categories

        // Courses Management
        Route::get('courses', [DashboardCourseController::class, 'index'])->name('courses.index'); // List Courses
        Route::post('courses', [DashboardCourseController::class, 'store'])->name('courses.store'); // Store Courses
        Route::put('courses/{id}', [DashboardCourseController::class, 'update'])->name('courses.update'); // Update Courses
        Route::delete('courses/{id}', [DashboardCourseController::class, 'destroy'])->name('courses.destroy'); // Delete Courses

        // Course Categories Management
        Route::get('courses/categories', [DashboardCourseCategoryController::class, 'index']); // List Course Categories
        Route::post('courses/categories', [DashboardCourseCategoryController::class, 'store']); // Store Course Categories
        Route::put('courses/categories/{id}', [DashboardCourseCategoryController::class, 'update']); // Update Course Categories
        Route::delete('courses/categories/{id}', [DashboardCourseCategoryController::class, 'destroy']); // Delete Course Categories

        // Course Chapters Management
        Route::get('courses/chapters', [DashboardChapterController::class, 'index']); // List courses
        Route::post('courses/chapters', [DashboardChapterController::class, 'store']); // Store Chapters
        Route::put('courses/chapters/{id}', [DashboardChapterController::class, 'update']); // Update Chapters
        Route::delete('courses/chapters/{id}', [DashboardChapterController::class, 'destroy']); // Delete Chapters

        // Course Videos Management
        Route::get('courses/videos', [DashboardVideoController::class, 'index']); // List Course Videos
        Route::post('courses/videos', [DashboardVideoController::class, 'store']); // Store Course Videos
        Route::put('courses/videos/{id}', [DashboardVideoController::class, 'update']); // Update Course Videos
        Route::delete('courses/videos/{id}', [DashboardVideoController::class, 'destroy']); // Delete Course Videos

        // Course Purchase Request Management
        Route::get('/courses/request', [DashboardRequestController::class, 'index']); // List Course Requests
        Route::post('/courses/request/{id}/confirm', [DashboardRequestController::class, 'confirm']); // List Course Requests

        // E-Library Management
        Route::get('books', [DashboardElibraryController::class, 'index']); // List Library Book
        Route::post('books', [DashboardElibraryController::class, 'store']); // Store Library Book
        Route::put('books/{id}', [DashboardElibraryController::class, 'update']); // Update Library Book
        Route::delete('books/{id}', [DashboardElibraryController::class, 'destroy']); // Delete Library Book
    });
});
