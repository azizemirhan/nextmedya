<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::middleware('is_admin')->group(function () {

    Route::post('/clear-all-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return back()->with('success', 'Tüm uygulama önbelleği başarıyla temizlendi.');
    })->name('bar.clearCache');

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

    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::get('permissions', [\App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/anasayfa-yonetimi', [HomepageController::class, 'index'])->name('homepage.index');

    Route::get('/sliders/trash', [SliderController::class, 'trash'])->name('sliders.trash');
    Route::post('/sliders/{id}/restore', [SliderController::class, 'restore'])->name('sliders.restore');
    Route::delete('/sliders/{id}/force-delete', [SliderController::class, 'forceDelete'])->name('sliders.forceDelete');
    Route::resource('sliders', SliderController::class);

    Route::get('projects-trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::post('projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.forceDelete');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project'
    ]);

    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class)->parameters([
        'testimonials' => 'testimonial'
    ]);

    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::post('/menus/{menu}/placement', [\App\Http\Controllers\Admin\MenuController::class, 'updatePlacement'])->name('menus.placement');
    Route::post('/menus/items', [\App\Http\Controllers\Admin\MenuItemController::class, 'store'])->name('menus.items.store');
    Route::put('/menus/items/{item}', [\App\Http\Controllers\Admin\MenuItemController::class, 'update'])->name('menus.items.update');
    Route::delete('/menus/items/{item}', [\App\Http\Controllers\Admin\MenuItemController::class, 'destroy'])->name('menus.items.destroy');
    Route::post('/update', [\App\Http\Controllers\Admin\MenuItemController::class, 'syncTree'])->name('menus.update');
    Route::get('/menus/pages', [\App\Http\Controllers\Admin\MenuController::class, 'pages'])->name('menus.pages');
    Route::get('/menus/services', [App\Http\Controllers\Admin\MenuController::class, 'services'])->name('menus.services');
    Route::post('/menus', [\App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('menus.index');              // GET  /admin/menus

    Route::post('pages/reorder-sections', [\App\Http\Controllers\Admin\PageController::class, 'reorderSections'])
        ->name('pages.reorder-sections');

    Route::post('pages/sections/{section}/toggle-status', [\App\Http\Controllers\Admin\PageController::class, 'toggleStatus'])
        ->where('section', '[0-9]+')
        ->name('pages.sections.toggleStatus');

    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);

    Route::post('services/editor/upload-image', [\App\Http\Controllers\Admin\ServiceController::class, 'uploadEditorImage'])->name('services.editor.uploadImage');
    Route::get('services/trash', [\App\Http\Controllers\Admin\ServiceController::class, 'trash'])->name('services.trash');
    Route::post('services/bulk-action', [\App\Http\Controllers\Admin\ServiceController::class, 'bulkAction'])->name('services.bulkAction');
    Route::get('services/{id}/restore', [\App\Http\Controllers\Admin\ServiceController::class, 'restore'])->name('services.restore');
    Route::delete('services/{id}/force-delete', [\App\Http\Controllers\Admin\ServiceController::class, 'forceDelete'])->name('services.forceDelete');
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->except(['show']);

    Route::get('/media', [\App\Http\Controllers\Admin\MediaController::class, 'index'])->name('media.index');
    Route::get('/media/api/list', [\App\Http\Controllers\Admin\MediaController::class, 'apiList'])->name('admin.media.list');
    Route::get('/media/folders', [\App\Http\Controllers\Admin\MediaController::class, 'folders'])->name('media.folders');
    Route::post('/media/folders', [\App\Http\Controllers\Admin\MediaController::class, 'createFolder'])->name('media.folders.create');
    Route::get('/media/collections', [\App\Http\Controllers\Admin\MediaController::class, 'collections'])->name('media.collections');
    Route::get('/media/{id}', [\App\Http\Controllers\Admin\MediaController::class, 'show'])->name('media.show');
    Route::post('/media/upload', [\App\Http\Controllers\Admin\MediaController::class, 'upload'])->name('media.upload');
    Route::put('/media/{id}', [\App\Http\Controllers\Admin\MediaController::class, 'update'])->name('media.update');
    Route::post('/media/bulk-action', [\App\Http\Controllers\Admin\MediaController::class, 'bulkAction'])->name('media.bulkAction');
    Route::delete('/media/{id}', [\App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
    Route::delete('/media/{id}/force', [\App\Http\Controllers\Admin\MediaController::class, 'forceDelete'])->name('media.forceDelete');
    Route::get('/media/{id}/temporary-url', [\App\Http\Controllers\Admin\MediaController::class, 'temporaryUrl'])->name('media.temporaryUrl');

    Route::get('settings/generate-sitemap', [\App\Http\Controllers\Admin\SettingController::class, 'generateSitemap'])->name('settings.generateSitemap');
    Route::post('/settings/languages', [App\Http\Controllers\Admin\SettingController::class, 'updateLanguages'])->name('settings.languages.update');

    Route::get('/contactforms', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contactforms.index');
    Route::get('/contactforms/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contactforms.show');
    Route::post('/contactforms/{id}/read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'read'])->name('contactforms.read');
    Route::delete('/contactforms/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contactforms.destroy');

    // export opsiyonel
    Route::get('/contactforms/contacts-export', [\App\Http\Controllers\Admin\ContactMessageController::class, 'export'])->name('contactforms.export');

    Route::get('/subscribers', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'index'])
        ->name('subscribers.index');

    Route::get('/subscribers-export', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'export'])
        ->name('subscribers.export');

    Route::post('/subscribers/{id}/unsubscribe', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'unsubscribe'])
        ->name('subscribers.unsubscribe');

    Route::post('/subscribers/{id}/resubscribe', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'resubscribe'])
        ->name('subscribers.resubscribe');

    Route::delete('/subscribers/{id}', [\App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'destroy'])
        ->name('subscribers.destroy');

    Route::get('/api/online-users', [\App\Http\Controllers\Admin\DashboardController::class, 'getOnlineUsers'])->name('api.onlineUsers');

    Route::get('/mailbox', [\App\Http\Controllers\Admin\MailController::class, 'index'])->name('mailbox.index');
    Route::get('/mailbox/sent', [\App\Http\Controllers\Admin\MailController::class, 'sent'])->name('mailbox.sent');
    Route::get('/mailbox/compose', [\App\Http\Controllers\Admin\MailController::class, 'create'])->name('mailbox.compose');
    Route::get('/mailbox/important', [\App\Http\Controllers\Admin\MailController::class, 'important'])->name('mailbox.important');
    Route::get('/mailbox/trash', [\App\Http\Controllers\Admin\MailController::class, 'trash'])->name('mailbox.trash');
    Route::post('/mailbox/send', [\App\Http\Controllers\Admin\MailController::class, 'store'])->name('mailbox.send');
    Route::get('/mailbox/{mail}', [\App\Http\Controllers\Admin\MailController::class, 'show'])->name('mailbox.show');
    Route::delete('/mailbox/{mail}', [\App\Http\Controllers\Admin\MailController::class, 'destroy'])->name('mailbox.destroy');
    Route::post('/mailbox/{id}/restore', [\App\Http\Controllers\Admin\MailController::class, 'restore'])->name('mailbox.restore');
    Route::delete('/mailbox/{id}/force-delete', [\App\Http\Controllers\Admin\MailController::class, 'forceDelete'])->name('mailbox.forceDelete');
    Route::post('/mailbox/{mail}/toggle-important', [\App\Http\Controllers\Admin\MailController::class, 'toggleImportant'])->name('mailbox.toggleImportant');

    Route::get('/chat', [\App\Http\Controllers\Admin\AdminChatController::class, 'index'])->name('admin.chat');
    Route::get('/chat/session/{id}', [\App\Http\Controllers\Admin\AdminChatController::class, 'getSession']);
    Route::post('/chat/session/{id}/send', [\App\Http\Controllers\Admin\AdminChatController::class, 'sendMessage']);
    Route::post('/chat/session/{id}/close', [\App\Http\Controllers\Admin\AdminChatController::class, 'closeSession']);

    Route::prefix('api')
        ->middleware(['auth:admin']) // 'web' middleware zaten RouteServiceProvider'dan geliyor
        ->name('api.') // Rota isimleri admin.api.
        ->group(function () {

            Route::post('/seo-analysis', [\App\Http\Controllers\Admin\Api\SeoAnalysisController::class, 'liveAnalysis'])
                ->name('seo.analysis'); // Rota adı: admin.api.seo.analysis

            Route::post('/serp-preview', [\App\Http\Controllers\Admin\Api\SeoAnalysisController::class, 'serpPreview'])
                ->name('serp.preview'); // Rota adı: admin.api.serp.preview
        });

    Route::prefix('security/recaptcha')->name('security.recaptcha.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\RecaptchaSecurityController::class, 'index'])->name('dashboard');
        Route::get('/{id}', [\App\Http\Controllers\Admin\RecaptchaSecurityController::class, 'show'])->name('show');
        Route::post('/block-ip', [\App\Http\Controllers\Admin\RecaptchaSecurityController::class, 'blockIp'])->name('block-ip');

        // API endpoints (AJAX için)
        Route::get('/api/stats', [\App\Http\Controllers\Admin\RecaptchaSecurityController::class, 'apiStats'])->name('api.stats');
    });

    Route::get(' / lock', function () {
        session(['locked' => true]);

        return redirect()->route('lock-screen');
    })->name('lock');

});