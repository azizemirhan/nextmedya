<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function index(Task $task)
    {
        return $task->comments()->with('user')->latest()->paginate(20);
    }

    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'body' => 'required|string',
            'mentions' => 'array'
        ]);
        $comment = $task->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
            'mentions' => $data['mentions'] ?? []
        ]);

        // sayaç + log
        $task->increment('comments_count');
        $task->activityLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'commented',
            'payload' => ['comment_id' => $comment->id]
        ]);

        return response()->json($comment->load('user'), 201);
    }

    public function update(Request $request, TaskComment $comment)
    {
        $this->authorize('update', $comment); // istersen policy
        $data = $request->validate(['body' => 'required|string']);
        $comment->update($data);
        return $comment->fresh('user');
    }

    public function destroy(TaskComment $comment)
    {
        $task = $comment->task;
        $comment->delete();
        $task->decrement('comments_count');
        $task->activityLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'comment_deleted',
            'payload' => ['comment_id' => $comment->id]
        ]);
        return response()->noContent();
    }
}
