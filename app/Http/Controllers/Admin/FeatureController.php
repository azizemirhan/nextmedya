<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $q = Feature::query();

        if ($s = $request->get('s')) {
            $q->where('title->tr', 'like', "%{$s}%")
                ->orWhere('title->en', 'like', "%{$s}%")
                ->orWhere('description->tr', 'like', "%{$s}%")
                ->orWhere('description->en', 'like', "%{$s}%");
        }

        $features = $q->orderBy('order')->latest()->paginate(15);

        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        $feature = new Feature();
        return view('admin.features.create', compact('feature'));
    }

    public function store(FeatureRequest $request)
    {
        $data = $request->validated();
        Feature::create($data);
        return redirect()->route('admin.features.index')
            ->with('success', 'Özellik başarıyla eklendi.');
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(FeatureRequest $request, Feature $feature)
    {
        $data = $request->validated();
        $feature->update($data);

        return redirect()->route('admin.features.index')
            ->with('success', 'Özellik güncellendi.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('admin.features.index')
            ->with('success', 'Özellik silindi.');
    }
}
