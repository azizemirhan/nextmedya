<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DraftController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;


Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::middleware('is_admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/drafts', [DraftController::class, 'upsert'])->name('drafts.upsert');      // oluştur/güncelle
    Route::get('/drafts/{draftKey}', [DraftController::class, 'get'])->name('drafts.get');            // getir
    Route::delete('/drafts/{draftKey}', [DraftController::class, 'destroy'])->name('drafts.destroy'); // sil
    Route::post('accounts/{id}/restore', [AccountController::class, 'restore'])->name('accounts.restore');
    Route::delete('accounts/{id}/force-delete', [AccountController::class, 'forceDelete'])->name('accounts.forceDelete');
    Route::post('accounts/upload', [AccountController::class, 'upload'])->name('accounts.upload');
    Route::get('accounts/preview/{id}', [AccountController::class, 'preview'])->name('accounts.preview');
    Route::resource('accounts', AccountController::class)->except('show');
    Route::get('contacts/{contact}/export-pdf', [\App\Http\Controllers\Admin\ContactController::class, 'exportPdf'])->name('contacts.exportPdf');
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->except(['show']);
    Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('posts/bulk-action', [PostController::class, 'bulkAction'])->name('posts.bulkAction');
    Route::get('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::post('editor/upload-image', [PostController::class, 'uploadEditorImage'])->name('editor.uploadImage');
    Route::resource('posts', PostController::class);
    Route::post('categories/update-status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::post('categories/bulk-action', [CategoryController::class, 'bulkAction'])->name('categories.bulkAction');
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::view('/tasks', 'admin.tasks.index')->name('tasks.index');
    Route::resource('boards', \App\Http\Controllers\Admin\BoardController::class)->except(['delete']);;

    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::get('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('asdaspdm1232058193412319123ki13p21s3o1dsadasdas', [\App\Http\Controllers\Admin\TerminalController::class, 'index'])->name('terminal.index');

    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/lock', function() {
        session(['locked' => true]);
        return redirect()->route('lock-screen');
    })->name('lock');

    Route::prefix('api')->group(function () {

        Route::post('/terminal/execute', [\App\Http\Controllers\Admin\TerminalController::class, 'execute'])->name('api.terminal.execute');

        Route::post('lists', [\App\Http\Controllers\Admin\TaskListController::class, 'store'])->name('api.lists.store'); // Bu satırı ekle
        Route::get('tasks/{task}', [\App\Http\Controllers\Admin\TaskController::class, 'show'])->name('api.tasks.show');
        Route::put('tasks/{task}', [\App\Http\Controllers\Admin\TaskController::class, 'update'])->name('api.tasks.update');
        Route::delete('lists/{list}', [\App\Http\Controllers\Admin\TaskListController::class, 'destroy'])->name('api.lists.destroy');

        Route::delete('boards/{board}', [\App\Http\Controllers\Admin\BoardController::class, 'destroy'])->name('api.boards.destroy');
        Route::get('/boards', [\App\Http\Controllers\Admin\BoardController::class, 'index'])->name('api.boards.index');
        Route::get('/boards/{board}', [\App\Http\Controllers\Admin\BoardController::class, 'show'])->name('api.boards.show');
        Route::post('/tasks', [\App\Http\Controllers\Admin\TaskController::class, 'store'])->name('api.tasks.store');
        Route::patch('/tasks/{task}/move', [\App\Http\Controllers\Admin\TaskController::class, 'move'])->name('api.tasks.move');
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('api.users.index');
    });

});
