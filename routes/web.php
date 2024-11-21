<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
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
use App\Http\Controllers\DashboardForumController;
use App\Http\Controllers\DashboardRequestController;
use App\Http\Controllers\DashboardVideoController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomePageController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);

// Profile
Route::get('profile', [ProfileController::class, 'index']);
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.index'); // Show Edit Profile
Route::put('profile/edit', [ProfileController::class, 'update'])->name('profile.update'); // Update Profile

// Courses
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index']); // Show all courses

    // This should be a separate route group, applying middleware correctly
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/{id}/show', [CourseController::class, 'show']); // Show a single course
        Route::get('/{id}/buy', [CourseController::class, 'buy']); // Buying a course
        Route::post('/{id}/buy', [CourseController::class, 'Purchase']); // Purchasing a course
        Route::get('/{course}/chapters/{chapter}/videos', [VideoController::class, 'chaptershow'])->name('chaptershow')->middleware('courseownershipmiddleware'); // Show all videos in a chapter
        Route::get('/{course}/chapters/{chapter}/videos/{video}', [VideoController::class, 'videoshow'])->name('videoshow')->middleware('courseownershipmiddleware'); // Show a specific video
        Route::get('/{course}/quiz/{quizzes}/questions/{question}', [QuestionController::class, 'questionshow'])->name('questionshow')->middleware('courseownershipmiddleware'); // Show a specific question
        Route::post('/{course}/quiz/{quiz}/questions/{question}/submit', [QuestionController::class, 'submitAnswer'])->name('submitquizanswer')->middleware('courseownershipmiddleware');
    });
});

Route::prefix('forum')->group(function () {
    // Forum home: List of all discussions/posts
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');

    // Create a new post/discussion
    Route::get('/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/store', [ForumController::class, 'store'])->name('forum.store');

    // View a single post/discussion
    Route::get('/{forum}', [ForumController::class, 'show'])->name('forum.show');

    // Edit a post/discussion
    Route::put('/{forum}', [ForumController::class, 'update'])->name('forum.update');

    // Delete a post/discussion
    Route::delete('/{forum}', [ForumController::class, 'destroy'])->name('forum.destroy');

    // Add a comment to a post
    Route::post('/{forum}/comments', [CommentController::class, 'store'])->name('forum.comments.store');

    // Update a comment of a post
    Route::put('/{forum}/comments/{comment}', [CommentController::class, 'update'])->name('forum.comments.update');

    // Delete a comment
    Route::delete('/{forum}/comments/{comment}', [CommentController::class, 'destroy'])->name('forum.comments.destroy');

    // Reply to a comment
    Route::post('/{forum}/comments/{comment}/replies', [ReplyController::class, 'store'])->name('forum.replies.store');

    Route::put('/{forum}/comments/{comment}/replies', [ReplyController::class, 'update'])->name('forum.replies.update');

    // Delete a reply
    Route::delete('/{forum}/comments/{comment}/replies', [ReplyController::class, 'destroy'])->name('forum.replies.destroy');
});



// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index'); // Show all articles
Route::middleware(['auth'])->group(function () {
    Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show'); // Show a specific article
});

// E-Library
Route::prefix('elibrary')->group(function () {
    Route::get('/', [LibraryController::class, 'index'])->name('elibrary.index'); // Show all books
    Route::middleware(['auth'])->group(function () {
        Route::get('/book/{id}', [LibraryController::class, 'show'])->name('elibrary.show'); // Show a specific book
        Route::get('/book/{id}/read', [LibraryController::class, 'read'])->name('elibrary.read')->middleware('auth', 'bookownershipmiddleware'); // Read free book
        Route::get('/book/{id}/buy', [LibraryController::class, 'buy'])->name('elibrary.buy')->middleware('auth'); // Buy specific book
        Route::post('/book/{id}/buy', [LibraryController::class, 'purchase'])->middleware('auth'); // Buy specific book
    });
});

