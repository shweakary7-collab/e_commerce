<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'E-Commerce Store'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .product-card { transition: transform 0.3s; margin-bottom: 20px; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .product-image { height: 200px; object-fit: cover; }
        .cart-badge { position: absolute; top: -8px; right: -8px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; }
        .footer { background: #343a40; color: white; padding: 20px 0; margin-top: 40px; }
        .btn-group { flex-wrap: wrap; gap: 5px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">E-Commerce Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form action="<?php echo e(route('home')); ?>" method="GET" class="d-flex me-auto">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search products..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu">
                                
                                <?php if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff')): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">Admin Dashboard</a></li>
                                <?php endif; ?>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                    <?php endif; ?>
                    
                    
                    <?php
                        $user = Auth::user();
                        $isAdminOrStaff = $user && ($user->hasRole('admin') || $user->hasRole('staff'));
                    ?>
                    
                    <?php if(!$isAdminOrStaff): ?>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="<?php echo e(route('cart.index')); ?>">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <?php
                                if (Auth::check()) {
                                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                                } else {
                                    $cartCount = \App\Models\Cart::where('session_id', session()->getId())
                                        ->whereNull('user_id')
                                        ->count();
                                }
                            ?>
                            <?php if($cartCount > 0): ?>
                                <span class="cart-badge"><?php echo e($cartCount); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <main><?php echo $__env->yieldContent('content'); ?></main>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; <?php echo e(date('Y')); ?> E-Commerce Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\laragon\www\e_commerce\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>