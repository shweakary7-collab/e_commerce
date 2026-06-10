<!-- Start Leftbar -->
<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="index.html" class="logo logo-large"><img src="{{ asset('backend/assets/images/logo.svg')}}" class="img-fluid" alt="logo"></a>
            <a href="index.html" class="logo logo-small"><img src="{{ asset('backend/assets/images/small_logo.svg')}}" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
        
                 @php
                    $user = auth()->user();
                    $isAdmin = $user && $user->hasRole('admin');
                @endphp

                <!-- Dashboard -->
                
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-line"></i><span>Dashboard</span>
                    </a>
                </li>

                <!-- Product Menu -->
                @can('view products')
                <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="ri-product-hunt-line"></i><span>Products</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ url('/products') }}" class="{{ Request::is('admin/products') ? 'active' : '' }}">Product List</a>
                        </li>

                        @can('create products')
                        <li>
                            <a href="{{ url('/products/create') }}" class="{{ Request::is('admin/products/create') ? 'active' : '' }}">Add Product</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                
                <!-- Order Menu -->
                @can('view orders')
                <li class="{{ Request::is('admin/orders*') ? 'active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="ri-shopping-cart-line"></i><span>Orders</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ url('/orders') }}">Order List</a>
                        </li>
                    </ul>
                @endcan
                </li>
                
                <!-- Category Menu -->
                @if($isAdmin)
                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="ri-folder-line"></i><span>Categories</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ url('/categories') }}" class="{{ Request::is('admin/categories*') ? 'active' : '' }}">Category List</a>
                        </li>
                        <li>
                            <a href="{{ url('/categories/create') }}" class="{{ Request::is('admin/categories/create') ? 'active' : '' }}">Add Category</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Role Management Menu -->
                <li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="ri-user-settings-line"></i><span>Role Management</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ route('admin.roles.index') }}">Roles List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.create') }}">Add Role</a>
                        </li>
                    </ul>
                </li>
                <!-- User Management Menu -->
                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="ri-user-line"></i><span>User Management</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="{{ Request::is('admin/users') ? 'active' : '' }}">Users List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.roles.create') }}" class="{{ Request::is('admin/users/create') ? 'active' : '' }}">Add New User</a>
                        </li>
                    </ul>
                </li> 
                @endif
            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
    </div>
<!-- End Leftbar -->