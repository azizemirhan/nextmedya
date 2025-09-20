<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    // Olması gereken doğru kod bu şekilde:
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'board_id' => 'required|exists:boards,id',
        ]);

        // O board'daki mevcut en yüksek position değerini buluyoruz.
        $maxPosition = TaskList::where('board_id', $data['board_id'])->max('position');

        // Yeni position değerini, bulunan en yüksek değerin bir fazlası olarak hesaplıyoruz.
        $newPosition = ($maxPosition === null) ? 0 : $maxPosition + 1;

        // Yeni listeyi, tüm doğru verilerle birlikte oluşturuyoruz.
        $list = TaskList::create([
            'name' => $data['name'],
            'board_id' => $data['board_id'],
            'position' => $newPosition,
        ]);

        return response()->json($list, 201);
    }

    public function destroy(TaskList $list)
    {
        $list->delete();
        // BOŞ CEVAP YERİNE, İÇİNDE MESAJ OLAN BİR JSON GÖNDERELİM
        return response()->json(['message' => 'List deleted successfully.']);
    }
}
