
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-3"><div class="card text-white bg-primary"><div class="card-body"><h5>Total Products</h5><h2><?php echo e($totalProducts); ?></h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-success"><div class="card-body"><h5>Total Orders</h5><h2><?php echo e($totalOrders); ?></h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-info"><div class="card-body"><h5>Total Revenue</h5><h2>$<?php echo e(number_format($totalRevenue, 2)); ?></h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-warning"><div class="card-body"><h5>Total Users</h5><h2><?php echo e($totalUsers); ?></h2></div></div></div>
</div>
<div class="card mt-4"><div class="card-header"><h5>Recent Orders</h5></div><div class="card-body">
    <table class="table"><thead><tr><th>Order #</th><th>User</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody><?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr><td><?php echo e($order->order_number); ?></td><td><?php echo e($order->user->name); ?></td><td>$<?php echo e(number_format($order->total_amount, 2)); ?></td><td><?php echo e($order->status); ?></td><td><?php echo e($order->created_at->format('Y-m-d')); ?></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
    </table>
</div></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\e_commerce\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>