<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\NewsletterSubscriber;
use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Bu haftanın başlangıç tarihini alıyoruz
        $startOfWeek = Carbon::now()->startOfWeek();

        // İstatistikleri hesaplayıp bir diziye atıyoruz
        $stats = [
            // Kullanıcı (User) İstatistikleri
            'total_users' => User::count(),
            'new_users_this_week' => User::where('created_at', '>=', $startOfWeek)->count(),

            // Ön Yüz (Frontend) Modelleri
            'total_pages' => Page::count(),
            'total_posts' => Post::count(),
            'total_projects' => Project::count(),
            'total_services' => Service::count(),
            'total_sliders' => Slider::count(),
            'total_testimonials' => Testimonial::count(),
            'total_faqs' => Faq::count(),
            'total_statistics' => Statistic::count(),
            'total_team_members' => TeamMember::count(),
            'total_features' => Feature::count(),
        ];

        $cards = [
            'contact_unread' => ContactMessage::unread()->count(),
            'contact_today' => ContactMessage::whereDate('created_at', today())->count(),
            'contact_week' => ContactMessage::where('created_at', '>=', now()->subDays(7))->count(),
        ];
        $cards['subs_total'] = NewsletterSubscriber::where('status', 'confirmed')->count();
        $cards['subs_pending'] = NewsletterSubscriber::where('status', 'pending')->count();
        $cards['subs_unsub'] = NewsletterSubscriber::where('status', 'unsubscribed')->count();
        $cards['subs_last7'] = NewsletterSubscriber::where('created_at', '>=', now()->subDays(7))->count();


        // Verileri view'a 'stats' değişkeni ile gönderiyoruz
        return view('admin.dashboard', compact('stats', 'cards'));
    }
    public function home()
    {
        // Bu haftanın başlangıç tarihini alıyoruz
        $startOfWeek = Carbon::now()->startOfWeek();

        // İstatistikleri hesaplayıp bir diziye atıyoruz
        $stats = [
            // Müşteri (Account) İstatistikleri
            'total_accounts' => Account::count(),
            'new_accounts_this_week' => Account::where('created_at', '>=', $startOfWeek)->count(),

            // Kişi (Contact) İstatistikleri
            'total_contacts' => Contact::count(),
            'new_contacts_this_week' => Contact::where('created_at', '>=', $startOfWeek)->count(),

            // Görev (Task) İstatistikleri
            // 'active_tasks' için kendi projenizdeki mantığı kullanın.
            // Örnek: status sütunu 'completed' olmayanlar.
            'active_tasks' => Task::where('status', '!=', 'completed')->count(),
            'total_tasks' => Task::count(),

            // Kullanıcı (User) İstatistikleri
            'total_users' => User::count(),
            'new_users_this_week' => User::where('created_at', '>=', $startOfWeek)->count(),
        ];

        // Verileri view'a 'stats' değişkeni ile gönderiyoruz
        return view('admin.dashboard', compact('stats'));
    }

}
