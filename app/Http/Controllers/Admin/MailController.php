<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mail;

// Veritabanı modelimiz (buna dokunmuyoruz)
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OutgoingMessageMail;

use Illuminate\Support\Facades\Mail as LaravelMail;
class MailController extends Controller
{
    // app/Http/Controllers/Admin/MailController.php

    public function index()
    {
        // SAYFA YÜKLENMEDEN ÖNCE MAİLLERİ ÇEKME KOMUTUNU ÇALIŞTIR
        \Artisan::call('mail:fetch');

        // info@tuncay-insaat.com kullanıcısını bul
        $infoUser = User::where('email', 'info@tuncay-insaat.com')->first();

        if ($infoUser) {
            // Eğer info kullanıcısı varsa, o kullanıcıya gelen mailleri listele
            $mails = Mail::where('recipient_id', $infoUser->id)->latest()->paginate(20);
        } else {
            // Eğer bulunamazsa (önlem olarak), boş bir koleksiyon döndür
            $mails = collect();
        }

        return view('admin.mailbox.index', ['mails' => $mails, 'page_title' => 'Gelen Kutusu']);
    }

    public function sent()
    {
        // info@tuncay-insaat.com kullanıcısını bul
        $infoUser = User::where('email', 'info@tuncay-insaat.com')->first();

        if ($infoUser) {
            // Eğer info kullanıcısı varsa, o kullanıcının gönderdiği mailleri listele
            // (Sistem içinden gönderilenler için)
            $mails = Mail::where('sender_id', $infoUser->id)->latest()->paginate(20);
        } else {
            $mails = Mail::where('sender_id', Auth::id())->latest()->paginate(20);
        }

        return view('admin.mailbox.index', ['mails' => $mails, 'page_title' => 'Gönderilmiş Mesajlar']);
    }

    public function create()
    {
        return view('admin.mailbox.compose');
    }

    // app/Http/Controllers/Admin/MailController.php

// app/Http/Controllers/Admin/MailController.php içindeki store fonksiyonu

    public function store(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $senderUser = User::where('email', 'info@tuncay-insaat.com')->first();

        if (!$senderUser) {
            return redirect()->back()->with('error', 'Sistem mail gönderici hesabı bulunamadı.');
        }

        $recipientUser = User::where('email', $request->recipient_email)->first();

        // Veritabanına kaydetme işlemi (Burada `Mail` modelini kullanıyoruz, bu doğru)
        Mail::create([
            'sender_id' => $senderUser->id,
            'recipient_id' => $recipientUser ? $recipientUser->id : null,
            'recipient_email' => $request->recipient_email,
            'subject' => $request->subject,
            'body' => $request->body,
            'is_read' => true,
        ]);

        // GERÇEK E-POSTAYI GÖNDERME İŞLEMİ (Burada takma adı kullanıyoruz)
        try {
            // 'Mail::to' YERİNE 'LaravelMail::to' KULLANIN
            LaravelMail::to($request->recipient_email)->send(new OutgoingMessageMail($request->subject, $request->body));
        } catch (\Exception $e) {
            // Hata ayıklama için log'a yazmak daha iyidir
            \Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'E-posta gönderilirken bir hata oluştu. Lütfen sistem yöneticisi ile görüşün.');
        }

        return redirect()->route('admin.mailbox.sent')->with('success', 'Mesajınız başarıyla gönderildi.');
    }
    public function show(Mail $mail)
    {
        // Güvenlik: Sadece ilgili kullanıcılar maili görebilir
        if ($mail->recipient_id != Auth::id() && $mail->sender_id != Auth::id()) {
            abort(403, 'Bu mesaja erişim yetkiniz yok.');
        }

        // Alıcı ise, okundu olarak işaretle
        if ($mail->recipient_id == Auth::id() && !$mail->is_read) {
            $mail->is_read = true;
            $mail->save();
        }

        return view('admin.mailbox.show', compact('mail'));
    }

    public function destroy(Mail $mail)
    {
        if ($mail->recipient_id != Auth::id() && $mail->sender_id != Auth::id()) {
            abort(403, 'Bu işlemi yapmaya yetkiniz yok.');
        }

        $mail->delete(); // Soft delete

        return redirect()->route('admin.mailbox.index')->with('success', 'Mesaj çöp kutusuna taşındı.');
    }

    public function trash()
    {
        $infoUser = User::where('email', 'info@tuncay-insaat.com')->first();
        $mails = Mail::onlyTrashed()->where('recipient_id', $infoUser->id)->latest()->paginate(20);
        return view('admin.mailbox.index', ['mails' => $mails, 'page_title' => 'Çöp Kutusu']);
    }

    public function restore($id)
    {
        $mail = Mail::onlyTrashed()->findOrFail($id);
        $mail->restore();
        return redirect()->route('admin.mailbox.trash')->with('success', 'Mesaj geri yüklendi.');
    }

    public function forceDelete($id)
    {
        $mail = Mail::onlyTrashed()->findOrFail($id);
        $mail->forceDelete();
        return redirect()->route('admin.mailbox.trash')->with('success', 'Mesaj kalıcı olarak silindi.');
    }

    // app/Http/Controllers/Admin/MailController.php

    public function important()
    {
        $infoUser = User::where('email', 'info@tuncay-insaat.com')->first();
        $mails = Mail::where('is_important', true)
            ->where(function ($query) use ($infoUser) {
                $query->where('recipient_id', $infoUser->id)
                    ->orWhere('sender_id', $infoUser->id);
            })
            ->latest()->paginate(20);

        return view('admin.mailbox.index', ['mails' => $mails, 'page_title' => 'Önemli Mesajlar']);
    }

    public function toggleImportant(Mail $mail)
    {
        $mail->is_important = !$mail->is_important;
        $mail->save();
        return back();
    }
}
