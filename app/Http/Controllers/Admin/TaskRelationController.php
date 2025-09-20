<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskRelationController extends Controller
{
    public function index(Task $task)
    {
        return $task->relations()->with('relatedTask')->get();
    }

    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'related_task_id' => 'required|exists:tasks,id|different:task.id',
            'type' => 'required|string|in:blocks,blocked_by,duplicates,relates'
        ]);
        // Aynı board’da olma kontrolü
        abort_unless(Task::find($data['related_task_id'])->board_id === $task->board_id, 422);

        $rel = $task->relations()->firstOrCreate($data);
        return response()->json($rel, 201);
    }

    public function destroy(TaskRelation $relation)
    {
        $relation->delete();
        return response()->noContent();
    }
}
