<?php

namespace App\Http\Controllers\Admin;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    public function index()
    {
        // --- GEÇİCİ OLARAK TÜM BOARD'LARI GETİR ---
        $boards = Board::query()
            ->select('id', 'name', 'visibility')
            ->orderBy('name')
            ->get();

        return response()->json($boards);
    }

    public function create()
    {
        return view('admin.boards.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visibility' => 'in:private,team,public'
        ]);
        $board = Board::create([
            'owner_id' => auth()->guard('admin')->id(),
            ...$data
        ]);
        return redirect()->route('admin.tasks.index');
    }

    public function show(Board $board)
    {
        // 'lists.tasks' ile hem listeleri hem de her listeye ait görevleri tek sorguda yüklüyoruz.
        return $board->load('lists.tasks');
    }

    public function edit(Board $board)
    {
        // Yetkilendirme kontrolü (isteğe bağlı ama önerilir)
        // $this->authorize('update', $board);

        return view('admin.boards.edit', compact('board'));
    }

    // GÜNCELLENDİ: Formdan gelen veriyi günceller ve geri yönlendirir
    public function update(Request $request, Board $board)
    {
        // $this->authorize('update', $board);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'visibility' => 'in:private,team,public'
        ]);

        $board->update($data);

        return redirect()->route('admin.tasks.index')->with('success', 'Pano başarıyla güncellendi!');
    }

    public function destroy(Board $board)
    {
        $this->authorize('delete', $board);
        $board->delete();
        return response()->noContent();
    }
}
