<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Bu hafta başlangıcı ve sonu
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Widget kartları için istatistikler
        $stats = [
            'total_accounts' => Account::count(),
            'new_accounts_this_week' => Account::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),

            'total_contacts' => Contact::count(),
            'new_contacts_this_week' => Contact::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),

            'total_tasks' => Task::count(),
            'active_tasks' => Task::whereIn('status', ['open', 'in_progress'])->count(),

            'total_users' => User::count(),
            'new_users_this_week' => User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
        ];

        // Listeler için veriler
        $recent_tasks = Task::with('taskList', 'board')->latest()->take(5)->get();
        $recent_accounts = Account::latest()->take(5)->get();


        return view('admin.dashboard', compact('stats', 'recent_tasks', 'recent_accounts'));
    }
}
