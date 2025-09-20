<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskChecklistController extends Controller
{
    public function index(Task $task)
    {
        return $task->checklists()->with('items')->orderBy('position')->get();
    }

    public function store(Request $request, Task $task)
    {
        $data = $request->validate(['title' => 'required|string|max:255']);
        $pos = $task->checklists()->max('position') + 1;
        $checklist = $task->checklists()->create([
            'title' => $data['title'],
            'position' => $pos,
        ]);
        $task->refresh()->update([
            'check_items_count' => $task->checklists()->sum('items_count'),
            'check_items_done_count' => $task->checklists()->sum('items_done_count'),
        ]);
        return response()->json($checklist, 201);
    }

    public function update(Request $request, Checklist $checklist)
    {
        $data = $request->validate(['title' => 'required|string|max:255']);
        $checklist->update($data);
        return $checklist;
    }

    public function destroy(Checklist $checklist)
    {
        $task = $checklist->task;
        $checklist->delete();
        // sayaçları güncelle
        $task->update([
            'check_items_count' => $task->checklists()->sum('items_count'),
            'check_items_done_count' => $task->checklists()->sum('items_done_count'),
        ]);
        return response()->noContent();
    }
}
