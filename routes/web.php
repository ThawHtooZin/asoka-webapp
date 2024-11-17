<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardAnnouncementController;
use App\Http\Controllers\DashboardArticleCategoryController;
use App\Http\Controllers\DashboardArticleController;
use App\Http\Controllers\DashboardBookCategoryController;
use App\Http\Controllers\DashboardChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCourseCategoryController;
use App\Http\Controllers\DashboardCourseController;
use App\Http\Controllers\DashboardElibraryController;
use App\Http\Controllers\DashboardRequestController;
use App\Http\Controllers\DashboardVideoController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

// 🌟 Public Routes - No login needed
Route::get('/', [HomePageController::class, 'index']); // Home sweet home!
Route::get('/logout', [LoginController::class, 'logout']); // Log out (GET method for quick links)
Route::post('/logout', [LoginController::class, 'logout']); // Log out (POST method for forms)

// 📚 Courses
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']); // Browse all courses

    // 🔒 Authenticated Routes for Courses
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/{id}/show', [CourseController::class, 'show']); // Peek into a single course
        Route::get('/{id}/buy', [CourseController::class, 'buy']); // Ready to buy this course?
        Route::post('/{id}/buy', [CourseController::class, 'Purchase']); // Confirm the purchase
        Route::get('/{course}/chapters/{chapter}/videos', [VideoController::class, 'chaptershow'])->name('chaptershow')->middleware('courseownershipmiddleware'); // Dive into chapter videos
        Route::get('/{course}/chapters/{chapter}/videos/{video}', [VideoController::class, 'videoshow'])->name('videoshow')->middleware('courseownershipmiddleware'); // Watch a specific video
        Route::get('/{course}/quiz/{quizzes}/questions/{question}', [QuestionController::class, 'questionshow'])->name('questionshow')->middleware('courseownershipmiddleware'); // Tackle a quiz question
        Route::post('/{course}/quiz/{quiz}/questions/{question}/submit', [QuestionController::class, 'submitAnswer'])->name('submitquizanswer')->middleware('courseownershipmiddleware'); // Submit your answer
    });
});

// 📰 Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index'); // Catch up on all articles
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show'); // Read a single article

// 📖 E-Library
Route::prefix('elibrary')->group(function () {
    Route::get('/', [LibraryController::class, 'index'])->name('elibrary.index'); // Browse the library
    Route::get('/book/{id}', [LibraryController::class, 'show'])->name('elibrary.show'); // Explore a book
    Route::get('/book/{id}/read', [LibraryController::class, 'read'])->name('elibrary.read')->middleware('auth', 'bookownershipmiddleware'); // Read if it's free
    Route::get('/book/{id}/buy', [LibraryController::class, 'buy'])->name('elibrary.buy')->middleware('auth'); // Buy this book
    Route::post('/book/{id}/buy', [LibraryController::class, 'purchase'])->middleware('auth'); // Confirm book purchase
});

// 📢 Announcements
Route::get('/announcement', [AnnouncementController::class, 'index']); // Stay updated!
Route::get('/announcement/{id}/show', [AnnouncementController::class, 'show']); // Detailed announcement

// 🔑 Authentication
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login'); // Login page
    Route::post('/login', [LoginController::class, 'login']); // Process login
    Route::get('/register', [RegisterController::class, 'index']); // Registration page
    Route::post('/register', [RegisterController::class, 'register']); // Sign up new users
});

// 👤 Authenticated User Dashboard
Route::middleware(['custom'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']); // Welcome to the dashboard!

        // 🙍‍♂️ User Management
        Route::get('users', [UserController::class, 'index'])->name('users.index'); // List all users
        Route::post('users', [UserController::class, 'store'])->name('users.store'); // Add new user
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update'); // Edit user
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Remove user

        // 🎭 Role Management
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index'); // List all roles
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store'); // Add new role
        Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update'); // Edit role
        Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); // Delete role

        // 📰 Article Management
        Route::get('articles', [DashboardArticleController::class, 'index'])->name('articles.index'); // All articles in admin view
        Route::post('articles', [DashboardArticleController::class, 'store'])->name('articles.store'); // Add new article
        Route::put('articles/{id}', [DashboardArticleController::class, 'update'])->name('articles.update'); // Edit article
        Route::delete('articles/{id}', [DashboardArticleController::class, 'destroy'])->name('articles.destroy'); // Remove article

        // 📚 Course Management
        Route::get('courses', [DashboardCourseController::class, 'index'])->name('courses.index'); // Admin view for courses
        Route::post('courses', [DashboardCourseController::class, 'store'])->name('courses.store'); // Add course
        Route::put('courses/{id}', [DashboardCourseController::class, 'update'])->name('courses.update'); // Edit course
        Route::delete('courses/{id}', [DashboardCourseController::class, 'destroy'])->name('courses.destroy'); // Remove course

        // 🚀 Announcement Management
        Route::get('announcements', [DashboardAnnouncementController::class, 'index']); // Admin announcement list
        Route::post('announcements', [DashboardAnnouncementController::class, 'store']); // Add new announcement
        Route::put('announcements/{id}', [DashboardAnnouncementController::class, 'update']); // Edit announcement
        Route::delete('announcements/{id}', [DashboardAnnouncementController::class, 'destroy']); // Remove announcement
    });
});
