<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskChecklistItemController extends Controller
{
    public function store(Request $request, Checklist $checklist)
    {
        $data = $request->validate(['text' => 'required|string|max:1000']);
        $pos = $checklist->items()->max('position') + 1;

        $item = $checklist->items()->create([
            'text' => $data['text'],
            'position' => $pos
        ]);

        $checklist->increment('items_count');
        $task = $checklist->task;
        $task->increment('check_items_count');

        return response()->json($item, 201);
    }

    public function update(Request $request, ChecklistItem $item)
    {
        $data = $request->validate([
            'text' => 'sometimes|string|max:1000',
            'is_done' => 'sometimes|boolean'
        ]);

        $before = $item->is_done;
        $item->update($data);

        if (array_key_exists('is_done', $data) && $data['is_done'] != $before) {
            $checklist = $item->checklist;
            $task = $checklist->task;

            if ($data['is_done']) {
                $checklist->increment('items_done_count');
                $task->increment('check_items_done_count');
            } else {
                $checklist->decrement('items_done_count');
                $task->decrement('check_items_done_count');
            }
        }

        return $item->fresh();
    }

    public function destroy(ChecklistItem $item)
    {
        $checklist = $item->checklist;
        $task = $checklist->task;

        // sayaçlar
        if ($item->is_done) {
            $checklist->decrement('items_done_count');
            $task->decrement('check_items_done_count');
        }
        $checklist->decrement('items_count');
        $task->decrement('check_items_count');

        $item->delete();

        return response()->noContent();
    }
}
