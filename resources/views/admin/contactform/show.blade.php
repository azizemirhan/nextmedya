{{-- resources/views/admin/contacts/show.blade.php --}}
@extends('admin.layouts.master')

@section('content')
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-link">&larr; Listeye dön</a>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <h1 class="h5 mb-3">{{ $m->subject }}</h1>
                <div>
                    @if(!$m->read_at)
                        <form action="{{ route('admin.contacts.read',$m->id) }}" method="post" class="d-inline">@csrf
                            <button class="btn btn-sm btn-outline-success">Okundu</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.contacts.destroy',$m->id) }}" method="post" class="d-inline"
                          onsubmit="return confirm('Silinsin mi?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Sil</button>
                    </form>
                </div>
            </div>

            <dl class="row">
                <dt class="col-sm-2">Gönderen</dt>
                <dd class="col-sm-10">{{ $m->name }} &lt;{{ $m->email }}&gt;</dd>

                <dt class="col-sm-2">Gönderim</dt>
                <dd class="col-sm-10">{{ $m->created_at->format('d.m.Y H:i') }}</dd>

                <dt class="col-sm-2">IP / UA</dt>
                <dd class="col-sm-10">{{ $m->ip }} / <span class="text-muted">{{ $m->user_agent }}</span></dd>
            </dl>

            <hr>
            <pre class="mb-0" style="white-space:pre-wrap;">{{ $m->message }}</pre>
        </div>
    </div>
@endsection
