@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Aboneler</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.subscribers.export', request()->query()) }}"
               class="btn btn-outline-secondary btn-sm">
                CSV Aktar
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Filtreler --}}
    <form method="get" class="card card-body mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Ara</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="email">
            </div>
            <div class="col-md-3">
                <label class="form-label">Durum</label>
                <select name="status" class="form-select">
                    @php $status = request('status'); @endphp
                    <option value="">Hepsi</option>
                    <option value="confirmed" {{ $status==='confirmed'?'selected':'' }}>confirmed</option>
                    <option value="pending" {{ $status==='pending'?'selected':'' }}>pending</option>
                    <option value="unsubscribed"{{ $status==='unsubscribed'?'selected':'' }}>unsubscribed</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Başlangıç</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Bitiş</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary w-100">Filtrele</button>
            </div>
        </div>
    </form>

    {{-- Liste --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tarih</th>
                    <th>E-posta</th>
                    <th>Durum</th>
                    <th>IP</th>
                    <th>UA</th>
                    <th class="text-end">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @forelse($subscribers as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->created_at?->format('d.m.Y H:i') }}</td>
                        <td class="fw-semibold">{{ $s->email }}</td>
                        <td>
                            @switch($s->status)
                                @case('confirmed')
                                    <span class="badge bg-success">confirmed</span>
                                    @break
                                @case('pending')
                                    <span class="badge bg-warning text-dark">pending</span>
                                    @break
                                @case('unsubscribed')
                                    <span class="badge bg-secondary">unsubscribed</span>
                                    @break
                                @default
                                    <span class="badge bg-light text-dark">{{ $s->status }}</span>
                            @endswitch
                        </td>
                        <td class="text-muted small">{{ $s->ip }}</td>
                        <td class="text-muted small text-truncate" style="max-width: 260px;">
                            {{ $s->user_agent }}
                        </td>
                        <td class="text-end">
                            @if($s->status !== 'unsubscribed')
                                <form action="{{ route('admin.subscribers.unsubscribe', $s->id) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary" title="Unsubscribe">Çıkar</button>
                                </form>
                            @endif
                            @if($s->status !== 'confirmed')
                                <form action="{{ route('admin.subscribers.resubscribe', $s->id) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success" title="Resubscribe">Aktifleştir
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.subscribers.destroy', $s->id) }}" method="post"
                                  class="d-inline" onsubmit="return confirm('Kalıcı olarak silinsin mi?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Kayıt bulunamadı.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $subscribers->links() }}
        </div>
    </div>
@endsection
