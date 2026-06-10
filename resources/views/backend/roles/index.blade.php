@extends('backend.layouts.master')
@section('title', 'Roles')
@section('content')
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Role Management</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Manage user roles and permissions here.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.roles.create') }}" class="btn" style="background-color: #e6f9f0; color: #065f46; font-weight: 600; border: none; border-radius: 10px; padding: 10px 20px;">
                <i class="ri-add-line me-1"></i> Add New Role
            </a>
        </div>
    </div>          
</div>

<div class="contentbar" style="padding-top: 10px;">
    <div class="card" style="border: none; border-radius: 14px; background-color: #ffffff; padding: 15px;">
        <div class="table-responsive">
            <table class="table" style="border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr style="background-color: #f8fafc; border: none;">
                        <th style="border: none; padding: 15px;">#</th>
                        <th style="border: none; padding: 15px;">Role Name</th>
                        <th style="border: none; padding: 15px;">Permissions</th>
                        <th style="border: none; padding: 15px;">Guard Name</th>
                        <th style="border: none; padding: 15px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $key => $role)
                    <tr style="background-color: #ffffff;">
                        <td style="padding: 15px;">{{ $key + 1 }}</td>
                        <td style="padding: 15px; font-weight: 600; color: #1e293b;">
                            <span class="badge" style="background-color: #e0e7ff; color: #3730a3; padding: 5px 12px; border-radius: 6px;">
                                {{ $role->name }}
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            @foreach($role->permissions->take(5) as $permission)
                                <span style="background-color: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; display: inline-block; margin: 2px;">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                            @if($role->permissions->count() > 5)
                                <span class="text-muted">+{{ $role->permissions->count() - 5 }} more</span>
                            @endif
                        </td>
                        <td style="padding: 15px;">{{ $role->guard_name }}</td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm" style="background-color: #eff6ff; color: #1e40af; border: none; border-radius: 6px; margin-right: 5px;">
                                Edit
                            </a>
                            @if($role->name !== 'admin')
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #fee2e2; color: #991b1b; border: none; border-radius: 6px;" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px;">No roles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection