<?php
namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'board_id'=>'required|exists:boards,id',
            'name'=>'required|string|max:255',
        ]);
        $position = TaskList::where('board_id',$data['board_id'])->max('position')+1;
        $list = TaskList::create([...$data,'position'=>$position]);
        return response()->json($list,201);
    }

    public function update(Request $request, TaskList $list)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $list->update($data);
        return $list;
    }

    public function destroy(TaskList $list)
    {
        $list->delete();
        return response()->noContent();
    }
}
