<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">Admin Panel</a>
            <div class="d-flex">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-light me-2">View Site</a>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button type="submit" class="btn btn-danger">Logout</button></form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block bg-light sidebar" style="min-height: calc(100vh - 56px);">
                <div class="pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.products.index')); ?>"><i class="fas fa-box"></i> Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.orders.index')); ?>"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.roles.index')); ?>"><i class="fas fa-shopping-cart"></i> Roles</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.users.index')); ?>"><i class="fas fa-shopping-cart"></i> Users</a></li>
                    </ul>
                </div>
            </nav>
            
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
                    <?php if(session('error')): ?><div class="alert alert-danger"><?php echo e(session('error')); ?></div><?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/layouts/master.blade.php ENDPATH**/ ?>