// Announcement
Route::get('/announcement', [AnnouncementController::class, 'index']);
Route::get('/announcement/{id}/show', [AnnouncementController::class, 'show']);


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
        Route::get('articles/categories', [DashboardArticleCategoryController::class, 'index'])->name('articles.categories.index'); // List Article Categories
        Route::post('articles/categories', [DashboardArticleCategoryController::class, 'store'])->name('articles.categories.store'); // Store Article Categories
        Route::put('articles/categories/{id}', [DashboardArticleCategoryController::class, 'update'])->name('articles.categories.update'); // Update Article Categories
        Route::delete('articles/categories/{id}', [DashboardArticleCategoryController::class, 'destroy'])->name('articles.categories.destory'); // Delete Article Categories

        // Courses Management
        Route::get('courses', [DashboardCourseController::class, 'index'])->name('courses.index'); // List Courses
        Route::post('courses', [DashboardCourseController::class, 'store'])->name('courses.store'); // Store Courses
        Route::put('courses/{id}', [DashboardCourseController::class, 'update'])->name('courses.update'); // Update Courses
        Route::delete('courses/{id}', [DashboardCourseController::class, 'destroy'])->name('courses.destroy'); // Delete Courses

        // Course Categories Management
        Route::get('courses/categories', [DashboardCourseCategoryController::class, 'index'])->name('courses.categories.index'); // List Course Categories
        Route::post('courses/categories', [DashboardCourseCategoryController::class, 'store'])->name('courses.categories.store'); // Store Course Categories
        Route::put('courses/categories/{id}', [DashboardCourseCategoryController::class, 'update'])->name('courses.categories.update'); // Update Course Categories
        Route::delete('courses/categories/{id}', [DashboardCourseCategoryController::class, 'destroy'])->name('courses.categories.destory'); // Delete Course Categories

        // Course Chapters Management
        Route::get('courses/chapters', [DashboardChapterController::class, 'index'])->name('courses.chapter.index'); // List Chapters
        Route::post('courses/chapters', [DashboardChapterController::class, 'store'])->name('courses.chapter.store'); // Store Chapters
        Route::put('courses/chapters/{id}', [DashboardChapterController::class, 'update'])->name('courses.chapter.update'); // Update Chapters
        Route::delete('courses/chapters/{id}', [DashboardChapterController::class, 'destroy'])->name('courses.chapter.destory'); // Delete Chapters

        // Course Videos Management
        Route::get('courses/videos', [DashboardVideoController::class, 'index'])->name('course.videos.index'); // List Course Videos
        Route::post('courses/videos', [DashboardVideoController::class, 'store'])->name('course.videos.store'); // Store Course Videos
        Route::put('courses/videos/{id}', [DashboardVideoController::class, 'update'])->name('course.videos.update'); // Update Course Videos
        Route::delete('courses/videos/{id}', [DashboardVideoController::class, 'destroy'])->name('course.videos.destory'); // Delete Course Videos

        // Course Purchase Request Management
        Route::get('/courses/request', [DashboardRequestController::class, 'courseindex'])->name('courses.request.index'); // List Course Requests
        Route::post('/courses/request/{id}/confirm', [DashboardRequestController::class, 'courseconfirm'])->name('courses.request.confirm'); // Confirem Course Request
        Route::post('/courses/request/{id}/achive', [DashboardRequestController::class, 'courseachive'])->name('courses.request.achive'); // Achive Course Request

        // E-Library Management
        Route::get('books', [DashboardElibraryController::class, 'index'])->name('book.index'); // List Library Book
        Route::post('books', [DashboardElibraryController::class, 'store'])->name('book.store'); // Store Library Book
        Route::put('books/{id}', [DashboardElibraryController::class, 'update'])->name('book.update'); // Update Library Book
        Route::delete('books/{id}', [DashboardElibraryController::class, 'destroy'])->name('book.destory'); // Delete Library Book

        // Book Category Management
        Route::get('books/categories', [DashboardBookCategoryController::class, 'index'])->name('book.categories.index'); // List Book Category
        Route::post('books/categories', [DashboardBookCategoryController::class, 'store'])->name('book.categories.store'); // Store Book Category
        Route::put('books/categories/{id}', [DashboardBookCategoryController::class, 'update'])->name('book.categories.update'); // Update Book Category
        Route::delete('books/categories/{id}', [DashboardBookCategoryController::class, 'destroy'])->name('book.categories.destory'); // Delete Book Category

        // Book Purchase Request Management
        Route::get('/books/request', [DashboardRequestController::class, 'bookindex'])->name('book.request.index'); // List Book Requests
        Route::post('/books/request/{id}/confirm', [DashboardRequestController::class, 'bookconfirm'])->name('book.request.confirm'); // Book Confirm Requests
        Route::post('/books/request/{id}/achive', [DashboardRequestController::class, 'bookachive'])->name('book.request.achive'); // Book Achive Requests

        // Announcement Management
        Route::get('announcements', [DashboardAnnouncementController::class, 'index'])->name('announcement.index'); // List Announcement
        Route::post('announcements', [DashboardAnnouncementController::class, 'store'])->name('announcement.store'); // Store Announcement
        Route::put('announcements/{id}', [DashboardAnnouncementController::class, 'update'])->name('announcement.update'); // Update Announcement
        Route::delete('announcements/{id}', [DashboardAnnouncementController::class, 'destroy'])->name('announcement.destory'); // Delete Announcement

        // Forum Management
        Route::get('forums', [DashboardForumController::class, 'index'])->name('dashboard.forum.index'); // List Forums
        Route::put('forums/{id}', [DashboardForumController::class, 'update'])->name('dashboard.forum.update'); // Update Forum
        Route::delete('forums/{id}', [DashboardForumController::class, 'destroy'])->name('dashboard.forum.destory'); // Delete Forum
    });
});
