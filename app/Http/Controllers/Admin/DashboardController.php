<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// Bunu ekleyebilirsiniz

class DashboardController extends Controller
{
    /**
     * Admin panelinin ana sayfasını gösterir.
     */
    public function index()
    {
        // Gelecekte buraya istatistikler, son kayıtlar gibi verileri gönderirsiniz.
        // Örnek: $userCount = User::count();
        // return view('admin.dashboard', ['userCount' => $userCount]);

        return view('admin.dashboard');
    }
}
