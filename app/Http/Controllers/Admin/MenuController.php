<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // DROPDOWN için tüm menüler
        $menus = Menu::orderBy('id')->get();

        // Seçili menü
        $menuId = $request->integer('menu');
        if ($menuId) {
            $menu = Menu::with(['items.children.children'])->findOrFail($menuId);
        } else {
            $menu = $menus->first();
            if (!$menu) {
                $menu = Menu::create([
                    'slug' => 'main-menu',
                    'name' => 'Primary Menu',
                    'placement' => 'header',
                ]);
            }
            $menu->load(['items.children.children']);
        }

        return view('admin.menus.index', compact('menus','menu'));
    }

    // Sol panel arama (kendi mevcut metodun varsa kullan)
    public function pages(Request $request)
    {
        $q = $request->string('q');
        $pages = Page::query()
            ->when($q, fn($x) => $x->where('slug','like',"%{$q}%"))
            ->orderByDesc('id')
            ->limit(50)
            ->get(['id','title','slug']);

        $locale = app()->getLocale();
        return response()->json($pages->map(function($p) use ($locale){
            $title = is_array($p->title) ? ($p->title[$locale] ?? reset($p->title)) : $p->title;
            return [
                'id'    => $p->id,
                'title' => $title,
                'slug'  => $p->slug,
                'url'   => url($p->slug),
            ];
        }));
    }

    public function services(Request $request)
    {
        $q = $request->string('q');
        $services = \App\Models\Service::query()
            ->when($q, fn($x) => $x->where('slug', 'like', "%{$q}%"))
            ->orderByDesc('id')
            ->limit(50)
            ->get(['id', 'title', 'slug']);

        $locale = app()->getLocale();
        return response()->json($services->map(function ($s) use ($locale) {
            $title = is_array($s->title) ? ($s->title[$locale] ?? reset($s->title)) : $s->title;
            return [
                'id' => $s->id,
                'title' => $title,
                'slug' => $s->slug,
                'url' => '/hizmetlerimiz/' . $s->slug, // veya hizmet detay sayfanızın route'u
            ];
        }));
    }

    // Placement güncelle
    public function updatePlacement(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'placement' => 'required|in:header,footer,both,none',
        ]);
        $menu->update($data);
        return response()->json(['ok'=>true, 'placement'=>$menu->placement]);
    }

    // Yeni menü oluştur (AJAX)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255|unique:menus,slug',
            'placement' => 'required|in:header,footer,both,none',
        ]);

        $slug = $data['slug'] ?: Str::slug($data['name']);
        // benzersizleştir
        $base = $slug; $i = 1;
        while (Menu::where('slug',$slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        $menu = Menu::create([
            'name'      => $data['name'],
            'slug'      => $slug,
            'placement' => $data['placement'],
        ]);

        return response()->json([
            'ok'   => true,
            'menu' => ['id'=>$menu->id, 'name'=>$menu->name, 'slug'=>$menu->slug, 'placement'=>$menu->placement]
        ]);
    }

    public function destroy(Request $request, \App\Models\Menu $menu)
    {
        // Silmeden önce, aynı sayfaya geri dönüldüğünde başka bir menüye geçebilmek için bir aday belirleyelim
        $next = \App\Models\Menu::where('id', '!=', $menu->id)->first();

        \DB::transaction(function () use ($menu) {
            // FK cascade yoksa güvence olsun:
            $menu->items()->delete();
            $menu->delete();
        });

        $redirect = $next
            ? route('admin.menus.index', ['menu' => $next->id])
            : route('admin.menus.index'); // hiç menü kalmadıysa index kendi default'unu oluşturur

        return response()->json(['ok' => true, 'redirect' => $redirect]);
    }

}
