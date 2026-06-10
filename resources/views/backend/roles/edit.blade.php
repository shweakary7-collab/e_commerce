@extends('backend.layouts.master')
@section('title', 'Edit Role')
@section('content')
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Edit Role: {{ $role->name }}</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Update role permissions.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.roles.index') }}" class="btn" style="background-color: #f1f5f9; color: #475569; font-weight: 600; border: none; border-radius: 10px; padding: 10px 20px;">
                <i class="ri-arrow-left-line me-1"></i> Back to List
            </a>
        </div>
    </div>          
</div>

<div class="contentbar" style="padding-top: 10px;">
    <div class="card" style="border: none; border-radius: 14px; background-color: #ffffff; padding: 25px;">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="form-group mb-4">
                <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Role Name</label>
                <input type="text" name="name" value="{{ $role->name }}" class="form-control" style="border: 2px solid #f1f5f9; border-radius: 10px; padding: 12px;" required>
            </div>
            
            <div class="form-group mb-4">
                <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" class="form-check-input" {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                            <label for="perm_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="btn" style="background-color: #e6f9f0; color: #065f46; font-weight: 700; border: none; border-radius: 10px; padding: 12px 25px;">
                <i class="ri-refresh-line me-1"></i> Update Role
            </button>
        </form>
    </div>
</div>
@endsection