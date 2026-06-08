@extends('backend.layouts.master')

@section('content')
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Category Management</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Manage your clothes shop categories here.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ url('categories/create') }}" class="btn" style="background-color: #e6f9f0; color: #065f46; font-weight: 600; border: none; border-radius: 10px; padding: 10px 20px;">
                <i class="ri-add-line me-1"></i> Add New Category
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
                        <th style="border: none; padding: 15px; color: #64748b;">#</th>
                        <th style="border: none; padding: 15px; color: #64748b;">Category Name</th>
                        <th style="border: none; padding: 15px; color: #64748b;">URL Slug</th>
                        <th style="border: none; padding: 15px; color: #64748b;">Status</th>
                        <th style="border: none; padding: 15px; color: #64748b; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $key => $category)
                    <tr style="background-color: #ffffff;">
                        <td style="padding: 15px; vertical-align: middle;">{{ $key + 1 }}</td>
                        <td style="padding: 15px; vertical-align: middle; font-weight: 600; color: #1e293b;">{{ $category->name }}</td>
                        <td style="padding: 15px; vertical-align: middle; color: #64748b;">{{ $category->slug }}</td>
                        
                        <td style="padding: 15px; vertical-align: middle;">
                            @if($category->status == 1)
                                <span style="background-color: #e6f9f0; color: #065f46; padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 600;">Active</span>
                            @else
                                <span style="background-color: #f1f5f9; color: #475569; padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 600;">Inactive</span>
                            @endif
                        </td>
                        
                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                            <a href="{{ url('categories/'.$category->id.'/edit') }}" class="btn btn-sm" style="background-color: #eff6ff; color: #1e40af; border: none; border-radius: 6px; margin-right: 5px; font-weight: 600;">Edit</a>
                            <a href="{{ url('categories/'.$category->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-sm" style="background-color: #fee2e2; color: #991b1b; border: none; border-radius: 6px; font-weight: 600; text-decoration: none;">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #64748b; font-weight: 500;">
                            <i class="ri-inbox-line" style="font-size: 2rem; display: block; margin-bottom: 10px; color: #94a3b8;"></i>
                            နမူနာ Category မရှိသေးပါ။
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection