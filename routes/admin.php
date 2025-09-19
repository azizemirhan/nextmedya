<?php

// routes/admin.php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DraftController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Bunu sonradan oluşturacağız

// Giriş Formu
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

// Giriş yapıldıktan sonra erişilecek sayfalar (Middleware ile korunacak)
Route::middleware('is_admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // MÜŞTERİ YÖNETİMİ (CRM)

    Route::post('/drafts', [DraftController::class, 'upsert'])->name('drafts.upsert');      // oluştur/güncelle
    Route::get('/drafts/{draftKey}', [DraftController::class, 'get'])->name('drafts.get');            // getir
    Route::delete('/drafts/{draftKey}', [DraftController::class, 'destroy'])->name('drafts.destroy'); // sil

    Route::post('accounts/{id}/restore', [AccountController::class, 'restore'])->name('accounts.restore');
    Route::delete('accounts/{id}/force-delete', [AccountController::class, 'forceDelete'])->name('accounts.forceDelete');
    Route::post('accounts/upload', [AccountController::class, 'upload'])->name('accounts.upload');
    Route::get('accounts/preview/{id}', [AccountController::class, 'preview'])->name('accounts.preview');
    Route::resource('accounts', AccountController::class)->except('show');

    Route::resource('contacts', ContactController::class)->except(['show']);
    Route::resource('deals', DealController::class)->except(['show']);
    Route::resource('tasks', TaskController::class)->except(['show']);

    // PROJE YÖNETİMİ
    Route::resource('projects', ProjectController::class);
    Route::resource('invoices', InvoiceController::class);

    // BLOG YÖNETİMİ
    Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('posts/bulk-action', [PostController::class, 'bulkAction'])->name('posts.bulkAction');
    Route::get('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::post('editor/upload-image', [PostController::class, 'uploadEditorImage'])->name('editor.uploadImage');
    Route::resource('posts', PostController::class);

    // ÖNCE spesifik (özel) olan route'ları tanımlayın
    Route::post('categories/update-status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::post('categories/bulk-action', [CategoryController::class, 'bulkAction'])->name('categories.bulkAction');
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('tags', TagController::class)->except(['show']);

    // RAPORLAMA
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');

    // SİSTEM
    Route::resource('users', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

});
