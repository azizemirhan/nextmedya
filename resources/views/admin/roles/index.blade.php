@extends('admin.layouts.master')
@section('title', 'Rol Yönetimi')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Roller</h5>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Yeni Rol Ekle</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Rol Adı</th>
                    <th>İzinler</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach($role->permissions->take(5) as $permission)
                                <span class="badge bg-secondary">{{ $permission->name }}</span>
                            @endforeach
                            @if($role->permissions->count() > 5)
                                <span class="badge bg-info">+{{ $role->permissions->count() - 5 }} daha</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-info">Düzenle</a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu rolü silmek istediğinizden emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
