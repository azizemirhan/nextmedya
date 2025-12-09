<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class FrontendServiceController extends Controller
{
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $sidebarServices = Service::query()
            ->select(['id','title','slug','summary','cover_image','order','is_active'])
            ->where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('frontend.services.service_detail', [
            'service' => $service,
            'sidebarServices' => $sidebarServices,
            'pageTitle' => $service->getTranslation('title', app()->getLocale()),
            'pageSubtitle' => null,
        ]);
    }
}
