@extends('backend.layouts.master')

@section('title', 'Create User')

@section('content')
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Create New User</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Add a new user and assign roles</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="ri-arrow-left-line me-1"></i> Back to List
            </a>
        </div>
    </div>
</div>

<div class="contentbar" style="padding-top: 10px;">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Assign Roles <span class="text-danger">*</span></label>
                        <div class="row">
                            @foreach($roles as $role)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                           id="role_{{ $role->id }}" class="form-check-input">
                                    <label for="role_{{ $role->id }}" class="form-check-label">
                                        @if($role->name == 'admin')
                                            <span class="badge bg-danger">{{ $role->name }}</span>
                                        @elseif($role->name == 'staff')
                                            <span class="badge bg-warning">{{ $role->name }}</span>
                                        @else
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-line me-1"></i> Create User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection