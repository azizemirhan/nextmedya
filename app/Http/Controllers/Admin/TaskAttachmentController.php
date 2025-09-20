<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskAttachmentController extends Controller
{
    public function index(Task $task)
    {
        return $task->attachments()->latest()->get();
    }

    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'file' => 'required|file|max:20480' // 20MB
        ]);

        $f = $data['file'];
        $path = $f->store("tasks/{$task->id}/attachments", 'public');

        $attachment = $task->attachments()->create([
            'user_id' => auth()->id(),
            'path' => $path,
            'original_name' => $f->getClientOriginalName(),
            'size' => $f->getSize(),
            'mime' => $f->getClientMimeType(),
        ]);

        $task->increment('attachments_count');
        $task->activityLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'attached',
            'payload' => ['attachment_id' => $attachment->id]
        ]);

        return response()->json($attachment, 201);
    }

    public function destroy(TaskAttachment $attachment)
    {
        $task = $attachment->task;
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();
        $task->decrement('attachments_count');

        $task->activityLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'attachment_deleted',
            'payload' => ['attachment_id' => $attachment->id]
        ]);

        return response()->noContent();
    }
}
