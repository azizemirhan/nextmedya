<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('admin/panel', [AdminController::class, 'dashboard'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::get('admin/blogs/', [BlogController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.blog.index');
Route::get('admin/posts/create', [BlogController::class, 'create'])->middleware(['auth', 'role:admin'])->name('admin.posts.create');
Route::post('admin/posts', [BlogController::class, 'store'])->middleware(['auth', 'role:admin'])->name('admin.posts.store');
Route::post('admin/posts/upload-image', [PostController::class, 'uploadImage'])->middleware(['auth', 'role:admin'])->name('admin.posts.uploadImage');

Route::get('admin/posts/edit/{post}', [BlogController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('admin.posts.edit');
Route::put('admin/posts/update/{id}', [BlogController::class, 'update'])->middleware(['auth', 'role:admin'])->name('admin.posts.update');
Route::delete('admin/posts/destroy/{id}', [BlogController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('admin.posts.destroy');


Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');

