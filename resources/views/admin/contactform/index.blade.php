{{-- resources/views/admin/contacts/index.blade.php --}}
@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">İletişim Mesajları</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.contactforms.export') }}" class="btn btn-outline-secondary btn-sm">CSV Aktar</a>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card"><div class="card-body">
                    <div class="text-muted">Toplam</div>
                    <div class="h4 mb-0">{{ $stats['total'] }}</div>
                </div></div>
        </div>
        <div class="col-md-3">
            <div class="card"><div class="card-body">
                    <div class="text-muted">Okunmamış</div>
                    <div class="h4 mb-0">{{ $stats['unread'] }}</div>
                </div></div>
        </div>
        <div class="col-md-3">
            <div class="card"><div class="card-body">
                    <div class="text-muted">Son 7 Gün</div>
                    <div class="h4 mb-0">{{ $stats['last7'] }}</div>
                </div></div>
        </div>
        <div class="col-md-3">
            <div class="card"><div class="card-body">
                    <div class="text-muted">Son 30 Gün</div>
                    <div class="h4 mb-0">{{ $stats['last30'] }}</div>
                </div></div>
        </div>
    </div>

    <form method="get" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Ara</label>
                <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="İsim, e-posta, konu, mesaj">
            </div>
            <div class="col-md-2">
                <label class="form-label">Başlangıç</label>
                <input type="date" name="from" value="{{ $dateFrom }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Bitiş</label>
                <input type="date" name="to" value="{{ $dateTo }}" class="form-control">
            </div>
            <div class="col-md-2 form-check mt-4">
                <input class="form-check-input" type="checkbox" name="unread" value="1" id="unread" {{ $onlyUnread?'checked':'' }}>
                <label class="form-check-label" for="unread">Sadece okunmamış</label>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filtrele</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th><th>Tarih</th><th>Gönderen</th><th>Konu</th><th>Durum</th><th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $m)
                    <tr class="{{ is_null($m->read_at) ? 'table-warning' : '' }}">
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="fw-semibold">{{ $m->name }}</div>
                            <div class="text-muted small">{{ $m->email }}</div>
                        </td>
                        <td class="text-truncate" style="max-width: 360px;">
                            <div class="fw-semibold">{{ $m->subject }}</div>
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($m->message, 120) }}</div>
                        </td>
                        <td>
                            @if($m->read_at)
                                <span class="badge bg-success">Okundu</span>
                            @else
                                <span class="badge bg-warning text-dark">Okunmadı</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.contactforms.show',$m->id) }}">Görüntüle</a>
                            @if(is_null($m->read_at))
                                <form action="{{ route('admin.contactforms.read',$m->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">Okundu</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.contactforms.destroy',$m->id) }}" method="post" class="d-inline" onsubmit="return confirm('Silinsin mi?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">Kayıt yok.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
