@extends('backend.layouts.master')

@section('content')
<div class="breadcrumbbar" style="background: transparent; padding: 25px 0 15px 0;">
    <div class="row align-items-center justify-content-between">
        <div class="col-md-6">
            <h4 class="page-title" style="font-weight: 700; color: #1e293b; font-size: 1.5rem;">Create Category</h4>
            <p class="text-muted" style="font-size: 0.85rem; margin-top: -5px;">Add a new category for your clothes shop.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ url('categories') }}" class="btn" style="background-color: #f1f5f9; color: #475569; font-weight: 600; border: none; border-radius: 10px; padding: 10px 20px;">
                <i class="ri-arrow-left-line me-1"></i> Back to List
            </a>
        </div>
    </div>          
</div>

<div class="contentbar" style="padding-top: 10px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="border: none; border-radius: 14px; background-color: #ffffff; padding: 25px;">
                <div class="card-body p-0">
                    
                    <form action="{{ url('categories/store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter category name (e.g. T-Shirt, Jeans)" style="border: 2px solid #f1f5f9; border-radius: 10px; padding: 12px; font-size: 0.95rem; background-color: #f8fafc;" required>
                        </div>

                        <div class="form-group mb-4">
                            <label style="font-weight: 600; color: #475569; margin-bottom: 8px;">Status</label>
                            <select name="status" class="form-control" style="border: 2px solid #f1f5f9; border-radius: 10px; padding: 8px 12px; font-size: 0.95rem; background-color: #f8fafc;">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn" style="background-color: #eff6ff; color: #1e40af; font-weight: 700; border: none; border-radius: 10px; padding: 12px 25px; width: 100%;">
                            <i class="ri-save-line me-1"></i> Save Category
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection