<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskLabelController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $data = $request->validate(['label_id' => 'required|exists:labels,id']);
        $label = Label::findOrFail($data['label_id']);
        // pano güvenliği: aynı board’a ait olmalı
        abort_unless($label->board_id === $task->board_id, 422);
        $task->labels()->syncWithoutDetaching([$label->id]);
        return response()->json(['ok' => true]);
    }

    public function destroy(Task $task, Label $label)
    {
        $task->labels()->detach($label->id);
        return response()->noContent();
    }
}
