<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatisticRequest;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $q = Statistic::query();

        if ($s = $request->get('s')) {
            $q->where('number', 'like', "%{$s}%")
                ->orWhere('title->tr', 'like', "%{$s}%")
                ->orWhere('title->en', 'like', "%{$s}%");
        }

        $statistics = $q->orderBy('order')->latest()->paginate(15);

        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        $statistic = new Statistic();
        return view('admin.statistics.create', compact('statistic'));
    }

    public function store(StatisticRequest $request)
    {
        $data = $request->validated();
        Statistic::create($data);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'İstatistik başarıyla eklendi.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(StatisticRequest $request, Statistic $statistic)
    {
        $data = $request->validated();
        $statistic->update($data);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'İstatistik güncellendi.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
            ->with('success', 'İstatistik silindi.');
    }
}
