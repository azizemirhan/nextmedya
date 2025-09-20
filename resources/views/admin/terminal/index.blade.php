@extends('admin.layouts.master')
@section('title', 'Terminal')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/xterm/css/xterm.css" />
    <style>
        .xterm-viewport {
            width: 100% !important; /* Genişlik sorununu düzeltir */
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header"><h5 class="mb-0">Sunucu Terminali</h5></div>
        <div class="card-body p-0">
            <div id="terminal" style="height: 600px; width: 100%;"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/xterm/lib/xterm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xterm-addon-fit/lib/xterm-addon-fit.js"></script>
    <script>
        const term = new Terminal({
            cursorBlink: true,
            convertEol: true,
            fontFamily: `'Fira Mono', monospace`,
            fontSize: 14,
        });
        const fitAddon = new FitAddon.FitAddon();
        term.loadAddon(fitAddon);
        term.open(document.getElementById('terminal'));
        fitAddon.fit();

        let currentLine = '';
        let cwd = '~'; // Başlangıçta ~ gösterelim, ilk komuttan sonra gerçek dizin gelecek.

        const CSRF_TOKEN = '{{ csrf_token() }}';
        const EXECUTE_URL = "{{ route('admin.api.terminal.execute') }}";

        // Terminal prompt'unu yazdıran fonksiyon
        function writePrompt() {
            currentLine = '';
            term.write(`\r\n\x1b[32muser@server\x1b[0m:\x1b[34m${cwd}\x1b[0m$ `);
        }

        async function runCommand(command) {
            term.writeln(''); // Yeni satıra geç
            try {
                const response = await fetch(EXECUTE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({ command: command })
                });

                const data = await response.json();

                // Gelen çıktıyı satır sonlarını düzelterek yazdır
                if (data.output) {
                    term.write(data.output.replace(/\n/g, '\r\n'));
                }

                // Mevcut dizini güncelle
                cwd = data.cwd;
            } catch (error) {
                term.writeln(`\r\n\x1b[31mError: ${error.message}\x1b[0m`);
            }
            writePrompt();
        }

        term.onKey(async ({ key, domEvent }) => {
            const printable = !domEvent.altKey && !domEvent.ctrlKey && !domEvent.metaKey;

            if (domEvent.keyCode === 13) { // Enter tuşu
                if (currentLine.trim()) {
                    await runCommand(currentLine);
                } else {
                    term.writeln('');
                    writePrompt();
                }
            } else if (domEvent.keyCode === 8) { // Backspace
                if (currentLine.length > 0) {
                    term.write('\b \b');
                    currentLine = currentLine.slice(0, -1);
                }
            } else if (printable) {
                currentLine += key;
                term.write(key);
            }
        });

        // Başlangıç prompt'u
        writePrompt();

    </script>
@endpush
