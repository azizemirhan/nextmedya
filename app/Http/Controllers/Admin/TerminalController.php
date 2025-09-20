<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class TerminalController extends Controller
{
    public function index()
    {
        // Session'daki dizin bilgisini temizleyerek yeni bir başlangıç yapalım
        session()->forget('terminal_cwd');
        return view('admin.terminal.index');
    }

    public function execute(Request $request)
    {
        $request->validate(['command' => 'required|string']);

        $command = $request->input('command');

        // Session'dan mevcut dizini al, yoksa projenin ana dizinini kullan
        $cwd = session('terminal_cwd', base_path());

        // 'cd' komutu, çalışan bir süreç olmadığı için özel olarak ele alınmalıdır.
        // Dizin değiştirip bu bilgiyi session'a kaydederiz.
        if (str_starts_with($command, 'cd ')) {
            // 'cd' ve boşluktan sonrasını al
            $newDir = trim(substr($command, 3));

            // Mevcut dizine göre yeni dizinin tam yolunu bul
            // realpath fonksiyonu, '..' gibi ifadeleri de çözümler.
            $targetDir = realpath($cwd . '/' . $newDir);

            if ($targetDir && is_dir($targetDir)) {
                // Yeni dizin geçerliyse session'a kaydet
                session(['terminal_cwd' => $targetDir]);
                return response()->json([
                    'output' => '',
                    'cwd' => $targetDir
                ]);
            } else {
                return response()->json([
                    'output' => "bash: cd: {$newDir}: Böyle bir dosya veya dizin yok",
                    'cwd' => $cwd
                ]);
            }
        }

        $process = Process::fromShellCommandline($command, $cwd);
        $process->run();

        // Başarılı komutlardan sonra (özellikle git pull gibi) dizin değişmiş olabileceğinden
        // Cwd'yi tekrar kontrol etmekte fayda var. Şimdilik sabit tutuyoruz.
        return response()->json([
            'output' => $process->getOutput() . $process->getErrorOutput(),
            'cwd' => $cwd
        ]);
    }
}
