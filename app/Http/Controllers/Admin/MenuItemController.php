<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    // MenuItemController store methodunda validation'ı güncelleyin
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'title' => 'required|array',
            'url' => 'nullable|string|max:500',
            'page_id' => 'nullable|exists:pages,id',
            'service_id' => 'nullable|exists:services,id', // Yeni alan
            'target' => 'nullable|in:_self,_blank',
            'classes' => 'nullable|string|max:255',
            'rel' => 'nullable|string|max:255',
        ]);

        // Order'ı belirleme
        $order = MenuItem::where('menu_id', $data['menu_id'])
                ->where('parent_id', $data['parent_id'])
                ->max('order') + 1;

        $item = MenuItem::create(array_merge($data, ['order' => $order]));

        return response()->json([
            'ok' => true,
            'item' => [
                'id' => $item->id,
                'title' => $item->title,
                'url' => $item->url,
                'page_id' => $item->page_id,
                'service_id' => $item->service_id, // Yeni alan
                'target' => $item->target,
                'classes' => $item->classes,
                'rel' => $item->rel,
                'order' => $item->order,
            ]
        ]);
    }
    public function update(Request $request, MenuItem $item)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'url' => 'nullable|string|max:500',
            'target' => 'nullable|in:_self,_blank',
            'classes' => 'nullable|string|max:255',
            'rel' => 'nullable|string|max:255',
        ]);

        $item->update($data);

        return response()->json([
            'ok' => true,
            'item' => [
                'id' => $item->id,
                'title' => $item->title,
                'url' => $item->url,
                'target' => $item->target,
                'classes' => $item->classes,
                'rel' => $item->rel,
            ]
        ]);
    }

    public function destroy(MenuItem $item)
    {
        // Alt öğeleri de sil
        $item->children()->delete();
        $item->delete();

        return response()->json(['ok' => true]);
    }

    public function syncTree(Request $request)
    {
        $payload = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:menu_items,id',
            'items.*.parent_id' => 'nullable|integer|exists:menu_items,id',
            'items.*.order' => 'required|integer',
        ]);

        DB::transaction(function () use ($payload) {
            foreach ($payload['items'] as $row) {
                MenuItem::whereKey($row['id'])->update([
                    'parent_id' => $row['parent_id'] ?? null,
                    'order'     => $row['order'],
                ]);
            }
        });

        return response()->json(['ok' => true]);
    }
}
