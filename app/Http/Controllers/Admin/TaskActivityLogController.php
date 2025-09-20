<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskActivityLogController extends Controller
{
    public function index(Task $task)
    {
        return $task->activityLogs()->latest()->paginate(50);
    }

    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'action' => 'required|string|max:100',
            'payload' => 'array'
        ]);
        $log = $task->activityLogs()->create([
            'user_id' => auth()->id(),
            'action' => $data['action'],
            'payload' => $data['payload'] ?? []
        ]);
        return response()->json($log, 201);
    }
}
