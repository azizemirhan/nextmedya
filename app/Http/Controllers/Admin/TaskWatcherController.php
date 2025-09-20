<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskWatcherController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $data = $request->validate(['user_id' => 'required|exists:users,id']);
        $task->watchers()->firstOrCreate(['user_id' => $data['user_id']]);
        return response()->json(['ok' => true]);
    }

    public function destroy(Task $task, User $user)
    {
        $task->watchers()->where('user_id', $user->id)->delete();
        return response()->noContent();
    }
}
