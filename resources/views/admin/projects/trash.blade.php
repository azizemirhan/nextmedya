@extends('admin.layouts.master')


@section('title', 'Projeler · Çöp Kutusu')


@section('content')
<div class="container-fluid">
<div class="card">
<div class="card-header d-flex align-items-center justify-content-between">
<h5 class="mb-0">Çöp Kutusu</h5>
<a href="{{ route('admin.projects.index') }}" class="btn btn-light">← Listeye Dön</a>
</div>
<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th>#</th>
<th>Başlık</th>
<th>Silinme</th>
<th class="text-end">İşlemler</th>
</tr>
</thead>
<tbody>
@forelse ($projects as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->title['tr'] ?? '-' }}</td>
<td>{{ optional($p->deleted_at)->format('d.m.Y H:i') }}</td>
<td class="text-end">
<form action="{{ route('admin.projects.restore', $p->id) }}" method="POST" class="d-inline">
@csrf
<button class="btn btn-sm btn-success">Geri Yükle</button>
</form>
<form action="{{ route('admin.projects.forceDelete', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Kalıcı olarak silinsin mi? Bu işlem geri alınamaz.');">
@csrf
@method('DELETE')
<button class="btn btn-sm btn-outline-danger">Kalıcı Sil</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center text-muted">Çöp kutusu boş.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
@if ($projects->hasPages())
<div class="card-footer">{{ $projects->links() }}</div>
@endif
</div>
</div>
@endsection
