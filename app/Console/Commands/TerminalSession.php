<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\Channel;

class TerminalSession extends Command
{
    protected $signature = 'terminal:session {userId}';
    protected $description = 'Starts a new terminal session for a user';

    public function handle()
    {
        $userId = $this->argument('userId');
        $channelName = "terminal.{$userId}";

        $this->info("Starting terminal session for user {$userId} on channel {$channelName}");

        // Temel komutları ve çalışma dizinini ayarla
        $descriptorspec = [
            0 => ["pipe", "r"],  // stdin
            1 => ["pipe", "w"],  // stdout
            2 => ["pipe", "w"]   // stderr
        ];
        $cwd = base_path(); // Başlangıç dizini
        $process = proc_open('bash', $descriptorspec, $pipes, $cwd);

        if (is_resource($process)) {
            // Canlı I/O için non-blocking moda al
            stream_set_blocking($pipes[1], 0);
            stream_set_blocking($pipes[2], 0);

            // Gelen komutları dinle
            \Illuminate\Support\Facades\Redis::subscribe(["terminal-input-{$userId}"], function (string $message) use ($pipes) {
                fwrite($pipes[0], $message);
            });

            // Çıktıyı sürekli olarak WebSocket'e gönder
            while (true) {
                $output = stream_get_contents($pipes[1]);
                if ($output) {
                    broadcast(new \App\Events\TerminalOutput($channelName, $output));
                }

                $error = stream_get_contents($pipes[2]);
                if ($error) {
                    broadcast(new \App\Events\TerminalOutput($channelName, $error));
                }
                usleep(10000); // 10ms bekle
            }

            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);
        }
    }
}
