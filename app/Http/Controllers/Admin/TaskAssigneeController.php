<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskAssigneeController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $data = $request->validate(['user_id' => 'required|exists:users,id']);
        $task->assignees()->syncWithoutDetaching([$data['user_id']]);
        return response()->json(['ok'=>true]);
    }

    public function destroy(Task $task, User $user)
    {
        $task->assignees()->detach($user->id);
        return response()->noContent();
    }
}
