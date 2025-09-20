@extends('admin.layouts.master')

@section('title', 'Şirketler')

@section('content')
    <div class="container-fluid">

        {{-- Üst Başlık & Buton --}}

        {{-- Arama & Filtre --}}
        <form method="GET" action="{{ route('admin.accounts.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                        placeholder="İsim, e-posta, telefon ara...">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Durum (tümü)</option>
                        <option value="active" @selected(request('status') == 'active')>Aktif</option>
                        <option value="inactive" @selected(request('status') == 'inactive')>Pasif</option>
                        <option value="prospect" @selected(request('status') == 'prospect')>Aday</option>
                        <option value="churned" @selected(request('status') == 'churned')>Kaybedildi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="owner_id" class="form-select">
                        <option value="">Sahip (tümü)</option>
                        @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}" @selected(request('owner_id') == $owner->id)>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary w-100" type="submit">
                        <i class="bi bi-search"></i> Ara
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Yeni Şirket
                    </a>
                </div>
            </div>
        </form>

        {{-- Şirketler Tablosu --}}
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Ad</th>
                            <th>E-posta</th>
                            <th>Telefon</th>
                            <th>Sektör</th>
                            <th>Durum</th>
                            <th>Sahip</th>
                            <th class="text-end">Aksiyonlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accounts as $account)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.accounts.preview', $account) }}" class="fw-semibold">
                                        {{ $account->name }}
                                    </a>
                                </td>
                                <td>{{ $account->primary_email }}</td>
                                <td>{{ $account->primary_phone }}</td>
                                <td>{{ $account->industry ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($account->status == 'active') bg-success
                                    @elseif($account->status == 'inactive') bg-secondary
                                    @elseif($account->status == 'prospect') bg-info
                                    @elseif($account->status == 'churned') bg-danger @endif">
                                        {{ ucfirst($account->status) }}
                                    </span>
                                </td>
                                <td>{{ $account->owner?->name ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.accounts.edit', $account) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.accounts.destroy', $account) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Hiç kayıt bulunamadı</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Sayfalama --}}
                <div class="mt-3">
                    {{ $accounts->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
