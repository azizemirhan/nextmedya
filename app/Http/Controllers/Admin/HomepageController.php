<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// İlgili Modelleri ekliyoruz
use App\Models\Feature;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Statistic;      // YENİ EKLENDİ
use App\Models\Testimonial;    // YENİ EKLENDİ

class HomepageController extends Controller
{
    /**
     * Anasayfa Yönetim panelini ve içerik istatistiklerini gösterir.
     */
    public function index()
    {
        // Anasayfa içeriklerinin sayılarını hesaplıyoruz
        $stats = [
            'total_sliders' => Slider::count(),
            'active_sliders' => Slider::where('is_active', true)->count(),

            'total_projects' => Project::count(),
            'ongoing_projects' => Project::where('status', 0)->count(),

            'total_services' => Service::count(),

            'total_testimonials' => Testimonial::count(),
            'pending_testimonials' => Testimonial::where('is_active', false)->count(),

            // YENİ EKLENEN İSTATİSTİKLER
            'total_features' => Feature::count(),
            'total_statistics' => Statistic::count(),
        ];

        // Verileri view'a 'stats' değişkeni ile gönderiyoruz
        return view('admin.hometabs', compact('stats'));
    }
}
