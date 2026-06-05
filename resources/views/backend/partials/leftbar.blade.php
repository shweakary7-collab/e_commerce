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
                        <li>
                            <a href="{{route('admin.dashboard')}}">
                                <i class="ri-user-6-fill"></i><span>Dashboard</span>
                            </a>
                        </li>
                <li class="{{ Request::is('admin/categories*') || Request::is('admin/products/create') ? 'active' : '' }}">
                    <a href="javaScript:void(0);">
                        <i class="ri-shirt-line"></i><span>Category </span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ url('/categories') }}" class="{{ Request::is('admin/categories*') ? 'active' : '' }}">Category (CRUD)</a>
                        </li>
                    </ul>
                </li>  
                <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                    <a href="javaScript:void(0);">
                        <i class="ri-shirt-line"></i><span>Products</span>
                        <i class="ri-arrow-right-s-line icon-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li>
                            <a href="{{ url('/products') }}" class="{{ Request::is('admin/products') ? 'active' : '' }}">Product List</a>
                        </li>
                        <li>
                            <a href="{{ url('/products/create') }}" class="{{ Request::is('admin/products/create') ? 'active' : '' }}">Add New Product</a>
                        </li>
                    </ul>
                </li>  
                <li class="{{ Request::is('/orders*') ? 'active' : '' }}">
                <a href="javaScript:void(0);">
                    <i class="ri-shopping-bag-3-line"></i><span>Order </span>
                    <i class="ri-arrow-right-s-line icon-right"></i>
                </a>
                <ul class="vertical-submenu">
                    <li>
                        <a href="{{ url('/orders') }}">Order List</a>
                    </li>
                </ul>
                </li>                                  
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->