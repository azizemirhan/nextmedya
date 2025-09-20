<?php

use App\Http\Controllers\Admin\TaskAssigneeController;
use App\Http\Controllers\Admin\TaskLabelController;
use App\Http\Controllers\Admin\TaskCommentController;
use App\Http\Controllers\Admin\TaskAttachmentController;
use App\Http\Controllers\Admin\TaskChecklistController;
use App\Http\Controllers\Admin\TaskChecklistItemController;
use App\Http\Controllers\Admin\TaskWatcherController;
use App\Http\Controllers\Admin\TaskRelationController;
use App\Http\Controllers\Admin\TaskActivityLogController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    // Atama & Etiket
    Route::post('tasks/{task}/assignees', [TaskAssigneeController::class, 'store']);
    Route::delete('tasks/{task}/assignees/{user}', [TaskAssigneeController::class, 'destroy']);

    Route::post('tasks/{task}/labels', [TaskLabelController::class, 'store']);
    Route::delete('tasks/{task}/labels/{label}', [TaskLabelController::class, 'destroy']);

    // Yorum
    Route::get('tasks/{task}/comments', [TaskCommentController::class, 'index']);
    Route::post('tasks/{task}/comments', [TaskCommentController::class, 'store']);
    Route::put('comments/{comment}', [TaskCommentController::class, 'update']);
    Route::delete('comments/{comment}', [TaskCommentController::class, 'destroy']);

    // Ek dosya
    Route::get('tasks/{task}/attachments', [TaskAttachmentController::class, 'index']);
    Route::post('tasks/{task}/attachments', [TaskAttachmentController::class, 'store']);
    Route::delete('attachments/{attachment}', [TaskAttachmentController::class, 'destroy']);

    // Checklist & item
    Route::get('tasks/{task}/checklists', [TaskChecklistController::class, 'index']);
    Route::post('tasks/{task}/checklists', [TaskChecklistController::class, 'store']);
    Route::put('checklists/{checklist}', [TaskChecklistController::class, 'update']);
    Route::delete('checklists/{checklist}', [TaskChecklistController::class, 'destroy']);

    Route::post('checklists/{checklist}/items', [TaskChecklistItemController::class, 'store']);
    Route::put('checklist-items/{item}', [TaskChecklistItemController::class, 'update']);
    Route::delete('checklist-items/{item}', [TaskChecklistItemController::class, 'destroy']);

    // Watchers
    Route::post('tasks/{task}/watchers', [TaskWatcherController::class, 'store']);
    Route::delete('tasks/{task}/watchers/{user}', [TaskWatcherController::class, 'destroy']);

    // Görev ilişkileri
    Route::get('tasks/{task}/relations', [TaskRelationController::class, 'index']);
    Route::post('tasks/{task}/relations', [TaskRelationController::class, 'store']);
    Route::delete('task-relations/{relation}', [TaskRelationController::class, 'destroy']);

    // Aktivite log – yalnızca listeleme/manuel log ekleme (opsiyonel)
    Route::get('tasks/{task}/activity', [TaskActivityLogController::class, 'index']);
    Route::post('tasks/{task}/activity', [TaskActivityLogController::class, 'store']); // istersen kapat
    Route::get('/columns/{column}/tasks', [\App\Http\Controllers\Admin\TaskController::class, 'listByColumn']);



});
