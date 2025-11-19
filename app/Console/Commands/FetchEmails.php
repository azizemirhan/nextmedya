<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\Mail as MailModel;
use App\Models\User;

class FetchEmails extends Command
{
    protected $signature = 'mail:fetch';
    protected $description = 'Fetch incoming emails from the IMAP server';

    public function handle()
    {
        $this->info("Connecting to IMAP server...");
        try {
            $client = Client::account('default');
            $client->connect();
            $this->info("Connection successful.");

            $inbox = $client->getFolder('INBOX');
            $messages = $inbox->messages()->unseen()->get();

            $this->info("Found " . $messages->count() . " new messages.");

            $recipientUser = User::where('email', env('IMAP_USERNAME'))->first();
            if (!$recipientUser) {
                $this->error("Recipient user " . env('IMAP_USERNAME') . " not found in the database.");
                return;
            }

            foreach ($messages as $message) {
                $subject = (string)$message->getSubject(); // Konuyu string'e çevirelim
                $this->info("Processing message: " . $subject);

                $dataToSave = [
                    'sender_id' => null,
                    'sender_name' => $message->getFrom()[0]->personal,
                    'sender_email' => $message->getFrom()[0]->mail,
                    'recipient_id' => $recipientUser->id,
                    'subject' => $subject, // Değiştirildi
                    'body' => $message->getHtmlBody() ?: $message->getTextBody(),
                    'is_read' => false,
                    'created_at' => $message->getDate(),
                ];

                // VERİTABANINA KAYDETMEDEN ÖNCE VERİYİ LOG DOSYASINA YAZALIM
                \Log::info('Attempting to save email:', $dataToSave);

                MailModel::create($dataToSave);

                $message->setFlag('Seen');
            }

            $this->info("Email fetching complete.");

        } catch (\Exception $e) {
            // Hata olursa detaylıca log'a yaz
            \Log::error('IMAP Fetch Error: ' . $e->getMessage());
            $this->error("An error occurred: " . $e->getMessage());
        }
    }
}
