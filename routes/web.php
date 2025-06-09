<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/register', [AuthController::class, 'register'])->name('register.get');
Route::Post('/register', [AuthController::class, 'registerStor'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login.get');
Route::post('/login', [AuthController::class, 'loginStor'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/posts', [DashboardController::class, 'ownPost'])->name('dashboard.posts');

    Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('posts.create.get');
    Route::post('/dashboard/posts/create', [PostController::class, 'store'] )->name('posts.create.post');

    Route::get('/dashboard/posts/{id}/edit', [PostController::class, 'edit'])->name(('posts.edit.get'));
    Route::patch('/dashboard/posts/{id}/edit', [PostController::class, 'update'])->name('posts.edit.post');

    Route::delete('/dashboard/posts/{id}/delete', [PostController::class, 'delete'])->name('posts.delete');

    Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

// 
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile/picture', [UserController::class, 'profilePicture'])->name('profile.picture');
    Route::get('/profile/update', [UserController::class, 'editBio'])->name('profile.editBio');
    Route::patch('/profile/update', [UserController::class, 'bioUpdate'])->name('profile.bioUpdate');

});


Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dashboard/categories', [CategoryController::class, 'show'])->name('categories.show');
    
    Route::get('/admin/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create.get');
    Route::post('/admin/dashboard/categories/create', [CategoryController::class, 'store'])->name('categories.create.post');
    
    Route::get('/admin/dashboard/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit.get');
    Route::patch('/admin/dashboard/categories/{id}/edit', [CategoryController::class, 'update'])->name('categories.edit.post');
   
    Route::delete('/admin/dashboard/categories/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    
    Route::get('/admin/users', [UserController::class, 'users'])->name('admin.users');
});