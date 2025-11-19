<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Api\SeoAnalysisController;

Route::prefix('admin/api')->middleware(['web', 'auth:admin'])->group(function () {
    Route::post('/seo-analysis', [SeoAnalysisController::class, 'liveAnalysis'])
        ->name('admin.api.seo.analysis');
    Route::post('/serp-preview', [SeoAnalysisController::class, 'serpPreview'])
        ->name('admin.api.serp.preview');
});