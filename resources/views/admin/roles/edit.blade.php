@extends('admin.layouts.master')
@section('title', 'Rolü Düzenle')

@section('content')
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Rolü Düzenle: {{ $role->name }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Rol Adı</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                </div>
                <hr>
                <h6>İzinler</h6>
                <div class="row">
                    @foreach ($permissions as $group => $permissionList)
                        <div class="col-md-4 mb-3">
                            <strong>{{ ucfirst($group) }}</strong>
                            @foreach ($permissionList as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}"
                                           @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </div>
    </form>
@endsection
