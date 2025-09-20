<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('assignees', 'labels')->latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'board_id' => 'required|exists:boards,id',
            'list_id' => 'required|exists:task_lists,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'in:low,normal,high,urgent',
            'due_at' => 'nullable|date'
        ]);
        $position = Task::where('list_id', $data['list_id'])->max('position') + 1;
        $task = Task::create([
            'creator_id' => auth()->id(),
            'status' => 'open',
            'position' => $position,
            ...$data
        ]);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        // user ilişkisi ile birlikte tüm detayları yüklüyoruz.
        return $task->load('assignees', 'labels', 'comments.user', 'attachments', 'checklists.items');
    }


    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|in:low,normal,high,urgent',
            'status' => 'sometimes|in:open,in_progress,done,archived',
            'due_at' => 'nullable|date'
        ]);

        $task->update($data);

        // Güncellenmiş ve tüm ilişkileriyle birlikte task'ı geri döndür.
        return $task->load('assignees', 'labels', 'comments.user', 'attachments', 'checklists.items');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }

    public function move(Request $request, Task $task)
    {
        $validated = $request->validate([
            'list_id' => 'required|exists:task_lists,id', // 'column_id' -> 'list_id' olarak ve tablo adı düzeltildi
            'position' => 'required|integer|min:0',
        ]);

        $oldListId = $task->list_id;
        $newListId = $validated['list_id'];

        DB::transaction(function () use ($task, $validated, $oldListId, $newListId) {
            // Task'ı yeni listeye ve pozisyona ata
            $task->updateQuietly([
                'list_id' => $newListId,
                'position' => $validated['position'],
            ]);

            // Diğer task'ları yeni listenin sonuna ekle
            DB::table('tasks')
                ->where('list_id', $newListId)
                ->where('id', '!=', $task->id)
                ->where('position', '>=', $validated['position'])
                ->increment('position');

            // Eğer task farklı bir listeden geldiyse, eski listedeki boşluğu kapat
            if ($oldListId != $newListId) {
                DB::table('tasks')
                    ->where('list_id', $oldListId)
                    ->where('position', '>', $task->getOriginal('position'))
                    ->decrement('position');
            }
        });

        return response()->json(['message' => 'Task moved successfully.']);
    }
    public function listByColumn($columnId)
    {
        $tasks = Task::where('column_id', $columnId)
            ->orderBy('position')
            ->get();

        return response()->json($tasks);
    }

}
